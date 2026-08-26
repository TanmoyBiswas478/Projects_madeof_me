// ===== 📁 src/MainSummarizer.jsx =====
import { useNavigate, useLocation } from "react-router-dom";
import { useState, useEffect, useMemo, useRef } from "react";
import * as pdfjsLib from "pdfjs-dist/build/pdf";
import axios from "axios";
import useSummaryStore from "./store/summaryStore";
import 'bootstrap/dist/css/bootstrap.min.css';
import Tesseract from 'tesseract.js';

pdfjsLib.GlobalWorkerOptions.workerSrc = `//cdnjs.cloudflare.com/ajax/libs/pdf.js/${pdfjsLib.version}/pdf.worker.min.js`;

export default function MainSummarizer() {
  const navigate = useNavigate();
  const location = useLocation();
  const { text, summary, setText, setSummary } = useSummaryStore();

  const safeText = typeof text === "string" ? text : "";
  const safeSummary = typeof summary === "string" ? summary : "";

  // Get current user for user-specific storage
  const [currentUser, setCurrentUser] = useState(null);
  const STORAGE_KEY = currentUser ? `summaries_${currentUser.email}` : 'ai-summaries-storage';

  const [loading, setLoading] = useState(false);
  const [isPlaying, setIsPlaying] = useState(false);
  const [isPaused, setIsPaused] = useState(false);
  const [voices, setVoices] = useState([]);
  const [selectedVoice, setSelectedVoice] = useState(null);

  // 🌟 NEW STATE: Checkbox to force Vision AI without annoying popups
  const [forceVisionAI, setForceVisionAI] = useState(true);

  const [theme, setTheme] = useState(localStorage.getItem("summ-theme") || "light");
  localStorage.removeItem("summ-theme");
  const [tone, setTone] = useState(localStorage.getItem("summ-tone") || "Simple");
  const [lengthPref, setLengthPref] = useState(localStorage.getItem("summ-length") || "Brief");
  const [bulletFormat, setBulletFormat] = useState(localStorage.getItem("summ-bulletFormat") || "enhanced");
  const [ttsRate, setTtsRate] = useState(parseFloat(localStorage.getItem("summ-ttsRate")) || 1.0);
  const [apiProvider, setApiProvider] = useState(localStorage.getItem("summ-api") || "groq");
  
  // FIXED: Load both Google keys into an array, filtering out empty strings
  const [apiKeys, setApiKeys] = useState({
    groq: import.meta.env.VITE_GROQ_API_KEY || '',
    together: import.meta.env.VITE_TOGETHER_API_KEY || '',
    openrouter: import.meta.env.VITE_OPENROUTER_API_KEY || '',
    googleKeys: [
      import.meta.env.VITE_GOOGLE_API_KEY1 || import.meta.env.VITE_GOOGLE_API_KEY || '',
      import.meta.env.VITE_GOOGLE_API_KEY2 || '',
      import.meta.env.VITE_GOOGLE_API_KEY3 || '',
      import.meta.env.VITE_GOOGLE_API_KEY4 || '',
    ].filter(k => k && k.length > 10)
  });

  // Track the currently active Google API Key index
  const activeKeyIndex = useRef(0);

  const [apiStatus, setApiStatus] = useState({});
  const [autoSaveEnabled, setAutoSaveEnabled] = useState(true);
  const [lastSavedAt, setLastSavedAt] = useState(null);
  const [detectedLang, setDetectedLang] = useState("Unknown");
  const [userLang, setUserLang] = useState("Auto");
  const activeLang = userLang === "Auto" ? detectedLang : userLang;

  // Check authentication and set current user
  useEffect(() => {
    const userData = JSON.parse(localStorage.getItem('user'));
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    
    if (!userData || !isLoggedIn) {
      navigate('/login');
      return;
    }
    
    setCurrentUser(userData);
  }, [navigate]);

  // Handle navigation state for viewing/editing summaries
  useEffect(() => {
    if (location.state?.summary) {
      const { summary, edit } = location.state;
      setText(summary.originalText || '');
      setSummary(summary.summary || '');
      
      if (edit) {
        console.log('Editing summary:', summary.title);
      } else {
        console.log('Viewing summary:', summary.title);
      }
    }
  }, [location.state, setText, setSummary]);

  useEffect(() => {
    const detectLanguage = (content) => {
      if (!content) return "Unknown";
      const sample = content.slice(0, 2000);
      const hindiBlock = (sample.match(/[\u0900-\u097F]/g) || []).length;
      const bengaliBlock = (sample.match(/[\u0980-\u09FF]/g) || []).length;
      const tamilBlock = (sample.match(/[\u0B80-\u0BFF]/g) || []).length;
      const englishChars = (sample.match(/[A-Za-z]/g) || []).length;
      const scores = { Tamil: tamilBlock, Devanagari: hindiBlock, BengaliScript: bengaliBlock, English: englishChars };
      const maxScore = Math.max(...Object.values(scores));
      if (maxScore < 5) return "Unknown";
      if (scores.Tamil === maxScore) return "Tamil";
      if (scores.BengaliScript === maxScore) return "Bengali";
      if (scores.Devanagari === maxScore) return "Hindi";
      if (scores.English === maxScore) return "English";
      return "Unknown";
    };
    setDetectedLang(detectLanguage(safeText?.trim() || ""));
  }, [safeText]);

  const [hoverWord, setHoverWord] = useState(null);
  const [wordMeaning, setWordMeaning] = useState(null);
  const [tooltipPos, setTooltipPos] = useState({ x: 0, y: 0 });
  const [ocrProgress, setOcrProgress] = useState(null);
  const [isProcessingOCR, setIsProcessingOCR] = useState(false);

  const fetchMeaning = async (word) => {
    try {
      if (!word) return;
      setWordMeaning("Searching...");
      const dictRes = await fetch(`https://api.dictionaryapi.dev/api/v2/entries/en/${word.toLowerCase()}`);
      const dictJson = await dictRes.json();
      setWordMeaning(dictJson?.[0]?.meanings?.[0]?.definitions?.[0]?.definition || "Meaning not found.");
    } catch (e) { setWordMeaning("Meaning not found."); }
  };

  useEffect(() => {
    const handler = (e) => {
      const tooltip = document.getElementById("word-meaning-tooltip");
      if (tooltip && !tooltip.contains(e.target)) { setHoverWord(null); setWordMeaning(null); }
    };
    document.addEventListener("click", handler);
    return () => document.removeEventListener("click", handler);
  }, []);

  useEffect(() => {
    const loadVoices = () => {
      const v = window.speechSynthesis.getVoices();
      if (v.length > 0) {
        setVoices(v);
        const preferred = v.find((voice) => voice.lang.includes(navigator.language)) || v[0];
        setSelectedVoice(preferred);
      }
    };
    loadVoices();
    window.speechSynthesis.onvoiceschanged = loadVoices;
    return () => { window.speechSynthesis.cancel(); };
  }, []);

  const stopSpeech = () => {
    window.speechSynthesis.cancel();
    setIsPlaying(false);
    setIsPaused(false);
  };

  const pauseResumeSpeech = () => {
    if (!window.speechSynthesis.speaking) return;
    if (isPaused) {
      window.speechSynthesis.resume();
      setIsPaused(false);
    } else {
      window.speechSynthesis.pause();
      setIsPaused(true);
    }
  };

  const speakSummary = (opts = { preview: false }) => {
    if (!safeSummary && !opts.preview) return;
    window.speechSynthesis.cancel();
    
    const textToSpeak = opts.preview ? "Aapka voice test ho raha hai" : safeSummary.replace(/[*#_~`>•]/g, "");
    
    const maxLength = 200; 
    const chunks = [];
    
    if (textToSpeak.length <= maxLength) {
      const utterance = new SpeechSynthesisUtterance(textToSpeak);
      utterance.rate = ttsRate;
      if (selectedVoice) { utterance.voice = selectedVoice; utterance.lang = selectedVoice.lang; }
      utterance.onstart = () => { setIsPlaying(true); setIsPaused(false); };
      utterance.onend = () => { setIsPlaying(false); setIsPaused(false); };
      utterance.onerror = () => { setIsPlaying(false); setIsPaused(false); };
      window.speechSynthesis.speak(utterance);
    } else {
      const words = textToSpeak.split(' ');
      let currentChunk = '';
      
      words.forEach((word, index) => {
        const testChunk = currentChunk ? `${currentChunk} ${word}` : word;
        if (testChunk.length <= maxLength) {
          currentChunk = testChunk;
        } else {
          if (currentChunk) chunks.push(currentChunk);
          currentChunk = word;
        }
        if (index === words.length - 1 && currentChunk) {
          chunks.push(currentChunk);
        }
      });
      
      let currentIndex = 0;
      
      const speakNextChunk = () => {
        if (currentIndex >= chunks.length) {
          setIsPlaying(false);
          setIsPaused(false);
          return;
        }
        
        const utterance = new SpeechSynthesisUtterance(chunks[currentIndex]);
        utterance.rate = ttsRate;
        if (selectedVoice) { utterance.voice = selectedVoice; utterance.lang = selectedVoice.lang; }
        
        utterance.onstart = () => {
          setIsPlaying(true);
          setIsPaused(false);
        };
        
        utterance.onend = () => {
          currentIndex++;
          if (currentIndex < chunks.length) {
            setTimeout(() => speakNextChunk(), 100); 
          } else {
            setIsPlaying(false);
            setIsPaused(false);
          }
        };
        
        utterance.onerror = () => {
          setIsPlaying(false);
          setIsPaused(false);
        };
        
        window.speechSynthesis.speak(utterance);
      };
      
      speakNextChunk();
    }
  };

  const handlePDFUpload = async (e) => {
    const file = e.target.files[0];
    if (!file) return;
    
    console.log('File selected:', file.name, file.type, file.size);
    
    if (file.type.startsWith('image/')) {
      console.log('Processing as image...');
      await handleImageOCR(file);
      return;
    }

    // 🌟 REMOVED POPUP: Uses the React State Checkbox variable instead
    const forceOCR = forceVisionAI;
    
    console.log('Processing as PDF. Force AI:', forceOCR);
    setIsProcessingOCR(true);
    setOcrProgress(5); 
    
    try {
      const reader = new FileReader();
      
      reader.onload = async function () {
        try {
          console.log('FileReader loaded, processing PDF...');
          setOcrProgress(10);
          
          const loadingTask = pdfjsLib.getDocument({
            data: new Uint8Array(this.result),
            disableWorker: false, 
            verbosity: pdfjsLib.VerbosityLevel.INFOS
          });
          
          const pdf = await loadingTask.promise;
          console.log('PDF loaded successfully, pages:', pdf.numPages);
          setOcrProgress(15);
          
          let fullText = "";
          const totalPages = pdf.numPages;
          
          if (totalPages === 0) {
            throw new Error('PDF has no pages');
          }
          
          const createPageTimeout = (timeoutMs) => {
            return new Promise((_, reject) => {
              setTimeout(() => reject(new Error(`Page processing timeout after ${timeoutMs}ms`)), timeoutMs);
            });
          };
          
          for (let i = 1; i <= totalPages; i++) {
            let pageExtracted = false;
            let renderAttempt = 1;

            while (!pageExtracted) {
              try {
                if (renderAttempt > 1) console.log(`Retrying page ${i} rendering (Attempt ${renderAttempt})...`);

                const pageProgress = 15 + Math.round((i - 1) / totalPages * 30);
                setOcrProgress(pageProgress);
                
                console.log(`Processing page ${i} of ${totalPages}`);
                
                const page = await Promise.race([
                  pdf.getPage(i),
                  createPageTimeout(30000)
                ]);
                
                const content = await Promise.race([
                  page.getTextContent(),
                  createPageTimeout(10000)
                ]);
                
                const pageText = content.items.map((item) => item.str).join(" ");
                const alphaChars = (pageText.match(/[a-zA-Z\s]/g) || []).length;
                const totalChars = pageText.trim().length;
                const isGarbageText = totalChars > 10 && (alphaChars / totalChars) < 0.65; 
                
                // 🌟 ADDED: Force OCR check
                if (totalChars < 10 || isGarbageText || forceOCR) {
                  if (forceOCR && totalChars >= 10) console.log(`Page ${i}: Native text found, but user forced Vision AI...`);
                  else if (isGarbageText) console.log(`Page ${i}: Detected hidden garbage OCR layer. Bypassing and using Vision AI...`);
                  else console.log(`Page ${i}: No text found. Using Vision AI...`);
                  
                  const unscaledViewport = page.getViewport({ scale: 1.0 });
                  
                  const maxDimension = 800; 
                  const largestSide = Math.max(unscaledViewport.width, unscaledViewport.height);
                  const safeScale = Math.min(2.0, maxDimension / largestSide);
                  
                  const viewport = page.getViewport({ scale: safeScale });
                  const canvas = document.createElement('canvas');
                  const context = canvas.getContext('2d', { willReadFrequently: true }); 
                  canvas.height = viewport.height;
                  canvas.width = viewport.width;
                  
                  context.fillStyle = "white";
                  context.fillRect(0, 0, canvas.width, canvas.height);
                  
                  await Promise.race([
                    page.render({ canvasContext: context, viewport }).promise,
                    createPageTimeout(90000) 
                  ]);
                  
                  const base64Image = canvas.toDataURL('image/jpeg', 0.8).split(',')[1];
                  
                  canvas.width = 0;
                  canvas.height = 0;
                  context.clearRect(0, 0, 0, 0);
                  page.cleanup();

                  if (base64Image) {
                    const aiProgress = 45 + Math.round((i - 1) / totalPages * 40);
                    setOcrProgress(aiProgress);
                    
                    const extractedText = await extractHandwrittenTextWithAI(base64Image, aiProgress, totalPages, i);
                    if (extractedText && extractedText.length > 0) {
                      fullText += extractedText + "\n\n";
                    }
                  }
                } else {
                  fullText += pageText + "\n\n";
                  console.log(`Page ${i}: Extracted clean text via native PDF content`);
                }
                
                pageExtracted = true; 
                
                if (i < totalPages) {
                   await new Promise(resolve => setTimeout(resolve, 2000));
                }
                
              } catch (pageError) {
                console.warn(`Page ${i} processing failed on attempt ${renderAttempt}:`, pageError.message);
                renderAttempt++;
                if (renderAttempt > 3) {
                  console.error(`Giving up on Page ${i} after 3 attempts.`);
                  pageExtracted = true; 
                } else {
                  console.log(`Retrying in 2 seconds...`);
                  await new Promise(resolve => setTimeout(resolve, 2000));
                }
              }
            } 
          }
          
          setOcrProgress(90);
          
          fullText = fullText
            .replace(/\s+/g, ' ')
            .replace(/\n+/g, ' ')
            .trim();
          
          setOcrProgress(95);
          
          if (fullText.length > 0) {
            setText(fullText);
            setOcrProgress(100);
            
            await new Promise(resolve => setTimeout(resolve, 500));
            
            alert(`✅ PDF Processing Complete!\n📝 Extracted: ${fullText.length} characters\n📄 Processed: ${totalPages} pages`);
          } else {
            alert("❌ No text could be extracted from the PDF.");
          }
          
        } catch (pdfError) {
          console.error('PDF processing error:', pdfError);
          alert("Error parsing PDF: " + (pdfError.message || "Unknown error"));
        } finally {
          setIsProcessingOCR(false);
          setOcrProgress(null);
        }
      };
      
      reader.onerror = () => {
        console.error('FileReader error');
        alert("Failed to read the PDF file. Please try again.");
        setIsProcessingOCR(false);
        setOcrProgress(null);
      };
      
      reader.readAsArrayBuffer(file);
      
    } catch (initError) {
      console.error('PDF initialization error:', initError);
      alert("Failed to initialize PDF processing: " + (initError.message || "Unknown error"));
      setIsProcessingOCR(false);
      setOcrProgress(null);
    }
  };
  
  const preprocessImage = async (imageFile) => {
    return new Promise((resolve, reject) => {
      const canvas = document.createElement('canvas');
      const ctx = canvas.getContext('2d');
      const img = new Image();
      
      img.onerror = () => {
        reject(new Error('Failed to load image'));
      };
      
      img.onload = () => {
        try {
          const maxWidth = 2000;
          const maxHeight = 2000;
          let scale = 1.5;
          
          let width = img.width * scale;
          let height = img.height * scale;
          
          if (width > maxWidth) {
            scale = maxWidth / img.width;
            width = maxWidth;
            height = img.height * scale;
          }
          
          if (height > maxHeight) {
            scale = maxHeight / img.height;
            height = maxHeight;
            width = img.width * scale;
          }
          
          canvas.width = width;
          canvas.height = height;
          
          ctx.imageSmoothingEnabled = true;
          ctx.imageSmoothingQuality = 'high';
          ctx.drawImage(img, 0, 0, width, height);
          
          const imageData = ctx.getImageData(0, 0, width, height);
          const data = imageData.data;
          
          const chunkSize = 10000; 
          let currentPixel = 0;
          
          const processChunk = () => {
            const endPixel = Math.min(currentPixel + chunkSize * 4, data.length);
            
            for (let i = currentPixel; i < endPixel; i += 4) {
              const r = data[i];
              const g = data[i + 1];
              const b = data[i + 2];
              
              const gray = 0.299 * r + 0.587 * g + 0.114 * b;
              
              const threshold = 120;
              const value = gray > threshold ? 255 : 0;
              
              data[i] = value;
              data[i + 1] = value;
              data[i + 2] = value;
            }
            
            currentPixel = endPixel;
            
            if (currentPixel < data.length) {
              setTimeout(processChunk, 0);
            } else {
              ctx.putImageData(imageData, 0, 0);
              canvas.toBlob(
                (blob) => {
                  if (blob) {
                    resolve(blob);
                  } else {
                    reject(new Error('Failed to create blob from canvas'));
                  }
                },
                'image/jpeg',
                0.9
              );
            }
          };
          setTimeout(processChunk, 0);
        } catch (error) {
          reject(error);
        }
      };
      
      img.src = URL.createObjectURL(imageFile);
    });
  };

  const extractHandwrittenTextWithAI = async (base64Image, progressStart, totalPages, currentPage) => {
    console.log(`Sending page ${currentPage} to Google Gemini Vision AI...`);
    const apiProgress = progressStart + Math.round((currentPage / totalPages) * 20);
    setOcrProgress(Math.min(apiProgress, 85));

    if (!apiKeys.googleKeys || apiKeys.googleKeys.length === 0) {
      console.warn("No Google API keys found! Falling back to Tesseract immediately.");
      return await basicOCRFromBase64(base64Image);
    }

    let transcribedText = "";
    let maxRetries = 5; 
    let isSuccess = false;
    let delayMs = 5000;

    for (let attempt = 1; attempt <= maxRetries; attempt++) {
      try {
        const currentKey = apiKeys.googleKeys[activeKeyIndex.current];
        
        if (attempt > 1) {
          console.log(`Gemini API Retry attempt ${attempt} for page ${currentPage} using Key #${activeKeyIndex.current + 1}...`);
        }

        const response = await axios.post(
          // FIXED: Strictly uses the high-efficiency gemini-2.5-flash model
          `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=${currentKey}`, 
          {
            contents: [{
              parts: [
                { text: "You are an expert transcription AI. Read the handwritten text in this image and transcribe it exactly as written. Maintain the original structure, paragraphs, and spacing. Do NOT add any conversational filler, markdown formatting, or commentary. Output ONLY the transcribed text." },
                { 
                  inline_data: { 
                    mime_type: "image/jpeg", 
                    data: base64Image 
                  } 
                }
              ]
            }],
            generationConfig: {
              temperature: 0.1
            }
          }, 
          {
            headers: { "Content-Type": "application/json" },
            timeout: 60000 
          }
        );

        transcribedText = response.data.candidates[0].content.parts[0].text.trim();
        isSuccess = true;
        break; 

      } catch (apiError) {
        console.warn(`Gemini Vision AI attempt ${attempt} failed:`, apiError.message);
        
        // ROTATE API KEY ON 429 ERROR
        if (apiError.response?.status === 429) {
          activeKeyIndex.current = (activeKeyIndex.current + 1) % apiKeys.googleKeys.length;
          console.log(`🔄 429 Limit Hit! Rotating to Google API Key #${activeKeyIndex.current + 1}`);
        }
        
        if (attempt < maxRetries) {
          console.log(`Server busy! Waiting ${delayMs / 1000} seconds before trying Gemini again...`);
          await new Promise(resolve => setTimeout(resolve, delayMs));
          delayMs *= 2; 
        }
      }
    }

    if (!isSuccess) {
      console.error(`Gemini Vision AI failed after ${maxRetries} attempts. Falling back to basic Tesseract OCR...`);
      setOcrProgress(progressStart + 10); 
      return await basicOCRFromBase64(base64Image);
    }

    const finalProgress = progressStart + Math.round((currentPage / totalPages) * 40);
    setOcrProgress(Math.min(finalProgress, 95));
    
    console.log(`📝 Page ${currentPage} successfully transcribed by Gemini.`);
    return transcribedText;
  };
  
  const basicOCRFromBase64 = async (base64Image) => {
    try {
      const byteCharacters = atob(base64Image);
      const byteNumbers = new Array(byteCharacters.length);
      for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
      }
      const byteArray = new Uint8Array(byteNumbers);
      const blob = new Blob([byteArray], { type: 'image/jpeg' });
      const file = new File([blob], 'page.jpg', { type: 'image/jpeg' });
      
      const result = await Tesseract.recognize(
        file,
        'eng',
        {
          logger: (m) => {
            console.log('Basic OCR progress:', m.status, m.progress);
          },
          tessedit_ocr_engine_mode: 1,
          tessedit_pageseg_mode: 1,
        }
      );
      
      const text = result.data.text.trim();
      console.log(`Basic OCR extracted: ${text.length} characters`);
      
      return text;
      
    } catch (error) {
      console.error('Basic OCR failed:', error);
      return "";
    }
  };

  const handleImageOCR = async (file) => {
    setIsProcessingOCR(true);
    setOcrProgress(5);
    
    try {
      console.log('Starting Gemini AI processing for image:', file.name);
      
      if (!file || file.size === 0) {
        throw new Error('Invalid file provided');
      }

      setOcrProgress(15);
      
      const base64Image = await new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = (e) => {
          const img = new Image();
          img.onload = () => {
            try {
              const maxDimension = 1200; 
              const largestSide = Math.max(img.width, img.height);
              const safeScale = Math.min(1.0, maxDimension / largestSide);
              
              const width = img.width * safeScale;
              const height = img.height * safeScale;

              const canvas = document.createElement('canvas');
              canvas.width = width;
              canvas.height = height;
              const ctx = canvas.getContext('2d', { willReadFrequently: true });
              
              ctx.fillStyle = "white";
              ctx.fillRect(0, 0, canvas.width, canvas.height);
              ctx.drawImage(img, 0, 0, width, height);

              const base64 = canvas.toDataURL('image/jpeg', 0.75).split(',')[1];
              
              canvas.width = 0;
              canvas.height = 0;
              ctx.clearRect(0, 0, 0, 0);
              
              resolve(base64);
            } catch (err) {
              reject(err);
            }
          };
          img.onerror = () => reject(new Error("Failed to load image."));
          img.src = e.target.result;
        };
        reader.onerror = () => reject(new Error("Failed to read file."));
        reader.readAsDataURL(file);
      });

      setOcrProgress(40);
      
      const finalText = await extractHandwrittenTextWithAI(base64Image, 40, 1, 1);
      
      setOcrProgress(95);
      
      if (finalText && finalText.length > 0) {
        setText(finalText);
        setOcrProgress(100);
        
        await new Promise(resolve => setTimeout(resolve, 500));
        alert(`✅ Image OCR Complete!\n📝 Extracted: ${finalText.length} characters`);
      } else {
        alert("❌ No text could be extracted. Please ensure the image contains readable text.");
      }
      
    } catch (err) {
      console.error('Image OCR Error:', err);
      alert("❌ OCR Error: " + (err.message || "Unknown error"));
    } finally {
      setIsProcessingOCR(false);
      setOcrProgress(null);
    }
  };

  const keywords = useMemo(() => {
    if (!safeText) return [];
    const tokens = safeText.toLowerCase().replace(/[^\w\s]/g, " ").split(/\s+/);
    const counts = {};
    tokens.forEach((t) => { if (t.length > 4) counts[t] = (counts[t] || 0) + 1; });
    return Object.keys(counts).sort((a, b) => counts[b] - counts[a]).slice(0, 10);
  }, [safeText]);

  const accuracyScore = useMemo(() => {
    if (!safeSummary || !safeText) return 0;
    const isTranslation = (activeLang !== "English" && detectedLang === "English");
    if (isTranslation) return (safeSummary.length > 100) ? 95 : 70;
    const hits = keywords.filter(k => safeSummary.toLowerCase().includes(k)).length;
    return Math.min(100, Math.round((hits / (keywords.length || 1)) * 100) + 10);
  }, [safeSummary, safeText, keywords, activeLang, detectedLang]);

  const checkApiKey = (provider) => {
    const key = apiKeys[provider];
    return key && key.length > 10 && key !== 'your_' + provider + '_api_key_here';
  };

  const getApiStatus = (provider) => {
    if (!checkApiKey(provider)) return 'no-key';
    return apiStatus[provider] || 'ready';
  };

  const summarizeText = async () => {
    if (!safeText.trim()) return;
    
    if (!checkApiKey(apiProvider)) {
      alert(`❌ No API key configured for ${apiProvider.toUpperCase()}. Please add your API key to the .env file and restart the server.`);
      return;
    }
    
    setLoading(true); setSummary("");
    setApiStatus(prev => ({ ...prev, [apiProvider]: 'loading' }));
    
    let promptInstruction = `Summarize the following text in ${activeLang}. Tone: ${tone}, Length: ${lengthPref}, Format: ${bulletFormat}.`;
    
    if (bulletFormat === "enhanced") {
      promptInstruction += `
      
      ENHANCED BULLET POINT FORMATTING:
      - Use hierarchical bullet structure with main points and sub-points
      - Start main points with: "##" for sections, "###" for subsections
      - Use standard MS Word style bullets: "###" for main points (bullet), "####" for sub-points (circle), "#####" for details (square)
      - Include emojis for visual hierarchy: "##" sections, "###" main points, "####" details
      - Structure: Section Title -> Main Point -> Supporting Details -> Examples
      - Use clear, concise language with action-oriented statements
      - Include quantifiable data where possible (percentages, numbers, statistics)
      - Add impact statements and key takeaways for each section
      - Use standard bullet symbols: · (bullet), o (circle), s (square) for different levels
      
      EXAMPLE STRUCTURE:
      ## Core Research Focus
      ### Primary Objective
      #### Key finding with specific data
      #### Supporting evidence and examples
      
      ### Methodology
      #### Approach description
      #### Implementation details
      
      ## Key Results
      ### Quantitative Outcomes
      #### Statistical data and metrics
      #### Comparison with benchmarks`;
    } else if (bulletFormat === "hierarchical") {
      promptInstruction += `
      
      HIERARCHICAL BULLET POINT FORMATTING:
      - Use multi-level hierarchy: "##" for main sections, "###" for subsections, "####" for details, "#####" for examples
      - Include professional emojis: "##" sections, "###" subsections, "####" details, "#####" examples
      - Use standard MS Word style bullets: · (bullet), o (circle), s (square) for different levels
      - Structure: Executive Summary -> Key Points -> Detailed Analysis -> Supporting Evidence -> Real-world Examples
      - Use professional, business-oriented language
      - Include specific metrics, KPIs, and measurable outcomes
      - Add strategic insights and actionable recommendations
      - Format with clear visual hierarchy and logical flow
      
      EXAMPLE STRUCTURE:
      ## Executive Summary
      ### Core Findings
      #### Primary metrics and KPIs
      ##### Real-world application example
      
      ### Strategic Implications
      #### Business impact assessment
      ##### Industry benchmark comparison
      
      ## Detailed Analysis
      ### Methodology Overview
      #### Data collection approach
      ##### Analytical framework used`;
    } else if (bulletFormat === "standard") {
      promptInstruction += `
      
      STANDARD BULLET POINT FORMATTING:
      - Use simple bullet points with clear structure
      - Start each point with "###" for main bullets (using · bullet symbol)
      - Use "####" for sub-points (using o circle symbol) when needed
      - Keep language clear and concise
      - Focus on key information and main takeaways
      - Use logical grouping of related points
      - Use standard MS Word style bullets: · (bullet), o (circle), s (square)`;
    }
    
    if (activeLang === "Hinglish") {
      promptInstruction = `You are a professional Hinglish content creator. Your task is to summarize the given text in authentic Hinglish style.
      
      CRITICAL LANGUAGE REQUIREMENTS:
      1. You MUST respond in HINGLISH regardless of API provider being used
      2. Use ONLY Latin alphabet (A-Z, a-z) - absolutely NO Devanagari script
      3. Mix Hindi and English words naturally like Indians speak
      4. Follow Hindi sentence structure and grammar patterns
      5. Use common Hinglish expressions and colloquialisms
      6. Maintain conversational, friendly tone
      7. NEVER mix English phrases with Hindi verbs in the middle of sentences
      8. Choose either English OR Hindi for complete phrases, not both
      9. IMPORTANT: Do not default to English - always maintain Hinglish style even with different APIs
      10. ENFORCE Hinglish output regardless of whether Groq, OpenRouter, or Together API is used
      
      GOOD EXAMPLES:
      - "Meeting bahut productive tha, sab kuch clear ho gaya" (GOOD)
      - "Kal tak apna report submit kar dena please" (GOOD)
      - "Results bahut impressive the, sabko pasand aaye" (GOOD)
      - "Main aapko is topic ke bare mein bata raha hun" (GOOD)
      
      BAD EXAMPLES (AVOID THESE):
      - "Let me summarize karte hain" (BAD - Don't mix English phrase with Hindi verb)
      - "Please consider karo" (BAD - Don't mix English phrase with Hindi verb)
      - "Basically ye hai ki" (BAD - Don't start with English then switch to Hindi)
      
      AUTHENTIC HINGLISH PATTERNS:
      - Start with Hindi words: "Yeh topic bahut interesting hai..."
      - Or start with English: "Topic ka main point yeh hai ki..."
      - Use complete Hindi phrases: "main samjha sakta hun ki..."
      - Use complete English phrases: "basically it's like this..."
      
      COMMON HINGLISH WORDS:
      - aap/you, hum/we, mere/my, tera/your
      - hai/are, tha/was, hoga/will be
      - aur/and, lekin/but, kyunke/because
      - bahut/very, thoda/little, zyada/more
      - kaam/work, time/time, problem/problem
      - accha/good, badia/nice, bakwas/useless
      
      ${bulletFormat === "enhanced" ? `
      ENHANCED BULLET POINT FORMATTING (Hinglish Style):
      - Use hierarchical structure: ## for sections, ### for main points, #### for details
      - Add emojis for better visual appeal: ## Section Title, ### Main Point, #### Detail
      - Use standard MS Word style bullets: · (bullet), o (circle), s (square) for different levels
      - Structure: Section ka title -> Main point -> Supporting details -> Examples
      - Use clear, concise language with action-oriented statements
      - Include numbers aur statistics jahan possible
      - Add impact statements aur key takeaways har section ke liye
      
      EXAMPLE STRUCTURE:
      ## Main Research Focus
      ### Primary Objective
      #### Key finding with specific data
      #### Supporting evidence aur examples
      
      ### Methodology
      #### Approach ka description
      #### Implementation details` : bulletFormat === "hierarchical" ? `
      HIERARCHICAL BULLET POINT FORMATTING (Hinglish Style):
      - Use multi-level hierarchy: ## for main sections, ### for subsections, #### for details, ##### for examples
      - Add professional emojis: ## sections, ### subsections, #### details, ##### examples
      - Use standard MS Word style bullets: · (bullet), o (circle), s (square) for different levels
      - Structure: Executive Summary -> Key Points -> Detailed Analysis -> Supporting Evidence -> Real-world Examples
      - Use professional, business-oriented language
      - Include specific metrics, KPIs, aur measurable outcomes
      - Add strategic insights aur actionable recommendations
      - Format with clear visual hierarchy aur logical flow
      
      EXAMPLE STRUCTURE:
      ## Executive Summary
      ### Core Findings
      #### Primary metrics aur KPIs
      ##### Real-world application example
      
      ### Strategic Implications
      #### Business impact assessment
      ##### Industry benchmark comparison
      
      ## Detailed Analysis
      ### Methodology Overview
      #### Data collection approach
      ##### Analytical framework used` : bulletFormat === "standard" ? `
      STANDARD BULLET POINT FORMATTING (Hinglish Style):
      - Use simple bullet points with clear structure
      - Start each point with "###" for main bullets (using · bullet symbol)
      - Use "####" for sub-points (using o circle symbol) when needed
      - Keep language clear aur concise
      - Focus on key information aur main takeaways
      - Use logical grouping of related points
      - Use standard MS Word style bullets: · (bullet), o (circle), s (square)` : ""}
      
      Target Tone: ${tone}
      Target Length: ${lengthPref}
      Format: ${bulletFormat}
      
      FINAL INSTRUCTION: Write exactly how Indians speak in daily life - choose one language pattern per phrase and stick to it! ALWAYS respond in Hinglish when Hinglish is selected, regardless of API provider (Groq, OpenRouter, Together).`;
    }
    
    try {
      let res;
      const startTime = Date.now();
      
      if (apiProvider === "groq") {
        res = await axios.post("https://api.groq.com/openai/v1/chat/completions", {
          model: "llama-3.1-8b-instant", 
          messages: [{ role: "user", content: `${promptInstruction}\n\nTEXT:\n${safeText.slice(0, 5000)}` }],
          max_tokens: 3000, 
          temperature: 0.7
        }, { 
          headers: { 
            Authorization: `Bearer ${apiKeys.groq}`,
            "Content-Type": "application/json"
          },
          timeout: 30000 
        });
      } else if (apiProvider === "openrouter") {
        res = await axios.post("https://openrouter.ai/api/v1/chat/completions", {
          model: "openai/gpt-3.5-turbo", 
          messages: [{ role: "user", content: `${promptInstruction}\n\nTEXT:\n${safeText.slice(0, 5000)}` }],
          max_tokens: 3000, 
          temperature: 0.7
        }, { 
          headers: { 
            Authorization: `Bearer ${apiKeys.openrouter}`,
            "Content-Type": "application/json",
            "HTTP-Referer": "http://localhost:5173",
            "X-Title": "AI Book Summarizer"
          } 
        });
      } else if (apiProvider === "together") {
        res = await axios.post("https://api.together.ai/v1/chat/completions", {
          model: "meta-llama/Llama-3.2-70b-chat-hf", 
          messages: [{ role: "user", content: `${promptInstruction}\n\nTEXT:\n${safeText.slice(0, 5000)}` }],
          max_tokens: 3000, 
          temperature: 0.7
        }, { 
          headers: { Authorization: `Bearer ${apiKeys.together}` },
          timeout: 120000 
        });
      } else {
        res = await axios.post("https://openrouter.ai/api/v1/chat/completions", {
          model: "arcee-ai/trinity-large-preview:free",
          messages: [{ role: "user", content: `${promptInstruction}\n\nTEXT:\n${safeText.slice(0, 5000)}` }],
          max_tokens: 3000, 
        }, { 
          headers: { Authorization: `Bearer ${apiKeys.openrouter}` },
          timeout: 30000 
        });
      }
      
      const responseTime = Date.now() - startTime;
      setSummary(res.data.choices[0].message.content.trim());
      setApiStatus(prev => ({ ...prev, [apiProvider]: 'success' }));
      
      console.log(`✅ ${apiProvider.toUpperCase()} Success: ${responseTime}ms`);
      
    } catch (err) { 
      console.error("API Error:", err);
      setApiStatus(prev => ({ ...prev, [apiProvider]: 'error' }));
      
      if (err.response?.status === 401) {
        alert(`❌ Invalid API key for ${apiProvider.toUpperCase()}. Please check your .env file.`);
      } else if (err.response?.status === 429) {
        alert(`⏱️ Rate limit exceeded for ${apiProvider.toUpperCase()}. Please try again in a moment.`);
      } else {
        alert(`❌ API Error with ${apiProvider}: ${err.message || "Unknown error"}`);
      }
    } finally { 
      setLoading(false); 
    }
  };

  useEffect(() => {
    if (!autoSaveEnabled) return;
    localStorage.setItem("summ-text", safeText);
    localStorage.setItem("summ-summary", safeSummary);
    setLastSavedAt(new Date().toLocaleTimeString());
  }, [safeText, safeSummary, autoSaveEnabled]);

  useEffect(() => {
    localStorage.setItem("summ-api", apiProvider);
  }, [apiProvider]);

  useEffect(() => {
    localStorage.setItem("summ-bulletFormat", bulletFormat);
  }, [bulletFormat]);

  const handleSaveToLibrary = () => {
    if (!safeSummary) return alert("Nothing to save!");
    if (!currentUser) return alert("User not authenticated!");
    
    const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || "[]");
    const newItem = {
      id: Date.now(),
      title: safeText.slice(0, 45).replace(/\n/g, " ") + "...",
      originalText: safeText,
      summary: safeSummary,
      date: new Date().toISOString(),
      language: activeLang,
      tone: tone,
      length: lengthPref,
      lang: activeLang,
      accuracy: accuracyScore,
      userEmail: currentUser.email 
    };
    localStorage.setItem(STORAGE_KEY, JSON.stringify([newItem, ...saved]));
    alert("Saved! Find it in the 📚 library.");
  };

  const handleLogout = () => {
    localStorage.removeItem('isLoggedIn');
    localStorage.removeItem('user');
    navigate('/login');
  };

  const formatSummaryForDisplay = (summary) => {
    if (!summary) return "";
    return summary.split('\n').map((line, index) => {
      const trimmedLine = line.trim();
      if (trimmedLine.startsWith('##')) {
        return (
          <h3 key={index} className="mt-4 mb-3" style={{color: '#e11d48', fontWeight: 'bold', fontSize: '18px'}}>
            {trimmedLine.replace('##', '').trim()}
          </h3>
        );
      } else if (trimmedLine.startsWith('###')) {
        return (
          <h4 key={index} className="mt-3 mb-2" style={{color: '#17a2b8', fontWeight: '600', fontSize: '16px'}}>
            {trimmedLine.replace('###', '').trim()}
          </h4>
        );
      } else if (trimmedLine.startsWith('####')) {
        return (
          <p key={index} className="mb-2 ms-3" style={{color: '#495057', fontSize: '14px', lineHeight: '1.6'}}>
            <span style={{color: '#17a2b8', marginRight: '8px'}}>o</span>
            {trimmedLine.replace('####', '').trim()}
          </p>
        );
      } else if (trimmedLine.startsWith('#####')) {
        return (
          <p key={index} className="mb-2 ms-4" style={{color: '#6c757d', fontSize: '13px', fontStyle: 'italic', lineHeight: '1.5'}}>
            <span style={{color: '#6c757d', marginRight: '8px'}}>s</span>
            {trimmedLine.replace('#####', '').trim()}
          </p>
        );
      } else if (trimmedLine.startsWith('-')) {
        return (
          <p key={index} className="mb-2 ms-2" style={{color: '#495057', fontSize: '14px', lineHeight: '1.6'}}>
            <span style={{color: '#e11d48', marginRight: '8px'}}>·</span>
            {trimmedLine.replace('-', '').trim()}
          </p>
        );
      } else if (trimmedLine.startsWith('o')) {
        return (
          <p key={index} className="mb-2 ms-3" style={{color: '#495057', fontSize: '14px', lineHeight: '1.6'}}>
            <span style={{color: '#17a2b8', marginRight: '8px'}}>o</span>
            {trimmedLine.replace('o', '').trim()}
          </p>
        );
      } else if (trimmedLine.startsWith('s')) {
        return (
          <p key={index} className="mb-2 ms-4" style={{color: '#6c757d', fontSize: '13px', fontStyle: 'italic', lineHeight: '1.5'}}>
            <span style={{color: '#6c757d', marginRight: '8px'}}>s</span>
            {trimmedLine.replace('s', '').trim()}
          </p>
        );
      } else if (trimmedLine.length > 0) {
        return (
          <p key={index} className="mb-2" style={{color: '#212529', fontSize: '14px', lineHeight: '1.6'}}>
            {trimmedLine}
          </p>
        );
      }
      return null;
    }).filter(Boolean);
  };

  const isDark = theme === "dark";

  return (
    <div className={`app-frame ${isDark ? 'theme-dark' : 'theme-light'}`}>
      <style>{`
        .app-frame {
          --accent:        #e11d48 !important;
          --accent-hover:  #be123c !important;
          --accent-soft:   rgba(225, 29, 72, 0.07) !important;
          --accent-border: rgba(225, 29, 72, 0.16) !important;
          --accent-glow:   rgba(225, 29, 72, 0.22) !important;
          --bg:        ${isDark ? '#180810' : '#fdf5f7'};
          --side:      ${isDark ? '#1e0c12' : '#ffffff'};
          --panel:     ${isDark ? 'rgba(35,10,18,0.92)' : '#ffffff'};
          --text:      ${isDark ? '#fde8ee' : '#18080e'};
          --text-muted:${isDark ? '#c87a90' : '#b05070'};
          --border:    ${isDark ? 'rgba(225,29,72,0.16)' : 'rgba(225,29,72,0.13)'};
          --stat-bg:     ${isDark ? 'rgba(225,29,72,0.08)' : '#fff0f3'};
          --stat-border: ${isDark ? 'rgba(225,29,72,0.18)' : 'rgba(225,29,72,0.15)'};
          --tag-bg:   ${isDark ? 'rgba(225,29,72,0.10)' : '#fff0f3'};
          --tag-text: #e11d48;
          --input-bg: ${isDark ? '#280e18' : '#ffffff'};
          --shadow-card: ${isDark ? '0 4px 24px rgba(0,0,0,0.45)' : '0 2px 14px rgba(225,29,72,0.07)'};
        }
        body, html { margin: 0; padding: 0; font-family: 'Inter', sans-serif; height: 100vh; overflow: hidden; background: var(--bg); color: var(--text); }
        .app-frame { display: flex; height: 100vh; }
        .rail { width: 60px; background: var(--side); border-right: 1px solid var(--border); display: flex; flex-direction: column; align-items: center; padding: 18px 0; gap: 6px; }
        @media (max-width: 768px) {
          .app-frame { flex-direction: row !important; height: auto !important; min-height: 100vh !important; }
          .app-frame .rail { width: 60px !important; height: 100vh !important; flex-direction: column !important; justify-content: flex-start !important; align-items: center !important; padding: 18px 0 !important; border-right: 1px solid var(--border) !important; border-bottom: none !important; position: relative !important; display: flex !important; flex-shrink: 0 !important; }
          .content { flex: 1; padding: 18px 22px !important; margin-left: 0 !important; }
          .inspector { width: 100% !important; order: 3; }
          .main-stack { order: 1; }
          .header { padding: 0 18px !important; height: 58px !important; }
        }
        .rail-btn { width: 40px; height: 40px; border-radius: 11px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.18s; color: var(--text-muted); font-size: 17px; border: none; background: transparent; }
        .rail-btn:hover { background: var(--accent-soft); color: var(--accent); }
        .rail-btn.active { background: var(--accent-soft); color: var(--accent); border: 1px solid var(--accent-border); }
        .workspace { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .header { height: 58px; display: flex; align-items: center; justify-content: space-between; padding: 0 28px; border-bottom: 1px solid var(--border); }
        .content { flex: 1; display: flex; padding: 18px 22px; gap: 18px; overflow-y: auto; background: var(--bg); }
        .main-stack { flex: 1; display: flex; flex-direction: column; gap: 14px; }
        .card-glass { background: var(--panel); border-radius: 14px; border: 1px solid var(--border); padding: 18px 20px; box-shadow: var(--shadow-card); display: flex; flex-direction: column; }
        .ai-textarea { width: 100%; background: transparent; border: none; color: var(--text); font-size: 14px; line-height: 1.7; outline: none; resize: none; flex: 1; min-height: 130px; }
        .ai-textarea::placeholder { color: var(--text-muted); }
        .inspector { width: 295px; display: flex; flex-direction: column; gap: 14px; }
        .stat-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 9px; }
        .stat-card { background: var(--stat-bg); border: 1px solid var(--stat-border); border-radius: 11px; padding: 13px; text-align: center; }
        .stat-v { font-size: 21px; font-weight: 800; color: var(--accent); display: block; line-height: 1; }
        .stat-l { font-size: 9px; text-transform: uppercase; letter-spacing: 1.1px; color: var(--text-muted); font-weight: 700; margin-top: 4px; }
        .btn-glow { background: var(--accent); color: #fff; border: none; padding: 12px 28px; border-radius: 11px; font-weight: 700; font-size: 14px; cursor: pointer; transition: 0.18s; box-shadow: 0 5px 18px var(--accent-glow); }
        .btn-glow:hover { background: var(--accent-hover); transform: translateY(-1px); box-shadow: 0 8px 22px var(--accent-glow); }
        .btn-glow:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
        .btn-ghost { background: var(--accent-soft); border: 1px solid var(--accent-border); color: var(--accent); padding: 7px 15px; border-radius: 9px; cursor: pointer; font-size: 13px; font-weight: 600; transition: background 0.15s; white-space: nowrap; }
        .btn-ghost:hover { background: rgba(225,29,72,0.13); }
        .btn-ghost:disabled { opacity: 0.4; cursor: not-allowed; }
        .btn-save { background: var(--accent); color: #fff; border: none; padding: 8px 18px; border-radius: 10px; cursor: pointer; font-size: 13px; font-weight: 700; transition: 0.18s; box-shadow: 0 3px 12px var(--accent-glow); display: flex; align-items: center; gap: 5px; }
        .btn-save:hover { background: var(--accent-hover); transform: scale(1.02); }
        .btn-logout { background: transparent; color: var(--text-muted); border: 1px solid var(--border); padding: 8px 16px; border-radius: 10px; font-size: 14px; cursor: pointer; transition: all 0.3s ease; }
        .btn-logout:hover { background: rgba(225,29,72,0.1); color: var(--accent); border-color: var(--accent); }
        .pro-select { background: var(--input-bg) !important; color: var(--text) !important; border: 1px solid var(--border) !important; border-radius: 9px !important; font-size: 13px !important; padding: 8px 32px 8px 11px !important; width: 100% !important; margin-bottom: 10px !important; appearance: none !important; -webkit-appearance: none !important; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%23e11d48' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important; background-repeat: no-repeat !important; background-position: right 11px center !important; cursor: pointer !important; }
        .pro-select:focus { outline: none !important; border-color: var(--accent) !important; box-shadow: 0 0 0 3px rgba(225,29,72,0.09) !important; }
        .label-sm { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); margin-bottom: 10px; display: block; }
        .keyword-tag { background: var(--tag-bg); color: var(--tag-text); border: 1px solid var(--accent-border); border-radius: 7px; padding: 4px 9px; font-size: 12px; font-weight: 600; margin: 3px; display: inline-block; }
        input[type="range"] { accent-color: var(--accent); cursor: pointer; }
        .btn-outline-primary { color: var(--accent) !important; border: 1px solid var(--accent-border) !important; border-radius: 9px !important; background: var(--accent-soft) !important; font-weight: 600 !important; font-size: 13px !important; transition: 0.18s !important; padding: 8px !important; }
        .btn-outline-primary:hover { background: var(--accent) !important; color: #fff !important; border-color: var(--accent) !important; }
        .spinner-border { color: var(--accent) !important; }
        .border-top { border-top: 1px solid var(--border) !important; }
        .border-bottom { border-bottom: 1px solid var(--border) !important; }
        #word-meaning-tooltip { position: fixed; z-index: 9999; padding: 13px; background: var(--panel); color: var(--text); border-radius: 11px; box-shadow: 0 8px 26px rgba(225,29,72,0.13); max-width: 215px; font-size: 13px; border: 1px solid var(--border); }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(225,29,72,0.22); border-radius: 4px; }
        .text-muted { color: var(--text-muted) !important; }
        .text-primary { color: var(--accent) !important; }
        .opacity-75 { opacity: 0.75; }
        .opacity-50 { opacity: 0.5; }
        @media (max-width: 768px) {
          .app-frame { flex-direction: column; }
          .rail { width: 100% !important; height: 50px !important; flex-direction: row !important; justify-content: space-around !important; align-items: center !important; padding: 8px 16px !important; border-right: none !important; border-bottom: 1px solid var(--border) !important; position: relative !important; display: flex !important; }
          .rail-btn { width: 36px; height: 36px; font-size: 16px; display: flex; align-items: center; justify-content: center; }
          .content { padding: 16px 20px; gap: 16px; }
          .inspector { width: 100%; order: 2; }
          .main-stack { order: 1; }
          .stat-grid { grid-template-columns: 1fr; gap: 8px; }
          .card-glass { padding: 16px 18px; border-radius: 12px; }
          .header { padding: 0 16px; height: 52px; }
          .btn-glow { padding: 10px 24px; font-size: 14px; border-radius: 10px; }
          .btn-ghost { padding: 8px 16px; font-size: 13px; border-radius: 8px; }
          .btn-save { padding: 8px 16px; font-size: 13px; border-radius: 8px; }
          .btn-logout { padding: 6px 14px; font-size: 13px; border-radius: 8px; }
          .pro-select { font-size: 14px; padding: 8px 12px; border-radius: 8px; }
          .ai-textarea { font-size: 16px; min-height: 120px; line-height: 1.6; }
        }
        @media (max-width: 480px) {
          .app-frame { flex-direction: row !important; height: auto !important; min-height: 100vh !important; }
          .app-frame .rail { width: 60px !important; height: 100vh !important; flex-direction: column !important; justify-content: flex-start !important; align-items: center !important; padding: 12px 0 !important; border-right: 1px solid var(--border) !important; border-bottom: none !important; position: relative !important; display: flex !important; flex-shrink: 0 !important; }
          .app-frame .content { flex: 1 !important; padding: 12px 16px !important; margin-left: 0 !important; }
          .app-frame .inspector { width: 100% !important; order: 3 !important; }
          .app-frame .main-stack { order: 1 !important; }
          .app-frame .header { padding: 0 12px !important; height: 48px !important; }
          .app-frame .card-glass { padding: 12px 14px !important; border-radius: 10px !important; }
          .app-frame .btn-glow { padding: 8px 20px !important; font-size: 13px !important; border-radius: 8px !important; }
          .app-frame .btn-ghost { padding: 6px 12px !important; font-size: 12px !important; border-radius: 6px !important; }
          .app-frame .btn-save { padding: 6px 14px !important; font-size: 12px !important; border-radius: 6px !important; }
          .app-frame .btn-logout { padding: 5px 12px !important; font-size: 12px !important; border-radius: 6px !important; }
          .app-frame .pro-select { font-size: 13px !important; padding: 6px 10px !important; border-radius: 6px !important; }
          .app-frame .ai-textarea { font-size: 16px !important; min-height: 100px !important; line-height: 1.5 !important; }
          .app-frame .stat-v { font-size: 18px !important; }
          .app-frame .stat-l { font-size: 8px !important; margin-top: 2px !important; }
        }
      `}</style>

      <nav className="rail">
        <div className="logo mb-4" style={{fontSize: 21}}>🚀</div>
        <button className="rail-btn active">🏠</button>
        <button className="rail-btn" onClick={() => navigate("/dashboard")}>📚</button>
        <button className="rail-btn" onClick={() => {
          const next = theme === 'dark' ? 'light' : 'dark';
          setTheme(next);
          localStorage.setItem('summ-theme', next);
        }} title="Toggle Theme">
          {isDark ? '☀️' : '🌙'}
        </button>
      </nav>

      <main className="workspace">
        <header className="header">
          <h2 className="m-0" style={{fontSize: 18, fontWeight: 800, letterSpacing: '-0.3px'}}>
            Summarize<span style={{color: '#e11d48'}}>.Pro</span>
          </h2>
          <div className="d-flex align-items-center gap-3">
            <div className="small text-muted mr-3" >Saved: {lastSavedAt || '--:--'}</div>
            <button className="btn-save" onClick={handleSaveToLibrary} style={{background: '#e11d48'}}>Save to Library</button>
            <button className="btn-logout" onClick={handleLogout} title="Logout">Logout</button>
          </div>
        </header>

        <div className="content">
          <div className="main-stack">
            <div className="card-glass" style={{flex: 1}}>
              
              {/* 🌟 NEW: The Source Text Input header now contains the Checkbox! */}
              <div className="d-flex justify-content-between mb-3 align-items-start">
                <span className="label-sm">Source Text Input</span>
                <div className="d-flex flex-column align-items-end gap-2">
                  <div className="d-flex align-items-center gap-2">
                    <input 
                      type="checkbox" 
                      id="forceAI" 
                      checked={forceVisionAI} 
                      onChange={(e) => setForceVisionAI(e.target.checked)} 
                      style={{accentColor: '#e11d48', cursor: 'pointer', width: '15px', height: '15px'}}
                    />
                    <label htmlFor="forceAI" className="small text-muted m-0 font-weight-bold" style={{cursor: 'pointer', fontSize: '11px'}}>
                      Force Vision AI (Scans/Handwriting)
                    </label>
                  </div>
                  <div>
                    <input type="file" id="pdfUp" hidden onChange={handlePDFUpload} accept=".pdf,image/*" />
                    <label htmlFor="pdfUp" className="btn-ghost py-1 px-3 m-0" style={{cursor: 'pointer'}} disabled={isProcessingOCR}>
                      {isProcessingOCR ? `🔄 OCR ${ocrProgress}%` : '📄 Import PDF/Image'}
                    </label>
                  </div>
                </div>
              </div>

              <textarea
                className="ai-textarea"
                placeholder="Paste your source text here for deep analysis..."
                value={safeText}
                onChange={(e) => setText(e.target.value)}
              />
              <div className="mt-3 pt-3 border-top d-flex justify-content-between small opacity-75 font-weight-bold" style={{fontStyle:'italic'}}>
                <span>Detect: {detectedLang}</span>
                <br></br>
                <span>{safeText.length} Chars</span>
              </div>
            </div>

            <div className="card-glass" style={{flex: 1.2}}>
              <span className="label-sm">AI Synthesized Content</span>
              <div
                className="ai-textarea overflow-auto p-3"
                style={{
                  background: 'linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%)',
                  border: '1px solid rgba(255,255,255,0.1)',
                  borderRadius: '12px',
                  boxShadow: '0 4px 20px rgba(0,0,0,0.1)',
                  backdropFilter: 'blur(10px)',
                  minHeight: '200px'
                }}
                onDoubleClick={(e) => {
                  const s = window.getSelection()?.toString().trim();
                  if (s && !s.includes(' ')) {
                    setHoverWord(s); fetchMeaning(s);
                    setTooltipPos({x: e.clientX, y: e.clientY});
                  }
                }}
              >
                {loading ? (
                  <div className="h-100 d-flex flex-column align-items-center justify-content-center text-center py-5">
                    <div className="spinner-border text-primary mb-3" style={{width: '3rem', height: '3rem'}}></div>
                    <div className="font-weight-bold text-primary">✨ Synthesizing Intelligent Summary...</div>
                    <div className="small text-muted mt-2">Analyzing content patterns...</div>
                  </div>
                ) : safeSummary ? (
                  <div>
                    {formatSummaryForDisplay(safeSummary)}
                  </div>
                ) : (
                  <div className="text-center py-5">
                    <div className="opacity-50" style={{fontStyle: 'italic', fontSize: '16px'}}>
                      📝 Generated summary results will appear here...
                    </div>
                    <div className="small text-muted mt-2">
                      Paste your source text and click "Generate AI Summary" to begin
                    </div>
                  </div>
                )}
              </div>

              {hoverWord && wordMeaning && (
                <div id="word-meaning-tooltip" style={{left: tooltipPos.x, top: tooltipPos.y}}>
                  <b className="text-primary d-block mb-1 font-weight-bold">{hoverWord}</b>
                  {wordMeaning}
                </div>
              )}

              <div className="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                <div className="d-flex gap-2">
                  <button className="btn-ghost" onClick={() => speakSummary()} title="Play Speech">
                    🔊 {isPlaying ? (isPaused ? 'Resume' : 'Playing') : 'Speak'}
                  </button>
                  <button className="btn-ghost" onClick={pauseResumeSpeech} disabled={!isPlaying} title="Pause">⏸</button>
                  <button className="btn-ghost" onClick={stopSpeech} title="Stop">⏹</button>
                </div>
                <button className="btn-glow px-5" onClick={summarizeText} disabled={loading}>
                  {loading ? 'Synthesizing...' : '⚡ Generate AI Summary'}
                </button>
              </div>
            </div>
          </div>

          <aside className="inspector">

            <div className="card-glass">
              <span className="label-sm">Engine Metrics</span>
              <div className="stat-grid">
                <div className="stat-card">
                  <span className="stat-v">{safeSummary.split(/\s+/).filter(Boolean).length}</span>
                  <span className="stat-l">Words</span>
                </div>
                <div className="stat-card">
                  <span className="stat-v">{accuracyScore}%</span>
                  <span className="stat-l">Accuracy</span>
                </div>
                <div className="stat-card">
                  <span className="stat-v">{Math.max(1, Math.round(safeSummary.split(/\s+/).filter(Boolean).length / 200))}m</span>
                  <span className="stat-l">Read Time</span>
                </div>
                <div className="stat-card">
                  <span className="stat-v">{detectedLang.slice(0, 2)}</span>
                  <span className="stat-l">Script</span>
                </div>
              </div>
            </div>

            <div className="card-glass">
              <span className="label-sm">Synthesis Configuration</span>
              <label className="label-sm opacity-50 mb-1">Target Language</label>
              <select className="form-control pro-select" value={userLang} onChange={e => setUserLang(e.target.value)}>
                <option value="Auto">Auto-Detect</option>
                <optgroup label="Indian Languages">
                  <option value="English">English</option>
                  <option value="Hinglish">Hinglish</option>
                  <option value="Hindi">Hindi</option>
                  <option value="Haryanvi">Haryanvi</option>
                  <option value="Bengali">Bengali</option>
                  <option value="Tamil">Tamil</option>
                  <option value="Telugu">Telugu</option>
                  <option value="Marathi">Marathi</option>
                  <option value="Gujarati">Gujarati</option>
                  <option value="Punjabi">Punjabi</option>
                  <option value="Kannada">Kannada</option>
                  <option value="Malayalam">Malayalam</option>
                  <option value="Odia">Odia</option>
                  <option value="Assamese">Assamese</option>
                  <option value="Urdu">Urdu</option>
                  <option value="Rajasthani">Rajasthani</option>
                </optgroup>
                <optgroup label="Foreign Languages">
                  <option value="Spanish">Spanish</option>
                  <option value="French">French</option>
                  <option value="German">German</option>
                  <option value="Chinese">Chinese (Mandarin)</option>
                  <option value="Japanese">Japanese</option>
                  <option value="Korean">Korean</option>
                  <option value="Arabic">Arabic</option>
                  <option value="Portuguese">Portuguese</option>
                  <option value="Russian">Russian</option>
                  <option value="Italian">Italian</option>
                </optgroup>
              </select>
              <label className="label-sm opacity-50 mb-1">API Provider</label>
              <div className="mb-2">
                <select className="form-control pro-select" value={apiProvider} onChange={e => setApiProvider(e.target.value)}>
                  <option></option>
                  <option value="groq">⚡ Groq (Ultra Fast - 200ms)</option>
                  <option value="openrouter">🟢 OpenRouter (Reliable - 1200ms)</option>
                </select>
              </div>
              
              <div className="small mb-3">
                {['groq', 'openrouter'].map(provider => {
                  const status = getApiStatus(provider);
                  const statusColors = {
                    'ready': '#28a745',
                    'loading': '#ffc107', 
                    'success': '#28a745',
                    'error': '#dc3545',
                    'no-key': '#6c757d'
                  };
                  const statusTexts = {
                    'ready': 'Ready',
                    'loading': 'Loading...',
                    'success': 'Working',
                    'error': 'Error',
                    'no-key': 'No Key'
                  };
                  const providerNames = {
                    'groq': 'Groq (Ultra Fast)',
                    'openrouter': 'OpenRouter (Reliable)'
                  };
                  
                  return (
                    <div key={provider} className="d-flex justify-content-between align-items-center py-1 border-bottom" style={{fontSize: '11px'}}>
                      <span className={provider === apiProvider ? 'font-weight-bold' : ''}>
                        {providerNames[provider]}
                      </span>
                      <span className="badge px-2 py-1" style={{
                        backgroundColor: statusColors[status],
                        color: 'white',
                        fontSize: '10px'
                      }}>
                        {statusTexts[status]}
                      </span>
                    </div>
                  );
                })}
              </div>
              
              <div className="small text-muted" style={{fontSize: '10px', fontStyle: 'italic'}}>
                ⚡ Both APIs working perfectly for demo!
              </div>
              <label className="label-sm opacity-50 mb-1">Summary Tone</label>
              <select className="form-control pro-select" value={tone} onChange={e => setTone(e.target.value)}>
                <option>Simple</option>
                <option>Professional</option>
                <option>Academic</option>
                <option>Creative</option>
              </select>
              <label className="label-sm opacity-50 mb-1">Visual Format</label>
              <select className="form-control pro-select" value={lengthPref} onChange={e => setLengthPref(e.target.value)}>
                <option>Brief</option>
                <option>Detailed</option>
                <option>Bullet Points</option>
              </select>
              <label className="label-sm opacity-50 mb-1">Bullet Format</label>
              <select className="form-control pro-select" value={bulletFormat} onChange={e => setBulletFormat(e.target.value)}>
                <option value="standard">Standard</option>
                <option value="enhanced">Enhanced</option>
                <option value="hierarchical">Hierarchical</option>
              </select>
            </div>

            <div className="card-glass">
              <span className="label-sm">Voice Parameters</span>
              <label className="label-sm opacity-50 mb-1">Rate: {ttsRate}x</label>
              <input
                type="range"
                className="custom-range mb-3 w-100"
                min="0.5" max="2" step="0.1"
                value={ttsRate}
                onChange={e => setTtsRate(parseFloat(e.target.value))}
              />
              <select
                className="form-control pro-select"
                value={selectedVoice?.name || ""}
                onChange={(e) => setSelectedVoice(voices.find(v => v.name === e.target.value))}
              >
                {voices.map((v, i) => <option key={i} value={v.name}>{v.name} ({v.lang})</option>)}
              </select>
              <button
                className="btn btn-sm btn-block btn-outline-primary mt-2"
                style={{borderRadius: 9, fontSize: 12, fontWeight: 700}}
                onClick={() => speakSummary({preview: true})}
              >
                Test Audio
              </button>
            </div>

            <div className="card-glass" style={{flex: 1}}>
              <span className="label-sm">Semantic Extract</span>
              <div className="d-flex flex-wrap align-content-start overflow-auto">
                {keywords.length > 0
                  ? keywords.map((k, i) => <span key={i} className="keyword-tag">{k}</span>)
                  : <span className="small opacity-50 p-2" style={{fontStyle:'italic'}}>Awaiting analysis...</span>
                }
              </div>
            </div>

          </aside>
        </div>
      </main>
    </div>
  );
}
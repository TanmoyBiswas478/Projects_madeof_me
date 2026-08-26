// 📁 src/Initiative.jsx
import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const Initiative = () => {
  const navigate = useNavigate();
  const [hovered, setHovered] = useState(null);
  const [activeDemo, setActiveDemo] = useState(null);
  const [speaking, setSpeaking] = useState(false);

  const demoText = "Artificial intelligence is transforming industries worldwide. From healthcare to education, AI systems are automating complex tasks and enabling breakthroughs at unprecedented speed.";

  const handleSpeak = () => {
    if (speaking) {
      window.speechSynthesis.cancel();
      setSpeaking(false);
    } else {
      const u = new SpeechSynthesisUtterance("Here is a sample summary. Artificial intelligence is transforming industries worldwide. From healthcare to education, AI systems are automating complex tasks.");
      u.rate = 1.1;
      u.onend = () => setSpeaking(false);
      window.speechSynthesis.speak(u);
      setSpeaking(true);
    }
  };

  const features = [
    {
      id:1, emoji:"🔊", title:"Text-to-Speech",
      tag:"Live Feature", color:"#0891b2", bg:"#ecfeff", border:"#67e8f9",
      desc:"After generating your summary, listen to it read aloud in your chosen language and voice. Perfect for hands-free learning.",
      example:"Summary generated → Click Speak → AI narrates: 'The report highlights three key findings: rising temperatures, policy changes, and renewable energy targets...'",
    },
    {
      id:2, emoji:"🎙️", title:"Multi-Voice Narration",
      tag:"Popular", color:"#7c3aed", bg:"#faf5ff", border:"#c4b5fd",
      desc:"Choose from multiple voices — male, female, regional accents — and control the speed of narration from 0.5x to 2x.",
      example:"Voice: Microsoft Zira (English US) | Rate: 1.5x → Summary narrated clearly at custom speed with natural pauses between points.",
    },
    {
      id:3, emoji:"⏸️", title:"Pause, Resume & Stop",
      tag:"Control", color:"#ea580c", bg:"#fff7ed", border:"#fdba74",
      desc:"Full playback control — pause mid-sentence, resume exactly where you left off, or stop anytime with one click.",
      example:"Playing summary at 1.2x → User pauses at line 3 → Resumes later → Stops after completion. No need to re-read.",
    },
    {
      id:4, emoji:"🌐", title:"Multilingual Speech",
      tag:"New", color:"#16a34a", bg:"#f0fdf4", border:"#86efac",
      desc:"Summaries in Hindi, Bengali, Tamil, Telugu, Hinglish and more — narrated in the correct language and script.",
      example:"Input: English article → Language: Hindi → Summary: 'इस रिपोर्ट के अनुसार, जलवायु परिवर्तन एक गंभीर समस्या है...' → Narrated in Hindi voice.",
    },
    {
      id:5, emoji:"📱", title:"Hinglish Voice Mode",
      tag:"Unique", color:"#db2777", bg:"#fdf2f8", border:"#f9a8d4",
      desc:"Our unique Hinglish mode summarizes in Hindi words written in English letters — then reads it aloud naturally.",
      example:"Input: HR policy doc → Hinglish summary: 'Aapki joining date July 1 ko hai, aur probation period 3 mahine ka hoga...' → Narrated clearly.",
    },
    {
      id:6, emoji:"💾", title:"Save & Revisit",
      tag:"Library", color:"#ca8a04", bg:"#fefce8", border:"#fde68a",
      desc:"Every summary you generate is saved to your personal library. Revisit, re-read, or re-listen anytime you want.",
      example:"Library shows: 'Climate Report Summary — Saved Oct 12, 98% accuracy, English, 2min read' → Click to reload and listen again.",
    },
  ];

  const voiceStats = [
    { label:"Voices Available", value:"50+", color:"#0891b2", bg:"#ecfeff", border:"#67e8f9" },
    { label:"Languages Supported", value:"8+",  color:"#7c3aed", bg:"#faf5ff", border:"#c4b5fd" },
    { label:"Max Speed",           value:"2x",  color:"#ea580c", bg:"#fff7ed", border:"#fdba74" },
    { label:"Accuracy Rate",       value:"98%", color:"#16a34a", bg:"#f0fdf4", border:"#86efac" },
  ];

  return (
    <div style={{
      minHeight:"100vh",
      background:"linear-gradient(145deg,#fff7ed 0%,#fdf4ff 35%,#ecfeff 65%,#f0fdf4 100%)",
      fontFamily:"'Trebuchet MS','Segoe UI',sans-serif",
      color:"#0f172a",
      position:"relative",
      overflow:"hidden",
    }}>

      {/* Light blobs */}
      {[
        { top:"-60px",  left:"15%",    size:"280px", color:"#fde68a", op:0.38 },
        { top:"40%",    right:"-60px", size:"260px", color:"#c4b5fd", op:0.28 },
        { bottom:"-60px",left:"8%",    size:"280px", color:"#f9a8d4", op:0.28 },
        { top:"15%",    left:"-60px",  size:"200px", color:"#a5f3fc", op:0.32 },
      ].map((b,i)=>(
        <div key={i} style={{
          position:"absolute",borderRadius:"9999px",
          filter:"blur(90px)",pointerEvents:"none",
          width:b.size,height:b.size,
          top:b.top,left:b.left,bottom:b.bottom,right:b.right,
          backgroundColor:b.color,opacity:b.op,
        }}/>
      ))}

      {/* NAVBAR */}
      <nav style={{
        display:"flex",alignItems:"center",justifyContent:"space-between",
        padding:"0 48px",height:"64px",
        borderBottom:"1px solid rgba(0,0,0,0.06)",
        background:"rgba(255,255,255,0.82)",backdropFilter:"blur(16px)",
        position:"sticky",top:0,zIndex:100,
      }}>
        <div style={{display:"flex",alignItems:"center",gap:"10px",cursor:"pointer"}} onClick={()=>navigate("/login")}>
          <div style={{
            width:"34px",height:"34px",borderRadius:"9999px",
            background:"linear-gradient(135deg,#38bdf8,#2563eb)",
            display:"flex",alignItems:"center",justifyContent:"center",
            boxShadow:"0 4px 14px rgba(56,189,248,0.40)",
          }}>
            <div style={{width:"12px",height:"12px",background:"#fff",borderRadius:"9999px"}}/>
          </div>
          <span style={{fontWeight:800,fontSize:"17px",color:"#0f172a",letterSpacing:"-0.3px"}}>
            Summarize<span style={{
              background:"linear-gradient(135deg,#38bdf8,#2563eb)",
              WebkitBackgroundClip:"text",WebkitTextFillColor:"transparent",
            }}>.Pro</span>
          </span>
        </div>
        <div style={{display:"flex",gap:"28px",alignItems:"center",fontSize:"15px",fontWeight:600}}>
          {[["Home","/login"],["Images","/images"],["Initiative","/Initiative"],["Pricing","/pricing"]].map(([label,path])=>(
            <span key={label} onClick={()=>navigate(path)} style={{
              cursor:"pointer",
              color:label==="Initiative"?"#0891b2":"#64748b",
              borderBottom:label==="Initiative"?"2.5px solid #0891b2":"none",
              paddingBottom:"2px",transition:"color 0.2s",
            }}
              onMouseEnter={e=>e.target.style.color="#0891b2"}
              onMouseLeave={e=>e.target.style.color=label==="Initiative"?"#0891b2":"#64748b"}
            >{label}</span>
          ))}
        </div>
      </nav>

      {/* HERO */}
      <div style={{textAlign:"center",padding:"52px 48px 36px"}}>
        <div style={{
          display:"inline-flex",alignItems:"center",gap:"8px",
          background:"#ecfeff",border:"1.5px solid #67e8f9",
          borderRadius:"20px",padding:"5px 16px",marginBottom:"18px",
          fontSize:"12px",fontWeight:700,color:"#0891b2",
        }}>🔊 Speech & Voice Features</div>

        <div style={{
          fontSize:"48px",fontWeight:900,letterSpacing:"-1.5px",lineHeight:1.15,
          background:"linear-gradient(135deg,#0891b2,#7c3aed,#ea580c)",
          WebkitBackgroundClip:"text",WebkitTextFillColor:"transparent",
          marginBottom:"16px",
        }}>Listen to Your<br/>Summaries</div>

        <p style={{color:"#64748b",fontSize:"15px",maxWidth:"520px",margin:"0 auto 28px",lineHeight:1.7}}>
          Generate a summary then have it read aloud to you. Multi-language, multi-voice,
          full playback control. Learn on the go — eyes free.
        </p>

        {/* Live demo widget */}
        <div style={{
          display:"inline-flex",flexDirection:"column",alignItems:"center",gap:"12px",
          background:"rgba(255,255,255,0.90)",backdropFilter:"blur(16px)",
          border:"2px solid #a5f3fc",borderRadius:"18px",
          padding:"22px 32px",maxWidth:"500px",width:"100%",
          boxShadow:"0 8px 30px rgba(8,145,178,0.10)",
        }}>
          <div style={{fontSize:"13px",color:"#64748b",textAlign:"left",width:"100%",lineHeight:1.6,fontStyle:"italic"}}>
            "{demoText}"
          </div>
          <div style={{width:"100%",height:"1px",background:"#e2e8f0"}}/>
          <div style={{display:"flex",gap:"10px",alignItems:"center"}}>
            <button onClick={handleSpeak} style={{
              background:speaking?"#ef4444":"linear-gradient(135deg,#0891b2,#7c3aed)",
              border:"none",borderRadius:"10px",padding:"10px 24px",
              color:"#fff",fontWeight:700,fontSize:"13px",cursor:"pointer",
              fontFamily:"inherit",transition:"all 0.2s",
              boxShadow:"0 4px 14px rgba(8,145,178,0.25)",
            }}>
              {speaking?"⏹ Stop":"🔊 Hear It Live"}
            </button>
            <button onClick={()=>navigate("/main")} style={{
              background:"#ffffff",border:"1.5px solid #a5f3fc",
              borderRadius:"10px",padding:"10px 20px",
              color:"#0891b2",fontWeight:700,fontSize:"13px",cursor:"pointer",
              fontFamily:"inherit",transition:"all 0.2s",
            }}
              onMouseEnter={e=>{e.target.style.background="#ecfeff";}}
              onMouseLeave={e=>{e.target.style.background="#ffffff";}}
            >Try Full App →</button>
          </div>
          <div style={{fontSize:"11px",color:"#94a3b8"}}>
            ↑ Click to hear a live browser TTS demo
          </div>
        </div>
      </div>

      {/* VOICE STATS */}
      <div style={{
        display:"grid",gridTemplateColumns:"repeat(4,1fr)",
        gap:"14px",padding:"0 48px 36px",
        maxWidth:"900px",margin:"0 auto",
      }}>
        {voiceStats.map((s,i)=>(
          <div key={i} style={{
            background:"#ffffff",border:`2px solid ${s.border}`,
            borderRadius:"14px",padding:"18px 14px",textAlign:"center",
            boxShadow:`0 4px 16px ${s.color}12`,
          }}>
            <div style={{fontSize:"28px",fontWeight:900,color:s.color,lineHeight:1}}>{s.value}</div>
            <div style={{fontSize:"12px",color:"#64748b",marginTop:"5px",fontWeight:600}}>{s.label}</div>
          </div>
        ))}
      </div>

      {/* FEATURES GRID */}
      <div style={{padding:"0 48px 20px",maxWidth:"1100px",margin:"0 auto"}}>
        <div style={{textAlign:"center",marginBottom:"28px"}}>
          <div style={{fontSize:"22px",fontWeight:800,color:"#0f172a",letterSpacing:"-0.5px"}}>
            Voice & Speech Features
          </div>
          <p style={{color:"#64748b",fontSize:"14px",marginTop:"6px"}}>
            Click any card to see how it works
          </p>
        </div>

        <div style={{display:"grid",gridTemplateColumns:"repeat(3,1fr)",gap:"18px"}}>
          {features.map(f=>(
            <div key={f.id}
              onClick={()=>setActiveDemo(activeDemo===f.id?null:f.id)}
              onMouseEnter={()=>setHovered(f.id)}
              onMouseLeave={()=>setHovered(null)}
              style={{
                background:activeDemo===f.id?f.bg:"#ffffff",
                border:`2px solid ${activeDemo===f.id||hovered===f.id?f.border:"#f1f5f9"}`,
                borderRadius:"18px",padding:"24px 20px",
                cursor:"pointer",transition:"all 0.22s",
                transform:hovered===f.id?"translateY(-4px)":"translateY(0)",
                boxShadow:hovered===f.id?`0 14px 36px ${f.color}18`:"0 2px 10px rgba(0,0,0,0.05)",
              }}>
              <div style={{display:"flex",justifyContent:"space-between",alignItems:"flex-start",marginBottom:"14px"}}>
                <div style={{
                  width:"48px",height:"48px",borderRadius:"13px",
                  background:f.bg,border:`1.5px solid ${f.border}`,
                  display:"flex",alignItems:"center",justifyContent:"center",fontSize:"22px",
                }}>{f.emoji}</div>
                <span style={{
                  background:f.bg,color:f.color,
                  border:`1px solid ${f.border}`,
                  borderRadius:"20px",padding:"3px 10px",
                  fontSize:"10px",fontWeight:800,letterSpacing:"0.5px",
                }}>{f.tag}</span>
              </div>
              <div style={{fontSize:"16px",fontWeight:700,color:"#0f172a",marginBottom:"8px"}}>{f.title}</div>
              <div style={{fontSize:"13px",color:"#64748b",lineHeight:1.6,marginBottom:"14px"}}>{f.desc}</div>

              {activeDemo===f.id&&(
                <div style={{
                  background:f.bg,border:`1px solid ${f.border}`,
                  borderRadius:"10px",padding:"12px 14px",
                  fontSize:"12px",color:f.color,lineHeight:1.6,
                  fontStyle:"italic",marginBottom:"12px",
                }}>
                  💡 {f.example}
                </div>
              )}

              <button style={{
                background:activeDemo===f.id?f.color:"transparent",
                border:`1.5px solid ${f.border}`,
                borderRadius:"8px",padding:"7px 16px",
                color:activeDemo===f.id?"#fff":f.color,
                fontWeight:700,fontSize:"12px",cursor:"pointer",
                transition:"all 0.2s",fontFamily:"inherit",
              }}>
                {activeDemo===f.id?"Hide Example ↑":"See Example ↓"}
              </button>
            </div>
          ))}
        </div>
      </div>

      {/* CTA */}
      <div style={{textAlign:"center",padding:"48px 48px 60px"}}>
        <div style={{
          display:"inline-flex",flexDirection:"column",alignItems:"center",gap:"16px",
          background:"rgba(255,255,255,0.88)",backdropFilter:"blur(16px)",
          border:"2px solid #a5f3fc",borderRadius:"22px",
          padding:"36px 48px",
          boxShadow:"0 8px 32px rgba(8,145,178,0.10)",
        }}>
          <div style={{fontSize:"24px",fontWeight:900,color:"#0f172a",letterSpacing:"-0.5px"}}>
            Ready to hear your summaries? 🎧
          </div>
          <p style={{color:"#64748b",fontSize:"14px",margin:0,maxWidth:"380px",lineHeight:1.7}}>
            Generate a summary and use the built-in voice player to listen hands-free in any language.
          </p>
          <button onClick={()=>navigate("/main")} style={{
            background:"linear-gradient(135deg,#0891b2,#7c3aed)",
            border:"none",borderRadius:"12px",padding:"13px 36px",
            color:"#fff",fontWeight:800,fontSize:"15px",cursor:"pointer",
            fontFamily:"inherit",boxShadow:"0 6px 20px rgba(8,145,178,0.28)",
            transition:"all 0.2s",
          }}
            onMouseEnter={e=>{e.target.style.transform="translateY(-2px)";e.target.style.boxShadow="0 10px 28px rgba(8,145,178,0.36)";}}
            onMouseLeave={e=>{e.target.style.transform="translateY(0)";e.target.style.boxShadow="0 6px 20px rgba(8,145,178,0.28)";}}
          >🚀 Open Summarizer</button>
        </div>
      </div>
    </div>
  );
};

// Mobile responsive styles
const mobileStyles = `
  @media (max-width: 768px) {
    .initiative-container {
      padding: "15px !important";
    }
    
    .demo-section {
      padding: "20px !important";
    }
    
    .feature-card {
      padding: "15px !important";
    }
    
    .feature-title {
      font-size: "20px !important";
    }
    
    .feature-description {
      font-size: "14px !important";
    }
    
    .speak-button {
      padding: "12px 20px !important";
      font-size: "14px !important";
    }
    
    .demo-controls {
      flex-direction: "column !important";
      gap: "10px !important";
    }
  }
  
  @media (max-width: 480px) {
    .initiative-container {
      padding: "10px !important";
    }
    
    .demo-section {
      padding: "15px !important";
    }
    
    .feature-card {
      padding: "12px !important";
    }
    
    .feature-title {
      font-size: "18px !important";
    }
    
    .feature-description {
      font-size: "13px !important";
    }
    
    .speak-button {
      padding: "10px 16px !important";
      font-size: "13px !important";
    }
    
    .demo-controls {
      flex-direction: "column !important";
      gap: "8px !important";
    }
  }
`;

// Inject mobile styles
if (typeof window !== 'undefined') {
  const styleElement = document.createElement('style');
  styleElement.textContent = mobileStyles;
  document.head.appendChild(styleElement);
}

export default Initiative;
// // 📁 src/Images.jsx
// import React, { useState } from "react";
// import { useNavigate } from "react-router-dom";

// const Images = () => {
//   const navigate = useNavigate();
  
//   // State to track which screenshot is currently active
//   const [activeIndex, setActiveIndex] = useState(0);

//   // Array of your app screenshots
//   const screenshots = [
//     {
//       id: 0,
//       title: "Main Editor",
//       desc: "Clean interface for uploading PDFs and generating AI summaries.",
//       src: "/shot1.png" // Make sure shot1.png is in your public folder
//     },
//     {
//       id: 1,
//       title: "Interactive Dictionary",
//       desc: "Double-click any word to fetch its meaning instantly.",
//       src: "/shot2.png" // Make sure shot2.png is in your public folder
//     },
//     {
//       id: 2,
//       title: "Audio Player (TTS)",
//       desc: "Built-in voice narration with speed and voice controls.",
//       src: "/shot3.png" // Make sure shot3.png is in your public folder
//     },
//     {
//       id: 3,
//       title: "Saved Library",
//       desc: "Manage, search, and download your past summaries.",
//       src: "/shot4.png" // Make sure shot4.png is in your public folder
//     }
//   ];

//   return (
//     <div style={{
//       minHeight: "100vh",
//       background: "linear-gradient(145deg,#fefce8 0%,#f0fdf4 30%,#ecfeff 60%,#fdf4ff 100%)",
//       fontFamily: "'Trebuchet MS','Segoe UI',sans-serif",
//       color: "#0f172a",
//       position: "relative",
//       overflow: "hidden",
//     }}>

//       {/* Light blobs for background effect */}
//       {[
//         { top:"-60px",  left:"-60px",  size:"300px", color:"#a3e635", op:0.22 },
//         { top:"35%",    left:"55%",    size:"260px", color:"#f9a8d4", op:0.26 },
//         { bottom:"-60px",right:"-60px",size:"300px", color:"#7dd3fc", op:0.24 },
//         { top:"60%",    left:"-50px",  size:"200px", color:"#fde68a", op:0.32 },
//       ].map((b,i)=>(
//         <div key={i} style={{
//           position:"absolute",borderRadius:"9999px",
//           filter:"blur(90px)",pointerEvents:"none",
//           width:b.size,height:b.size,
//           top:b.top,left:b.left,bottom:b.bottom,right:b.right,
//           backgroundColor:b.color,opacity:b.op,
//         }}/>
//       ))}

//       {/* NAVBAR */}
//       <nav style={{
//         display:"flex",alignItems:"center",justifyContent:"space-between",
//         padding:"0 48px",height:"64px",
//         borderBottom:"1px solid rgba(0,0,0,0.06)",
//         background:"rgba(255,255,255,0.82)",backdropFilter:"blur(16px)",
//         position:"sticky",top:0,zIndex:100,
//       }}>
//         <div style={{display:"flex",alignItems:"center",gap:"10px",cursor:"pointer"}} onClick={()=>navigate("/login")}>
//           <div style={{
//             width:"34px",height:"34px",borderRadius:"9999px",
//             background:"linear-gradient(135deg,#38bdf8,#2563eb)",
//             display:"flex",alignItems:"center",justifyContent:"center",
//             boxShadow:"0 4px 14px rgba(56,189,248,0.40)",
//           }}>
//             <div style={{width:"12px",height:"12px",background:"#fff",borderRadius:"9999px"}}/>
//           </div>
//           <span style={{fontWeight:800,fontSize:"17px",color:"#0f172a",letterSpacing:"-0.3px"}}>
//             Summarize<span style={{
//               background:"linear-gradient(135deg,#38bdf8,#2563eb)",
//               WebkitBackgroundClip:"text",WebkitTextFillColor:"transparent",
//             }}>.Pro</span>
//           </span>
//         </div>
//         <div style={{display:"flex",gap:"28px",alignItems:"center",fontSize:"15px",fontWeight:600}}>
//           {[["Home","/login"],["Images","/images"],["Initiative","/Initiative"],["Pricing","/pricing"]].map(([label,path])=>(
//             <span key={label} onClick={()=>navigate(path)} style={{
//               cursor:"pointer",
//               color:label==="Images"?"#16a34a":"#64748b",
//               borderBottom:label==="Images"?"2.5px solid #16a34a":"none",
//               paddingBottom:"2px",transition:"color 0.2s",
//             }}
//               onMouseEnter={e=>e.target.style.color="#16a34a"}
//               onMouseLeave={e=>e.target.style.color=label==="Images"?"#16a34a":"#64748b"}
//             >{label}</span>
//           ))}
//         </div>
//       </nav>

//       {/* HERO SECTION */}
//       <div style={{textAlign:"center",padding:"52px 48px 20px",position:"relative"}}>
//         <div style={{
//           display:"inline-flex",alignItems:"center",gap:"8px",
//           background:"#f0fdf4",border:"1.5px solid #86efac",
//           borderRadius:"20px",padding:"5px 16px",marginBottom:"18px",
//           fontSize:"12px",fontWeight:700,color:"#16a34a",
//         }}>📄 See It In Action</div>

//         <div style={{
//           fontSize:"48px",fontWeight:900,letterSpacing:"-1.5px",lineHeight:1.15,
//           background:"linear-gradient(135deg,#16a34a,#0891b2,#7c3aed)",
//           WebkitBackgroundClip:"text",WebkitTextFillColor:"transparent",
//           marginBottom:"16px",
//         }}>Powerful AI Summarization<br/>Built For Your Workflow</div>

//         <p style={{color:"#64748b",fontSize:"15px",maxWidth:"580px",margin:"0 auto 32px",lineHeight:1.7}}>
//           Experience a clean, distraction-free interface designed to turn hours of reading into minutes. Explore our core features below.
//         </p>
//       </div>

//       {/* MULTIPLE SCREENSHOT GALLERY SECTION */}
//       <div style={{padding:"0px 48px 80px",maxWidth:"1100px",margin:"0 auto"}}>
        
//         {/* Main Large Display Image */}
//         <div style={{
//           background:"rgba(255, 255, 255, 0.5)",
//           backdropFilter:"blur(20px)",
//           border:"1px solid rgba(255, 255, 255, 0.8)",
//           borderRadius:"24px",
//           padding:"16px",
//           boxShadow:"0 25px 50px -12px rgba(0, 0, 0, 0.15)",
//           marginBottom: "24px"
//         }}>
//           {/* Top Browser Bar Mockup */}
//           <div style={{display:"flex", gap:"8px", marginBottom:"12px", paddingLeft:"8px"}}>
//             <div style={{width:"12px", height:"12px", borderRadius:"50%", background:"#ff5f56"}}></div>
//             <div style={{width:"12px", height:"12px", borderRadius:"50%", background:"#ffbd2e"}}></div>
//             <div style={{width:"12px", height:"12px", borderRadius:"50%", background:"#27c93f"}}></div>
//           </div>
          
//           <img 
//             src={screenshots[activeIndex].src} 
//             alt={screenshots[activeIndex].title} 
//             style={{
//               width:"100%",
//               height:"auto",
//               minHeight: "400px",
//               borderRadius:"12px",
//               display:"block",
//               border:"1px solid rgba(0,0,0,0.05)",
//               backgroundColor:"#e2e8f0", // Fallback color
//               objectFit: "cover"
//             }} 
//           />
//         </div>

//         {/* Thumbnail Selectors */}
//         <div style={{
//           display: "grid",
//           gridTemplateColumns: "repeat(4, 1fr)",
//           gap: "16px"
//         }}>
//           {screenshots.map((shot, index) => (
//             <div 
//               key={shot.id}
//               onClick={() => setActiveIndex(index)}
//               style={{
//                 background: activeIndex === index ? "#ffffff" : "rgba(255,255,255,0.4)",
//                 border: `2px solid ${activeIndex === index ? "#16a34a" : "transparent"}`,
//                 borderRadius: "16px",
//                 padding: "16px",
//                 cursor: "pointer",
//                 transition: "all 0.2s ease",
//                 boxShadow: activeIndex === index ? "0 10px 25px rgba(22,163,74,0.15)" : "none",
//                 transform: activeIndex === index ? "translateY(-4px)" : "translateY(0)"
//               }}
//               onMouseEnter={(e) => {
//                 if (activeIndex !== index) e.currentTarget.style.background = "rgba(255,255,255,0.8)";
//               }}
//               onMouseLeave={(e) => {
//                 if (activeIndex !== index) e.currentTarget.style.background = "rgba(255,255,255,0.4)";
//               }}
//             >
//               <div style={{fontSize:"15px", fontWeight:800, color:"#0f172a", marginBottom:"6px"}}>
//                 {shot.title}
//               </div>
//               <div style={{fontSize:"13px", color:"#64748b", lineHeight:1.5}}>
//                 {shot.desc}
//               </div>
//             </div>
//           ))}
//         </div>

//         {/* Call to Action Button */}
//         <div style={{textAlign: "center", marginTop: "48px"}}>
//           <button onClick={()=>navigate("/main")} style={{
//             background:"linear-gradient(135deg,#16a34a,#0891b2)",
//             border:"none",borderRadius:"12px",padding:"14px 40px",
//             color:"#fff",fontWeight:800,fontSize:"16px",cursor:"pointer",
//             fontFamily:"inherit",boxShadow:"0 6px 22px rgba(22,163,74,0.28)",
//             transition:"all 0.2s",
//           }}
//             onMouseEnter={e=>{e.target.style.transform="translateY(-2px)";e.target.style.boxShadow="0 10px 30px rgba(22,163,74,0.36)";}}
//             onMouseLeave={e=>{e.target.style.transform="translateY(0)";e.target.style.boxShadow="0 6px 22px rgba(22,163,74,0.28)";}}
//           >🚀 Open Summarizer Setup</button>
//         </div>

//       </div>
//     </div>
//   );
// };

// export default Images;

// 📁 src/Images.jsx
//
// 🖼️  Screenshots are served from the /public/ folder.
//     Make sure these 6 files exist in your project root /public/ directory:
//
//       /public/ss_input.png          → Source text input panel
//       /public/ss_sidebar.png        → Engine metrics + config sidebar
//       /public/ss_output.png         → AI synthesized content output
//       /public/ss_keywords.png       → Semantic keyword extract panel
//       /public/ss_savetolibrary.png  → Save to library button bar
//       /public/ss_library.png        → Saved library dark page
//
//     Because they live in /public/, reference them as "/ss_*.png" directly —
//     no import statements required.

import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const Images = () => {
  const navigate = useNavigate();
  const [activeSlide, setActiveSlide] = useState(0);

  const slides = [
    {
      label: "📄 Input",
      caption: "Paste or import any text — up to 5,000+ characters",
      img: "/ss_input.png",
      narrow: false,
    },
    {
      label: "⚙️ Configure",
      caption: "Engine metrics, language, tone, voice & format settings",
      img: "/ss_sidebar.png",
      narrow: true,
    },
    {
      label: "✨ Output",
      caption: "AI synthesized summary — speak it aloud or copy it",
      img: "/ss_output.png",
      narrow: false,
    },
    {
      label: "🔑 Keywords",
      caption: "Semantic keyword extraction from your content",
      img: "/ss_keywords.png",
      narrow: true,
    },
    {
      label: "🔑 Meaning",
      caption: "Dictionary meaning extraction from the summary",
      img: "/meaning.png",
      narrow: true,
    },
    {
      label: "💾 Save",
      caption: "One-click save to your personal library",
      img: "/ss_savetolibrary.png",
      narrow: true,
    },
    {
      label: "📚 Library",
      caption: "All your summaries — searchable, downloadable, reloadable",
      img: "/ss_library.png",
      narrow: false,
    },
  ];

  const howItWorks = [
    { step:"01", title:"Paste or Upload", desc:"Paste your text directly or upload a PDF document", emoji:"📥", color:"#16a34a", bg:"#f0fdf4", border:"#86efac" },
    { step:"02", title:"Choose Settings", desc:"Pick your language, tone, and summary length", emoji:"⚙️", color:"#7c3aed", bg:"#faf5ff", border:"#c4b5fd" },
    { step:"03", title:"Generate Summary", desc:"Hit the button and get your AI summary in seconds", emoji:"⚡", color:"#ea580c", bg:"#fff7ed", border:"#fdba74" },
    { step:"04", title:"Save & Share", desc:"Save to your library or copy to use anywhere", emoji:"💾", color:"#0891b2", bg:"#ecfeff", border:"#67e8f9" },
  ];

  const current = slides[activeSlide];

  return (
    <div style={{
      minHeight:"100vh",
      background:"linear-gradient(145deg,#fefce8 0%,#f0fdf4 30%,#ecfeff 60%,#fdf4ff 100%)",
      fontFamily:"'Trebuchet MS','Segoe UI',sans-serif",
      color:"#0f172a",
      position:"relative",
      overflow:"hidden",
    }}>

      {/* Blobs */}
      {[
        { top:"-60px",  left:"-60px",  size:"300px", color:"#a3e635", op:0.22 },
        { top:"35%",    left:"55%",    size:"260px", color:"#f9a8d4", op:0.26 },
        { bottom:"-60px",right:"-60px",size:"300px", color:"#7dd3fc", op:0.24 },
        { top:"60%",    left:"-50px",  size:"200px", color:"#fde68a", op:0.32 },
      ].map((b,i)=>(
        <div key={i} style={{
          position:"absolute",borderRadius:"9999px",filter:"blur(90px)",pointerEvents:"none",
          width:b.size,height:b.size,top:b.top,left:b.left,bottom:b.bottom,right:b.right,
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
              color:label==="Images"?"#16a34a":"#64748b",
              borderBottom:label==="Images"?"2.5px solid #16a34a":"none",
              paddingBottom:"2px",transition:"color 0.2s",
            }}
              onMouseEnter={e=>e.target.style.color="#16a34a"}
              onMouseLeave={e=>e.target.style.color=label==="Images"?"#16a34a":"#64748b"}
            >{label}</span>
          ))}
        </div>
      </nav>

      {/* HERO TEXT */}
      <div style={{textAlign:"center",padding:"52px 48px 36px",position:"relative"}}>
        <div style={{
          display:"inline-flex",alignItems:"center",gap:"8px",
          background:"#f0fdf4",border:"1.5px solid #86efac",
          borderRadius:"20px",padding:"5px 16px",marginBottom:"18px",
          fontSize:"12px",fontWeight:700,color:"#16a34a",
        }}>📄 Document & Text Summarization</div>

        <div style={{
          fontSize:"48px",fontWeight:900,letterSpacing:"-1.5px",lineHeight:1.15,
          background:"linear-gradient(135deg,#16a34a,#0891b2,#7c3aed)",
          WebkitBackgroundClip:"text",WebkitTextFillColor:"transparent",
          marginBottom:"16px",
        }}>Summarize Any<br/>Visual Content</div>

        <p style={{color:"#64748b",fontSize:"15px",maxWidth:"520px",margin:"0 auto 28px",lineHeight:1.7}}>
          PDFs, scanned images, infographics, articles — paste or upload anything
          and get an instant AI-powered summary. No fluff. Just the key points.
        </p>

        <div style={{display:"flex",gap:"12px",justifyContent:"center",flexWrap:"wrap"}}>
          <button onClick={()=>navigate("/main")} style={{
            background:"linear-gradient(135deg,#16a34a,#0891b2)",
            border:"none",borderRadius:"12px",padding:"13px 32px",
            color:"#fff",fontWeight:800,fontSize:"15px",cursor:"pointer",
            fontFamily:"inherit",boxShadow:"0 6px 20px rgba(22,163,74,0.28)",transition:"all 0.2s",
          }}
            onMouseEnter={e=>{e.target.style.transform="translateY(-2px)";e.target.style.boxShadow="0 10px 28px rgba(22,163,74,0.36)";}}
            onMouseLeave={e=>{e.target.style.transform="translateY(0)";e.target.style.boxShadow="0 6px 20px rgba(22,163,74,0.28)";}}
          >⚡ Try Summarizer Now</button>
          <button onClick={()=>navigate("/pricing")} style={{
            background:"#ffffff",border:"2px solid #e2e8f0",
            borderRadius:"12px",padding:"13px 32px",
            color:"#374151",fontWeight:700,fontSize:"15px",cursor:"pointer",
            fontFamily:"inherit",transition:"all 0.2s",boxShadow:"0 2px 8px rgba(0,0,0,0.06)",
          }}
            onMouseEnter={e=>{e.target.style.borderColor="#86efac";e.target.style.color="#16a34a";}}
            onMouseLeave={e=>{e.target.style.borderColor="#e2e8f0";e.target.style.color="#374151";}}
          >View Pricing →</button>
        </div>
      </div>

      {/* ── SCREENSHOT HERO ── */}
      <div style={{padding:"0 48px 64px",maxWidth:"1000px",margin:"0 auto"}}>

        <div style={{textAlign:"center",marginBottom:"20px"}}>
          <div style={{fontSize:"22px",fontWeight:800,color:"#0f172a",letterSpacing:"-0.5px"}}>
            See It In Action
          </div>
          <p style={{color:"#64748b",fontSize:"14px",marginTop:"6px"}}>
            Click any tab to explore the actual app
          </p>
        </div>

        {/* Tab pills */}
        <div style={{display:"flex",gap:"8px",justifyContent:"center",flexWrap:"wrap",marginBottom:"24px"}}>
          {slides.map((s,i)=>(
            <button key={i} onClick={()=>setActiveSlide(i)} style={{
              padding:"7px 18px",borderRadius:"20px",
              border:`2px solid ${activeSlide===i?"#16a34a":"#e2e8f0"}`,
              background:activeSlide===i?"#f0fdf4":"#fff",
              color:activeSlide===i?"#16a34a":"#94a3b8",
              fontWeight:700,fontSize:"12px",cursor:"pointer",
              fontFamily:"inherit",transition:"all 0.18s",
              boxShadow:activeSlide===i?"0 2px 10px rgba(22,163,74,0.14)":"none",
            }}>{s.label}</button>
          ))}
        </div>

        {/* Browser chrome frame */}
        <div style={{
          borderRadius:"18px",
          boxShadow:"0 40px 100px rgba(0,0,0,0.15), 0 2px 8px rgba(0,0,0,0.06)",
          border:"1.5px solid #e2e8f0",
          overflow:"hidden",
          background:"#fff",
        }}>
          {/* Browser top bar */}
          <div style={{
            background:"#f8fafc",borderBottom:"1px solid #e2e8f0",
            padding:"10px 16px",display:"flex",alignItems:"center",gap:"12px",
          }}>
            <div style={{display:"flex",gap:"7px"}}>
              {["#ff5f57","#febc2e","#28c840"].map(c=>(
                <div key={c} style={{width:"12px",height:"12px",borderRadius:"50%",background:c}}/>
              ))}
            </div>
            <div style={{
              flex:1,maxWidth:"380px",margin:"0 auto",
              background:"#fff",border:"1px solid #e2e8f0",
              borderRadius:"8px",padding:"5px 12px",
              display:"flex",alignItems:"center",gap:"8px",
            }}>
              <span style={{fontSize:"11px",color:"#94a3b8"}}>🔒</span>
              <span style={{fontSize:"12px",color:"#64748b",fontWeight:500}}>app.summarize.pro/main</span>
            </div>
            <div style={{
              marginLeft:"auto",
              background:"#f0fdf4",border:"1px solid #86efac",
              borderRadius:"8px",padding:"3px 10px",
              fontSize:"11px",color:"#16a34a",fontWeight:700,
            }}>{current.label}</div>
          </div>

          {/* Screenshot display */}
          <div style={{
            background: current.narrow ? "#f8fafc" : "#fff",
            display:"flex",justifyContent:"center",alignItems:"flex-start",
            padding: current.narrow ? "32px" : "0",
            minHeight:"300px",
          }}>
            <img
              src={current.img}
              alt={current.caption}
              style={{
                width: current.narrow ? "auto" : "100%",
                maxWidth: current.narrow ? "340px" : "100%",
                maxHeight:"580px",
                objectFit:"contain",
                display:"block",
                borderRadius: current.narrow ? "12px" : "0",
                boxShadow: current.narrow ? "0 8px 32px rgba(0,0,0,0.12)" : "none",
              }}
            />
          </div>

          {/* Caption + prev/next bar */}
          <div style={{
            background:"#f8fafc",borderTop:"1px solid #f1f5f9",
            padding:"10px 20px",
            display:"flex",alignItems:"center",justifyContent:"space-between",
          }}>
            <span style={{fontSize:"12px",color:"#64748b",fontStyle:"italic"}}>
              💡 {current.caption}
            </span>
            <div style={{display:"flex",alignItems:"center",gap:"14px"}}>
              <span
                onClick={()=>setActiveSlide(i=>Math.max(0,i-1))}
                style={{
                  fontSize:"18px",userSelect:"none",
                  cursor:activeSlide===0?"default":"pointer",
                  color:activeSlide===0?"#e2e8f0":"#94a3b8",
                }}
              >←</span>
              <span style={{fontSize:"11px",color:"#94a3b8",fontWeight:600}}>
                {activeSlide+1} / {slides.length}
              </span>
              <span
                onClick={()=>setActiveSlide(i=>Math.min(slides.length-1,i+1))}
                style={{
                  fontSize:"18px",userSelect:"none",
                  cursor:activeSlide===slides.length-1?"default":"pointer",
                  color:activeSlide===slides.length-1?"#e2e8f0":"#94a3b8",
                }}
              >→</span>
            </div>
          </div>
        </div>

        {/* Dot indicators */}
        <div style={{display:"flex",justifyContent:"center",gap:"6px",marginTop:"16px"}}>
          {slides.map((_,i)=>(
            <div key={i} onClick={()=>setActiveSlide(i)} style={{
              width:activeSlide===i?"22px":"8px",height:"8px",
              borderRadius:"9999px",
              background:activeSlide===i?"#16a34a":"#e2e8f0",
              cursor:"pointer",transition:"all 0.25s",
            }}/>
          ))}
        </div>
      </div>

      {/* HOW IT WORKS */}
      <div style={{padding:"0 48px 60px",maxWidth:"1100px",margin:"0 auto"}}>
        <div style={{textAlign:"center",marginBottom:"32px"}}>
          <div style={{fontSize:"22px",fontWeight:800,color:"#0f172a",letterSpacing:"-0.5px"}}>How It Works</div>
          <p style={{color:"#64748b",fontSize:"14px",marginTop:"6px"}}>4 simple steps to your perfect summary</p>
        </div>
        <div style={{display:"grid",gridTemplateColumns:"repeat(4,1fr)",gap:"16px"}}>
          {howItWorks.map((h,i)=>(
            <div key={h.step} style={{
              background:"#ffffff",border:`2px solid ${h.border}`,
              borderRadius:"16px",padding:"22px 18px",textAlign:"center",
              boxShadow:`0 4px 16px ${h.color}12`,position:"relative",
            }}>
              {i < howItWorks.length-1 && (
                <div style={{position:"absolute",top:"36px",right:"-22px",fontSize:"18px",color:"#cbd5e1",zIndex:2}}>→</div>
              )}
              <div style={{
                width:"48px",height:"48px",borderRadius:"13px",
                background:h.bg,border:`1.5px solid ${h.border}`,
                display:"flex",alignItems:"center",justifyContent:"center",
                fontSize:"22px",margin:"0 auto 12px",
              }}>{h.emoji}</div>
              <div style={{fontSize:"11px",fontWeight:800,color:h.color,letterSpacing:"1.5px",marginBottom:"6px"}}>STEP {h.step}</div>
              <div style={{fontSize:"15px",fontWeight:700,color:"#0f172a",marginBottom:"6px"}}>{h.title}</div>
              <div style={{fontSize:"12px",color:"#64748b",lineHeight:1.6}}>{h.desc}</div>
            </div>
          ))}
        </div>

        <div style={{textAlign:"center",marginTop:"40px"}}>
          <button onClick={()=>navigate("/main")} style={{
            background:"linear-gradient(135deg,#16a34a,#0891b2)",
            border:"none",borderRadius:"12px",padding:"14px 40px",
            color:"#fff",fontWeight:800,fontSize:"16px",cursor:"pointer",
            fontFamily:"inherit",boxShadow:"0 6px 22px rgba(22,163,74,0.28)",transition:"all 0.2s",
          }}
            onMouseEnter={e=>{e.target.style.transform="translateY(-2px)";e.target.style.boxShadow="0 10px 30px rgba(22,163,74,0.36)";}}
            onMouseLeave={e=>{e.target.style.transform="translateY(0)";e.target.style.boxShadow="0 6px 22px rgba(22,163,74,0.28)";}}
          >🚀 Start Summarizing for Free</button>
        </div>
      </div>

    </div>
  );
};

// Mobile responsive styles
const mobileStyles = `
  @media (max-width: 768px) {
    .screenshot-container {
      padding: "15px !important";
    }
    
    .screenshot-nav {
      flex-direction: "column !important";
      gap: "10px !important";
      margin-bottom: "20px !important";
    }
    
    .screenshot-card {
      padding: "15px !important";
    }
    
    .how-it-works {
      font-size: "18px !important";
    }
    
    .how-it-works h3 {
      font-size: "16px !important";
    }
    
    .how-it-works p {
      font-size: "13px !important";
    }
    
    .how-it-works-grid {
      grid-template-columns: "1fr !important";
      gap: "12px !important";
    }
    
    .step-card {
      padding: "12px !important";
    }
    
    .step-emoji {
      width: "36px !important";
      height: "36px !important";
      font-size: "18px !important";
    }
    
    .step-text {
      font-size: "14px !important";
    }
    
    .start-button {
      padding: "10px 20px !important";
      font-size: "14px !important";
    }
  }
  
  @media (max-width: 480px) {
    .screenshot-container {
      padding: "10px !important";
    }
    
    .screenshot-nav {
      gap: "8px !important";
      margin-bottom: "15px !important";
    }
    
    .screenshot-card {
      padding: "12px !important";
    }
    
    .how-it-works {
      font-size: "16px !important";
    }
    
    .how-it-works h3 {
      font-size: "14px !important";
    }
    
    .how-it-works p {
      font-size: "12px !important";
    }
    
    .how-it-works-grid {
      grid-template-columns: "1fr !important";
      gap: "10px !important";
    }
    
    .step-card {
      padding: "10px !important";
    }
    
    .step-emoji {
      width: "32px !important";
      height: "32px !important";
      font-size: "16px !important";
    }
    
    .step-text {
      font-size: "13px !important";
    }
    
    .start-button {
      padding: "8px 16px !important";
      font-size: "13px !important";
    }
  }
`;

// Inject mobile styles
if (typeof window !== 'undefined') {
  const styleElement = document.createElement('style');
  styleElement.textContent = mobileStyles;
  document.head.appendChild(styleElement);
}

export default Images;
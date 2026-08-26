// 📁 src/Pricing.jsx
import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const Pricing = () => {
  const navigate = useNavigate();
  const [billing, setBilling] = useState("monthly");
  const [hovered, setHovered] = useState(null);

  const plans = [
    {
      id:1, name:"Starter", emoji:"🌱",
      monthly:"Free", yearly:"Free",
      color:"#16a34a", bg:"#f0fdf4", border:"#86efac", glow:"rgba(22,163,74,0.18)",
      features:["50 summaries / month","PDF upload (5MB)","3 languages","Basic tone options","Community support"],
      cta:"Get Started", popular:false,
    },
    {
      id:2, name:"Pro", emoji:"⚡",
      monthly:"₹299", yearly:"₹199",
      color:"#ea580c", bg:"#fff7ed", border:"#fdba74", glow:"rgba(234,88,12,0.18)",
      features:["Unlimited summaries","PDF upload (50MB)","8 languages + Hinglish","All tone & format options","Voice narration","Save to Library","Priority support"],
      cta:"Go Pro ⚡", popular:true,
    },
    {
      id:3, name:"Team", emoji:"🚀",
      monthly:"₹799", yearly:"₹499",
      color:"#7c3aed", bg:"#faf5ff", border:"#c4b5fd", glow:"rgba(124,58,237,0.18)",
      features:["Everything in Pro","5 team members","Shared library","API access","Custom branding","Advanced analytics","Dedicated support"],
      cta:"Launch Team", popular:false,
    },
  ];

  return (
    <div style={{
      minHeight:"100vh",
      background:"linear-gradient(150deg,#fefce8 0%,#fff7ed 25%,#faf5ff 60%,#f0fdf4 100%)",
      fontFamily:"'Trebuchet MS','Segoe UI',sans-serif",
      color:"#0f172a",
      position:"relative",
      overflow:"hidden",
    }}>

      {/* Light blobs */}
      {[
        { top:"-60px",  left:"-60px",  size:"300px", color:"#fde68a", op:0.45 },
        { top:"30%",    left:"40%",    size:"260px", color:"#c4b5fd", op:0.28 },
        { bottom:"-60px",right:"-60px",size:"300px", color:"#86efac", op:0.35 },
        { top:"60%",    left:"-50px",  size:"220px", color:"#fdba74", op:0.32 },
        { top:"5%",     right:"5%",    size:"180px", color:"#a5f3fc", op:0.28 },
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
            background:"linear-gradient(135deg,#fbbf24,#7c3aed)",
            display:"flex",alignItems:"center",justifyContent:"center",
            boxShadow:"0 4px 14px rgba(251,191,36,0.40)",
          }}>
            <div style={{width:"12px",height:"12px",background:"#fff",borderRadius:"9999px"}}/>
          </div>
          <span style={{fontWeight:800,fontSize:"17px",color:"#0f172a",letterSpacing:"-0.3px"}}>
            Summarize<span style={{
              background:"linear-gradient(135deg,#fbbf24,#7c3aed)",
              WebkitBackgroundClip:"text",WebkitTextFillColor:"transparent",
            }}>.Pro</span>
          </span>
        </div>
        <div style={{display:"flex",gap:"28px",alignItems:"center",fontSize:"15px",fontWeight:600}}>
          {[["Home","/login"],["Images","/images"],["Initiative","/Initiative"],["Pricing","/pricing"]].map(([label,path])=>(
            <span key={label} onClick={()=>navigate(path)} style={{
              cursor:"pointer",
              color:label==="Pricing"?"#ea580c":"#64748b",
              borderBottom:label==="Pricing"?"2.5px solid #ea580c":"none",
              paddingBottom:"2px",transition:"color 0.2s",
            }}
              onMouseEnter={e=>e.target.style.color="#ea580c"}
              onMouseLeave={e=>e.target.style.color=label==="Pricing"?"#ea580c":"#64748b"}
            >{label}</span>
          ))}
        </div>
      </nav>

      {/* HERO */}
      <div style={{textAlign:"center",padding:"52px 48px 40px"}}>
        <div style={{
          display:"inline-block",
          fontSize:"52px",fontWeight:900,letterSpacing:"-1.5px",lineHeight:1.1,
          background:"linear-gradient(135deg,#fbbf24,#ea580c,#7c3aed,#16a34a)",
          WebkitBackgroundClip:"text",WebkitTextFillColor:"transparent",
        }}>Simple Pricing</div>
        <p style={{color:"#64748b",fontSize:"15px",marginTop:"10px",fontWeight:400}}>
          No hidden fees. No surprises. Just pure value.
        </p>

        {/* Billing toggle */}
        <div style={{
          display:"inline-flex",alignItems:"center",
          background:"#ffffff",border:"2px solid #e2e8f0",
          borderRadius:"14px",padding:"4px",marginTop:"24px",
          boxShadow:"0 4px 16px rgba(0,0,0,0.06)",
        }}>
          {["monthly","yearly"].map((b)=>(
            <button key={b} onClick={()=>setBilling(b)} style={{
              background:billing===b
                ?"linear-gradient(135deg,#fbbf24,#ea580c)"
                :"transparent",
              border:"none",borderRadius:"10px",
              padding:"8px 24px",
              color:billing===b?"#fff":"#64748b",
              fontWeight:700,fontSize:"13px",cursor:"pointer",
              fontFamily:"inherit",transition:"all 0.2s",
              textTransform:"capitalize",
            }}>
              {b}{b==="yearly"&&(
                <span style={{
                  background:"#dcfce7",color:"#15803d",
                  borderRadius:"10px",padding:"1px 8px",
                  fontSize:"10px",marginLeft:"6px",fontWeight:800,
                }}>-33%</span>
              )}
            </button>
          ))}
        </div>
      </div>

      {/* PRICING CARDS */}
      <div style={{
        display:"grid",gridTemplateColumns:"repeat(3,1fr)",
        gap:"22px",padding:"0 48px 60px",
        maxWidth:"1000px",margin:"0 auto",
        alignItems:"start",
      }}>
        {plans.map(p=>(
          <div key={p.id}
            onMouseEnter={()=>setHovered(p.id)}
            onMouseLeave={()=>setHovered(null)}
            style={{
              background: p.popular ? p.bg : "#ffffff",
              border:`2px solid ${p.popular||hovered===p.id ? p.border : "#f1f5f9"}`,
              borderRadius:"22px",padding:"32px 28px",
              cursor:"pointer",transition:"all 0.22s",
              transform:p.popular||hovered===p.id?"translateY(-6px)":"translateY(0)",
              boxShadow:p.popular
                ?`0 20px 50px ${p.glow}`
                :hovered===p.id?`0 14px 36px ${p.glow}`
                :"0 2px 12px rgba(0,0,0,0.05)",
              position:"relative",
            }}>

            {/* Popular badge */}
            {p.popular&&(
              <div style={{
                position:"absolute",top:"-14px",left:"50%",
                transform:"translateX(-50%)",
                background:"linear-gradient(135deg,#fbbf24,#ea580c)",
                borderRadius:"20px",padding:"4px 18px",
                fontSize:"11px",fontWeight:800,color:"#fff",
                letterSpacing:"0.5px",whiteSpace:"nowrap",
                boxShadow:"0 4px 14px rgba(234,88,12,0.30)",
              }}>⭐ MOST POPULAR</div>
            )}

            {/* Header */}
            <div style={{textAlign:"center",marginBottom:"22px"}}>
              <div style={{
                width:"56px",height:"56px",borderRadius:"16px",
                background:p.bg,border:`2px solid ${p.border}`,
                display:"flex",alignItems:"center",justifyContent:"center",
                fontSize:"28px",margin:"0 auto 12px",
              }}>{p.emoji}</div>
              <div style={{
                fontSize:"11px",fontWeight:700,letterSpacing:"2px",
                color:p.color,textTransform:"uppercase",marginBottom:"8px",
              }}>{p.name}</div>
              <div style={{
                fontSize:"42px",fontWeight:900,lineHeight:1,color:p.color,
              }}>
                {billing==="monthly"?p.monthly:p.yearly}
              </div>
              {p.monthly!=="Free"&&(
                <div style={{fontSize:"12px",color:"#94a3b8",marginTop:"4px"}}>per month</div>
              )}
            </div>

            {/* Divider */}
            <div style={{
              height:"1.5px",
              background:`linear-gradient(90deg,transparent,${p.border},transparent)`,
              marginBottom:"18px",
            }}/>

            {/* Features */}
            <div style={{display:"flex",flexDirection:"column",gap:"10px",marginBottom:"22px"}}>
              {p.features.map((f,i)=>(
                <div key={i} style={{display:"flex",alignItems:"center",gap:"10px",fontSize:"13px"}}>
                  <span style={{
                    width:"20px",height:"20px",borderRadius:"9999px",
                    background:p.bg,border:`1.5px solid ${p.border}`,
                    display:"flex",alignItems:"center",justifyContent:"center",
                    fontSize:"11px",flexShrink:0,color:p.color,fontWeight:800,
                  }}>✓</span>
                  <span style={{color:"#374151"}}>{f}</span>
                </div>
              ))}
            </div>

            {/* CTA */}
            <button style={{
              width:"100%",
              background:p.popular||hovered===p.id?p.color:"transparent",
              border:`2px solid ${p.border}`,
              borderRadius:"11px",padding:"12px",
              color:p.popular||hovered===p.id?"#fff":p.color,
              fontWeight:800,fontSize:"14px",cursor:"pointer",
              transition:"all 0.22s",fontFamily:"inherit",
              boxShadow:p.popular?`0 6px 20px ${p.glow}`:"none",
            }}
              onMouseEnter={e=>{e.target.style.background=p.color;e.target.style.color="#fff";e.target.style.transform="scale(1.02)";}}
              onMouseLeave={e=>{if(!p.popular){e.target.style.background="transparent";e.target.style.color=p.color;}e.target.style.transform="scale(1)";}}
            >{p.cta}</button>
          </div>
        ))}
      </div>

      {/* Bottom note */}
      <div style={{textAlign:"center",paddingBottom:"48px",color:"#94a3b8",fontSize:"13px"}}>
        All plans include 14-day free trial · No credit card required
      </div>
    </div>
  );
};

// Mobile responsive styles
  const mobileStyles = `
    @media (max-width: 768px) {
      .pricing-container {
        padding: "15px !important";
      }
      
      .plan-grid {
        grid-template-columns: 1fr !important;
        gap: "15px !important";
      }
      
      .plan-card {
        padding: "20px !important";
      }
      
      .pricing-header {
        font-size: "24px !important";
      }
      
      .plan-features {
        font-size: "14px !important";
      }
      
      .cta-button {
        width: "100% !important";
        padding: "12px 20px !important";
        font-size: "16px !important";
      }
    }
    
    @media (max-width: 480px) {
      .pricing-container {
        padding: "10px !important";
      }
      
      .plan-card {
        padding: "15px !important";
      }
      
      .pricing-header {
        font-size: "20px !important";
      }
      
      .plan-features {
        font-size: "13px !important";
      }
      
      .cta-button {
        padding: "10px 16px !important";
        font-size: "14px !important";
      }
    }
  `;

  // Inject mobile styles
  if (typeof window !== 'undefined') {
    const styleElement = document.createElement('style');
    styleElement.textContent = mobileStyles;
    document.head.appendChild(styleElement);
  }

export default Pricing;
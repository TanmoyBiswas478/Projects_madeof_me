// ===== Login.jsx =====
import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { sendOTP } from "../utils/emailService";

const Login = () => {
  const navigate = useNavigate();

  const [email, setEmail] = useState("");
  const [name, setName] = useState("");
  const [error, setError] = useState("");
  const [isLoading, setIsLoading] = useState(false);

  // OTP related states
  const [showOTP, setShowOTP] = useState(false);
  const [otp, setOtp] = useState("");
  const [otpSent, setOtpSent] = useState(false);

  // Sign up / Sign in toggle
  const [isSignUp, setIsSignUp] = useState(false);

  // NAV ROUTES
  const navRoutes = {
    Home: "/login",
    Images: "/images",
    Initiative: "/initiative",
    Pricing: "/pricing",
  };

  // Toggle between Sign In and Sign Up
  const toggleSignUp = () => {
    setIsSignUp(!isSignUp);
    setError("");
    setShowOTP(false);
    setOtp("");
    setOtpSent(false);
    setName("");
  };

  // MORNING MIST - Light sky-blue + deep blue gradient
  // Clean white cards, sky bg, gradient accents
  const styles = {
    // PAGE - soft sky white background
    container: {
      position: "relative",
      minHeight: "100vh",
      overflow: "hidden",
      background: "linear-gradient(160deg, #f0f9ff 0%, #e0f2fe 35%, #f8fbff 65%, #eff6ff 100%)",
      color: "#0a2540",
      fontFamily: "'Inter', -apple-system, BlinkMacSystemFont, sans-serif",
    },

    // Very soft blobs - sky blue tones, ultra-low opacity
    backgroundPattern: {
      position: "absolute",
      borderRadius: "9999px",
      filter: "blur(110px)",
      pointerEvents: "none",
    },
    bgPattern1: {
      top: "-60px",
      left: "-60px",
      width: "350px",
      height: "350px",
      backgroundColor: "#38bdf8",
      opacity: 0.18,
    },
    bgPattern2: {
      top: "28%",
      left: "38%",
      width: "300px",
      height: "300px",
      backgroundColor: "#7dd3fc",
      opacity: 0.12,
    },
    bgPattern3: {
      bottom: "-60px",
      right: "-60px",
      width: "350px",
      height: "350px",
      backgroundColor: "#93c5fd",
      opacity: 0.20,
    },
    bgPattern4: {
      top: "58%",
      left: "-80px",
      width: "220px",
      height: "220px",
      backgroundColor: "#38bdf8",
      opacity: 0.10,
    },
    bgPattern5: {
      bottom: "10%",
      right: "16%",
      width: "190px",
      height: "190px",
      backgroundColor: "#bae6fd",
      opacity: 0.20,
    },
    bgPattern6: {
      top: "10%",
      right: "8%",
      width: "170px",
      height: "170px",
      backgroundColor: "#7dd3fc",
      opacity: 0.15,
    },

    mainContainer: {
      position: "relative",
      zIndex: 10,
    },

    glassBackground: {
      display: "flex",
      flexDirection: "column",
      height: "100vh",
      padding: "0 48px",
    },

    mainContent: {
      display: "flex",
      flex: 1,
      alignItems: "center",
      gap: "60px",
      marginTop: "40px",
    },

    // NAVBAR - Original beautiful design
    navBar: {
      display: "flex",
      justifyContent: "space-between",
      alignItems: "center",
      height: "64px",
      borderBottom: "1px solid rgba(56,189,248,0.15)",
    },
    logoSection: {
      display: "flex",
      alignItems: "center",
      gap: "10px",
    },
    logoCircle: {
      width: "34px",
      height: "34px",
      background: "linear-gradient(135deg, #38bdf8, #2563eb)",
      borderRadius: "9999px",
      display: "flex",
      alignItems: "center",
      justifyContent: "center",
      boxShadow: "0 4px 14px rgba(56,189,248,0.40)",
    },
    logoInner: {
      width: "12px",
      height: "12px",
      backgroundColor: "#fff",
      borderRadius: "9999px",
    },
    logoText: {
      fontWeight: 700,
      fontSize: "20px",
      color: "#0a2540",
      letterSpacing: "-0.3px",
    },
    navLinks: {
      display: "flex",
      alignItems: "center",
      gap: "28px",
      fontSize: "17px",
      fontWeight: 500,
    },
    navLink: {
      cursor: "pointer",
      transition: "color 0.2s",
      color: "#4a7fa5",
    },
    joinBtn: {
      border: "1.5px solid #38bdf8",
      padding: "6px 20px",
      borderRadius: "20px",
      color: "#0284c7",
      backgroundColor: "transparent",
      fontWeight: 600,
      cursor: "pointer",
      transition: "all 0.2s",
    },

    leftSection: {
      flex: 1,
      maxWidth: "500px",
      display: "flex",
      flexDirection: "column",
      justifyContent: "center",
    },

    descriptionText: {
      fontSize: "38px",
      fontWeight: 800,
      lineHeight: "1.32",
      color: "#0a2540",
      letterSpacing: "-0.7px",
      margin: 0,
    },

    // Sky-to-blue gradient on the accent word
    descriptionAccent: {
      background: "linear-gradient(135deg, #38bdf8 0%, #2563eb 100%)",
      WebkitBackgroundClip: "text",
      WebkitTextFillColor: "transparent",
      backgroundClip: "text",
    },

    descriptionSub: {
      marginTop: "18px",
      fontSize: "14px",
      color: "#4a7fa5",
      fontWeight: 400,
      lineHeight: "1.75",
    },

    // Floating badge under subtitle
    badgeRow: {
      display: "flex",
      gap: "10px",
      marginTop: "22px",
      flexWrap: "wrap",
    },
    badge: {
      display: "inline-flex",
      alignItems: "center",
      gap: "5px",
      background: "rgba(56,189,248,0.10)",
      border: "1px solid rgba(56,189,248,0.25)",
      borderRadius: "20px",
      padding: "5px 13px",
      fontSize: "12px",
      fontWeight: 600,
      color: "#0369a1",
    },

    // FORM CARD
    rightSection: {
      flex: 1,
      display: "flex",
      justifyContent: "center",
      alignItems: "center",
    },
    formContainer: {
      background: "rgba(255,255,255,0.88)",
      backdropFilter: "blur(24px)",
      WebkitBackdropFilter: "blur(24px)",
      padding: "44px 40px",
      borderRadius: "24px",
      width: "100%",
      maxWidth: "395px",
      border: "1px solid rgba(186,230,253,0.70)",
      boxShadow: "0 8px 40px rgba(56,189,248,0.10), 0 2px 8px rgba(37,99,235,0.06)",
    },
    formTitle: {
      fontSize: "25px",
      fontWeight: 800,
      textAlign: "center",
      marginBottom: "8px",
      marginTop: 0,
      color: "#0a2540",
      letterSpacing: "-0.5px",
    },
    formSubtitle: {
      fontSize: "15px",
      textAlign: "center",
      color: "#4a7fa5",
      marginBottom: "22px",
      fontWeight: 400,
    },
    formFields: {
      display: "flex",
      flexDirection: "column",
      gap: "12px",
    },
    inputGroup: {
      display: "flex",
      flexDirection: "column",
    },
    inputField: {
      padding: "13px 16px",
      borderRadius: "11px",
      border: "1.5px solid #bae6fd",
      backgroundColor: "#f0f9ff",
      color: "#0a2540",
      fontSize: "14px",
      outline: "none",
      width: "100%",
      boxSizing: "border-box",
      transition: "border-color 0.2s, box-shadow 0.2s, background 0.2s",
      fontFamily: "inherit",
    },
    signinBtn: {
      background: "linear-gradient(135deg, #38bdf8 0%, #2563eb 100%)",
      color: "#fff",
      padding: "13px",
      borderRadius: "11px",
      fontWeight: 700,
      fontSize: "15px",
      cursor: "pointer",
      border: "none",
      width: "100%",
      marginTop: "4px",
      boxShadow: "0 4px 18px rgba(37,99,235,0.28)",
      letterSpacing: "0.2px",
      transition: "opacity 0.2s, transform 0.15s, box-shadow 0.2s",
      fontFamily: "inherit",
    },
    signupLink: {
      textAlign: "center",
      fontSize: "13px",
      color: "#4a7fa5",
      marginTop: "4px",
    },
    signupText: {
      textDecoration: "none",
      cursor: "pointer",
      fontWeight: 700,
      background: "linear-gradient(135deg, #38bdf8, #2563eb)",
      WebkitBackgroundClip: "text",
      WebkitTextFillColor: "transparent",
      backgroundClip: "text",
    },
    divider: {
      textAlign: "center",
      color: "#7ab8d4",
      fontSize: "13px",
    },
    socialButtons: {
      display: "flex",
      justifyContent: "space-between",
      gap: "12px",
    },
    socialBtn: {
      flex: 1,
      padding: "10px",
      backgroundColor: "#f0f9ff",
      color: "#0284c7",
      border: "1px solid #bae6fd",
      borderRadius: "9px",
      fontWeight: 600,
      fontSize: "13px",
      cursor: "pointer",
      transition: "background-color 0.2s",
    },
    otpContainer: {
      display: "flex",
      gap: "8px",
      marginTop: "8px",
    },
    otpInput: {
      width: "45px",
      height: "45px",
      textAlign: "center",
      fontSize: "18px",
      fontWeight: "600",
      borderRadius: "8px",
      border: "1.5px solid #bae6fd",
      backgroundColor: "#f0f9ff",
      color: "#0a2540",
      outline: "none",
      transition: "border-color 0.2s, box-shadow 0.2s",
    },
    resendBtn: {
      background: "transparent",
      color: "#0284c7",
      border: "1px solid #bae6fd",
      padding: "8px 16px",
      borderRadius: "8px",
      fontSize: "13px",
      fontWeight: "600",
      cursor: "pointer",
      marginTop: "8px",
      transition: "all 0.2s",
    },
  };

  const handleSendOTP = async () => {
    if (!email) {
      setError("Please enter your email address");
      return;
    }

    if (!email.includes("@")) {
      setError("Please enter a valid email address");
      return;
    }

    // Check if email is in deleted accounts list (account was deleted)
    const deletedAccounts = JSON.parse(localStorage.getItem("deletedAccounts") || "[]");
    if (deletedAccounts.includes(email.toLowerCase()) && !isSignUp) {
      setError("This account has been deleted. Please sign up again to create a new account.");
      return;
    }

    if (isSignUp && !name.trim()) {
      setError("Please enter your name for Sign Up");
      return;
    }

    setIsLoading(true);
    setError("");

    try {
      const result = await sendOTP(email);
      if (result.success) {
        setShowOTP(true);
        setOtpSent(true);
        setError("");
      } else {
        setError(result.message || "Failed to send OTP. Please try again.");
      }
    } catch (err) {
      setError("Failed to send OTP. Please check your email and try again.");
    } finally {
      setIsLoading(false);
    }
  };

  const handleVerifyOTP = () => {
    if (otp.length !== 6) {
      setError("Please enter a 6-digit OTP");
      return;
    }

    // Verify OTP from localStorage - handle both string and JSON formats
    const storedOTPData = localStorage.getItem(`otp_${email.toLowerCase()}`);
    
    if (storedOTPData) {
      let storedOTP;
      try {
        // Try to parse as JSON (new format)
        const parsed = JSON.parse(storedOTPData);
        storedOTP = parsed.otp;
      } catch (e) {
        // If not JSON, treat as string (old format)
        storedOTP = storedOTPData;
      }
      
      if (storedOTP === otp) {
        // OTP verified successfully
        const userData = {
          email: email,
          name: isSignUp ? name : email.split("@")[0], // Use provided name for Sign Up
          picture: null, // No profile picture for now
        };

        // Store user data
        localStorage.setItem("user", JSON.stringify(userData));
        localStorage.setItem("isLoggedIn", "true");
        
        // If this is a Sign Up, remove email from deleted accounts list
        if (isSignUp) {
          const deletedAccounts = JSON.parse(localStorage.getItem("deletedAccounts") || "[]");
          // FIX: Use 'accEmail' so we don't shadow the 'email' state variable
          const updatedDeletedAccounts = deletedAccounts.filter((accEmail) => accEmail !== email.toLowerCase());
          localStorage.setItem("deletedAccounts", JSON.stringify(updatedDeletedAccounts));
        }
        
        // Clear OTP
        localStorage.removeItem(`otp_${email.toLowerCase()}`);
        
        // Navigate to main page
        navigate("/main");
        return;
      }
    }
    
    setError("Invalid OTP. Please try again.");
  };

  const handleOTPChange = (e, index) => {
    const value = e.target.value;
    
    // Only allow numbers
    if (!/^\d*$/.test(value)) return;
    
    const newOtp = otp.split("");
    newOtp[index] = value;
    setOtp(newOtp.join(""));

    // Auto-focus next input
    if (value && index < 5) {
      const nextInput = document.getElementById(`otp-${index + 1}`);
      if (nextInput) nextInput.focus();
    }
  };

  const handleResendOTP = async () => {
    setOtp("");
    await handleSendOTP();
  };

  return (
    <div style={styles.container}>
      {/* Subtle background blobs */}
      <div style={{ ...styles.backgroundPattern, ...styles.bgPattern1 }}></div>
      <div style={{ ...styles.backgroundPattern, ...styles.bgPattern2 }}></div>
      <div style={{ ...styles.backgroundPattern, ...styles.bgPattern3 }}></div>
      <div style={{ ...styles.backgroundPattern, ...styles.bgPattern4 }}></div>
      <div style={{ ...styles.backgroundPattern, ...styles.bgPattern5 }}></div>
      <div style={{ ...styles.backgroundPattern, ...styles.bgPattern6 }}></div>

      <div style={styles.mainContainer}>
        <div style={styles.glassBackground}>

          {/* NAVBAR - Original beautiful design */}
          <div style={styles.navBar}>
            <div style={styles.logoSection}>
              <div style={styles.logoCircle}>
                <div style={styles.logoInner}></div>
              </div>
              <span style={styles.logoText}>
                Summarize
                <span style={{
                  background: "linear-gradient(135deg,#38bdf8,#2563eb)",
                  WebkitBackgroundClip: "text",
                  WebkitTextFillColor: "transparent",
                  backgroundClip: "text",
                }}>.Pro</span>
              </span>
            </div>

            <div style={styles.navLinks}>
              {["Home", "Images", "Initiative", "Pricing"].map((item) => (
                <span
                  key={item}
                  style={styles.navLink}
                  onClick={() => navigate(navRoutes[item])}
                  onMouseEnter={(e) => (e.target.style.color = "#0284c7")}
                  onMouseLeave={(e) => (e.target.style.color = "#4a7fa5")}
                >
                  {item}
                </span>
              ))}
              <span
                style={{ ...styles.navLink, ...styles.joinBtn }}
                onClick={() => setIsSignUp(true)}
                onMouseEnter={(e) => {
                  e.target.style.background = "linear-gradient(135deg,#38bdf8,#2563eb)";
                  e.target.style.color = "#fff";
                  e.target.style.borderColor = "transparent";
                }}
                onMouseLeave={(e) => {
                  e.target.style.background = "transparent";
                  e.target.style.color = "#0284c7";
                  e.target.style.borderColor = "#38bdf8";
                }}
              >
                Join
              </span>
            </div>
          </div>

          {/* MAIN */}
          <div style={styles.mainContent}>
            {/* LEFT */}
            <div style={styles.leftSection}>
              <p style={styles.descriptionText}>
                The best free<br />
                <span style={styles.descriptionAccent}>Summarizer</span><br />
                Texts, PDFs,<br />
                Licence free text &<br />
                pdf summarized by users.
              </p>
              <p style={styles.descriptionSub}>
                Paste any text or upload a PDF and get<br />
                a clean, accurate AI summary in seconds.
              </p>
              <div style={styles.badgeRow}>
                <span style={styles.badge}>⚡ AI Powered</span>
                <span style={styles.badge}>📄 PDF Support</span>
                <span style={styles.badge}>🌐 Multi-language</span>
              </div>
            </div>

            {/* RIGHT - FORM */}
            <div style={styles.rightSection}>
              <div style={styles.formContainer}>
                  <h2 style={styles.formTitle}>
                    {showOTP ? "Verify OTP" : (isSignUp ? "Sign up" : "Sign in")}
                  </h2>
                  <p style={styles.formSubtitle}>
                    {showOTP 
                      ? "Enter the 6-digit code sent to your email"
                      : (isSignUp ? "Create your account with email verification" : "Enter your email to receive OTP")
                    }
                  </p>

                  <div style={styles.formFields}>

                    {!showOTP ? (
                      // Email Input Form
                      <>
                        {isSignUp && (
                          <div style={styles.inputGroup}>
                            <input
                              type="text"
                              placeholder="Your Name"
                              value={name}
                              onChange={(e) => setName(e.target.value)}
                              style={styles.inputField}
                              onFocus={(e) => {
                                e.target.style.borderColor = "#38bdf8";
                                e.target.style.boxShadow = "0 0 0 3px rgba(56,189,248,0.14)";
                                e.target.style.backgroundColor = "#fff";
                              }}
                              onBlur={(e) => {
                                e.target.style.borderColor = "#bae6fd";
                                e.target.style.boxShadow = "none";
                                e.target.style.backgroundColor = "#f0f9ff";
                              }}
                            />
                          </div>
                        )}
                        <div style={styles.inputGroup}>
                          <input
                            type="email"
                            placeholder="Email Address"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            style={styles.inputField}
                            onFocus={(e) => {
                              e.target.style.borderColor = "#38bdf8";
                              e.target.style.boxShadow = "0 0 0 3px rgba(56,189,248,0.14)";
                              e.target.style.backgroundColor = "#fff";
                            }}
                            onBlur={(e) => {
                              e.target.style.borderColor = "#bae6fd";
                              e.target.style.boxShadow = "none";
                              e.target.style.backgroundColor = "#f0f9ff";
                            }}
                          />
                        </div>

                        <button
                          style={styles.signinBtn}
                          onClick={handleSendOTP}
                          disabled={isLoading}
                          onMouseEnter={(e) => {
                            e.target.style.opacity = "0.90";
                            e.target.style.transform = "translateY(-1px)";
                            e.target.style.boxShadow = "0 8px 26px rgba(37,99,235,0.36)";
                          }}
                          onMouseLeave={(e) => {
                            e.target.style.opacity = "1";
                            e.target.style.transform = "translateY(0)";
                            e.target.style.boxShadow = "0 4px 18px rgba(37,99,235,0.28)";
                          }}
                        >
                          {isLoading ? "Sending..." : "Send OTP"}
                        </button>
                      </>
                    ) : (
                      // OTP Verification Form
                      <>
                        <div style={styles.otpContainer}>
                          {[0, 1, 2, 3, 4, 5].map((index) => (
                            <input
                              key={index}
                              id={`otp-${index}`}
                              type="text"
                              maxLength={1}
                              value={otp[index] || ""}
                              onChange={(e) => handleOTPChange(e, index)}
                              style={styles.otpInput}
                              onFocus={(e) => {
                                e.target.style.borderColor = "#38bdf8";
                                e.target.style.boxShadow = "0 0 0 3px rgba(56,189,248,0.14)";
                                e.target.style.backgroundColor = "#fff";
                              }}
                              onBlur={(e) => {
                                e.target.style.borderColor = "#bae6fd";
                                e.target.style.boxShadow = "none";
                                e.target.style.backgroundColor = "#f0f9ff";
                              }}
                            />
                          ))}
                        </div>

                        <button
                          style={styles.signinBtn}
                          onClick={handleVerifyOTP}
                          onMouseEnter={(e) => {
                            e.target.style.opacity = "0.90";
                            e.target.style.transform = "translateY(-1px)";
                            e.target.style.boxShadow = "0 8px 26px rgba(37,99,235,0.36)";
                          }}
                          onMouseLeave={(e) => {
                            e.target.style.opacity = "1";
                            e.target.style.transform = "translateY(0)";
                            e.target.style.boxShadow = "0 4px 18px rgba(37,99,235,0.28)";
                          }}
                        >
                          Verify OTP
                        </button>

                        <button
                          style={styles.resendBtn}
                          onClick={handleResendOTP}
                          onMouseEnter={(e) => {
                            e.target.style.background = "linear-gradient(135deg,#38bdf8,#2563eb)";
                            e.target.style.color = "#fff";
                            e.target.style.borderColor = "transparent";
                          }}
                          onMouseLeave={(e) => {
                            e.target.style.background = "transparent";
                            e.target.style.color = "#0284c7";
                            e.target.style.borderColor = "#bae6fd";
                          }}
                        >
                          Resend OTP
                        </button>
                      </>
                    )}

                    {/* Error Message */}
                    {error && (
                      <div
                        style={{
                          color: "#0369a1",
                          textAlign: "center",
                          fontSize: "13px",
                          fontWeight: 500,
                          background: "#f0f9ff",
                          border: "1px solid #bae6fd",
                          borderRadius: "9px",
                          padding: "9px 12px",
                        }}
                      >
                        {error}
                      </div>
                    )}

                    <div style={styles.signupLink}>
                      {isSignUp ? "Already Have An Account?" : "Don't Have An Account?"}{" "}
                      <span
                        style={styles.signupText}
                        onClick={toggleSignUp}
                        onMouseEnter={(e) => (e.target.style.textDecoration = "underline")}
                        onMouseLeave={(e) => (e.target.style.textDecoration = "none")}
                      >
                        {isSignUp ? "Sign In" : "Sign Up"}
                      </span>
                    </div>

                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

// Mobile responsive styles
  const mobileStyles = `
    @media (max-width: 768px) {
      .container {
        padding: "10px 20px !important";
        width: "95% !important";
      }
      
      .mainContent {
        flex-direction: "column !important";
        padding: "15px !important";
      }
      
      .leftSection {
        width: "100% !important";
        padding: "20px !important";
        margin-bottom: "20px !important";
      }
      
      .rightSection {
        width: "100% !important";
        padding: "20px !important";
      }
      
      .container1 {
        padding: "15px 20px !important";
        width: "100% !important";
      }
      
      .inputField {
        padding: "12px 16px !important";
        font-size: "16px !important";
      }
      
      .btn-primary {
        padding: "12px 24px !important";
        font-size: "16px !important";
        width: "100% !important";
      }
      
      .btn-secondary {
        padding: "10px 20px !important";
        font-size: "14px !important";
        width: "100% !important";
      }
      
      .signupLink {
        font-size: "14px !important";
        margin-top: "15px !important";
      }
    }
    
    @media (max-width: 480px) {
      .container {
        padding: "8px 15px !important";
      }
      
      .mainContent {
        padding: "10px !important";
      }
      
      .leftSection {
        padding: "15px !important";
      }
      
      .rightSection {
        padding: "15px !important";
      }
      
      .container1 {
        padding: "10px 15px !important";
      }
      
      .inputField {
        padding: "10px 12px !important";
        font-size: "16px !important";
      }
      
      .btn-primary {
        padding: "10px 20px !important";
        font-size: "15px !important";
      }
      
      .btn-secondary {
        padding: "8px 16px !important";
        font-size: "13px !important";
      }
      
      .signupLink {
        font-size: "13px !important";
        margin-top: "10px !important";
      }
    }
  `;

  // Inject mobile styles
  if (typeof window !== 'undefined') {
    const styleElement = document.createElement('style');
    styleElement.textContent = mobileStyles;
    document.head.appendChild(styleElement);
  }

export default Login;
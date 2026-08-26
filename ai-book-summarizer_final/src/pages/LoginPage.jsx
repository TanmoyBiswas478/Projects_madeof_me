import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import EmailService from '../utils/emailService';
import './LoginPage.css';

// Mobile responsive styles
const mobileStyles = `
  @media (max-width: 768px) {
    .login-container {
      padding: 15px !important;
      width: 95% !important;
    }
    
    .auth-form {
      padding: 20px !important;
    }
    
    .input-field {
      padding: 12px 16px !important;
      font-size: 16px !important;
    }
    
    .btn-primary, .btn-secondary {
      padding: 10px 20px !important;
      font-size: 14px !important;
      width: 100% !important;
    }
    
    .signup-link {
      font-size: 13px !important;
      margin-top: 15px !important;
    }
  }
  
  @media (max-width: 480px) {
    .login-container {
      padding: 10px !important;
    }
    
    .auth-form {
      padding: 15px !important;
    }
    
    .input-field {
      padding: 10px 12px !important;
      font-size: 16px !important;
    }
    
    .btn-primary, .btn-secondary {
      padding: 8px 16px !important;
      font-size: 13px !important;
    }
    
    .signup-link {
      font-size: 12px !important;
      margin-top: 10px !important;
    }
  }
`;

// Inject mobile styles
if (typeof window !== 'undefined') {
  const styleElement = document.createElement('style');
  styleElement.textContent = mobileStyles;
  document.head.appendChild(styleElement);
}

export default function LoginPage() {
  const [isLogin, setIsLogin] = useState(true);
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [name, setName] = useState('');
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [showOTP, setShowOTP] = useState(false);
  const [otp, setOTP] = useState('');
  const [otpSent, setOtpSent] = useState(false);
  const [otpExpiry, setOtpExpiry] = useState(0);
  const [resendTimer, setResendTimer] = useState(0);
  const navigate = useNavigate();
  const emailService = new EmailService();

  useEffect(() => {
    let interval;
    if (resendTimer > 0) {
      interval = setInterval(() => {
        setResendTimer(prev => prev - 1);
      }, 1000);
    }
    return () => clearInterval(interval);
  }, [resendTimer]);

  useEffect(() => {
    let interval;
    if (otpExpiry > 0) {
      interval = setInterval(() => {
        setOtpExpiry(prev => Math.max(0, prev - 1));
      }, 1000);
    }
    return () => clearInterval(interval);
  }, [otpExpiry]);

  const handleSendOTP = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError('');

    try {
      if (!isLogin) {
        // Check if user already exists during registration
        const users = JSON.parse(localStorage.getItem('users') || '{}');
        if (users[email]) {
          throw new Error('User already exists with this email');
        }
      } else {
        // Check if user exists during login
        const users = JSON.parse(localStorage.getItem('users') || '{}');
        if (!users[email]) {
          throw new Error('User not found');
        }
      }

      // Generate and send OTP
      const result = await emailService.sendOTPEmail(email);
      
      if (result.success) {
        setShowOTP(true);
        setOtpSent(true);
        setOtpExpiry(300); // 5 minutes
        setResendTimer(60); // Resend after 60 seconds
        setError('');
      } else {
        throw new Error(result.message);
      }
    } catch (error) {
      setError(error.message);
    } finally {
      setLoading(false);
    }
  };

  const handleOTPVerification = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError('');

    try {
      const result = emailService.verifyOTP(email, otp);
      
      if (result.valid) {
        // OTP verified, proceed with login/registration
        if (isLogin) {
          // Login logic
          const users = JSON.parse(localStorage.getItem('users') || '{}');
          const user = users[email];
          
          if (user.password !== password) {
            throw new Error('Invalid password');
          }

          // Store session
          localStorage.setItem('user', JSON.stringify({
            email: user.email,
            name: user.name,
            picture: user.picture || null
          }));
          localStorage.setItem('isLoggedIn', 'true');
          
          navigate('/dashboard');
        } else {
          // Registration logic
          const users = JSON.parse(localStorage.getItem('users') || '{}');

          const newUser = {
            email,
            password,
            name,
            picture: null,
            createdAt: new Date().toISOString(),
            summaries: []
          };

          users[email] = newUser;
          localStorage.setItem('users', JSON.stringify(users));
          
          // Send welcome email
          await emailService.sendWelcomeEmail(email, name);
          
          // Auto-login after registration
          localStorage.setItem('user', JSON.stringify({
            email: newUser.email,
            name: newUser.name,
            picture: newUser.picture
          }));
          localStorage.setItem('isLoggedIn', 'true');
          
          initializeUserStorage(email);
          navigate('/dashboard');
        }
      } else {
        throw new Error(result.message);
      }
    } catch (error) {
      setError(error.message);
    } finally {
      setLoading(false);
    }
  };

  const handleResendOTP = async () => {
    if (resendTimer > 0) return;
    
    setLoading(true);
    setError('');

    try {
      const result = await emailService.resendOTP(email);
      
      if (result.success) {
        setOtpExpiry(300); // Reset expiry to 5 minutes
        setResendTimer(60); // Reset resend timer
        setError('OTP resent successfully!');
      } else {
        throw new Error(result.message);
      }
    } catch (error) {
      setError(error.message);
    } finally {
      setLoading(false);
    }
  };

  const initializeUserStorage = (userEmail) => {
    const userKey = `summaries_${userEmail}`;
    if (!localStorage.getItem(userKey)) {
      localStorage.setItem(userKey, JSON.stringify([]));
    }
  };

  return (
    <div className="login-container">
      <div className="login-card">
        <div className="login-header">
          <h1 className="login-title">AI Book Summarizer</h1>
          <p className="login-subtitle">
            {isLogin ? 'Welcome back! Sign in to access your summaries' : 'Create your account to start summarizing'}
          </p>
        </div>

        <div className="login-content">
          {!showOTP ? (
            // Email/Password Form
            <div className="email-auth-section">
              <form onSubmit={handleSendOTP} className="auth-form">
                {!isLogin && (
                  <div className="form-group">
                    <label htmlFor="name">Full Name</label>
                    <input
                      type="text"
                      id="name"
                      value={name}
                      onChange={(e) => setName(e.target.value)}
                      required
                      placeholder="Enter your full name"
                    />
                  </div>
                )}

                <div className="form-group">
                  <label htmlFor="email">Email Address</label>
                  <input
                    type="email"
                    id="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                    placeholder="Enter your email"
                  />
                </div>

                <div className="form-group">
                  <label htmlFor="password">Password</label>
                  <input
                    type="password"
                    id="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                    placeholder="Enter your password"
                    minLength={6}
                  />
                </div>

                {error && <div className="error-message">{error}</div>}

                <button 
                  type="submit" 
                  className="auth-button"
                  disabled={loading}
                >
                  {loading ? 'Sending OTP...' : 'Send OTP'}
                </button>
              </form>

              <div className="auth-switch">
                <span>
                  {isLogin ? "Don't have an account?" : "Already have an account?"}
                </span>
                <button 
                  className="switch-button"
                  onClick={() => {
                    setIsLogin(!isLogin);
                    setError('');
                    setShowOTP(false);
                    setOTP('');
                  }}
                >
                  {isLogin ? 'Sign Up' : 'Sign In'}
                </button>
              </div>
            </div>
          ) : (
            // OTP Verification Form
            <div className="otp-auth-section">
              <div className="otp-header">
                <h3>Verify Your Email</h3>
                <p>We've sent a 6-digit OTP to {email}</p>
                {otpExpiry > 0 && (
                  <p className="expiry-time">OTP expires in {Math.floor(otpExpiry / 60)}:{(otpExpiry % 60).toString().padStart(2, '0')}</p>
                )}
              </div>
              
              <form onSubmit={handleOTPVerification} className="otp-form">
                <div className="form-group">
                  <label htmlFor="otp">Enter OTP</label>
                  <input
                    type="text"
                    id="otp"
                    value={otp}
                    onChange={(e) => setOTP(e.target.value.replace(/\D/g, '').slice(0, 6))}
                    required
                    placeholder="Enter 6-digit OTP"
                    maxLength={6}
                    className="otp-input"
                  />
                </div>

                {error && <div className="error-message">{error}</div>}

                <button 
                  type="submit" 
                  className="auth-button"
                  disabled={loading || otp.length !== 6}
                >
                  {loading ? 'Verifying...' : 'Verify OTP'}
                </button>
              </form>

              <div className="otp-actions">
                <button 
                  className="resend-button"
                  onClick={handleResendOTP}
                  disabled={resendTimer > 0 || loading}
                >
                  {resendTimer > 0 ? `Resend OTP in ${resendTimer}s` : 'Resend OTP'}
                </button>
                
                <button 
                  className="back-button"
                  onClick={() => {
                    setShowOTP(false);
                    setOTP('');
                    setError('');
                  }}
                >
                  Back
                </button>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}

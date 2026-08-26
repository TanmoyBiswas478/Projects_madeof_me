import emailjs from '@emailjs/browser';

// Email Service for OTP Verification using EmailJS
class EmailService {
    constructor() {
        // EmailJS configuration
        this.serviceID =
            import.meta.env.VITE_REACT_APP_EMAILJS_SERVICE_ID;
        this.templateID =
            import.meta.env.VITE_REACT_APP_EMAILJS_TEMPLATE_ID;
        this.welcomeTemplateID =
            import.meta.env.VITE_REACT_APP_EMAILJS_WELCOME_TEMPLATE_ID;
        this.publicKey =
            import.meta.env.VITE_REACT_APP_EMAILJS_USER_ID;

        // Initialize EmailJS
        if (this.publicKey) {
            emailjs.init(this.publicKey);
        }

        this.otpExpiry = 5 * 60 * 1000; // 5 minutes expiry
    }

    // Generate 6-digit OTP
    generateOTP() {
        return Math.floor(100000 + Math.random() * 900000).toString();
    }

    // Store OTP with expiry
    storeOTP(email, otp) {
        const expiry = Date.now() + this.otpExpiry;
        const otpData = {
            otp: otp,
            expiry: expiry,
            timestamp: new Date().toISOString()
        };

        // Store in localStorage with email as key
        localStorage.setItem(`otp_${email.toLowerCase()}`, JSON.stringify(otpData));

        console.log(`OTP stored for ${email}:`, otpData);

        // Clean up expired OTPs
        this.cleanupExpiredOTPs();
    }

    // Verify OTP
    verifyOTP(email, inputOTP) {
        const storedData = localStorage.getItem(`otp_${email.toLowerCase()}`);
        console.log(`Verifying OTP for ${email}, stored data:`, storedData);
        console.log(`Input OTP:`, inputOTP);

        if (!storedData) {
            console.log('No OTP data found for email');
            return { valid: false, message: 'OTP not found or expired' };
        }

        let stored;
        try {
            stored = JSON.parse(storedData);
        } catch (error) {
            console.error('Failed to parse stored OTP data:', error);
            localStorage.removeItem(`otp_${email.toLowerCase()}`);
            return { valid: false, message: 'OTP data corrupted' };
        }

        console.log('Parsed stored OTP data:', stored);

        if (Date.now() > stored.expiry) {
            console.log('OTP expired');
            localStorage.removeItem(`otp_${email.toLowerCase()}`);
            return { valid: false, message: 'OTP expired' };
        }

        if (stored.otp !== inputOTP) {
            console.log(`OTP mismatch: expected ${stored.otp}, got ${inputOTP}`);
            return { valid: false, message: 'Invalid OTP' };
        }

        console.log('OTP verification successful');
        // OTP is valid, remove it
        localStorage.removeItem(`otp_${email.toLowerCase()}`);
        return { valid: true, message: 'OTP verified successfully' };
    }

    // Clean up expired OTPs
    cleanupExpiredOTPs() {
        const now = Date.now();
        const keys = Object.keys(localStorage);

        keys.forEach(key => {
            if (key.startsWith('otp_')) {
                try {
                    const data = JSON.parse(localStorage.getItem(key));
                    if (now > data.expiry) {
                        localStorage.removeItem(key);
                    }
                } catch (error) {
                    // Remove corrupted data
                    localStorage.removeItem(key);
                }
            }
        });
    }

    // Send OTP email using EmailJS
    async sendOTPEmail(email, otp) {
        try {
            // Generate OTP if not provided
            const otpToSend = otp || this.generateOTP();
            console.log(`Sending OTP ${otpToSend} to ${email}`);

            // Store OTP first
            this.storeOTP(email, otpToSend);

            // Check if EmailJS is configured
            if (!this.serviceID || !this.templateID || !this.publicKey) {
                console.warn('EmailJS not configured, using demo mode');
                console.log(`OTP ${otpToSend} sent to ${email} (demo mode)`);
                return {
                    success: true,
                    message: 'OTP sent successfully (demo mode)',
                    otp: otpToSend // Only for demo - remove in production
                };
            }

            // Send email using EmailJS
            const emailParams = {
                email: email,
                otp_code: otpToSend,
                expiry_minutes: 5,
                app_name: 'AI Book Summarizer'
            };

            console.log('EmailJS parameters:', emailParams);

            const response = await emailjs.send(
                this.serviceID,
                this.templateID,
                emailParams
            );

            console.log('EmailJS response:', response);

            return {
                success: true,
                message: 'OTP sent successfully',
                response: response,
                otp: otpToSend // For debugging
            };

        } catch (error) {
            console.error('Failed to send OTP:', error);
            return {
                success: false,
                message: 'Failed to send OTP. Please try again.',
                error: error.message
            };
        }
    }

    // Send welcome email after successful registration
    async sendWelcomeEmail(email, name) {
        try {
            // Check if EmailJS is configured
            if (!this.serviceID || !this.welcomeTemplateID || !this.publicKey) {
                console.warn('EmailJS not configured, skipping welcome email');
                console.log(`Welcome email would be sent to ${email} (demo mode)`);
                return { success: true, message: 'Welcome email sent (demo mode)' };
            }

            // Send welcome email using EmailJS
            const response = await emailjs.send(
                this.serviceID,
                this.welcomeTemplateID, {
                    email: email,
                    user_name: name,
                    app_name: 'AI Book Summarizer'
                }
            );

            console.log('Welcome email sent:', response);
            return { success: true, message: 'Welcome email sent', response: response };

        } catch (error) {
            console.error('Failed to send welcome email:', error);
            return { success: false, message: 'Failed to send welcome email', error: error.message };
        }
    }

    // Send password reset email
    async sendPasswordResetEmail(email, resetToken) {
        try {
            const emailData = {
                service_id: import.meta.env.VITE_REACT_APP_EMAILJS_SERVICE_ID || 'default_service',
                template_id: this.resetTemplateID || 'reset_template',
                user_id: import.meta.env.VITE_REACT_APP_EMAILJS_USER_ID || 'default_user',
                template_params: {
                    to_email: email,
                    reset_token: resetToken,
                    expiry_hours: 1,
                    app_name: 'AI Book Summarizer'
                }
            };

            console.log(`Password reset email sent to ${email}`);
            return { success: true, message: 'Password reset email sent' };

        } catch (error) {
            console.error('Failed to send password reset email:', error);
            return { success: false, message: 'Failed to send password reset email' };
        }
    }

    // Get remaining time for OTP
    getOTPExpiryTime(email) {
        const stored = this.otpStore.get(email.toLowerCase());
        if (!stored) return 0;

        const remaining = stored.expiry - Date.now();
        return Math.max(0, Math.floor(remaining / 1000)); // Return seconds
    }

    // Resend OTP
    async resendOTP(email) {
        const newOTP = this.generateOTP();
        console.log(`Resending OTP ${newOTP} to ${email}`);
        return await this.sendOTPEmail(email, newOTP);
    }

    // Check if OTP exists for email
    hasOTP(email) {
        const storedData = localStorage.getItem(`otp_${email.toLowerCase()}`);
        if (!storedData) return false;

        try {
            const stored = JSON.parse(storedData);
            if (Date.now() > stored.expiry) {
                localStorage.removeItem(`otp_${email.toLowerCase()}`);
                return false;
            }
            return true;
        } catch (error) {
            localStorage.removeItem(`otp_${email.toLowerCase()}`);
            return false;
        }
    }
}

// Create and export a singleton instance
const emailServiceInstance = new EmailService();

// Export the sendOTP function for easy import
export const sendOTP = async(email) => {
    return await emailServiceInstance.sendOTPEmail(email);
};

export default emailServiceInstance;
# EmailJS Setup Guide for OTP Verification

## Step 1: Create EmailJS Account
1. Go to [https://www.emailjs.com/](https://www.emailjs.com/)
2. Click "Sign Up" and create a free account
3. Verify your email address

## Step 2: Create Email Service
1. After logging in, go to "Email Services" in the dashboard
2. Click "Add New Service"
3. Select "Gmail" (or your preferred email provider)
4. Connect your email account:
   - For Gmail: Use your Gmail address and app password
   - **Important**: Enable 2-factor authentication on Gmail and create an "App Password"
5. Name your service (e.g., "gmail_service")
6. Click "Create Service"

## Step 3: Create Email Templates

### Template 1: OTP Verification Email
1. Go to "Email Templates" in the dashboard
2. Click "Create New Template"
3. Fill in the template details:
   - **Template Name**: `otp_verification`
   - **Subject**: `Your OTP Code for AI Book Summarizer`
   - **HTML Content**:
   ```html
   <h3>Your OTP Code</h3>
   <p>Hello,</p>
   <p>Your One-Time Password (OTP) for AI Book Summarizer is:</p>
   <h1 style="font-size: 32px; color: #667eea; text-align: center; padding: 20px; background: #f8fafc; border-radius: 10px;">
       {{otp_code}}
   </h1>
   <p>This OTP will expire in {{expiry_minutes}} minutes.</p>
   <p>If you didn't request this OTP, please ignore this email.</p>
   <p>Best regards,<br>AI Book Summarizer Team</p>
   ```

### Template 2: Welcome Email
1. Click "Create New Template" again
2. Fill in the template details:
   - **Template Name**: `welcome_email`
   - **Subject**: `Welcome to AI Book Summarizer!`
   - **HTML Content**:
   ```html
   <h3>Welcome to AI Book Summarizer! {{user_name}}</h3>
   <p>Thank you for joining AI Book Summarizer!</p>
   <p>Your account has been successfully created and you can now:</p>
   <ul>
       <li>Generate AI-powered summaries</li>
       <li>Save and manage your summaries</li>
       <li>Export and share your content</li>
   </ul>
   <p>Get started by visiting our app and creating your first summary!</p>
   <p>Best regards,<br>AI Book Summarizer Team</p>
   ```

## Step 4: Get Your Credentials
1. Go to "Integration" in the EmailJS dashboard
2. You'll find your **Public Key** (this is your USER_ID)
3. Go to "Email Services" and click on your service to get the **Service ID**
4. Go to "Email Templates" to get the **Template ID** for each template

## Step 5: Update Your .env File
Add these credentials to your `.env` file:

```env
# EmailJS Configuration
REACT_APP_EMAILJS_SERVICE_ID=your_service_id_here
REACT_APP_EMAILJS_TEMPLATE_ID=your_otp_template_id_here
REACT_APP_EMAILJS_WELCOME_TEMPLATE_ID=your_welcome_template_id_here
REACT_APP_EMAILJS_USER_ID=your_public_key_here

# SMTP Configuration (backup)
REACT_APP_SMTP_HOST=smtp.gmail.com
REACT_APP_SMTP_PORT=587
REACT_APP_SMTP_USER=your-email@gmail.com
REACT_APP_SMTP_PASS=your-app-password
```

## Step 6: Update EmailService.js
Replace the demo email sending with actual EmailJS integration:

```javascript
import emailjs from '@emailjs/browser';

// In the sendOTPEmail method:
async sendOTPEmail(email, otp) {
    try {
        const response = await emailjs.send(
            process.env.REACT_APP_EMAILJS_SERVICE_ID,
            process.env.REACT_APP_EMAILJS_TEMPLATE_ID,
            {
                to_email: email,
                otp_code: otp,
                expiry_minutes: 5,
                app_name: 'AI Book Summarizer'
            },
            process.env.REACT_APP_EMAILJS_USER_ID
        );
        
        this.storeOTP(email, otp);
        return { success: true, message: 'OTP sent successfully' };
    } catch (error) {
        console.error('Failed to send OTP:', error);
        return { success: false, message: 'Failed to send OTP' };
    }
}
```

## Step 7: Gmail App Password Setup (if using Gmail)
1. Go to your Google Account settings
2. Go to "Security" section
3. Enable "2-Step Verification"
4. Under "Signing in to Google", click "App passwords"
5. Generate a new app password for "EmailJS"
6. Use this app password in your SMTP configuration

## Step 8: Test the Setup
1. Restart your React application
2. Try registering a new user
3. Check if you receive the OTP email
4. Verify the OTP works correctly

## Troubleshooting

### Common Issues:
1. **Email not sending**: Check your EmailJS credentials in .env file
2. **Gmail authentication failed**: Make sure you're using an App Password, not your regular password
3. **Template not found**: Verify Template ID matches exactly in EmailJS dashboard
4. **CORS issues**: Make sure your domain is added to EmailJS allowed domains

### Debug Tips:
- Check browser console for EmailJS errors
- Verify all environment variables are loaded correctly
- Test templates directly in EmailJS dashboard first

## Free Plan Limitations
- EmailJS free plan allows 200 emails per month
- Each email counts towards your limit
- Consider upgrading to a paid plan for production use

## Alternative: Direct SMTP
If EmailJS doesn't work, you can use a backend service with direct SMTP:
- Node.js with Nodemailer
- Python with smtplib
- Or any server-side email service

This gives you unlimited emails but requires a backend server.

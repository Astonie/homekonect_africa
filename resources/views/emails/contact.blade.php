<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <table cellpadding="0" cellspacing="0" border="0" width="600" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(to right, #3b82f6, #1d4ed8); padding: 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px;">HomeKonnect</h1>
                            <p style="margin: 10px 0 0; color: #e0e7ff; font-size: 14px;">New Contact Form Submission</p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="margin: 0 0 20px; color: #1f2937; font-size: 22px;">Contact Details</h2>
                            
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-bottom: 20px;">
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">
                                        <strong style="color: #4b5563;">Name:</strong><br>
                                        <span style="color: #1f2937;">{{ $name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">
                                        <strong style="color: #4b5563;">Email:</strong><br>
                                        <a href="mailto:{{ $email }}" style="color: #3b82f6; text-decoration: none;">{{ $email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb;">
                                        <strong style="color: #4b5563;">Subject:</strong><br>
                                        <span style="color: #1f2937;">{{ $subject }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 0;">
                                        <strong style="color: #4b5563;">Message:</strong><br>
                                        <div style="margin-top: 10px; padding: 15px; background-color: #f9fafb; border-left: 3px solid #3b82f6; color: #1f2937; line-height: 1.6;">
                                            {{ $messageContent }}
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 20px 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0; color: #6b7280; font-size: 12px;">
                                This email was sent from the HomeKonnect contact form<br>
                                &copy; {{ date('Y') }} HomeKonnect. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

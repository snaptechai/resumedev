<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Resume Mansion</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            margin-top: 20px;
            background-color: #f8f8f8 !important;
        }

        .email-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 40px 30px 30px;
            background-color: white;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #2c5530;
        }

        .logo img {
            height: 24px;
        }

        .content {
            padding: 0 30px 30px;
            background-color: white;
        }

        .greeting {
            font-size: 16px;
            color: #000000;
            margin-bottom: 18px;
        }

        .reset-button {
            background-color: #2c5530;
            color: white !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            display: inline-block;
            font-weight: 600;
            margin: 20px 0;
        }

        .reset-button:hover {
            background-color: #1e3a22;
        }

        .reset-button:visited {
            color: white !important;
        }

        .reset-button:link {
            color: white !important;
        }

        .signature {
            font-size: 16px;
            color: #000000;
        }

        .footer {
            background-color: #bcec88;
            padding: 32px 32px;
            text-align: center;
        }

        .footer-logo {
            font-size: 24px;
            font-weight: bold;
            color: #2c5530;
            margin-bottom: 1px;
        }

        .footer-logo img {
            height: 22px;
        }

        .tagline {
            font-size: 14px;
            color: #051d14;
            margin-bottom: 25px;
            font-weight: 400;
            line-height: 20px;
        }

        .follow-text {
            font-size: 14px;
            color: #000000;
            margin-bottom: 15px;
            font-weight: 500;
            line-height: 18px;
        }

        .social-icons {
            margin-bottom: 30px;
            text-align: center;
        }

        .social-icons-wrapper {
            display: inline-block;
        }

        .social-icon {
            width: 38px;
            height: 38px;
            background-color: white;
            border-radius: 50%;
            display: inline-block;
            text-align: center;
            line-height: 29px;
            text-decoration: none;
            color: #333;
            font-size: 18px;
            transition: background-color 0.3s;
            margin: 0 7px;
            vertical-align: middle;
        }

        .social-icon img {
            width: 38px;
            height: 38px;
        }

        .social-icon:hover {
            background-color: #f0f0f0;
        }

        .help-section {
            font-size: 14px;
            color: #000000;
            margin-bottom: 20px;
            font-weight: 500;
            line-height: 14px;
        }

        .help-section a {
            color: #000000;
            text-decoration: underline;
            font-weight: 700;
        }

        .account-info {
            font-size: 13px;
            color: #000000;
            margin-bottom: 20px;
            font-weight: 500;
            line-height: 14px;
        }

        .footer-links {
            font-size: 13px;
            margin-bottom: 20px;
            font-weight: 500;
            line-height: 18px;
        }

        .footer-links a {
            color: #000000;
            text-decoration: underline;
        }

        .footer-links span {
            margin: 0 5px;
        }

        .address {
            font-size: 13px;
            color: #00000080;
            margin-bottom: 15px;
            line-height: 18px;
        }

        .copyright {
            font-size: 13px;
            color: #000000;
            font-weight: 500;
        }

        .normal-text {
            font-size: 16px;
            color: #000000;
            line-height: 24px;
            font-weight: 400;
            margin-bottom: 25px;
        }
    </style>
</head>

<body style="margin: 0; padding: 0; background-color: #f8f8f8;">
    <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f8f8f8">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table role="presentation" class="email-container" width="800" border="0" cellspacing="0"
                    cellpadding="0" bgcolor="#ffffff"
                    style="margin: 0 auto; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td class="header" style="text-align: center; padding: 40px 30px 30px;">
                            <div class="logo">
                                <img alt="resumemansion" src="https://i.imgur.com/qidegPO.png" style="height: 24px;" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="content" style="padding: 0 30px 30px;">
                            <div class="greeting">Hi {{ $user->full_name }},</div>

                            <div class="normal-text">
                                We received a request to reset your password for your Resume Mansion account.
                            </div>

                            <div class="normal-text">
                                Click the button below to reset your password:
                            </div>

                            <div style="text-align: center; margin: 30px 0;">
                                <a href="{{ $resetUrl }}" class="reset-button"
                                    style="background-color: #2c5530; color: white !important; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block; font-weight: 600;">Reset
                                    Password</a>
                            </div>

                            <div class="normal-text">
                                This link will expire in 60 minutes for security reasons.
                            </div>

                            <div class="normal-text">
                                If you didn't request a password reset, please ignore this email. Your password will
                                remain unchanged.
                            </div>

                            <div class="signature">
                                Best regards,<br />
                                The Resume Mansion Team
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer" bgcolor="#bcec88" style="padding: 32px 32px; text-align: center;">
                            <div class="footer-logo">
                                <img alt="resumemansion" src="https://i.imgur.com/qidegPO.png" />
                            </div>

                            <div class="tagline">It's a Resume Exploit</div>

                            <div class="follow-text">Follow us for more</div>

                            <div class="social-icons">
                                <div class="social-icons-wrapper">
                                    <a href="https://www.linkedin.com/company/resumemansion/" class="social-icon">
                                        <img alt="Linkedin" src="https://i.imgur.com/koHxU81.png" />
                                    </a>
                                    <a href="https://www.facebook.com/profile.php?id=61569871652572&mibextid=wwXIfr&mibextid=wwXIfr"
                                        class="social-icon">
                                        <img alt="Facebook" src="https://i.imgur.com/teFV5X5.png" />
                                    </a>
                                    <a href="https://x.com/ResumeMansion" class="social-icon">
                                        <img alt="Twitter/X" src="https://i.imgur.com/vJN1MNB.png" />
                                    </a>
                                    <a href="https://www.youtube.com/channel/UCBZ2e3MNuWrK5JrkrV0rwHQ"
                                        class="social-icon">
                                        <img alt="YouTube" src="https://i.imgur.com/ieYmFTl.png" />
                                    </a>
                                </div>
                            </div>

                            <div class="help-section">
                                Need a helping hand? Visit our <a href="#">Help Center</a>
                            </div>

                            <div class="account-info">
                                You received this message because you have an account with
                                Resume Mansion.
                            </div>

                            <div class="footer-links">
                                <a href="#">Privacy Policy</a> <span>•</span>
                                <a href="#">Terms of Use</a> <span>•</span>
                                <a href="#">Contact Us</a> <span>•</span>
                                <a href="#">Unsubscribe</a>
                            </div>

                            <div class="address">
                                Garden City, 83714, Idaho, United States
                            </div>

                            <div class="copyright">
                                © Resume Mansion LLC. All Rights Reserved.
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>

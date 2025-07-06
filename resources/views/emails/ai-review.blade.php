<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Mansion</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7f0 0%, #e8f5e8 50%, #d4f0d4 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
        }

        .logo {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .logo .resume {
            color: #2d5016;
        }

        .logo .mansion {
            color: #7ba05b;
            font-weight: normal;
        }

        .tagline {
            color: #2d5016;
            font-size: 14px;
            font-weight: 600;
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
            margin-top: 60px;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background-color: #a8d678;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .icon {
            width: 40px;
            height: 40px;
            fill: #2d5016;
        }

        .cta-box {
            background-color: #a8d678;
            padding: 20px 40px;
            border-radius: 8px;
            text-align: center;
            max-width: 400px;
        }

        .cta-text {
            color: #2d5016;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.3;
        }

        .contact-bar {
            background-color: #2d5016;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .contact-bar span {
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .logo {
                font-size: 28px;
            }
            
            .contact-bar {
                flex-direction: column;
                gap: 5px;
                padding: 15px 25px;
                border-radius: 15px;
            }
            
            .cta-box {
                padding: 15px 25px;
                margin: 0 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img alt="resumemansion" src="https://i.imgur.com/qidegPO.png" style="height: 24px;" />
        </div>
        <div class="tagline">Certified Professional Resume Writers</div>
    </div>

    <div class="main-content">
        
    </div>

    <div class="footer">
        <div class="icon-circle">
            <svg class="icon" viewBox="0 0 24 24">
                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 7V9C15 10.1 14.1 11 13 11V18H15V22H9V18H11V11C9.9 11 9 10.1 9 9V7L3 7V9H5V20C5 21.1 5.9 22 7 22H17C18.1 22 19 21.1 19 20V9H21Z"/>
            </svg>
        </div>

        <div class="cta-box">
            <div class="cta-text">
                Hire a Professional Career Coach<br>
                through Resume Mansion today!
            </div>
        </div>

        <div class="contact-bar">
            <span>contact@resumemansion.com</span>
            <span>|</span>
            <span>www.resumemansion.com</span>
        </div>
    </div>
</body>
</html>
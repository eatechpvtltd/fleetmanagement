<!-- resources/views/emails/forgot-password.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #ffffff;
        }
        .reset-link {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>{{ $title }}</h2>
        </div>
        
        <div class="content">
            <p>Hello {{ $user }},</p>
            <p>We received a request to reset your password. Click the link below to reset your password:</p>
            
            <a href="{{ $reset_link }}" class="reset-link">Reset Your Password</a>
            
            <p>If you didn't request a password reset, please ignore this email or contact support if you have concerns.</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
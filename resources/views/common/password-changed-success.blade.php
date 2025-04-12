<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed Successfully</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .container {
            padding: 2rem;
            width: 100%;
            max-width: 28rem;
        }

        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 0px 15px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem 1.5rem 0.75rem;
            text-align: center;
        }

        .icon-container {
            display: flex;
            justify-content: center;
            margin-bottom: 0.5rem;
        }

        .check-icon {
            width: 4rem;
            height: 4rem;
            color: #10b981;
        }

        .card-title {
            margin: 2rem 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
        }

        .card-description {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 1.5rem;
        }

        .card-content {
            padding: 1rem 1.5rem;
            text-align: center;
            color: #4b5563;
            font-size: 0.875rem;
        }

        .card-footer {
            padding: 0.75rem 1.5rem 1.5rem;
            display: flex;
            justify-content: center;
        }

        .button {
            display: inline-block;
            width: 100%;
            background-color: #1d4ed8;
            color: white;
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            border-radius: 0.375rem;
            text-align: center;
            text-decoration: none;
            font-size: 0.875rem;
            line-height: 1.25rem;
            transition: background-color 0.2s;
        }

        .button:hover {
            background-color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="icon-container">
                    <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h2 class="card-title">Password Changed Successfully</h2>
                <p class="card-description">Your password has been updated. You can now log in with your new password.
                </p>
            </div>
            <div class="card-footer">
                <a href="/login" class="button">Return to Login</a>
            </div>
        </div>
    </div>
</body>

</html>
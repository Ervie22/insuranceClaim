<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            color: #333;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 20px 0;
            background-color: #3490dc;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777777;
        }

        .break-all {
            word-break: break-all;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>Hello {{ $name ?? '' }},</h2>

        <p>Please click the button below to verify your email address.</p>

        <p>
            <a href="{{ $url }}" style="
        display: inline-block;
        padding: 12px 24px;
        background-color: #3490dc;
        color: #ffffff;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        font-size: 16px;
    ">
                {{ $actionText }}
            </a>
        </p>

        <p>If you did not create an account, no further action is required.</p>

        <p>Thanks & Regards,<br>
            {{ config('app.name') }} Team
        </p>

        <div class="footer">
            <p>If you're having trouble clicking the "{{ $actionText }}" button, copy and paste the URL below into your web browser:</p>
            <p class="break-all">{{ $url }}</p>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Maseco Inquiry</title> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 750px;
            margin: 0px !important;
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333333;
            border-bottom: 2px solid #f4f4f4;
            padding-bottom: 10px;
        }
        p {
            font-size: 16px;
            color: #555555;
            line-height: 1.5;
        }
        .label {
            font-weight: bold;
            color: #333333;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Inquiry Details:</h2>
        <p><span class="label">Name:</span> {{ $contact->name }}</p>
        <p><span class="label">Email:</span> {{ $contact->email }}</p>
        <p><span class="label">Phone:</span> {{ $contact->phone }}</p>
        <p><span class="label">Found Us Via:</span> {{ $contact->find_us ?? 'Not specified' }}</p>

        <div class="footer">
           Maseco © 2025. All rights reserved. <br>
          
        </div>
    </div>
</body>
</html>

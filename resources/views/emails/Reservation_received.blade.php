<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Request Submitted</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f8ff;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 640px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #5f9ea0;
            padding: 20px;
            color: white;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .body {
            padding: 30px;
        }
        .body h2 {
            font-size: 20px;
            color: #5f9ea0;
        }
        .details {
            background-color: #f4f9f9;
            padding: 20px;
            border-left: 5px solid #5f9ea0;
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
            font-size: 16px;
        }
        .footer {
            background-color: #e0f7fa;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #6c757d;
        }
        .btn {
            background-color: #5f9ea0;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your Reservation Request Has Been Received</h1>
        </div>
        <div class="body">
            <h2>Dear {{ $data['full_name'] }},</h2>
            <p>Thank you for submitting your reservation request to Silvercastle Hotel. We have successfully received your request and are currently reviewing it. You will receive a confirmation soon.</p>

            <div class="details">
                <p><strong>Reservation Summary:</strong></p>
                <p><strong>Check-In Date:</strong> {{ \Carbon\Carbon::parse($data['checkin'])->format('F j, Y') }}</p>
                <p><strong>Check-Out Date:</strong> {{ \Carbon\Carbon::parse($data['checkout'])->format('F j, Y') }}</p>

                <p><strong>Room Type(s):</strong></p>
                <ul>
                    @foreach($data['room_types'] as $room)
                        <li>{{ $room['room_type'] }} - {{ $room['no_of_room'] }} room(s)</li>
                    @endforeach
                </ul>
            </div>

            <p>If you need further assistance or want to modify your reservation, please don’t hesitate to contact us.</p>

            <a href="mailto:info@silvercastleresort.com" class="btn">Contact Us</a>
        </div>


        <div class="footer">
            <p>We look forward to welcoming you to Silvercastle Hotel.</p>
            <p>&copy; {{ now()->year }} Silvercastle Hotel. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
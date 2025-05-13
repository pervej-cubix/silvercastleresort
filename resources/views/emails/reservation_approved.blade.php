<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reservation Approved</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
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
            background-color: #007B5E;
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
            color: #007B5E;
            font-size: 20px;
        }
        .details {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 20px;
            border-left: 5px solid #007B5E;
        }
        .details p {
            margin: 5px 0;
            font-size: 16px;
        }
        .footer {
            background-color: #e9ecef;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Reservation Approved</h1>
    </div>

    <div class="body">
        <h2>Dear {{ $data['title'] }} {{ $data['first_name'] }} {{ $data['last_name'] }},</h2>
        <p>We are delighted to inform you that your reservation has been successfully <strong>approved</strong>.</p>
        
        <div class="details">
            @foreach($data['roomTypes'] as $room)
            <p>Room Type: {{ $room['room_type'] }} | No of Rooms: {{ $room['no_of_room'] }}</p>
            @endforeach
        
            <p><strong>Check-In Date:</strong> {{ \Carbon\Carbon::parse($data['checkin_date'])->format('F j, Y') }}</p>
            <p><strong>Check-Out Date:</strong> {{ \Carbon\Carbon::parse($data['checkout_date'])->format('F j, Y') }}</p>
        </div>        

        <p style="margin-top: 25px;">Should you need to make changes or have any special requests, feel free to contact us.</p>

        <p>We look forward to welcoming you!</p>

        <p style="margin-top: 30px;">
            Warm regards,<br>
            <strong>The Hotel Team</strong><br>
            <a href="#" style="color: #007B5E; text-decoration: none;">www.silvercastleresort.com</a>
        </p>
    </div>

    <div class="footer">
        &copy; {{ now()->year }} Silvercastle Resort. All rights reserved.
    </div>
</div>
</body>
</html>

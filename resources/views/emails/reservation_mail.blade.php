<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation Request</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        color: #333;
        background-color: #f8f8f8;
    }

    .container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .content {
        font-size: 16px;
        line-height: 1.5;
    }

    .label {
        font-weight: bold;
    }

    .footer {
        margin-top: 20px;
        font-size: 14px;
        color: #777;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">Reservation Request from Website</div>

    <div class="content">
        <p><span class="label">Guest Type:</span> {{ $data['guest_type'] }}</p>
        <p><span class="label">Full Name:</span> {{ $data['full_name'] }}</p>
        <p><span class="label">Address:</span> {{ $data['address'] }}</p>
        <p><span class="label">Phone:</span> {{ $data['phone'] }}</p>
        <p><span class="label">Email:</span> {{ $data['email'] }}</p>
        <p><span class="label">Check-In Date:</span> {{ $data['checkin'] }}</p>
        <p><span class="label">Check-Out Date:</span> {{ $data['checkout'] }}</p>

        <p><span class="label">Room Types:</span></p>
        <ul>
            @foreach ($data['room_types'] as $room)
                <li>{{ $room['room_type'] }} - {{ $room['no_of_room'] }} room(s)</li>
            @endforeach
        </ul>

        <p><span class="label">Guest Rooms:</span></p>
        <ul>
            @foreach ($data['guest_rooms'] as $guestRoom)
                <li>
                    Room {{ $guestRoom['room'] }} ({{ $guestRoom['room_type'] }}) - 
                    Adults: {{ $guestRoom['adults'] }}, Children: {{ $guestRoom['children'] }}
                </li>
            @endforeach
        </ul>

        <p><span class="label">Country:</span> {{ $data['country'] }}</p>
        <p><span class="label">Special Requirements:</span> {{ $data['requirements'] ?? 'N/A' }}</p>
    </div>
        <!-- <div class="footer">Thank you for choosing us. We look forward to your stay!</div> -->
    </div>
</body>

</html>
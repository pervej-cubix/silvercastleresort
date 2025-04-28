<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation Request</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        color: #333;
        background-color: #eaeded;
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
        <p><span class="label">First Name:</span> {{ $data['title'] }}</p>
        <p><span class="label">First Name:</span> {{ $data['first_name'] }}</p>
        <p><span class="label">Last Name:</span> {{ $data['last_name'] }}</p>
        <p><span class="label">Address:</span> {{ $data['address'] }}</p>
        <p><span class="label">Phone:</span> {{ $data['phone'] }}</p>
        <p><span class="label">Email:</span> {{ $data['email'] }}</p>
        <p><span class="label">Check-In Date:</span> {{ $data['checkin_date'] }}</p>
        <p><span class="label">Check-Out Date:</span> {{ $data['checkout_date'] }}</p>
        <p><span class="label">Room Type:</span> {{ $data['room_type'] }}</p>
        <p><span class="label">Country:</span> {{ $data['country'] }}</p>
        <p><span class="label">Number of Rooms:</span> {{ $data['room_no'] ?? 'N/A' }}</p>
        <p><span class="label">Number of Adults:</span> {{ $data['pax_in'] }}</p>
        <p><span class="label">Number of Children:</span> {{ $data['child_in'] }}</p>
        <p><span class="label">Special Requirements:</span> {{ $data['guest_remarks'] }}</p>
        <p><span class="label">Day Count:</span> {{ $data['day_count'] }}</p>
        <p><span class="label">Reservation Mode:</span> {{ $data['reservation_mode'] }}</p>
        <p><span class="label">Currency Type:</span> {{ $data['currency_type'] }}</p>
        <p><span class="label">Conversion Rate:</span> {{ $data['conversion_rate'] }}</p>
        <p><span class="label">Guest Source ID:</span> {{ $data['guest_source_id'] }}</p>
        <p><span class="label">Reference ID:</span> {{ $data['reference_id'] }}</p>
        <p><span class="label">Reservation Status:</span> {{ $data['reservation_status'] }}</p>
    </div>

        <!-- <div class="footer">Thank you for choosing us. We look forward to your stay!</div> -->
    </div>
</body>

</html>
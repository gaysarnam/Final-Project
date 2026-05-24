<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; border: 1px solid #eee; padding: 20px; border-radius: 10px; }
        .header { background: #004d26; color: white; padding: 10px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 20px; }
        .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; }
        
        /* NEW: Cancellation message box */
        .admin-message { 
            background: #fff3e0; 
            border-left: 4px solid #e65100; 
            padding: 15px; 
            margin: 20px 0; 
            border-radius: 0 8px 8px 0;
            font-style: italic;
            color: #555;
        }
        .admin-message strong { color: #d32f2f; display: block; margin-bottom: 5px; font-style: normal; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>TN Multi Services</h1>
        </div>
        <div class="content">
            <p>Dear {{ $booking->user->first_name }},</p>
            <p>{{ $statusMessage }}</p>
            
            {{-- ✅ NEW: Show admin's cancellation message if booking is cancelled --}}
            @if($booking->status === 'Cancelled' && !empty($cancellationMessage))
                <div class="admin-message">
                    <strong>📝 Message from TN Admin:</strong>
                    {{ $cancellationMessage }}
                </div>
            @endif
            
            <hr>
            <h3>Booking Details:</h3>
            <p><b>Service:</b> {{ $booking->service_name }} ({{ $booking->service_type }})</p>
            <p><b>Date:</b> {{ $booking->booking_date }}</p>
            @if($booking->booking_time)
                <p><b>Time:</b> {{ \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') }}</p>
            @endif
            <p><b>Status:</b> 
                <span style="color: {{ $booking->status === 'Confirmed' ? '#2e7d32' : ($booking->status === 'Cancelled' ? '#d32f2f' : '#e65100') }}; font-weight: 600;">
                    {{ $booking->status }}
                </span>
            </p>
            <hr>

            <p>If you have any questions, please contact us at +975-77343125.</p>
            <p>Best Regards,<br>The Management Team</p>
        </div>
        <div class="footer">
            &copy; 2026 TN Multi Services. Samdrupjongkhar, Bhutan.
        </div>
    </div>
</body>
</html>
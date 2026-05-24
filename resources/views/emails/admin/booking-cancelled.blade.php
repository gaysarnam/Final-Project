@component('mail::message')
# ⚠️ Booking Cancelled by User

A user has cancelled their **confirmed** booking. Please review the details below:

## 📋 Booking Details
| Field | Value |
|-------|-------|
| **Booking ID** | #{{ $booking->id }} |
| **User** | {{ $booking->user->first_name }} {{ $booking->user->last_name }} |
| **User Email** | {{ $booking->user->email }} |
| **Service Type** | {{ ucfirst($booking->service_type) }} |
| **Service Name** | {{ $booking->service_name }} |
| **Scheduled Date** | {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }} |
@if($booking->booking_time)
| **Scheduled Time** | {{ $booking->booking_time }} |
@endif
| **Previous Status** | ✅ Confirmed |
| **New Status** | ❌ Cancelled |

## 💬 User Message / Reason
> "{{ $booking->cancellation_reason ?? 'No reason provided.' }}"

## ✅ Action Required
- [ ] Update reservation system
- [ ] Free up the slot for other guests

@component('mail::button', ['url' => route('admin.bookings')])
🔗 View All Bookings in Admin Panel
@endcomponent

---
*Automated notification from {{ config('app.name') }}*
@endcomponent
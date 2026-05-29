<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\BookingStatusMail;
use App\Mail\AdminBookingCancellationMail;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Store a new booking (User side)
     */
    public function store(Request $request)
    {
        $rules = [
            'service_type' => 'required|string|max:255',
            'service_name' => 'required|string|max:255',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'nullable|string|max:255',
            'check_out_date' => 'nullable|date|after:booking_date',
            'special_request' => 'nullable|string|max:1000',
            'order_items' => 'nullable|string',
        ];

        if ($request->service_type === 'Lodging') {
            $rules['number_of_guests'] = 'required|integer|min:1|max:4';
        } else {
            $rules['number_of_guests'] = 'nullable|integer';
        }

        $request->validate($rules, [
            'number_of_guests.min' => 'Number of guests must be at least 1.',
            'check_out_date.after' => 'Check-out date must be after check-in date.',
        ]);

        // =================================================================
        // NEW CODE BLOCK STARTS
        // =================================================================
        if ($request->service_type === 'Restaurant') {
            if ($this->isTableBusy($request->service_name, $request->booking_date, $request->booking_time)) {
                return back()->withInput()->with('error_conflict', 'Sorry, ' . $request->service_name . ' is already reserved for this date and time. Please choose another slot or table.');
            }
        }
        // =================================================================
        // NEW CODE BLOCK ENDS
        // =================================================================

        $orderItems = $request->order_items;
        if (is_string($orderItems)) {
            $orderItems = json_decode($orderItems, true);
        }

        Booking::create([
            'user_id' => Auth::id(),
            'service_type' => $request->service_type,
            'service_name' => $request->service_name,
            'number_of_guests' => $request->service_type === 'Lodging' 
                ? $request->number_of_guests 
                : null,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time ?? null,
            'check_out_date' => $request->check_out_date ?? null,
            'special_request' => $request->special_request,
            'order_items' => $orderItems,
            'status' => 'Pending',
        ]);

        return back()->with('booking_success', 'Sent Successfully! Please wait for the confirmation through your whatsapp or email.');
    }

    /**
     * Edit a booking - Redirects back to the service page with pre-filled data
     */
    public function edit($id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if (strtolower($booking->status) !== 'pending') {
            return redirect()->route('my.bookings')->with('error', 'Only pending bookings can be edited.');
        }

        if (!$this->canEditBooking($booking)) {
            return redirect()->route('my.bookings')->with('error', 'The deadline for editing this booking has passed.');
        }

        $serviceType = strtolower($booking->service_type);

        if ($serviceType === 'spa') {
            $categories = \App\Models\SpaCategory::with('services')->get();
            return view('spa', compact('categories', 'booking'));
        } 
        elseif ($serviceType === 'lodging') {
            $rooms = \App\Models\Room::all();
            return view('lodging', compact('rooms', 'booking'));
        } 
        elseif ($serviceType === 'restaurant') {
            $categories = \App\Models\MenuCategory::with('restaurantMenus')->get();
            $tables = \App\Models\RestaurantTable::all();
            return view('restaurant', compact('categories', 'tables', 'booking'));
        }

        return redirect()->route('my.bookings');
    }

    /**
     * Update an existing booking
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $rules = [
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'nullable|string|max:255',
            'check_out_date' => 'nullable|date|after:booking_date',
            'special_request' => 'nullable|string|max:1000',
            'order_items' => 'nullable|string',
        ];

        if ($booking->service_type === 'Lodging') {
            $rules['number_of_guests'] = 'required|integer|min:1|max:4';
        }

        $request->validate($rules);

        // =================================================================
        // NEW CODE BLOCK STARTS
        // =================================================================
        if ($booking->service_type === 'Restaurant') {
            $sName = $request->service_name ?? $booking->service_name;
            $bDate = $request->booking_date;
            $bTime = $request->booking_time ?? $booking->booking_time;

            if ($this->isTableBusy($sName, $bDate, $bTime, $booking->id)) {
                return back()->withInput()->with('error_conflict', 'Sorry, this table is already confirmed for another guest at this time.');
            }
        }
        // =================================================================
        // NEW CODE BLOCK ENDS
        // =================================================================

        $orderItems = $request->order_items;
        if (is_string($orderItems)) {
            $orderItems = json_decode($orderItems, true);
        }

        $booking->update([
            'service_name' => $request->service_name ?? $booking->service_name,
            'number_of_guests' => $request->number_of_guests ?? $booking->number_of_guests,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time ?? null,
            'check_out_date' => $request->check_out_date ?? null,
            'special_request' => $request->special_request,
            'order_items' => $orderItems,
        ]);

        return redirect()->route('my.bookings')->with('booking_success', 'Booking updated successfully!');
    }

    /**
     * ADMIN: List all bookings
     */
    public function index() 
    {
        $bookings = Booking::with('user')->orderBy('created_at', 'desc')->get();

        $restaurantBookings = $bookings
            ->where('service_type', 'Restaurant')
            ->map(function ($b) {
                return [
                    'id'           => $b->id,
                    'service_name' => $b->service_name,
                    'booking_date' => $b->booking_date ? Carbon::parse($b->booking_date)->format('Y-m-d') : null,
                    'booking_time' => $b->booking_time ? Carbon::parse($b->booking_time)->format('g:i A') : '—',
                    'status'       => $b->status,
                    'guest'        => optional($b->user)->first_name . ' ' . optional($b->user)->last_name,
                ];
            })
            ->values();

        return view('admin.bookings', compact('bookings', 'restaurantBookings'));
    }

    /**
     * ADMIN: Update booking status
     * Note: Restaurant tables have no status column — their availability is
     * determined solely by the bookings table. Only Room status is updated here.
     */
    public function updateStatus(Request $request, $id) 
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        // Only update Room status on confirmation — Restaurant tables are unaffected
        if ($request->status === 'Confirmed') {
            if ($booking->service_type === 'Lodging') {
                $room = \App\Models\Room::where('name', $booking->service_name)->first();
                if ($room) {
                    $room->status = 'unavailable';
                    $room->save();
                }
            }
        }

        $emailMessage = $this->generateConfirmationMessage($booking, $request->status);
        $cancellationMessage = $request->input('cancellation_message');
        Mail::to($booking->user->email)->send(new BookingStatusMail($booking, $emailMessage, $cancellationMessage));

        return back()->with('success', 'Booking updated and status synchronized successfully!');
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('my-bookings', compact('bookings'));
    }

    public function cancelUserBooking(Request $request, $id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if (!in_array($booking->status, ['Pending', 'Confirmed'])) {
            return response()->json(['success' => false, 'message' => 'This booking cannot be cancelled.'], 400);
        }

        if (!$this->canCancelBooking($booking)) {
            return response()->json(['success' => false, 'message' => 'Cancellation period has expired.'], 400);
        }

        $previousStatus = $booking->status;
        $booking->status = 'Cancelled';
        $booking->cancellation_reason = $request->input('cancellation_message');
        $booking->save();

        if ($previousStatus === 'Confirmed') {
            try {
                $adminEmail = config('mail.admin_address', '05230116.jnec@rub.edu.bt');
                Mail::to($adminEmail)->send(new AdminBookingCancellationMail($booking));
            } catch (\Exception $e) {
                Log::error('❌ Failed to send admin email', ['error' => $e->getMessage()]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Booking cancelled successfully.']);
    }

    private function canEditBooking(Booking $booking): bool
    {
        $serviceType = strtolower($booking->service_type);
        $now = now();
        $targetDateTime = $this->getBookingDateTime($booking);
        
        if (!$targetDateTime) return false;

        if ($serviceType === 'restaurant') {
            return $now->lessThan($targetDateTime->copy()->subMinutes(30));
        } 
        elseif (in_array($serviceType, ['spa', 'lodging'])) {
            return $now->lessThan($targetDateTime->copy()->subHours(3));
        }
        
        return false;
    }

    private function generateConfirmationMessage(Booking $booking, string $status): string
    {
        $serviceName = $booking->service_name;
        $serviceType = strtolower($booking->service_type);

        if ($status === 'Confirmed') {
            if ($serviceType === 'table' || $serviceType === 'restaurant') {
                return "Your booking for {$serviceName} has been confirmed. Please cancel your reservation before 20 minutes of the scheduled time.";
            } elseif (in_array($serviceType, ['spa', 'lodging'])) {
                return "Your booking for {$serviceName} has been confirmed. Please note that cancellations must be made at least 3 hours before the scheduled time.";
            } else {
                return "Your booking for {$serviceName} has been confirmed.";
            }
        } elseif ($status === 'Cancelled') {
            return "We regret to inform you that your booking for {$serviceName} has been cancelled.";
        }

        return "Your booking for {$serviceName} status has been updated to: {$status}.";
    }

    private function canCancelBooking(Booking $booking): bool
    {
        $serviceType = strtolower($booking->service_type);
        $bookingDateTime = $this->getBookingDateTime($booking);
        if (!$bookingDateTime) return true;
        $now = now();
        if ($serviceType === 'table' || $serviceType === 'restaurant') {
            return $now->lessThan($bookingDateTime->copy()->subMinutes(20));
        } 
        elseif (in_array($serviceType, ['spa', 'lodging'])) {
            return $now->lessThan($bookingDateTime->copy()->subHours(3));
        }
        return true;
    }

    private function getBookingDateTime(Booking $booking)
    {
        if (!$booking->booking_date) return null;
        $date = is_string($booking->booking_date) ? Carbon::parse($booking->booking_date) : $booking->booking_date;
        $dateTimeStr = $date->format('Y-m-d');
        if ($booking->booking_time) $dateTimeStr .= ' ' . $booking->booking_time;
        try { return Carbon::parse($dateTimeStr); } catch (\Exception $e) { return null; }
    }

    // =================================================================
    // NEW HELPER METHOD
    // =================================================================
    /**
     * Check if a restaurant table is already confirmed for a specific date and time.
     */
    private function isTableBusy($serviceName, $date, $time, $excludeBookingId = null)
    {
        // We only restrict physical tables, not "Takeaway Order"
        if ($serviceName === 'Takeaway Order') {
            return false;
        }

        $query = Booking::where('service_type', 'Restaurant')
            ->where('service_name', $serviceName)
            ->where('booking_date', $date)
            ->where('booking_time', $time)
            ->where('status', 'Confirmed');

        // If we are updating an existing booking, don't check against itself
        if ($excludeBookingId) {
            $query->where('id', '!=', $excludeBookingId);
        }

        return $query->exists();
    }
}
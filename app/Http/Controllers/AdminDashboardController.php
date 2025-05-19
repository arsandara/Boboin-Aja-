<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $todayGuest = DB::table('reservations')->whereDate('check_in', $today)->count();

        $newBooking = DB::table('reservations')->whereDate('created_at', $today)->count();

        $revenueToday = DB::table('reservations')
            ->whereDate('check_in', $today)
            ->sum('total_price');

        $bookings = DB::table('reservations')
            ->where('status', 'Confirmed')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $rooms = DB::table('rooms')
            ->leftJoin('reservations', function($join) {
                $join->on('rooms.room_name', '=', 'reservations.room_name')
                    ->where('reservations.status', 'Checked In');
            })
            ->select('rooms.room_name', 'rooms.total_rooms', DB::raw('COUNT(reservations.reservation_id) as occupied_rooms'))
            ->groupBy('rooms.room_name', 'rooms.total_rooms')
            ->get();

        $occupancyData = [];
        $totalRooms = 0;
        $totalOccupied = 0;

        foreach ($rooms as $room) {
            $occupied = (int) $room->occupied_rooms;
            $total = (int) $room->total_rooms;
            $available = $total - $occupied;

            $occupancyData[] = [
                'room_name' => $room->room_name,
                'occupied' => $occupied,
                'available' => $available,
                'total' => $total,
                'sold_out' => $available <= 0,
            ];

            $totalRooms += $total;
            $totalOccupied += $occupied;
        }

        $availabilityPercentage = $totalRooms > 0 ? round(($totalRooms - $totalOccupied) / $totalRooms * 100) : 0;

        return view('admin.dashboard', compact(
            'todayGuest', 'newBooking', 'revenueToday', 'bookings', 'occupancyData', 'availabilityPercentage'
        ));
    }
}

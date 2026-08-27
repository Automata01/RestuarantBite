<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function index()
    {
        // =========================
        // KPI
        // =========================

        $totalRevenue = Reservation::whereNotIn('status', ['cancelled'])
            ->sum('total_amount');

        $totalReservations = Reservation::count();

        $todayReservations = Reservation::whereDate(
            'reservation_date',
            today()
        )->count();

        $pendingReservations = Reservation::where(
            'status',
            'pending'
        )->count();


        // =========================
        // MONTHLY REVENUE
        // Last 6 months
        // =========================

        $monthlyRevenue = collect();

        for ($i = 5; $i >= 0; $i--) {

            $date = Carbon::now()
                ->subMonths($i);

            $revenue = Reservation::whereNotIn(
                    'status',
                    ['cancelled']
                )
                ->whereYear(
                    'reservation_date',
                    $date->year
                )
                ->whereMonth(
                    'reservation_date',
                    $date->month
                )
                ->sum('total_amount');

            $monthlyRevenue->push([
                'month' => $date->format('M'),
                'revenue' => (float) $revenue,
            ]);
        }


        // =========================
        // RESERVATION STATUS
        // =========================

        $reservationStatus = Reservation::select(
                'status',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('status')
            ->get()
            ->map(function ($item) {
                return [
                    'status' => ucfirst(
                        str_replace(
                            '_',
                            ' ',
                            $item->status
                        )
                    ),
                    'count' => (int) $item->count,
                ];
            });


        // =========================
        // RECENT RESERVATIONS
        // =========================

        $recentReservations = Reservation::with([
                'user',
                'restaurantTable'
            ])
            ->latest()
            ->take(8)
            ->get();


        // =========================
        // POPULAR MENU ITEMS
        // =========================

        $popularMenuItems = ReservationItem::select(
                'menu_item_id',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(quantity * price) as total_revenue')
            )
            ->with('menuItem')
            ->groupBy('menu_item_id')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();


        return view(
            'admin.dashboard',
            compact(
                'totalRevenue',
                'totalReservations',
                'todayReservations',
                'pendingReservations',
                'monthlyRevenue',
                'reservationStatus',
                'recentReservations',
                'popularMenuItems'
            )
        );
    }
}
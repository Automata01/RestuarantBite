<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\RestaurantTable;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Reservation page
     */
    public function create()
    {
        $tables = RestaurantTable::where('status', 'available')
            ->orderBy('table_number')
            ->get();

        $menuItems = MenuItem::where('is_available', true)
            ->orderBy('name')
            ->get();

        return view('reservations.create', compact(
            'tables',
            'menuItems'
        ));
    }

    /**
     * Store reservation
     *
     * IMPORTANT:
     * Keep only ONE store() method in this controller.
     */
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_table_id' => 'required|exists:restaurant_tables,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'location' => 'required|string|max:255',

            'items' => 'nullable|array',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {

            /*
             * Prevent the same table from being booked
             * at the same date/time.
             */
            $alreadyReserved = Reservation::where(
                'restaurant_table_id',
                $request->restaurant_table_id
            )
            ->where('reservation_date', $request->reservation_date)
            ->where('reservation_time', $request->reservation_time)
            ->whereIn('status', [
                'pending',
                'confirmed'
            ])
            ->exists();

            if ($alreadyReserved) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'restaurant_table_id' =>
                            'This table is already reserved for the selected date and time.'
                    ]);
            }

            /*
             * Calculate food total
             */
            $totalAmount = 0;

            if ($request->filled('items')) {

                foreach ($request->items as $item) {

                    $menuItem = MenuItem::findOrFail(
                        $item['menu_item_id']
                    );

                    $totalAmount +=
                        $menuItem->price * $item['quantity'];
                }
            }

            /*
             * Create reservation
             */
            $reservation = Reservation::create([
                'user_id' => Auth::id(),

                'restaurant_table_id' =>
                    $request->restaurant_table_id,

                'reservation_date' =>
                    $request->reservation_date,

                'reservation_time' =>
                    $request->reservation_time,

                'location' =>
                    $request->location,

                'status' =>
                    'pending',

                'total_amount' =>
                    $totalAmount,
            ]);

            /*
             * Save advance food orders
             */
            if ($request->filled('items')) {

                foreach ($request->items as $item) {

                    $menuItem = MenuItem::findOrFail(
                        $item['menu_item_id']
                    );

                    $reservation->items()->create([
                        'menu_item_id' =>
                            $menuItem->id,

                        'quantity' =>
                            $item['quantity'],

                        'price' =>
                            $menuItem->price,
                    ]);
                }
            }

            DB::commit();

            /*
             * Send user to actual receipt
             */
            return redirect()
                ->route(
                    'reservations.receipt',
                    $reservation->id
                )
                ->with(
                    'success',
                    'Reservation successfully created.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' =>
                        'Unable to create reservation. ' .
                        $e->getMessage()
                ]);
        }
    }

    /**
     * Show receipt
     */
    public function receipt($id)
    {
        $reservation = Reservation::with([
            'user',
            'restaurantTable',
            'items.menuItem'
        ])
        ->where('user_id', Auth::id())
        ->findOrFail($id);

        return view(
            'reservations.receipt',
            compact('reservation')
        );
    }

    /**
     * User reservation history
     */
    public function index()
    {
        $reservations = Reservation::with([
            'restaurantTable',
            'items.menuItem'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

        return view(
            'reservations.index',
            compact('reservations')
        );
    }
}
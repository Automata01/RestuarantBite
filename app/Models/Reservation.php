<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'restaurant_table_id',
        'reservation_date',
        'reservation_time',
        'location',
        'status',
        'total_amount',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurantTable()
    {
        return $this->belongsTo(
            RestaurantTable::class,
            'restaurant_table_id'
        );
    }

    public function items()
    {
        return $this->hasMany(
            ReservationItem::class
        );
    }
}
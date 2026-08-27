<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationItem extends Model
{
    protected $fillable = [
        'reservation_id',
        'menu_item_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function reservation()
    {
        return $this->belongsTo(
            Reservation::class
        );
    }

    public function menuItem()
    {
        return $this->belongsTo(
            MenuItem::class,
            'menu_item_id'
        );
    }
}
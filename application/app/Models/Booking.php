<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_date',
        'price',
        'zone',
        'event_id',
    ];

    public function events()
    {
        return $this->belongsTo(Event::class);
    }
}

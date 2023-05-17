<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'available_ticket',
        'date',
        'category_id',
        'stadium_id'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function stadiums()
    {

        return $this->belongsTo(Stadium::class);
    }
    
    public function matchings()
    {
        return $this->hasMany(Matching::class);
    }
}

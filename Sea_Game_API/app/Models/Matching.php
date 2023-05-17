<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matching extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1',
        'team2',
        'time',
        'event_id'
    ];
    public function events()
    {
        return $this->belongsTo(Event::class);
    }
}

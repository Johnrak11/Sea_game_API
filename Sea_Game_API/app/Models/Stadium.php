<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'zoneA', 'zoneB', 'address'];

    public function events()
    {

        return $this->hasMany(Event::class);
    }
}

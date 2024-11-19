<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'type', 'nightPrice', 'hotel_id'];

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function guests(){
        return $this->hasMany(Guest::class);
    }
}

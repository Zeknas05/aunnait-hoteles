<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'surname', 'passportID', 'checkinDate', 'checkoutDate', 'roomId'];
    public function room(){
        return $this->belongsTo(Room::class);
    }
    
}

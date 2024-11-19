<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'adress', 'phoneNumber', 'email', 'website'];
    public function services(): BelongsToMany{
        return $this->belongsToMany(Service::class);
    }
}

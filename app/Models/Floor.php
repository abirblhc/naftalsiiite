<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        ('floor_number'),
    ];

    public function locations(){
       
        return $this->hasMany(Location::class, 'location_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Corridor extends Model
{
    use HasFactory;

    protected $fillable = [
     
        'location_id', 
        'name',  
    ];

    public function materials()
    {
        return $this->hasMany(Material::class, 'corridor_id');
    }

     public function location()
  {
      return $this->belongsTo(location::class, 'location_id');
  }

}

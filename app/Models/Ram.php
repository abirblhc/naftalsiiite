<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Ram extends Model
{
    use HasFactory;
    protected $fillable = [
        'capacity',
        'state',

    ];
    //
    public function computer()
    {
        return $this->belongsTo(Computer::class, 'computer_id');
    }

}

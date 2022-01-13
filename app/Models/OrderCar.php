<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderCar extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [
        'id',
    ];

    public function car(){
        return $this->belongsTo(Car::class,'car_id');
    }
}

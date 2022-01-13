<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [
        'id',
    ];

    public function cars(){
        return $this->hasMany(Car::class,'car_model_id');
    }
    public function marques(){
        return $this->belongsTo(CarMarque::class,'car_marque_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [
        'id',
    ];
    public function type(){
        return $this->belongsTo(CarType::class,'car_type_id');
    }
    public function models(){
        return $this->belongsTo(CarModel::class,'car_model_id');
    }
    public function rate(){
        return $this->hasMany(CarRate::class,'product_id');
    }
    public function order(){
        return $this->belongsToMany(Order::class,'order_cars','car_id','order_id')->withPivot('updated_at','created_at');
    }
}

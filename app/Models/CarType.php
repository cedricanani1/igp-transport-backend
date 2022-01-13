<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CarType extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [
        'id',
    ];

    public function cars(){
        return $this->hasMany(Car::class,'car_type_id');
    }
    public function child(){
        return $this->hasMany(CarType::class,'parent_id');
    }
    public function parent(){
        return $this->belongsTo(CarType::class,'parent_id');
    }
}

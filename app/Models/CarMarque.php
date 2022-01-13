<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CarMarque extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [
        'id',
    ];
    public function models(){
        return $this->hasMany(CarModel::class,'car_marque_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;
    protected $fillable = [
        'city_name',
        'street_name',
        'area_name'
        
    ];

    //Relationships
    public function healthCenters(){
        return $this->hasMany(HealthCenter::class);
    }

    public function persons(){
        return $this->hasMany(Person::class);
    }
}

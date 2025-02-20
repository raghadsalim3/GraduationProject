<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCenter extends Model
{
    /** @use HasFactory<\Database\Factories\HaelthCenterFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'phone_number',
        'location_id'

        
    ];

    //Relationships
    public function location(){

        return $this->belongsTo(Location::class);
    }
}

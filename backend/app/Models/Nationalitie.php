<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationalitie extends Model
{
    /** @use HasFactory<\Database\Factories\NationalitieFactory> */
    use HasFactory;
    protected $fillable = [
        'country_name',
        'country_code'
        ,'nationality_name',
    ];
}

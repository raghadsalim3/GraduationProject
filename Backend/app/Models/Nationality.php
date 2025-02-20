<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    /** @use HasFactory<\Database\Factories\NationalitieFactory> */
    use HasFactory;
    protected $table = 'nationalities';
    protected $fillable = [
        'country_name',
        'country_code',
        'nationality_name',
    ];

        //Relationships
        public function persons(){
            return $this->hasMany(Person::class , 'nationalities_id');
        }
}

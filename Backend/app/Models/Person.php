<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Person extends Model
{
    /** @use HasFactory<\Database\Factories\PersonFactory> */
    use HasFactory;
    protected $table = 'persons';
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'phone_number',
        'identity_card_number',
        'location_id',
        'nationalities_id',
        'isDeceased',
        
    ];

    // Relationships 

    public function location(){
        return $this->belongsTo(Location::class);
    }
    public function nationality(){
        return $this->belongsTo(Nationality::class , 'nationalities_id');
    }
    public function employee(){
        return $this->hasOne(Employee::class , 'id' , 'id');
    }

    function CreatePerson(Request $request){

        logger()->info("Received data:", $request->all());
        $newPerson = Person::create([
    
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'gender' =>$request->input('gender'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'identity_card_number' => $request->input('identity_card_number'),
                'nationalities_id' => $request->input('nationalities_id'),
                'location_id' => $request->input('location_id'),
                
        ]);
            
    
         return $newPerson;
    }

    function getPersonByidentityCardNumber(string $identity_card_number ) 
    {
        $person = Person::where('identity_card_number',$identity_card_number)->with(['location','nationality'])->first();
        return $person;
        
    }

    function isPersonExist(string $identity_card_number)
    {
        return Person::where('identity_card_number',$identity_card_number)->exists();

    }
}

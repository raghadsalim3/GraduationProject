<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Models\Nationality;
use App\Models\Location;

class PersonController extends Controller
{
    public function index()
    {
        $person=Person::all();
        return ['person'=>$person];
    }
    public function create()
    {
        $nationality=Nationality::all();
        $location=Location::all();

        return ['nationality'=>$nationality,'location'=>$location];
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=request()->all();
        Person::create([
        'first_name'=>request()->first_name,
        'last_name'=>request()->last_name,
        'gender'=>request()->gender,
        'email'=>request()->email,
        'phone_number'=>request()->phone_number,
        'identity_card_number'=>request()->identity_card_number,
        'location_id'=>request()->location_id,
        'nationalities_id'=>request()->nationalities_id,
        'isDeceased'=>request()->isDeceased,
        ]);
        return $data;
    }
    
    public function edit(Person $person)
    {
        $nationality=Nationality::all();
        $location=Location::all();

        return ['person'=>$person,'nationality'=>$nationality,'location'=>$location];
    }
    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return(['person'=>$person]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($personId)
    {
        $singlePersonFromDB=Person::find($personId);

        $singlePersonFromDB->update([
        'first_name'=>request()->first_name,
        'last_name'=>request()->last_name,
        'gender'=>request()->gender,
        'email'=>request()->email,
        'phone_number'=>request()->phone_number,
        'identity_card_number'=>request()->identity_card_number,
        'location_id'=>request()->location_id,
        'nationalities_id'=>request()->nationalities_id,
        'isDeceased'=>request()->isDeceased,
        ]);

        return($singlePersonFromDB);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($personId)
    {
        $person=Person::find($personId);

        $person->delete($personId);
        return(Person::all());
    }

    public function checkIdentityCardNumber(string $identity_card_number)
    {
        $person = new Person();
        if($person->isPersonExist($identity_card_number))
        {
            return $person->getPersonByidentityCardNumber($identity_card_number);

        }
    }
}

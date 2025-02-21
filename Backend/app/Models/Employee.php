<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Person;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;
    protected $fillable = [
        'id',
        'role',
        'position',
        'date_of_birth',
        'employment_date',
        'isActive',
        'health_center_id'
    ];

    //Relationships
    public function person(){
        return $this->belongsTo(Person::class , 'id' , 'id');
    }
    public function health_center(){
        return $this->belongsTo(HealthCenter::class);
    }

    //The main function to create an employee
    function CreateEmployee(Request $request)
    {
        $isPersonExist = $request->input('isPersonExist');
        if($isPersonExist)
        {
            $personId = $request->input('personId');
            $this->CreateEmployeeForExistPerson($request,$personId);
        }
        else
        {
    
            $this->CreateEmployeeWithPerson($request);
        }

    }

     function CreateEmployeeWithPerson(Request $request)
    {
        $newPerson = (new Person())->CreatePerson($request);
       $this->CreateEmployeeForExistPerson($request , $newPerson->id);
       

    }

     function CreateEmployeeForExistPerson(Request $request , int $personId){
        $newEmployee = Employee::create(
            [ 'id' => $personId,
              'employment_date' => $request->input('employment_date'),
              'date_of_birth' => $request->input('date_of_birth'),
              'health_center_id' => $request->input('health_center_id'),
              'position' => $request->input('position'),

            ]
        );

        return $newEmployee;

    }


      

 
}

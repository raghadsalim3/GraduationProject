<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Person;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($token)
    {
        //Give me all the employees they work in specified HealthCenter:
        //Why the error is happend SQLSTATE[42S22]: Column not found: 1054 Unknown column 'remember_token' in 'where clause' 
        //(Connection: mysql, SQL: select * from `persons` where `remember_token` = 3ytfegc462tfgg554FGfSEvbFG limit 1
        // but I want to chek the remember_token in the user table

        // $getPerson_id=$getUser->persons_id;
        // $getPerson = Person::find($getPerson_id);
        // return['persons_id'=>$getUser->persons_id];
            $getPerson = User::find($token);
            if($getPerson!=null){

                $getPersonId=$getPerson->id;
                $employee=Employee::find($getPersonId);
                $gethealth_center_id=$employee->health_center_id;
                $getAllEmployees=Employee::where('health_center_id',$gethealth_center_id)->get();
    
                $employeeCount = $getAllEmployees->count();
                return [
                        'employees' => $getAllEmployees,
                        'count' => $employeeCount,
                    ];
            }else{
                return response()->json([
                    'message' => 'Not Found this user!'
                ], 401);
            }      
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->CreateEmployee($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function getByname(string $name)
    {
        if($name == null){
            return "enter a name!";
        }
        else{
            $employees = Person::whereHas('employee',function($query)
            {
                $query->whereNotNull('id');
    
            })->whereRaw("CONCAT(first_name, ' ' , last_name) LIKE ?" , ['%' . $name . '%']
            )->with(['employee.health_center'])->get();
    
            if($employees == null){
                return "Not found";
            }
            else{
                return  $employees;
            }

        }



       

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

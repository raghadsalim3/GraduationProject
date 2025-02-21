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
    public function index()
    {
        //
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

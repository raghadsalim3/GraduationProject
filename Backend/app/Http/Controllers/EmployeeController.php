<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Person;
use App\Models\User;
use App\Models\HealthCenter;
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
        if ($getPerson != null) {

            $getPersonId = $getPerson->id;
            $employee = Employee::find($getPersonId);
            $gethealth_center_id = $employee->health_center_id;
            $getAllEmployees = Employee::where('health_center_id', $gethealth_center_id)->get();

            $employeeCount = $getAllEmployees->count();
            return [
                'employees' => $getAllEmployees,
                'count' => $employeeCount,
            ];
        } else {
            return response()->json([
                'message' => 'Not Found this user!'
            ], 401);
        }
    }
    public function create()
    {
        // Give me all the HealthCenter that can choose one from them: 
        $healthCenter = HealthCenter::all();
        return ['healthCenter' => $healthCenter];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->CreateEmployee($request);
    }

    //Give me the all the data of specified employee that store in DataBase 
    public function edit(Employee $employee)
    {
        $healthCenter = HealthCenter::all();
        return ['employee' => $employee, 'healthCenter' => $healthCenter];
    }
    /**
     * Display the specified resource.
     * Type Hinting
     */
    public function show(Employee $employee) //
    {
        return (['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($employeeId)
    {
        //Find the specified employee by using ID:
        $singleEmployeeFromDB = Employee::find($employeeId);

        //Update the data after get the specified employee:
        $singleEmployeeFromDB->update([
            'role' => request()->role,
            'isActive' => request()->isActive,
        ]);

        //Return the employee after updated:
        return ($singleEmployeeFromDB);
    }

    public function getByname(string $name)
    {
        if ($name == null) {
            return "enter a name!";
        } else {
            $employees = Person::whereHas('employee', function ($query) {
                $query->whereNotNull('id');
            })->whereRaw(
                "CONCAT(first_name, ' ' , last_name) LIKE ?",
                ['%' . $name . '%']
            )->with(['employee.health_center'])->get();

            if ($employees == null) {
                return "Not found";
            } else {
                return  $employees;
            }
        }
    }

    public function isActive($employeeId)
    {
        // Find the employee by ID
        $singleEmployeeFromDB = Employee::find($employeeId);

        // Check if the employee exists
        if (!$singleEmployeeFromDB) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        //Change the status of employee and save it in the vareble:
        $newStatus = $singleEmployeeFromDB->isActive ? '0' : '1';

        // Update the employee's status
        $singleEmployeeFromDB->update([
            'isActive' => $newStatus,
        ]);
        return (Employee::all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

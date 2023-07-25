<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

require_once base_path('utils/calculateDayTimeAndNightTime.php');

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'daytime' => 'required',
            'nightTime' => 'required',
        ]);

        $result = calculateDayTimeAndNightTime($request->daytime, $request->nightTime);

        $request->daytime = $result['daytimeHours'];
        $request->nightTime = $result['nightTimeHours'];

        return Employee::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return $employee;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'daytime' => 'required',
            'nightTime' => 'required',
        ]);

        $employee->update($request->all());

        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}

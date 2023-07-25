<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

// Função para calcular as horas noturnas e diurnas
function convertToMinutes($timeString) {
    list($horas, $minutos) = explode(':', $timeString);

    return ($horas * 60) + $minutos;
}

function convertToTimeString($totalMinutes) {
    $hours = floor($totalMinutes / 60);
    $minutes = $totalMinutes % 60;

    return sprintf("%02d:%02d", $hours, $minutes);
}

function calcularHorasNoturnasDiurnas($initial, $final) {
    $minutesInitial = convertToMinutes($initial);
    $minutesFinal = convertToMinutes($final);

    $daytimeHours = 0;
    $nightTimeHours = 0;

    // Tempo convertido de horas para minutos
    $twoHours = 120;
    $fiveHours = 300;
    $twentyTwoHours = 1320;
    $twentyFourHours = 1440;

    if ($minutesInitial >= $twentyTwoHours && $minutesFinal <= $twentyFourHours) {
        $nightTimeHours += $twentyFourHours - $minutesInitial;
    }

    if ($minutesInitial >= $fiveHours && $minutesFinal <= $twentyTwoHours && $minutesInitial < $minutesFinal) {
        $daytimeHours += $minutesFinal - $minutesInitial;
    }

    if ($minutesInitial >= $fiveHours && $minutesFinal > $twentyTwoHours && $minutesFinal <= $twentyFourHours) {
        $daytimeHours += $twentyTwoHours - $minutesInitial;
        $nightTimeHours += $minutesFinal - $twentyTwoHours;
    }

    if ($minutesInitial >= 0 && $minutesInitial <= $fiveHours) {
        $nightTimeHours += $fiveHours - $minutesInitial;
    }

    dd(convertToTimeString($daytimeHours), convertToTimeString($nightTimeHours));
    // $result = $minutesFinal - $minutesInitial;
}


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

        $resultado = calcularHorasNoturnasDiurnas($request->daytime, $request->nightTime);

        // return Employee::create($request->all());
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

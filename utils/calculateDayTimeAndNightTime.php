<?php

require_once 'convertToMinutes.php';

function calculateDayTimeAndNightTime($initial, $final) {
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

    if ($minutesInitial < $twentyTwoHours && $minutesFinal >= 0 && $minutesFinal <= $fiveHours) {
        $daytimeHours += $twentyTwoHours - $minutesInitial;
        $nightTimeHours += $twoHours + ($fiveHours - $minutesFinal);
    }

    if ($minutesInitial < $twentyTwoHours && $minutesFinal >= 0 && $minutesFinal > $fiveHours) {
        $daytimeHours += $twentyTwoHours - $minutesInitial + ($minutesFinal - $fiveHours);
        $nightTimeHours += $twoHours + $fiveHours;
    }

    if ($minutesInitial > $twentyTwoHours && $minutesFinal >= 0 && $minutesFinal > $fiveHours) {
        $daytimeHours += $minutesFinal - $fiveHours;
        $nightTimeHours += $fiveHours + $twentyFourHours - $minutesInitial;
    }

    return [
        "daytimeHours" => convertToTimeString($daytimeHours),
        "nightTimeHours" => convertToTimeString($nightTimeHours),
    ];
}

?>

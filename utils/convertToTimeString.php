<?php

function convertToTimeString($totalMinutes) {
    $hours = floor($totalMinutes / 60);
    $minutes = $totalMinutes % 60;

    return sprintf("%02d:%02d", $hours, $minutes);
}

?>

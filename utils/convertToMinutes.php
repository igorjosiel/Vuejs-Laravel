<?php

function convertToMinutes($timeString) {
    list($horas, $minutos) = explode(':', $timeString);

    return ($horas * 60) + $minutos;
}

?>

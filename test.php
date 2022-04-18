<?php
$append = '00:';
$start_time = $append . '12:30.725';
$current_time = $append . '15:45.212';

function calc_times($time = FALSE)
{
    $min = substr($time, -9, 2);
    $seconds = substr($time, -6);

    $total_time = $min*60 + $seconds;
    return $total_time;
}

$time_diff = calc_times($current_time) - calc_times($start_time);
echo $time_diff;


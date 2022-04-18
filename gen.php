<?php
$input_name = $_POST['input_file'];
$raw_start_time = $_POST['start_time'];
$raw_end_time = $_POST['end_time'];
$space_name = $_POST['out_file'];
$out_name = str_replace(' ', '_', $space_name);
$extension = $_POST['extension'];
$duration = $_POST['duration'];

$start_time = $raw_start_time;
$end_time = $raw_end_time;

function convert_to_seconds($time = FALSE)
{   
    // if string length exceeds 6, then the string contains a value
    // for the minute so do this 
    if (strlen($time) > 6) {
    $min = substr($time, -9, 2);
    $seconds = substr($time, -6);

    $int_min = floatval($min);
    $int_sec = floatval($seconds);

    $total_time = $int_min*60 + $seconds;
    }
    // anything equal to or less than 6 means that the string does not 
    // contain a value for the minute so do not attempt to convert it to
    // seconds 
    else 
    {
        $total_time = floatval($time);
    }
    return $total_time;
}

// use the above function to get the relevant times and subtract them
$time_diff = convert_to_seconds($end_time) - convert_to_seconds($start_time);

function ffmpeg_no_touchy($extension, $start_time, $time_diff, $input_name, $out_name, $quality = FALSE)
{
    echo '<strong>ffmpeg -ss ' . $start_time . ' -t ' . $time_diff . ' -i "' . $input_name . $extension . '" ' , $out_name . $quality . $extension . '</strong><br><br>';
}

function ffmpeg_line($size = FALSE, $bv = FALSE, $r = FALSE, $extension = FALSE, $start_time, $time_diff, $input_name, $out_name, $quality = FALSE)
{
    echo 'ffmpeg -ss ' . $start_time . ' -t ' . $time_diff . ' -i "' . $input_name . $extension . '" -s ' . $size . ' -b:v ' . $bv . ' -r ' . $r . ' -filter:a "volume=10dB" ' . '"' . $out_name . $quality . '"' . '.mp4' . '<br><br>';
}

function duration_specified($size = FALSE, $bv = FALSE, $r = FALSE, $extension = FALSE, $start_time, $duration = FALSE, $input_name, $out_name, $quality = FALSE)
{
    echo 'ffmpeg -ss ' . $start_time . ' -t ' . $duration . ' -i "' . $input_name . $extension . '" -s ' . $size . ' -b:v ' . $bv . ' -r ' . $r . ' -filter:a "volume=10dB" ' . '"' . $out_name . $quality . '"' . '.mp4' . '<br><br>';
}

function lossless($start_time, $time_diff, $size = FALSE, $r = FALSE, $input_name, $extension, $out_name, $quality = FALSE)
{
    echo "ffmpeg -ss " . $start_time . " -t " . $time_diff . " -i '" . $input_name . $extension . "' -s " . $size . " -r " . $r . " -c:v libx264 -crf 18 -preset veryslow -c:a copy " . $out_name . $quality . ".mp4";
}

ffmpeg_no_touchy($extension, $start_time, $time_diff, $input_name, $out_name, '_576p');

ffmpeg_line('1280x720', '2000000', '60', $extension, $start_time, $time_diff, $input_name, $out_name, '_tiktok');
ffmpeg_line('2400x1080', '4000000', '60', $extension, $start_time, $time_diff, $input_name, $out_name, '_Native_1080p60');
ffmpeg_line('1920x1080', '4000000', '60', $extension, $start_time, $time_diff, $input_name, $out_name, '_1080p60');
ffmpeg_line('1280x720', '2000000', '60', $extension, $start_time, $time_diff, $input_name, $out_name, '_720p60');
ffmpeg_line('1280x720', '1600000', '30', $extension, $start_time, $time_diff, $input_name, $out_name, '_720p');
ffmpeg_line('854x480', '750000', '30', $extension, $start_time, $time_diff, $input_name, $out_name, '_480p');

echo "<br><br>";
echo "Duration Specified:" . "<br><br>";
duration_specified('2400x1080', '4000000', '60', $extension, $start_time, $duration, $input_name, $out_name, '_Native_1080p60');

echo "<br><br>";
echo "Losless:" . "<br><br>";

lossless($start_time, $time_diff, '1920x1080', '60', $input_name, $extension, $out_name, '1080plossless');

echo "<br><br>";

echo 'Input start time: ' . $raw_start_time . '<br><br>';
echo 'Input end time: ' . $raw_end_time;
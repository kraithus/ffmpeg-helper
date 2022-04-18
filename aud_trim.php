<?php
$input_name = $_POST['audio_name'];
$raw_start_time = $_POST['start_time'];
$duration = $_POST['duration'];
$space_name = $_POST['output_name'];
$out_name = str_replace(' ', '_', $space_name);
$extension = $_POST['audio_extension'];
$input_extension = $_POST['input_extension'];

$start_time = $raw_start_time;

function ffmpeg_line($extension = FALSE, $input_extension = FALSE, $start_time, $duration, $input_name, $out_name)
{
    echo 'ffmpeg -ss ' . $start_time . ' -t ' . $duration . ' -i "' . $input_name . $input_extension . '" ' . $out_name . $extension . '<br><br>';
}

ffmpeg_line($extension, $input_extension, $start_time, $duration, $input_name, $out_name,);

echo 'Input start time: ' . $raw_start_time . '<br><br>';
echo 'Duration: ' . $duration;
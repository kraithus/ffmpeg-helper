<?php
$input_name = $_POST['input_name'];
$width = $_POST['vid_width'];
$height = $_POST['vid_height'];
$out_name = $_POST['input_name'] . '_cropped_9to16';
$extension = $_POST['video_extension'];

$better_out_name = str_replace(' ', '_', $out_name);

//Finding X point
$int_w = $width;
$int_h = $height;

$w = $int_h*(9/16);
$x = ($int_w-$w)/2;
$y = $int_h;
$h = $y;

echo 'ffmpeg -i "' . $input_name . $extension .'" -filter:v '.'"crop=' .$w. ':'. $h .':'. $x . ':'. $y. '" ' . $better_out_name . '.mp4';
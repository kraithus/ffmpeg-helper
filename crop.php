<?php
$input_name = $_POST['input_name'];
$width = $_POST['vid_width'];

$man_height = $_POST['manual_height'];

if ($man_height == 0) {
    $height = $_POST['vid_height'];
}    
else {
    $height = $man_height;
}    

$out_name = $_POST['input_name'] . '_cropped_square';
$extension = $_POST['video_extension'];

$better_out_name = str_replace(' ', '_', $out_name);

//Finding X point
$int_w = $width;
$int_h = $height;

$x = ($int_w - $int_h)/2;
$y = $int_h;

echo 'ffmpeg -i "' . $input_name . $extension .'" -filter:v '.'"crop=' .$y. ':'. $y .':'. $x . ':'. $y. '" ' . $better_out_name . '.mp4';


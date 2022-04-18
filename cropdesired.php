<?php
$input_name = $_GET['input_name'];

$man_height = $_GET['manual_height'];
$man_width = $_GET['manual_width'];

if ($man_height == 0) {
    $height = $_GET['vid_height'];
}    
else {
    $height = $man_height;
}    

if ($man_width == 0) {
    $width = $_GET['vid_width'];
}    
else {
    $width = $man_width;
}  

$out_name = $_GET['input_name'] . '_cropped';
$extension = $_GET['video_extension'];

$better_out_name = str_replace(' ', '_', $out_name);

$currentHeight = $height;
$currentWidth = $width;

// if no width is supplied, use current width
if ($_GET['new_width'] == 0) {
    $newWidth = $width;
} else {
    $newWidth = $_GET['new_width'];
}

$newHeight = $_GET['new_height'];

if ($currentWidth - $newWidth == 0) {
    $x = 0;
} else {
    $widthCroppedOutPerSide = ($currentWidth - $newWidth)/2;
    $x = $widthCroppedOutPerSide;
}

// height cropped out on both ends so as to center video
$heightCroppedOutPerSide = ($currentHeight - $newHeight)/2;

// amount to subtract to find starting point, ignore the height cropped on top.
// so y point is cropped bottom plus new height
$y = $heightCroppedOutPerSide;

echo 'ffmpeg -i "' . $input_name . $extension .'" -filter:v ' . '"crop=' .$newWidth . ':' . $newHeight .':' . $x . ':' . $y . '" ' . $better_out_name . '_' . $newWidth . 'x' . $newHeight . '.mp4';

echo "<br><br> Preview: <br><br>";

echo 'ffplay -i "' . $input_name . $extension .'" -vf '.'"crop=' .$newWidth . ':' . $newHeight . ':' . $x . ':' . $y . '"'; 
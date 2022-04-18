<?php
// Pass POST data to variables
$video = $_POST['video_name'];
$audio = $_POST['audio_name'];
$vid_ext = $_POST['video_extension'];
$aud_ext = $_POST['audio_extension'];
$output_name = $_POST['output_name'];

$no_space_name = str_replace(' ', '_', $output_name);

// Generate ffmpeg output using POST data
echo 'ffmpeg -i ' . '"' . $video . $vid_ext . '"' . ' -i ' . '"' . $audio . $aud_ext . '"'. ' -filter_complex amix=inputs=2 ' . $no_space_name . '.mp4'; 
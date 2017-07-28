<?php
/*
* Code by Đại Nguyễn
* Facebook: http://facebook.com/deekey.hn
* Email: daikupj@gmail.com
* Rất vui nếu được Donate :D
*/
session_start();

$security_code = rand(100000,999999);
$_SESSION["security_code"] = $security_code;
$image = imagecreatetruecolor(60, 24);
$fg = imagecolorallocate($image, 22, 86, 165); 
$bg = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bg);
imagestring($image, 5, 5, 5,  $security_code, $fg);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>
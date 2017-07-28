<?php
/*
* Code by Đại Nguyễn
* Facebook: http://facebook.com/deekey.hn
* Email: daikupj@gmail.com
* Rất vui nếu được Donate :D
*/
function XoaDauTiengViet($noidung){
    $noidung = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $noidung);
    $noidung = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $noidung);
    $noidung = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $noidung);
    $noidung = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $noidung);
    $noidung = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $noidung);
    $noidung = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $noidung);
    $noidung = preg_replace("/(đ)/", 'd', $noidung);
    $noidung = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $noidung);
    $noidung = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $noidung);
    $noidung = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $noidung);
    $noidung = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $noidung);
    $noidung = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $noidung);
    $noidung = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $noidung);
    $noidung = preg_replace("/(Đ)/", 'D', $noidung);
    return $noidung;
}
?>
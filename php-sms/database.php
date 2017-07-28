<?php
/*
* Code by Đại Nguyễn
* Facebook: http://facebook.com/deekey.hn
* Email: daikupj@gmail.com
* Rất vui nếu được Donate :D
*/
$server = 'localhost';
$userdb = 'root';
$passdb = 'mysql';
$dbname = 'sms';
$connect_db = mysql_connect($server, $userdb, $passdb) OR DIE('<span style="color:red">CONNECT FAILED!</span>');
$connect_db = mysql_select_db($dbname, $connect_db) OR DIE('<span style="color:red">SELECT DATABASE FAILED!</span>');
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
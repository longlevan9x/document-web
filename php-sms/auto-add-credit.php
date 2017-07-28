<?php
/*
* Code by Đại Nguyễn
* Facebook: http://facebook.com/deekey.hn
* Email: daikupj@gmail.com
* Rất vui nếu được Donate :D
*/
require_once('textlocal.php');
require_once('database.php');
$qr = mysql_query("SELECT * FROM `credits` ORDER BY `id_c` ASC LIMIT 1");
while($get = mysql_fetch_array($qr)){
	$id_c = $get['id_c'];
	$mail_c = $get['mail_c'];
	$password_c = 'Pass ở đây';
	$connect_sms = new Connect_Textlocal($mail_c, $password_c);

try {
    $balance = $connect_sms->getBalance();
    if($balance['sms'] < 1){
    	$id_d = $get['id_c'];
    	$qd = mysql_query("DELETE FROM `credits` WHERE `id_c` = $id_d");
    	}
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
}
?>
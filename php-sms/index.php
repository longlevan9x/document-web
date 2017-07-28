<?php
/*
* Code by Đại Nguyễn
* Facebook: http://facebook.com/deekey.hn
* Email: daikupj@gmail.com
* Rất vui nếu được Donate :D
*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Đại Nguyễn">
	<title>SMS FREE & FASTEST</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet"> 
	<link href="css/bootstrap.min.css" rel="stylesheet"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<?php include 'database.php'; ?>
<?php include 'textlocal.php'; ?>
<?php include 'auto-add-credit.php'; ?>
<?php include 'functions.php'; ?>
<?php session_start(); ?>
<body>
	<div class="container">
		<div class="col-md-8">
			<div class="blog-header">
				<h1 class="blog-title"><a href="http://dhost.me">SMS FREE & FASTEST</a></h1>
				<p class="lead blog-description">Nhắn tin miễn phí đến mọi số điện thoại di động</p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="blog-header">
				<h1 class="blog-title">Update v1.4.1</h1>
				<p><small><font color="green">- Cập nhật API cho mọi người phát triển<br>
					- Tự động bỏ dấu tiếng Việt trong nội dung tin nhắn<br>
					- Bắt buộc nội dung tin nhắn > 20 kí tự<br>
				</font></small></p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-7">
				<div class="panel panel-primary">
					<div class="panel-heading">GỬI SMS MIỄN PHÍ - <a href="http://facebook.com/deekey.hn"><font color="white"><u>DONATE ME</u></font></a></div>
					<div class="list-group">
						<div class="list-group-item">
							<?php 
							$connect_api = new Connect_Textlocal($mail_c, $password_c);
							if(isset($_POST['sendSMS'], $_POST['phone'], $_POST['msg'])){
								$np = strip_tags($_POST['phone']);
								$phone = array('84'.substr($np, 1, strlen($np)));
								$sender = 'DSOFT';
								$msg_content = strip_tags($_POST['msg']);
								$msg = $msg_content.' - DHOST.ME';
								$msg = XoaDauTiengViet($msg);
								if($_POST['phone'] == NULL || $_POST['msg'] == NULL){
									echo '<div class="alert alert-danger" role="alert">Không được để trống số điện thoại hoặc nội dung tin nhắn!</div>';
								} else {
									if(strlen($msg_content) < 20){
										echo '<div class="alert alert-danger" role="alert">Nội dung tin nhắn từ 30 - 130 kí tự!</div>';
									} else {
										if($_POST[security_code] != $_SESSION['security_code']){
											echo '<div class="alert alert-danger" role="alert">Sai mã bảo vệ! Vui lòng nhập lại</div>';
										} else {
											if($result = $connect_api->sendSMS($phone, $msg, $sender)){
												echo '<div class="alert alert-success" role="alert">Gửi tin nhắn thành công!</div>';
												$q = mysql_query("INSERT INTO `message`(`msg_to`,`content`,`credit`) VALUES ('$np','$msg_content','$mail_c')");
											} else {
												die('Error: ' . $e->getMessage());
												}
											}
										}
									}
								}
								?>
								<form class="form-horizontal" action="" method="POST">
									<div class="form-group">
										<label for="MobileNumber" class="col-sm-3 control-label">SĐT</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="phone" value="" placeholder="Số điện thoại (0974208128)">
										</div>
										<br><br>
										<label for="Message" class="col-sm-3 control-label">Tin nhắn</label>
										<div class="col-sm-8">
											<textarea name="msg" class="form-control" rows="4" placeholder="Nội dung (không quá 150 kí tự, KHÔNG hỗ trợ tiếng Việt có dấu)..." maxlength="160"></textarea><br>  								
										</div>
										<label for="Message" class="col-sm-3 control-label"><img src="capcha.php"/></label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="security_code" placeholder="Mã bảo vệ"><br>
										</div>
										<center><button type="submit" name="sendSMS" class="btn btn-primary"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> GỬI SMS</button></center>

									</div>
								</form>

							</div>
						</div>

					</div>
				</div>
				<div class="col-sm-5">
					<div class="panel panel-primary">
						<div class="panel-heading">SMS MỚI NHẤT - SMS ĐÃ GỬI: <?php $qc = mysql_num_rows(mysql_query("SELECT * FROM `message`")); echo $qc;?></div>
						<div class="list-group">
							<table class="table table-bordered">
								<tr>
									<th>SĐT</th>
									<th>Tin nhắn</th> 
								</tr>
								<?php 
								$qr = mysql_query("SELECT * FROM `message` ORDER BY `id_msg` DESC LIMIT 6"); 
								while($row = mysql_fetch_array($qr)){ 
									if(strlen($msg_to) == 10){
										$msg_to = substr($row['msg_to'], 0, 7).'xxx';
									} else {
										$msg_to = substr($row['msg_to'], 0, 8).'xxx';
									}
									$content_sms = $row['content'];

									echo '<tr>';
									echo '<td>'.$msg_to.'</td>';
									echo '<td>'.$content_sms.'</td>'; 
									echo '</tr>';
								}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<footer>
				<p>Copyright <a href="http://facebook.com/deekey.hn">Đại Nguyễn</a> &copy; 2017 - All rights reserved</p>
			</footer>    
		</div>

		<script src="jquery/bootstrap.min.js" type="text/javascript"></script>
		<script src="jquery/jquery.min.js" type="text/javascript"></script>
	</body>

	</html>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Hello <?php echo $firstname ;?> , </h2>
		<p> Thank your for joining with our site </p>
		<p> Bellow is your account Info </p>
		<p>
			Email :  <?php echo $email ?> <br />
			Password :  <?php echo $password ?><br />
		</p>
		<p> Please follow link activation  <a href="<?php echo site_url('user/activation?code='.$code) ?>."> Active my account now</a></p>
		<p> If the link now working , copy and paste link bellow </p>
		<p>  <?php echo site_url('user/activation?code='.$code) ?> </p> 
		<br /><br /><p> Thank You </p><br /><br />
		
		 <?php echo CNF_APPNAME ?> 
	</body>
</html>
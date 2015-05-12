<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2> You Have New Mail form Contact Form  </h2>
		<p> Bellow is contact form detail submission : </p>
		<div>
			Name : <?php echo $name;?><br />
			Email : <?php echo $email;?><br />
			Subject : <?php echo $subject;?><br /><br />
			Message : 
			<div style="padding:10px; background:#f0f0f0;">
					<?php echo $notes;?>
			</div>
		</div>
	</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Codeigniter SXIMO</title>
<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="<?php echo base_url();?>sximo/js/plugins/bootstrap/css/bootstrap.css" type="text/css"  />	
<link rel="stylesheet" href="<?php echo base_url();?>sximo/css/sximo.css" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url();?>sximo/css/icon.css" type="text/css"  />

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->	

		
	
  	</head>
<body class="gray-bg">
    <div class="middle-box  ">
        <div>
			<div class="page-content-wrapper m-t">
			<div class="sbox">
				<div class="sbox-title"> <?php if(isset($message))echo $message;?> </div>
				<div class="sbox-content">
				
					<ul class="parsley-error-list">
						<?php if(isset($errors)) echo $errors;?>
					</ul>
					<div style="padding:10px 0; text-align:center">
						<a href="javascript:history.go(-1)" class="btn btn-sm btn-primary"> Back To Previous Page </a>
					</div>	
				</div>	
					
						
				</div>	
			</div>		
        </div>
    </div>



</body> 
</html>

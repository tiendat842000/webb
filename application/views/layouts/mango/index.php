<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php echo isset($page['pageTitle']) ? $page['pageTitle'].' | '.CNF_APPNAME : CNF_APPNAME ;?> </title>
<meta name="keywords" content="<?php echo CNF_METAKEY ?>">
<meta name="description" content=""<?php echo CNF_METADESC ?>"/>
<link rel="shortcut icon" href=""<?php echo base_url().'favicon.ico'?>" type="image/x-icon">	
	<link href="<?php echo base_url().'sximo/themes/mango/css/bootstrap.min.css';?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url().'sximo/themes/mango/css/animate.css';?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url().'sximo/themes/mango/font-awesome/css/font-awesome.min.css';?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url()?>sximo/css/icons.min.css" rel="stylesheet" type="text/css" />	
	<link href="<?php echo base_url()?>sximo/themes/mango/js/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />	
	<link href="<?php echo base_url()?>sximo/themes/mango/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" rel="stylesheet" type="text/css" />	
	<link href="<?php echo base_url()?>sximo/js/plugins/bootstrap.summernote/summernote.css" rel="stylesheet" type="text/css" />	
	<link href="<?php echo base_url()?>sximo/js/plugins/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />	
	<link href="<?php echo base_url()?>sximo/js/plugins/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />	
	<link href="<?php echo base_url()?>sximo/js/plugins/select2/select2.css" rel="stylesheet" type="text/css" />	
	<link href="<?php echo base_url()?>sximo/themes/mango/css/mango.css" rel="stylesheet" type="text/css" />	

	<script type="text/javascript" src="<?php echo base_url()?>sximo/themes/mango/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/themes/mango/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/themes/mango/js/fancybox/source/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/themes/mango/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7s"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/themes/mango/js/fancybox/source/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/js/plugins/prettify.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/js/plugins/parsley.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/js/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/themes/mango/js/jquery.mixitup.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/js/plugins/jquery.jCombo.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/js/plugins/bootstrap.summernote/summernote.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>sximo/themes/mango/js/mango.js"></script>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->		


	
  	</head>

<body >

<header>	
	<div class="container">
		<div class="navbar navbar-default ">			
				<div class="navbar-header">
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php echo base_url() ?>" class="navbar-brand site-logo">
					<img src="<?php echo base_url().'sximo/themes/mango/img/logo.png'?>" class="img-responsive" width="70" height="70" />
					<span class="logo_title"> <?php echo CNF_APPNAME ?></span>
					<span class="logo_subtitle"><?php echo CNF_APPDESC ?></span>
					</a>
				</div>

				<div class="navbar-collapse collapse">
				<?php $this->load->view('layouts/mango/topbar');?>
				</div><!--/nav-collapse -->
			</div><!-- /container -->

		</div>
</header>		
		
		<div style="min-height:400px; padding-bottom:50px;">
			<?php echo $content ?>
		</div>
		
		<div class="clr"></div>
	


<div id="footer">
	<div class=" container">
		<div class="col-md-7"> Copyright 2014 <?php echo CNF_APPNAME ?> . ALL Rights Reserved. <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></div>
		<div class="col-md-5"></div>
	</div>	
</div>

<div class="modal fade" id="sximo-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-default">
		
			<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Modal title</h4>
		</div>
		<div class="modal-body" id="sximo-modal-content">
	
		</div>
	</div>
</div>
</div>

	
<script>
jQuery(document).ready(function() {

	window.prettyPrint && prettyPrint();
});
</script>	
</body> 
</html>
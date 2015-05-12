<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo  CNF_APPNAME ;?></title>
<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="<?php echo base_url();?>sximo/js/plugins/bootstrap/css/bootstrap.css" type="text/css"  />	
<link rel="stylesheet" href="<?php echo base_url();?>sximo/css/sximo.css" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url();?>sximo/css/animate.css" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url();?>sximo/css/icon.css" type="text/css"  />
<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>sximo/js/plugins/select2/select2.css">
<link rel="stylesheet" href="<?php echo base_url();?>sximo/fonts/awesome/css/font-awesome.min.css" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url();?>sximo/js/plugins/iCheck/skins/square/green.css" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url();?>sximo/js/plugins/markitup/skins/simple/style.css" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url();?>sximo/js/plugins/markitup/sets/default/style.css" type="text/css"  />
<link rel="stylesheet" href="<?php echo base_url();?>sximo/js/plugins/fancybox/jquery.fancybox.css" type="text/css"  />
	
<script src="<?php echo base_url();?>sximo/js/plugins/jquery.min.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/jquery.cookie.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/select2/select2.min.js"></script>

<script src="<?php echo base_url();?>sximo/js/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/prettify.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/fancybox/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/prettify.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/parsley.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/datepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/jquery.jCombo.min.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/bootstrap.summernote/summernote.min.js"></script>

<script src="<?php echo base_url();?>sximo/js/plugins/markitup/jquery.markitup.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/markitup/sets/default/set.js"></script>


<script src="<?php echo base_url();?>sximo/js/sximo.js"></script>
		<script language="javascript">
		jQuery(document).ready(function($)	{
		   $('.markItUp').markItUp(mySettings );
		});
		</script>

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->	


</head>

<body>

<body class="sxim-init" >
<div id="wrapper">
	<?php $this->load->view('layouts/sidemenu');?>
	<div class="gray-bg " id="page-wrapper">
		<?php $this->load->view('layouts/headmenu');?>
		<?php echo $content ;?>		
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

<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$('#sidemenu').sximMenu();	
	});		
</script>
</body>
</html>

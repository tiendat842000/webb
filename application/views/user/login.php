<div class="sbox">
	<div class="sbox-title">
			
				<h3 ><?php  echo CNF_APPNAME .'<small> '. CNF_APPDESC .' </small>';?></h3>
				
	</div>
	<div class="sbox-content">
	<div class="text-center">
<!--		<img src="<?php echo base_url().'sximo/themes/mango/img/logo.png';?>" width="90" height="90" />-->
	</div>	
	<?php echo $this->session->flashdata('message');?>
	<?php echo form_open('user/postlogin'); ?>
	
	<div class="form-group has-feedback">
		<label> Email Address	</label>
		<input type="text" name="email" value="" class="form-control" placeholder="Email Address">
		<i class="fa fa-envelope form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label> Password	</label>
		<input type="password" name="password" value="" class="form-control"  placeholder="Password">
		<i class="icon-lock form-control-feedback"></i>
	</div>	
	<?php if( CNF_RECAPTCHA ) { ?>
	<div class="form-group has-feedback">
		
		<?php echo $recaptcha_html ?>
		<i class="icon-lock form-control-feedback"></i>
	</div>
	<?php } ?>
	
	<div class="form-group  has-feedback text-center" style=" margin-bottom:20px;" >
		 	 
			<button type="submit" class="btn btn-primary btn-sm btn-block" > Sign In</button>
		       

		
	 	<div class="clr"></div>
		
	</div>	
	<p class="text-center"><a  id="or"  href="javascript://ajax"><small>Forgot password?</small></a></p>
	<p class="text-muted text-center">Do not have an account?</p>				
		<a class="btn btn-default btn-white btn-white btn-block"  href="<?php echo site_url('user/register');?>"> Create an account </a>
		
		<div style="padding:15px 0;" class="text-center" >
			<?php if(CNF_LOGINFB =='true'): ?>
			<a href="<?php echo  site_url('user/hlogin/Facebook') ; ?>" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook </a>
			<?php endif; ?>
			<?php if (CNF_LOGINGG =='true')  : ?>
			<a href="<?php echo  site_url('user/hlogin/Google') ; ?>" class="btn btn-danger"><i class="fa fa-google-plus"></i> Google </a>
			<?php endif; ?>
			<?php if (CNF_LOGINTW =='true')  : ?>
			<a href="<?php echo  site_url('user/hlogin/Twitter') ; ?>" class="btn btn-info"><i class="fa fa-twitter"></i> Twitter </a>
			<?php endif; ?>
		</div>
		
	  <p style="padding:10px 0" class="text-center">
	  <a href="<?php echo site_url();?>"> Back to Site </a>  
   		</p>			
	</div>		  
	  
	
 <?php echo form_close();?>  
 	<div style="padding:20px;">
 	<form class="form-vertical box" action="<?php echo site_url('user/saveRequest'); ?>" id="fr" method="post" style="margin-top:20px; display:none;">

 	
       <div class="form-group has-feedback">
	   <div class="">
			<label> Email Address </label>
		   <input type="text" name="credit_email" value="" class="form-control">
			<i class="icon-envelope form-control-feedback"></i>
		</div> 	
		</div>
		<div class="form-group has-feedback">        
          <button type="submit" class="btn btn-danger ">Reset My Password  </button>        
      </div>
	  
	  <div class="clr"></div>
  
	</form>
	</div>

  <div class="clr"></div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#or').click(function(){
		$('#fr').toggle();
	});
});
</script>
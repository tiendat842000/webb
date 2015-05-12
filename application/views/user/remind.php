
<!-- Login wrapper -->
<div class="login-wrapper">
<div class="sbox">
	<div class="sbox-title">
	<h3 ><?php  echo CNF_APPNAME .'<small> '. CNF_APPDESC .' </small>';?></h3>
	</div>
	<div class="sbox-content">
		<div class="text-center">
			<img src="<?php echo base_url().'sximo/themes/mango/img/logo.png';?>" width="90" height="90" />
		</div>	
		<form action="<?php echo site_url('user/saveReset/'.$verCode);?>" class="form-vertical" method="post"> 
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
			
		
		<div class="form-group has-feedback">
			<label>New Password </label>
			<input type="password" name="password" class="form-control" placeholder="New Password" />
			<i class="icon-lock form-control-feedback"></i>
		</div>
		
		  <div class="form-group has-feedback">
			<label>Re-type Password</label>
			<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" />
			<i class="icon-lock form-control-feedback"></i>
		</div>
		
		  <div class="form-group has-feedback">
				<div class="col-xs-6">
				  <button type="submit" class="btn btn-primary pull-right">Reset My Password</button>
				</div>
		  </div>
		  <div class="clr" style="clear:both"></div>
	  		
	
	 </form>		
		
	</div>
</div>
		
</div>
<!-- /login wrapper -->
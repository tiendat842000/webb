<div class="sbox">
	<div class="sbox-title">
			
				<h3 ><?php echo CNF_APPNAME ;?></h3>
				
	</div>
	<div class="sbox-content">
	<div class="text-center">
		<img src="<?php echo base_url().'sximo/themes/mango/img/logo.png';?>" width="90" height="90" />
	</div>	
	<?php echo $this->session->flashdata('message');?>	
		<ul class="parsley-error-list">
			<?php echo $this->session->flashdata('errors');?>
		</ul>
	<form class="form-signup" action="<?php echo site_url('user/create');?>" method="post">
	
	<div class="form-group has-feedback">
		<label> First Name	<span class="asterix">*</span> </label>
		<?php echo form_input(array('name'=>'firstname','placeholder'=>'First Name','required'=>'true','class'=>'form-control'));?>
		<i class="icon-users form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label> Last Name	 <span class="asterix">*</span></label><br />
		<?php echo form_input(array('name'=>'lastname','placeholder'=>'Last Name','required'=>'true','class'=>'form-control'));?>
		<i class="icon-users form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label> Email Address	 <span class="asterix">*</span></label>
		<?php echo form_input(array('name'=>'email','placeholder'=>'Email Address','required'=>'true','class'=>'form-control'));?>
		<i class="icon-envelop form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label> Password <span class="asterix">*</span></label>
		<?php echo form_password(array('name'=>'password','placeholder'=>'Password','required'=>'true','class'=>'form-control'));?>
		<i class="icon-lock form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>Confirm Password <span class="asterix">*</span></label>
		<?php echo form_password(array('name'=>'password_confirmation','placeholder'=>'Confirm Password','required'=>'true','class'=>'form-control'));?>
		<i class="icon-lock form-control-feedback"></i>
	</div>
			

      <div class="row form-actions">
        <div class="col-sm-12">
          <button type="submit" style="width:100%;" class="btn btn-primary pull-right"><i class="icon-user-plus"></i> Sign Up</button>
       </div>
      </div>
	  <p style="padding:10px 0" class="text-center">
	  <a href="<?php echo site_url('user/login');?>"> Back to Login </a> | <a href="<?php echo site_url();?>"> Back to Site </a> 
   		</p>
 </form>
 </div>
</div> 

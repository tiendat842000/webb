<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"><?php echo $this->lang->line('core.m_dashboard'); ?> </a></li>
		<li><a href="<?php echo site_url('users') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('users/save/'.$row['id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" >

						<fieldset><legend><?php echo $this->lang->line('core.fr_userssystem'); ?> </legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Group / Level" class=" control-label col-md-4 text-left"><?php echo $this->lang->line('core.fr_grouplevel'); ?> <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='group_id' rows='5' id='group_id' class='form-control '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Username" class=" control-label col-md-4 text-left"><?php echo $this->lang->line('core.username'); ?> <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['username'];?>' name='username'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="First Name" class=" control-label col-md-4 text-left"><?php echo $this->lang->line('core.firstname'); ?> <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['first_name'];?>' name='first_name'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Last Name" class=" control-label col-md-4 text-left"><?php echo $this->lang->line('core.lastname'); ?> </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['last_name'];?>' name='last_name'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Email" class=" control-label col-md-4 text-left"><?php echo $this->lang->line('core.email'); ?> <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['email'];?>' name='email'  required parsley-type='email'  /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"><?php echo $this->lang->line('core.status'); ?> <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='active' value ='0' requred @if($row['active'] == '0') checked="checked" @endif ><?php echo $this->lang->line('core.fr_minactive'); ?> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='active' value ='1' requred @if($row['active'] == '1') checked="checked" @endif ><?php echo $this->lang->line('core.fr_mactive'); ?> </label> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Avatar" class=" control-label col-md-4 text-left"><?php echo $this->lang->line('core.avatar'); ?> </label>
									<div class="col-md-8">
									  <input  type='file' name='avatar' id='avatar' 
									  <?php if($row['avatar'] =='') echo "class='required'"; ;?> style='width:150px !important;'  />
					<?php echo SiteHelpers::showUploadedFile($row['avatar'],'/uploads/users/') ;?>
				 <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			
			
			<fieldset>
				<legend><?php echo $this->lang->line('core.password'); ?> </legend>
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.password'); ?> </label>
					<div class="col-md-8">
					<input name="password" type="password" id="password" class="form-control input-sm" value="" style="width:50% !important;"
					<?php if($row['id'] =='')echo 'required'; ?>/>   
					 </div> 
				  </div>  
				  
				  <div class="form-group">
					<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.repassword'); ?> </label>
					<div class="col-md-8">
					<input name="password_confirmation" type="password" id="password_confirmation" class="form-control input-sm" style="width:50% !important;"
					<?php if($row['id'] =='')echo 'required'; ?>/>  
					 </div> 
				  </div>				
			
			</fieldset>			
		
			<div style="clear:both"></div>	
				
			  <div class="form-group">
				<label class="col-sm-4 text-right"> </label>
				<div class="col-sm-8">	
				<input type="submit" name="apply" class="btn btn-info" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
				<input type="submit" name="submit" class="btn btn-primary" value="<?php echo $this->lang->line('core.btn_savereturn'); ?>" />
				</div>	  
		
			  </div> 
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#group_id").jCombo("<?php echo site_url('users/comboselect?filter=tb_groups:group_id:name') ?>",
		{  selected_value : '<?php echo $row["group_id"] ?>' });
		 	 
});
</script>		 
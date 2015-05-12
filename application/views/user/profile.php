
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3><?php echo $this->lang->line('core.m_myaccount'); ?> <small>View Detail My Info</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard') ;?>"><?php echo $this->lang->line('core.m_dashboard'); ?> </a></li>
		<li class="active"><?php echo $this->lang->line('core.m_myaccount'); ?> </li>
      </ul>
	</div>  
		
	<div class="page-content-wrapper m-t">
	<ul class="nav nav-tabs" >
	  <li class="active"><a href="#info" data-toggle="tab"><?php echo $this->lang->line('core.personalinfo'); ?> </a></li>
	  <li ><a href="#pass" data-toggle="tab"><?php echo $this->lang->line('core.password'); ?> </a></li>
	</ul>	
	
	<div class="tab-content">
	  <div class="tab-pane active m-t" id="info">
	  	<?php echo $this->session->flashdata('message');?>
		<?php echo validation_errors(); ?>
	  	<form class="form-horizontal" action="<?php echo site_url('user/saveProfile') ;?>" method="post"  parsley-validate='true' novalidate='true' enctype="multipart/form-data"> 
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Username </label>
			<div class="col-md-8">
			<input name="username" type="text" id="username" disabled="disabled" class="form-control input-sm" required  value="<?php echo $info->username ;?>" />  
			 </div> 
		  </div>  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Email  </label>
			<div class="col-md-8">
			<input name="email" type="text" id="email"  class="form-control" value="<?php echo $info->email ?>" /> 
			<?php echo form_error('email'); ?>
			 </div> 
		  </div> 	  
	  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.firstname'); ?> </label>
			<div class="col-md-8">
			<input name="first_name" type="text" id="first_name" class="form-control " required value="<?php echo $info->first_name ?>" /> 
			 </div> 
		  </div>  
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.lastname'); ?> </label>
			<div class="col-md-8">
			<input name="last_name" type="text" id="last_name" class="form-control " required value="<?php echo $info->last_name ?>" />  
			 </div> 
		  </div>    
	
		  <div class="form-group  " >
			<label for="ipt" class=" control-label col-md-4 text-right"> Avatar </label>
			<div class="col-md-8">
			<input type="file" name="avatar">
			<br />
			 Image Dimension 80 x 80 px <br />
			<?php echo SiteHelpers::showUploadedFile($info->avatar,'/uploads/users/') ?>
			
			 </div> 
		  </div>  
	
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> </label>
			<div class="col-md-8">
				<button class="btn btn-success" type="submit"><?php echo $this->lang->line('core.sb_savechanges'); ?> </button>
			 </div> 
		  </div> 	
		
		</form>
	  </div>
  
	  <div class="tab-pane  m-t" id="pass">
	  <form class="form-horizontal" action="<?php echo site_url('user/savePassword') ;?>" method="post"  parsley-validate='true' novalidate='true'>  
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.newpassword'); ?> </label>
			<div class="col-md-8">
			<input name="password" type="password" id="password" class="form-control input-sm" value="" /> 
			 </div> 
		  </div>  
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.repassword'); ?> </label>
			<div class="col-md-8">
			<input name="password_confirmation" type="password" id="password_confirmation" class="form-control input-sm" value="" />  
			 </div> 
		  </div>    
		 
		
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> </label>
			<div class="col-md-8">
				<button class="btn btn-danger" type="submit"><?php echo $this->lang->line('core.sb_savechanges'); ?> </button>
			 </div> 
		  </div>   
		</form>
	  </div>
  


</div>
</div>
 
 </div>
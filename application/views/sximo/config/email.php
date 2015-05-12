
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3><?php echo $this->lang->line('core.m_blastemail'); ?> <small> Send Bulk Email </small></h3>
      </div>
   
      <ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard');?>"><?php echo $this->lang->line('core.m_dashboard'); ?> </a></li>
		<li><a href="<?php echo site_url('sximo/config');?>"><?php echo $this->lang->line('core.fr_config'); ?> </a></li>
		<li><a href="<?php echo site_url('sximo/config/email');?>"><?php echo $this->lang->line('core.t_emailtemplate'); ?> </a></li>	  		
      </ul>
	  
	  
    </div>

 <div class="page-content-wrapper m-t">  


		<?php echo $this->session->flashdata('message');?>	
<div class="block-content">
	<ul class="nav nav-tabs" style="margin-bottom:10px;">
		<li><a href="<?php echo site_url('sximo/config');?>"><?php echo $this->lang->line('core.tab_siteinfo'); ?> </a></li>
		<li  class="active"><a href="<?php echo site_url('sximo/config/email');?>" ><?php echo $this->lang->line('core.t_emailtemplate'); ?> </a></li>
		<li><a href="<?php echo site_url('sximo/config/security');?>"><?php echo $this->lang->line('core.tab_security'); ?> </a></li>
	</ul>	


<div class="tab-content">
	  <div class="tab-pane active use-padding" id="info">	


<div class="sbox m-t">
	<div class="sbox-title"><h5>   </h5></div>
	<div class="sbox-content">	


	 <form class="form-vertical row" action="<?php echo site_url('sximo/config/postEmail');?>" method="post">
	
	<div class="col-sm-6">
	
		<fieldset > <legend><?php echo $this->lang->line('core.fr_newaccountinfo'); ?>  </legend>
		  <div class="form-group">
			<label for="ipt" class=" control-label"><?php echo $this->lang->line('core.t_emailtemplate'); ?> </label>		
			<textarea rows="20" name="regEmail" class="form-control input-sm  markItUp"><?php echo $regEmail ;?></textarea>		
		  </div>  
		

		<div class="form-group">   
			<button class="btn btn-primary" type="submit"><?php echo $this->lang->line('core.sb_savechanges'); ?> </button>	 
		</div>
	
  	</fieldset>


	</div> 


	<div class="col-sm-6">
	
	 <fieldset> <legend><?php echo $this->lang->line('core.forgotpassword'); ?> </legend>
  
		
		  <div class="form-group">
			<label for="ipt" class=" control-label "><?php echo $this->lang->line('core.t_emailtemplate'); ?> </label>
			
			<textarea rows="20" name="resetEmail" class="form-control input-sm markItUp"><?php echo $resetEmail ;?></textarea>
			 
		  </div> 
	  <div class="form-group">
		<label for="ipt" class=" control-label col-md-4"> </label>
		<div class="col-md-8">
			<button class="btn btn-primary" type="submit"><?php echo $this->lang->line('core.sb_savechanges'); ?> </button>
		 </div> 
	 
	  </div>	  
	 </fieldset>    
 	
 </div>
 </form>
 </div></div>
</div>
</div>
</div>
</div>






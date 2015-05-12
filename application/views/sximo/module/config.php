
  <div class="page-content row ">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
				<h3><?php echo $this->lang->line('core.mod_configtitle'); ?> : <?php echo ucwords($row->module_name)  ;?> <small><?php echo $this->lang->line('core.mod_configtitlesub'); ?>  </small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard');?>"><?php echo $this->lang->line('core.home'); ?> </a></li>
		<li><a href="<?php echo site_url('sximo/module') ;?>"><?php echo $this->lang->line('core.t_module'); ?> </a></li>
        <li class="active"><?php echo $this->lang->line('core.mod_configinfo'); ?> </li>
      </ul>	  
	  
    </div>

 <div class="page-content-wrapper m-t"> 
	
	<?php $this->load->view('sximo/module/tab',array('active'=>'config')); ?>
	<?php echo $this->session->flashdata('message');?>
<div class="sbox">
	<div class="sbox-title"><h5><?php echo $this->lang->line('core.mod_configinfo'); ?> <small><?php echo $this->lang->line('core.mod_configinfosub'); ?> </small> </h5></div>
	<div class="sbox-content">	
	<div class="col-md-8">
	<form class="form-horizontal" action="<?php echo site_url('sximo/module/saveconfig/'.$module_name);?>" method="post">
	<input  type='text' name='module_id' id='module_id'  value='<?php echo $row->module_id ;?>'  style="display:none; " />
  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.mod_imoduletitle'); ?> </label>
	<div class="col-md-8">	
	<input  type='text' name='module_title' id='module_title' class="form-control " required value='<?php echo $row->module_title ;?>'  /> 
	 </div> 
  </div>  

  <div class="form-group">
    <label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.mod_imodulenote'); ?> </label>
	<div class="col-md-8">
		<input  type='text' name='module_note' id='module_note'  value='<?php echo $row->module_note ?>' class="form-control "  />
	 </div> 
  </div>    	

	  <div class="form-group">
		<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.mod_imodulename'); ?> </label>
		<div class="col-md-8">
		<input  type='text' name='module_name' id='module_name' readonly="1"  class="form-control " required value='<?php echo $row->module_name ?>'  />
		 </div> 
	  </div>  
  
	   <div class="form-group">
		<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.mod_imoduledb'); ?> </label>
		<div class="col-md-8">
		<input  type='text' name='module_db' id='module_db' readonly="1"  class="form-control " required value='<?php echo $row->module_db?>'  />
		  
		 </div> 
	  </div>  
  
	  <div class="form-group" style="display:none;" >
		<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.mod_imoduleauthor'); ?> </label>
		<div class="col-md-8">
		<input  type='text' name='module_author' id='module_author' class="form-control " required readonly="1"  value='<?php echo $row->module_author ?>'  />
		 </div> 
	  </div>  
	 
		<div class="form-group">
			<label for="ipt" class=" control-label col-md-4"></label>
			<div class="col-md-8">
			<button type="submit" name="submit" class="btn btn-primary"><?php echo $this->lang->line('core.btn_updatemodule'); ?> </button>
			 </div> 
		</div>   
	
  	</form>
	
  
	</div>
	<div class="clr clear"></div>
	</div>
	</div>
</div>			
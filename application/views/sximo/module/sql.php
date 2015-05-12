
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
				<h3><?php echo $this->lang->line('core.mod_mysqltitle'); ?> : <?php echo ucwords( $row->module_name );?> <small> <?php echo $this->lang->line('core.mod_mysqltitlesub'); ?> </small></h3>
      </div>
	  

      <ul class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard');?>"><?php echo $this->lang->line('core.m_dashboard'); ?> </a></li>
		<li><a href="<?php echo site_url('sximo/module') ;?>"><?php echo $this->lang->line('core.t_module'); ?> </a></li>
        <li class="active"><?php echo $this->lang->line('core.mod_mysqltitle'); ?>  </li>
      </ul>	
	  	  
    </div>

	 <div class="page-content-wrapper m-t"> 
	<?php $this->load->view('sximo/module/tab',array('active'=>'sql')); ?>
	<?php echo $this->session->flashdata('message');?>
<div class="sbox">
 <div class="sbox-title"><h5><?php echo $this->lang->line('core.mod_mysqlinfo'); ?>  <small><?php echo $this->lang->line('core.mod_mysqlinfosub'); ?> </small> </h5> </div>
 <div class="sbox-content">
 	<form class="form-vertical" action="<?php echo site_url('sximo/module/savesql/'.$module_name);?>" method="post">

	 <div class="infobox infobox-info fade in">
	  <button type="button" class="close" data-dismiss="alert"> x </button>  
		<p><?php echo $this->lang->line('core.mod_sqltips_a'); ?> </p>	
	</div>	


	<div class="form-group">
	<label for="ipt" class=" control-label"><?php echo $this->lang->line('core.mod_sqlselect'); ?></label>
	  <textarea name="sql_select" rows="5" id="sql_select" class="tab_behave form-control"  placeholder="<?php echo $this->lang->line('core.mod_sqlselect'); ?>" ><?php echo $sql_select ;?></textarea>
	</div> 	

<div class="form-group">
<label for="ipt" class=" control-label"><?php echo $this->lang->line('core.mod_sqlwhere'); ?></label>
  <textarea name="sql_where" rows="2" id="sql_where" class="form-control" placeholder="<?php echo $this->lang->line('core.mod_sqlwhere'); ?>" ><?php echo $sql_where ;?></textarea>
</div> 

<div class="infobox infobox-danger fade in">
  <button type="button" class="close" data-dismiss="alert"> x </button>  
  <p><?php echo $this->lang->line('core.mod_sqltips_b'); ?></p>	
</div>	
		
	

<div class="form-group">
<label for="ipt" class=" control-label"><?php echo $this->lang->line('core.mod_sqlgroup'); ?></label>
 <textarea name="sql_group" rows="2" id="sql_group" class="form-control"   placeholder="SQL Grouping Statement" ><?php echo $sql_group ;?></textarea>

</div> 
<div class="form-group">
<label for="ipt" class=" control-label"></label>
<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('core.btn_savesql'); ?> </button>
</div> 	

 <input type="hidden" name="module_id" value="<?php echo $row->module_id ;?>" />
 <input type="hidden" name="module_name" value="<?php echo $row->module_name ;?>" />
 
 </form>
 </div>
</div>	
	
</div>	</div>
<div class="clr"></div>

<div class="page-content row">
    <!-- Page header -->
    <div class="page-header ">
      <div class="page-title">
        <h3> Module <small>  List Of All Modules </small></h3>
      </div>
    </div>
	<div class="page-content-wrapper">
	<div class="ribon-sximo">
<section >

		<div class="row m-l-none m-r-none m-t  white-bg shortcut " >
			<div class="col-sm-6 col-md-3 b-r  p-sm ">
				<span class="pull-left m-r-sm text-info"><i class="fa fa-plus-circle"></i></span> 
				<a href="<?php echo site_url('sximo/module/create');?>" class="clear">
					<span class="h3 block m-t-xs"><strong><?php echo $this->lang->line('core.fr_createmodule'); ?> </strong>
					</span> <small class="text-muted text-uc"><?php echo $this->lang->line('core.fr_newmodule'); ?> </small>
				</a>
			</div>

		</div> </section>		

		
	</div>
	
	<ul class="nav nav-tabs" style="margin-bottom:10px;">
	  <li <?php if($type =='addon') echo 'class="active"'?>><a href="<?php echo site_url('sximo/module');?>"><?php echo $this->lang->line('core.fr_mymodule'); ?>  </a></li>
	  <li <?php if($type =='core') echo 'class="active"';?>><a href="<?php echo site_url('sximo/module?t=core');?>"><?php echo $this->lang->line('core.tab_core'); ?> </a></li>
	</ul>
		
	<?php echo $this->session->flashdata('message');?>	
	
	
	<div class="table-responsive ibox-content" style="min-height:400px;">
	<?php if(count($rowData) >=1) :?> 
		<table class="table table-striped ">
			<thead>
			<tr>
				<th><?php echo $this->lang->line('core.btn_action'); ?> </th>					
				<th><input type="checkbox" class="checkall" /></th>
				<th><?php echo $this->lang->line('core.t_module'); ?> </th>
				<th>Controller</th>
				<th>Database</th>
				<th>PRI</th>
				<th>Created</th>
		
			</tr>
			</thead>
        <tbody>
		<?php foreach ($rowData as $row) : ?>
			<tr>		
				<td>
				<div class="btn-group">
				<button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-cog"></i> <span class="caret"></span>
				</button>
					<ul style="display: none;" class="dropdown-menu icons-right">
						<?php if($type !='core') : ?>
						<li><a href="<?php echo site_url($row->module_name);?>"><i class="fa fa-cog"></i><?php echo $this->lang->line('core.fr_viewmodule'); ?> </a></li>
						<?php endif;?>
						<li><a href="<?php echo site_url('sximo/module/config/'.$row->module_name);?>"><i class="fa fa-edit"></i><?php echo $this->lang->line('core.fr_editmodule'); ?> </a></li>
						<?php if($type !='core') : ?>
						<li><a href="javascript://ajax" onclick="SximoConfirmDelete('<?php echo site_url('sximo/module/destroy/'.$row->module_id);?>')"><i class="fa fa-trash-o"></i><?php echo $this->lang->line('core.fr_removemodule'); ?> </a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url('sximo/module/rebuild/'.$row->module_id);?>"><i class="fa fa-reload"></i><?php echo $this->lang->line('core.fr_rebuildmodule'); ?> </a></li>
						<?php endif;?>
					</ul>
				</div>					
				</td>
				<td>
				 <?php if($type !='core'):?>
				<input type="checkbox" class="ids" name="id[]" value="<?php echo $row->module_id ;?>" /> <?php endif;?></td>
				<td><?php echo $row->module_title ;?> </td>
				<td><?php echo $row->module_name ;?> </td>
				<td><?php echo $row->module_db ;?> </td>
				<td><?php echo $row->module_db_key ;?> </td>
				<td><?php echo $row->module_created ;?> </td>
			</tr>
		<?php endforeach;?>	
	</tbody>		
	</table>
	
	<?php else:?>
		
		<p class="text-center" style="padding:50px 0;"><?php echo $this->lang->line('core.norecord'); ?> ! 
		<br /><br />
		<a href="<?php echo site_url('sximo/module/create');?>" class="btn btn-default "><i class="icon-plus-circle2"></i><?php echo $this->lang->line('core.fr_newmodule'); ?> </a>
		 </p>	
	<?php endif;?>
	</div>	
	
	</div>	

</div>	  
	  
  <script language='javascript' >
  jQuery(document).ready(function($){
    $('.post_url').click(function(e){
      e.preventDefault();
      if( ( $('.ids',$('#SximoTable')).is(':checked') )==false ){
        alert( $(this).attr('data-title') + " not selected");
        return false;
      }
      $('#SximoTable').attr({'action' : $(this).attr('href') }).submit();
    })
  })
  </script>	  


  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
          <h3><?php echo $this->lang->line('core.t_module'); ?> <small> List Of All Modules</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard');?>"><?php echo $this->lang->line('core.m_dashboard'); ?> </a></li>
		<li><a href="<?php echo site_url('sximo/module') ;?>"><?php echo $this->lang->line('core.t_module'); ?> </a></li>
        <li class="active"><?php echo $this->lang->line('core.create'); ?> </li>
      </ul>
	</div>  



	 <div class="page-content-wrapper m-t">  
	<?php echo $this->session->flashdata('message');?>	
	<form class="form-horizontal" action="<?php echo site_url('sximo/module/saveCreate/');?>" method="post" parsley-validate novalidate>


	<div class="form-group has-feedback">
		<label class="col-sm-3 text-right"><?php echo $this->lang->line('core.fr_modtitle'); ?> </label>
		<div class="col-sm-9">	
			<input name="module_title" class="form-control" placeholder="Title Name" required />
		</div>
	</div>		
	
	<div class="form-group ">
		<label class="col-sm-3 text-right"><?php echo $this->lang->line('core.fr_modnote'); ?> </label>
		<div class="col-sm-9">	
		<input name="module_note" class="form-control" placeholder="Short description module" required />
		
		</div>
	</div>


	<div class="form-group ">
		<label class="col-sm-3 text-right">Class Controller </label>
		<div class="col-sm-9">	
		<input name="module_name" class="form-control" placeholder="Class Controller / Module Name" required />
	  	
		</div>
	</div>	
		
	
	<div class="form-group">
		<label class="col-sm-3 text-right"><?php echo $this->lang->line('core.fr_modtable'); ?> </label>
		<div class="col-sm-9">	
			<select name="module_db" class="form-control">
				<?php foreach($tables as $table){?>
					<option value="<?php echo $table;?>"><?php echo $table;?></option>
				<?php } ?>
			</select>	 	
		</div>
	</div>	
		
	<div class="form-group " style="display:none;">
		<label class="col-sm-3 text-right">Author </label>
		<div class="col-sm-9">	
	  
		
		</div>
	</div>	
		


	<div class="form-group switchSql">
		<label class="col-sm-3 text-right">  </label>
		<div class="col-sm-9">	
			<label class="radio radio-inline">
				<input type="radio" name="creation" value="auto"  checked="checked"  /> 
				Auto Mysql Statment 
			</label>		
			<label class="radio radio-inline">
				<input type="radio" name="creation" value="manual"  />
				Manual Mysql Statment 
			</label>		
		</div>
	</div>	
	
	<div class="form-group manualsql">
		<label class="col-sm-3 text-right">  </label>
		<div class="col-sm-9">
			<textarea class="form-control" name="sql_select" placeholder="SQL Select & Join Statement" rows="3" id="sql_select"></textarea>	  
		</div> 
	</div>	
	
	<div class="form-group manualsql">
		<label class="col-sm-3 text-right">  </label>
		<div class="col-sm-9">
			<textarea class="form-control" name="sql_where" placeholder="SQL Where Statement" rows="2" id="sql_where"></textarea>	 
		</div> 
	</div>		

	<div class="form-group manualsql">
		<label class="col-sm-3 text-right">  </label>
		<div class="col-sm-9">
			<textarea class="form-control" name="sql_group" placeholder="SQL Grouping Statement" rows="2" id="sql_group"></textarea>	
			
		</div> 
	</div>	
	
		
      <div class="form-group">
		<label class="col-sm-3 text-right"> </label>
		<div class="col-sm-9">	
	  	<button type="submit" class="btn btn-primary ">  Create New Module </button>
		</div>	  

      </div>
    
 </form>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('.manualsql').hide();
		$('.switchSql input:radio').on('ifClicked', function() {
		  val = $(this).val(); 
			if(val == 'manual')
			{
				$('.manualsql').show();
				$('#sql_select').attr("required","true");
				$('#sql_where').attr("required","true");
				
			} else {
				$('.manualsql').hide();
				$('#sql_select').removeAttr("required");
				$('#sql_where').removeAttr("required");
	
			}		  
		  
		});

	});
	
</script>

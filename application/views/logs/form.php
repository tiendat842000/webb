<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('logs') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('logs/save/'.$row['auditID']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
						<fieldset><legend> Logs</legend>
									
								  <div class="form-group  " >
									<label for="AuditID" class=" control-label col-md-4 text-left"> AuditID </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['auditID'];?>' name='auditID'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ipaddress" class=" control-label col-md-4 text-left"> Ipaddress </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['ipaddress'];?>' name='ipaddress'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="User Id" class=" control-label col-md-4 text-left"> User Id </label>
									<div class="col-md-8">
									  <select name='user_id' rows='5' id='user_id' code='{$user_id}' 
							class='select2 '    ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Module" class=" control-label col-md-4 text-left"> Module </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['module'];?>' name='module'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Task" class=" control-label col-md-4 text-left"> Task </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['task'];?>' name='task'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Note" class=" control-label col-md-4 text-left"> Note </label>
									<div class="col-md-8">
									  <textarea name='note' rows='2' id='note' class='form-control '  
				           ><?php echo $row['note'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Logdate" class=" control-label col-md-4 text-left"> Logdate </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control datetime' placeholder='' value='<?php echo $row['logdate'];?>' name='logdate'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="apply" class="btn btn-info btn-sm" value="Apply" />
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="Save & Return " />
			<a href="<?php echo site_url('logs');?>" class="btn btn-sm btn-warning">Back To List </a>
 		</div>
			  		
		</form>

	</div>	
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#user_id").jCombo("<?php echo site_url('logs/comboselect?filter=tb_users:id:first_name') ?>",
		{  selected_value : '<?php echo $row["user_id"] ?>' });
		 	 
});
</script>		 
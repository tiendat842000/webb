<div class="page-content row">
    <!-- Page header -->
<div class="page-header">
	<div class="page-title">
	<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
	</div>
	<ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('opm') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ul>  	  
</div>
 
 	<div class="page-content-wrapper m-t">
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> <?php echo $pageTitle ;?> <small><?php echo $pageNote ;?></small></h4></div>
	<div class="sbox-content"> 	


		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('opm/save/'.$row['id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
						<fieldset><legend> Quản lý Room meeting</legend>
									
								  <div class="form-group  " >
									<label for="MeetingID" class=" control-label col-md-4 text-left"> MeetingID </label>
									<div class="col-md-8">
									  <textarea name='meetingID' rows='2' id='meetingID' class='form-control '  
				           ><?php echo $row['meetingID'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="MeetingName" class=" control-label col-md-4 text-left"> MeetingName </label>
									<div class="col-md-8">
									  <textarea name='meetingName' rows='2' id='meetingName' class='form-control '  
				           ><?php echo $row['meetingName'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="MeetingVersion" class=" control-label col-md-4 text-left"> MeetingVersion </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['meetingVersion'];?>' name='meetingVersion'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="AttendeePW" class=" control-label col-md-4 text-left"> AttendeePW </label>
									<div class="col-md-8">
									  <textarea name='attendeePW' rows='2' id='attendeePW' class='form-control '  
				           ><?php echo $row['attendeePW'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="ModeratorPW" class=" control-label col-md-4 text-left"> ModeratorPW </label>
									<div class="col-md-8">
									  <textarea name='moderatorPW' rows='2' id='moderatorPW' class='form-control '  
				           ><?php echo $row['moderatorPW'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="WaitForModerator" class=" control-label col-md-4 text-left"> WaitForModerator </label>
									<div class="col-md-8">
									  <?php $waitForModerator = explode(",",$row['waitForModerator']); ?>
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='waitForModerator[]' value =''   class='' 
					<?php if(in_array('',$waitForModerator)) echo 'checked';?> 
					 /> none </label>  <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Recorded" class=" control-label col-md-4 text-left"> Recorded </label>
									<div class="col-md-8">
									  <?php $recorded = explode(",",$row['recorded']); ?>
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='recorded[]' value =''   class='' 
					<?php if(in_array('',$recorded)) echo 'checked';?> 
					 />  </label>  <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="User Member Manager" class=" control-label col-md-4 text-left"> User Member Manager </label>
									<div class="col-md-8">
									  <textarea name='user_member_manager' rows='2' id='user_member_manager' class='form-control '  
				           ><?php echo $row['user_member_manager'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Max Number" class=" control-label col-md-4 text-left"> Max Number </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['max_number'];?>' name='max_number'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Start Date" class=" control-label col-md-4 text-left"> Start Date </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control datetime' placeholder='' value='<?php echo $row['start_date'];?>' name='start_date'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="End Date" class=" control-label col-md-4 text-left"> End Date </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control datetime' placeholder='' value='<?php echo $row['end_date'];?>' name='end_date'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Salt" class=" control-label col-md-4 text-left"> Salt </label>
									<div class="col-md-8">
									  <textarea name='salt' rows='2' id='salt' class='form-control '  
				           ><?php echo $row['salt'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Urt" class=" control-label col-md-4 text-left"> Urt </label>
									<div class="col-md-8">
									  <textarea name='urt' rows='2' id='urt' class='form-control '  
				           ><?php echo $row['urt'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="ServerId" class=" control-label col-md-4 text-left"> ServerId </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['serverId'];?>' name='serverId'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="ServerIP" class=" control-label col-md-4 text-left"> ServerIP </label>
									<div class="col-md-8">
									  <textarea name='serverIP' rows='2' id='serverIP' class='form-control '  
				           ><?php echo $row['serverIP'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="ServerName" class=" control-label col-md-4 text-left"> ServerName </label>
									<div class="col-md-8">
									  <textarea name='serverName' rows='2' id='serverName' class='form-control '  
				           ><?php echo $row['serverName'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="apply" class="btn btn-info btn-sm" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('opm');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 
 	 
});
</script>		 
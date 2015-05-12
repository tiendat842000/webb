
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
      </div>

	
		  <ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>"> Dashboard</a></li>
			<li><a href="<?php echo site_url('sximo/pages') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Add </li>
		  </ul>
		 
	  
    </div>

<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>
		 <form class="form-vertical row " action="<?php echo site_url('sximo/pages/save/'.$row['pageID']);?>" method="post" novalidate parsley-validate>

			<div class="col-sm-8 ">
				<div class="sbox">
					<div class="sbox-title">Page Content </div>	
					<div class="sbox-content">				
						
					  <div class="form-group  " >
						
						<div class="" style="background:#fff;">
						  <textarea name='content' rows='35' id='content'    class='form-control markItUp'  
							  ><?php echo htmlentities($content) ?></textarea>
						 </div> 
					  </div> 	
					 </div>
				</div>	
		 	</div>		 
		 
		 <div class="col-sm-4 ">
			<div class="sbox">
				<div class="sbox-title">Page Info </div>	
				<div class="sbox-content">						
				  <div class="form-group hidethis " style="display:none;">
					<label for="ipt" class=""> PageID </label>
					
					  <?php echo form_input(array('name'=>'pageID','value'=>$row['pageID'],'class'=>'form-control'));?>
					
				  </div> 					
				  <div class="form-group  " >
					<label for="ipt" > Title </label>
					 <?php echo form_input(array('name'=>'title','value'=>$row['title'],'class'=>'form-control'));?>
					 
				  </div> 					
				  <div class="form-group  " >
					<label for="ipt" > Alias </label>
						 <?php echo form_input(array('name'=>'alias','value'=>$row['alias'],'class'=>'form-control'));?>
					 
				  </div> 					
				  <div class="form-group  " >
					<label for="ipt" > Filename </label>
					
					  <input name="filename" type="text" class="form-control" value="<?php echo $row['filename']?>" 
					  <?php if($row['pageID'] !='') echo 'readonly="1"';?> required
					  />
					
				  </div> 
				  <div class="form-group  " >
				  <label for="ipt"> Who can view this page ? </label>
					<?php foreach($groups as $group):?> 
					<label class="checkbox">					
					  <input  type='checkbox' name='group_id[<?php echo $group['id'] ?>]'    value="<?php echo $group['id'] ?>"
					  <?php if($group['access'] ==1 or $group['id'] ==1) echo 'checked'?>
					   /> 
					  <?php echo $group['name'] ?>
					</label>  
					<?php endforeach;?>	
						  
				  </div> 
				  <div class="form-group  " >
					<label> Show for Guest ? unlogged  </label>
					<label class="checkbox"><input  type='checkbox' name='allow_guest' 
 						<?php if($row['allow_guest'] ==1 ) echo 'checked';?> value="1"	/> Allow Guest ?  </lable>
				  </div>

	
				  <div class="form-group  " >
					<label> Status </label>
					<label class="radio">					
					  <input  type='radio' name='status'  value="enable" required
					  <?php if( $row['status'] =='enable')  	echo 'checked';?>				  
					   /> 
					  Enable
					</label> 
					<label class="radio">					
					  <input  type='radio' name='status'  value="disabled" required
					    <?php if( $row['status'] =='disabled')  	echo 'checked';?>				  
					   /> 
					  Disabled
					</label> 					 
				  </div> 

				  <div class="form-group  " >
					<label> Template </label>
					<label class="radio">					
					  <input  type='radio' name='template'  value="frontend" required
					  <?php if( $row['template'] =='frontend')  	echo 'checked';?>	
					  				  
					   /> 
					  Frontend
					</label> 
					<label class="radio">					
					  <input  type='radio' name='template'  value="backend" required	
					    <?php if( $row['template'] =='backend')  	echo 'checked';?>			  
					   /> 
					  Backend
					</label> 					 
				  </div> 				  
				  
			  <div class="form-group">
					<input type="submit" name="apply" class="btn btn-info btn-sm" value="Apply" />
					<input type="submit" name="submit" class="btn btn-primary btn-sm" value="Submit " />
					<a href="<?php echo site_url('sximo/pages');?>" class="btn btn-sm btn-warning">Back To List </a>		 
		
			  </div> 
			  </div>
			  </div>				  				  
				  		
			</div>

		</form>
	</div>
</div>	

<style type="text/css">
.note-editor .note-editable { height:500px;}
</style>			 	 
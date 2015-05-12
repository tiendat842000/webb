<div class="page-content row">
    <!-- Page header -->

 	<div class="page-content-wrapper m-t">
<div class="sbox animated fadeInRight">
	
	<div class="sbox-content"> 	


                    <?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
                
		 <form action="<?php echo site_url('registeronline/save/'.$row['id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
						<fieldset><legend> Thông tin cá nhân</legend>
									
								  <div class="form-group  " >
									<label for="Họ và Tên" class=" control-label col-md-4 text-left"> Họ và Tên <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['name'];?>' name='name'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Địa chỉ" class=" control-label col-md-4 text-left"> Địa chỉ <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['address'];?>' name='address'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Email" class=" control-label col-md-4 text-left"> Email <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['email'];?>' name='email'  required parsley-type='email'  /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Điện thoại" class=" control-label col-md-4 text-left"> Điện thoại <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['tel'];?>' name='tel'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			</div>
			
			<div class="col-md-6">
						<fieldset><legend> Khác</legend>
									
								  <div class="form-group  " >
									<label for="Hinh thức đăng ký" class=" control-label col-md-4 text-left"> Hinh thức đăng ký <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='type' rows='5' id='type' code='{$type}' 
							class='select2 '  required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Công ty" class=" control-label col-md-4 text-left"> Công ty </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['companyname'];?>' name='companyname'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Số thành viên" class=" control-label col-md-4 text-left"> Số thành viên </label>
									<div class="col-md-8">
									  <input type='text' class='form-control' placeholder='' value='<?php echo $row['num_of_member'];?>' name='num_of_member'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Mô tả/Yêu cầu" class=" control-label col-md-4 text-left"> Mô tả/Yêu cầu </label>
									<div class="col-md-8">
									  <textarea name='note' rows='2' id='editor' class='form-control markItUp '  
						 ><?php echo $row['note'] ;?></textarea> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> </fieldset>
			</div>
			
			<?php echo $this->session->flashdata('success');?>
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="apply" class="btn btn-info btn-sm" value="<?php echo $this->lang->line('core.btn_apply'); ?>" />
			<!--<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />-->
			<a href="<?php echo site_url('home');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
</div>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#type").jCombo("<?php echo site_url('registeronline/comboselect?filter=tb_type:id:typename') ?>",
		{  selected_value : '<?php echo $row["type"] ?>' });
		 	 
});
</script>		 
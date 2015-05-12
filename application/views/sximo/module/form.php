
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> Edit Module : <?php echo $row->module_name ;?> <small> Manage Installed Module </small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard');?>">Dashboard</a></li>
		<li><a href="<?php echo site_url('sximo/module') ;?>"> Module </a></li>
        <li class="active">  Form Grid Editor </li>
      </ul>		  
	  
    </div>
	<div class="page-content-wrapper m-t"> 
	<?php $this->load->view('sximo/module/tab',array('active'=>'form')); ?>
	<?php echo $this->session->flashdata('message');?>

	<ul class="nav nav-tabs" style="margin-bottom:10px;">
		<li class="active" ><a href="<?php echo site_url('sximo/module/form/'.$module_name);?>">Form Configuration </a></li> 
		<li ><a href="<?php echo site_url('sximo/module/formdesign/'.$module_name);?>">Form Layout</a></li> 
	</ul>
  
<div class="sbox">
	<div class="sbox-title"><h5> Form Grid  </h5></div>
	<div class="sbox-content">	
	<form class="form-vertical" action="<?php echo site_url('sximo/module/saveForm/'.$module_name);?>" method="post">
 <div class="table-responsive">
		<table class="table table-striped table-bordered" id="table">
		<thead class="no-border">
          <tr >
			<th scope="col"><?php echo $this->lang->line('core.mod_thnum'); ?></th>
			<th scope="col"><?php echo $this->lang->line('core.mod_thfield'); ?></th>
			<th scope="col" data-hide="phone"><?php echo $this->lang->line('core.mod_thcaption'); ?> </th>
			<th scope="col" data-hide="phone"><?php echo $this->lang->line('core.mod_thtype'); ?> </th>
			<th scope="col" data-hide="phone"><?php echo $this->lang->line('core.grid_show'); ?> </th>

			<th scope="col" data-hide="phone"><?php echo $this->lang->line('core.mod_thsearchable'); ?> </th>
			<th scope="col" data-hide="phone"><?php echo $this->lang->line('core.mod_threquired'); ?> </th>
            <th scope="col">&nbsp;</th>
          </tr>
		  </thead>
		  <tbody class="no-border-x no-border-y">	
		  <?php usort($forms, "SiteHelpers::_sort"); ?>
		  <?php $i=0; foreach($forms as $rows){
		  $id = ++$i;
		  ?>
          <tr>
            <td  class="index"><?php echo $id;?></td>
            <td><?php echo $rows['field'];?></td>
            <td>
				<input type="text" name="label[<?php echo $id;?>]" class="form-control input-sm" value="<?php echo $rows['label'];?>" />
			
			</td>
			<td>
            <?php echo $rows['type'];?>
			<input type="hidden" name="type[<?php echo $id;?>]" value="<?php echo $rows['type'];?>" />
			</td>
            <td>
			<label >
            <input type="checkbox" name="view[<?php echo $id;?>]" value="1" 
			<?php if($rows['view'] == 1) echo 'checked="checked"';?> />
			</label>
			</td>
            
            <td>
			<label >
            <input type="checkbox" name="search[<?php echo $id;?>]" value="1" 
			<?php if($rows['search'] == 1) echo 'checked="checked"';?>
			/>
			</label>
			</td>
			<td>
				<?php
		$reqType = array(
			'required'			=> 'Required',
			'alpa'				=> 'Required Only Alpha ',
			'numeric'			=> 'Required Only Number',	
			'alpa_num'			=> 'Required Alpha & Numeric ',			
			'email'				=> 'Required Email',
			'url'				=> 'Required Url',
			'date'				=> 'Required Date',
					
		);
		
	?>
		<select name="required[<?php echo $id;?>]" id="required" class="form-control" style="width:150px;" >
			<option value="0" <?php if($rows['required'] == 1) echo 'selected="selected"';?>>No Required</option>
			<?php foreach($reqType as $item=>$val) { ?>
				<option value="<?php echo $item;?>" <?php if($rows['required'] == $item) echo 'selected="selected"';?>><?php echo $val;?></option>
			<?php } ?>
		</select>
		</td>
            <td>
			<a href="javascript:void(0)" class="btn btn-xs btn-primary editForm"  role="button"  
			onclick="SximoModal('<?php echo site_url('sximo/module/editform/'.$row->module_id.'?field='.$rows['field'].'&alias='.$rows['alias']) ?>','Edit Field : <?php echo $rows['field'];?>')">
			<i class="fa fa-cog"></i></a>

			
			
			<input type="hidden" name="alias[<?php echo $id;?>]" value="<?php echo $rows['alias'];?>" />
			<input type="hidden" name="field[<?php echo $id;?>]" value="<?php echo $rows['field'];?>" />	
			<input type="hidden" name="form_group[<?php echo $id;?>]" value="<?php echo $rows['form_group'];?>" />	
			<input type="hidden" name="sortlist[<?php echo $id;?>]" class="reorder" value="<?php echo $rows['sortlist'];?>" />		
			<input type="hidden" name="opt_type[<?php echo $id;?>]" value="<?php echo $rows['option']['opt_type'];?>" />
			<input type="hidden" name="lookup_query[<?php echo $id;?>]" value="<?php echo $rows['option']['lookup_query'];?>" />
			<input type="hidden" name="lookup_table[<?php echo $id;?>]" value="<?php echo $rows['option']['lookup_table'];?>" />
			<input type="hidden" name="lookup_key[<?php echo $id;?>]" value="<?php echo $rows['option']['lookup_key'];?>" />
			<input type="hidden" name="lookup_value[<?php echo $id;?>]" value="<?php echo $rows['option']['lookup_value'];?>" />
			<input type="hidden" name="is_dependency[<?php echo $id;?>]" value="<?php echo $rows['option']['is_dependency'];?>" />
			<input type="hidden" name="lookup_dependency_key[<?php echo $id;?>]" value="<?php echo $rows['option']['lookup_dependency_key'];?>" />
			<input type="hidden" name="path_to_upload[<?php echo $id;?>]" value="<?php echo $rows['option']['path_to_upload'];?>" />
			<input type="hidden" name="upload_type[<?php echo $id;?>]" value="<?php echo $rows['option']['upload_type'];?>" />
			<input type="hidden" name="resize_width[<?php echo $id;?>]" value="<?php if(isset($rows['option']['resize_width'])) echo $rows['option']['resize_width'];?>" />
			<input type="hidden" name="resize_height[<?php echo $id;?>]" value="<?php if(isset($rows['option']['resize_height'])) echo $rows['option']['resize_height'];?>" />
			<input type="hidden" name="extend_class[<?php echo $id;?>]" value="<?php if(isset($rows['option']['resize_height'])) echo $rows['option']['resize_height'];?>" />
			<input type="hidden" name="tooltip[<?php echo $id;?>]" value="<?php if(isset($rows['option']['tooltip'])) echo $rows['option']['tooltip'];?>" />
			<input type="hidden" name="attribute[<?php echo $id;?>]" value="<?php if(isset($rows['option']['attribute'])) echo $rows['option']['attribute'];?>" />
			<input type="hidden" name="extend_class[<?php echo $id;?>]" value="<?php if(isset($rows['option']['extend_class'])) echo $rows['option']['extend_class'];?>" />
			<input type="hidden" name="is_multiple[<?php echo $id;?>]" value="<?php if(isset($rows['option']['is_multiple'])) echo $rows['option']['is_multiple'];?>" />
			
			</td>
			
          </tr>
		  <?php } ?>
		  </tbody>
        </table>
		</div>

 <div class="infobox infobox-danger fade in">
  <button type="button" class="close" data-dismiss="alert"> x </button>  
  <p><?php echo $this->lang->line('core.mod_formtips2'); ?></p>	
</div>		
		
		<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('core.sb_savechanges'); ?> </button>
		<input type="hidden" name="module_id" value="<?php echo $row->module_id ;?>" />
 </form>	
	
</div>	
</div></div>
<script>
$(document).ready(function() {
	
	$('.expand-row').hide();
	$('.btn-sm').click(function(){
		var id = $(this).attr('rel');
		$('.expand-row').hide();
		$(id).slideDown(100);
		
	});
	var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index) {
			$(this).width($originals.eq(index).width())
		});
		return $helper;
		},
		updateIndex = function(e, ui) {
			$('td.index', ui.item.parent()).each(function (i) {
				$(this).html(i + 1);
			});
			$('.reorder', ui.item.parent()).each(function (i) {
				$(this).val(i + 1);
			});			
		};
		
/*	$("#table tbody").sortable({
		helper: fixHelperModified,
		stop: updateIndex
	});	*/	
});


</script>

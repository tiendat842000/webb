<div class="table-footer">
<div class="row">
 <div class="col-sm-5">
  <div class="table-actions" style=" padding: 10px 0">
 
   <form action='<?php echo site_url($pageModule.'/filter/') ?>' >
	   <?php  $pages = array(5,10,20,30,50)?>
	   <?php $orders = array('asc','desc') ?>
	<select name="rows" data-placeholder="Show" class="select-alt"  >
	  <option value=""> <?php echo $this->lang->line('core.grid_page'); ?> </option>
	  <?php foreach ($pages as $p): ?>
	  <option value="<?php echo  $p  ?>" 
		<?php if ($this->input->get('rows') == $p):  ?>
			selected="selected"
		<?php endif; 	 ?>
	  ><?php echo  $p  ?></option>
	  <?php endforeach;  ?>
	</select>
	<select name="sort" data-placeholder="Sort" class="select-alt"  >
	  <option value=""> <?php echo $this->lang->line('core.grid_sort'); ?> </option>	 
	  <?php foreach ($tableGrid as $field): ?>
	   <?php if ($field['view'] =='1' && $field['sortable'] =='1'):  ?>
		  <option value="<?php echo  $field['field']  ?>" 
			<?php if ($this->input->get('sort') == $field['field']):  ?>
				selected="selected"
			<?php endif; 	 ?>
		  ><?php echo  $field['label']  ?></option>
		<?php endif; 	   ?>
	  <?php endforeach;  ?>
	 
	</select>	
	<select name="order" data-placeholder="Order" class="select-alt">
	  <option value=""> <?php echo $this->lang->line('core.grid_order'); ?></option>
	   <?php foreach ($orders as $o): ?>
	  <option value="<?php echo  $o  ?>"
		<?php if ($this->input->get('order') == $o): ?>
			selected="selected"
		<?php endif; 	 ?>
	  ><?php echo  ucwords($o)  ?></option>
	 <?php endforeach;  ?>
	</select>	
	<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>	
	<input type="hidden" name="md" value="" />
	</form>
	
  </div>					
  </div>
   <div class="col-sm-3">
	<p class="text-center" style=" padding: 25px 0">

	</p>
   </div>
	<div class="col-sm-4">			 
 	<?php echo  $pagination  ?>
 	 </div>
  </div>
</div>	


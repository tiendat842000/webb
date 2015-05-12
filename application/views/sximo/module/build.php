	<form class="form-horizontal" action="<?php echo site_url('sximo/module/dobuild/'.$module_id);?>" method="post">
	<div class="form-group">
		<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.mod_bldictrl'); ?> </label>
	<div class="col-md-8">
		<label class="checkbox">
		<input name="controller" type="checkbox" id="controller" value="1">
		<code> <?php echo ucwords($module_name) ;?>.php </code> <br /><?php echo $this->lang->line('core.mod_bldireplace'); ?> 
		</label>
	</div>
	</div>

	<div class="form-group">
		<label for="ipt" class=" control-label col-md-4">Model </label>
	<div class="col-md-8">
		<label class="checkbox">
		<input name="model" type="checkbox" id="model" value="1">
		<code><?php echo ucwords($module_name) ;?>model.php</code> <?php echo $this->lang->line('core.mod_bldimodel'); ?> <br /><?php echo $this->lang->line('core.mod_bldireplace'); ?>
		</label>
	</div>
	</div>

	<div class="form-group">
		<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.mod_bldigrid'); ?> </label>
	<div class="col-md-8">
		<label class="checkbox">
		<input name="grid" type="checkbox" id="grid" value="1">
		<code>index.php</code>	<?php echo $this->lang->line('core.mod_bldiat'); ?> <code>views/<?php echo ucwords($module_name) ;?>/ </code><?php echo $this->lang->line('core.mod_bldifolder'); ?> <br /> <?php echo $this->lang->line('core.mod_bldireplace'); ?>
		</label>
	</div>
	</div>

	<div class="form-group">
		<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.mod_bldiform'); ?>		</label>
	<div class="col-md-8">
		<label class="checkbox">
		<input name="form" type="checkbox" id="form" value="1" checked>
		<code>form.php</code>	<?php echo $this->lang->line('core.mod_bldiat'); ?> <code>views/<?php echo ucwords($module_name) ;?>/ </code><?php echo $this->lang->line('core.mod_bldifolder'); ?>  <br /> <?php echo $this->lang->line('core.mod_bldireplace'); ?>

		</label>
	</div>
	</div>

	<div class="form-group">
		<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.mod_bldiview'); ?> </label>
	<div class="col-md-8">
		<label class="checkbox">
		<input name="view" type="checkbox" id="view" value="1" checked>
		 <code>view.php</code>	<?php echo $this->lang->line('core.mod_bldiat'); ?> <code>views/<?php echo ucwords($module_name) ;?>/ </code> <?php echo $this->lang->line('core.mod_bldifolder'); ?>  <br /> <?php echo $this->lang->line('core.mod_bldireplace'); ?>
		</label>
		<input name="rebuild" type="hidden" id="rebuild" value="ok">
		<input name="module_id" type="hidden" id="module_id" value="<?php echo $module_id;?>">
	</div>
	</div>

		<div class="form-group">
		<label for="ipt" class=" control-label col-md-4"></label>
	<div class="col-md-8">
		<button type="submit" name="submit" class="btn btn-sm btn-danger"><?php echo $this->lang->line('core.btn_rebuild'); ?></button>
	</div>
	</div>

</form>


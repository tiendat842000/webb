<script type="text/javascript" src="<?php echo base_url().'sximo/js/plugins/jquery.nestable.js';?>"></script>

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3><?php echo $this->lang->line('core.m_menu'); ?> <small><?php echo $this->lang->line('core.t_menusmall'); ?> </small></h3>
      </div>
    </div>
 	

	<div class="page-content-wrapper m-t">  
	
	
	<ul class="nav nav-tabs" style="margin:10px 0;">
		<li <?php if($active == 'top') echo 'class="active"';?>><a href="<?php echo  site_url('sximo/menu/index?pos=top');?>"><i class="icon-paragraph-justify2"></i><?php echo $this->lang->line('core.tab_topmenu'); ?> </a></li>
		<li <?php if($active == 'sidebar') echo 'class="active"'?>><a href="<?php echo  site_url('sximo/menu/index?pos=sidebar');?>"><i class="icon-paragraph-justify2"></i><?php echo $this->lang->line('core.tab_sidemenu'); ?> </a></li>	
	</ul>  	
	<?php echo $this->session->flashdata('message');?>	
	
		<div class="col-sm-5">

		<div class="box ">
 <div class="infobox infobox-info fade in">
  <button type="button" class="close" data-dismiss="alert"> x </button>  
  <p><?php echo $this->lang->line('core.t_tipsdrag'); ?> </p>	
</div>

            <div id="list2" class="dd" style="min-height:350px;">
              <ol class="dd-list">
			<?php foreach ($menus as $menu) : ?>
				  <li data-id="<?php echo $menu['menu_id'];?>" class="dd-item dd3-item">
					<div class="dd-handle dd3-handle"></div><div class="dd3-content"><?php echo  $menu['menu_name'];?>
						<span class="pull-right">
						<a href="<?php echo site_url('sximo/menu/index/'.$menu['menu_id'].'?pos='.$active);?>"><i class="fa fa-cogs"></i></a></span>
					</div>
					<?php if(count($menu['childs']) > 0) : ?>
						<ol class="dd-list" style="">
							<?php foreach ($menu['childs'] as $menu2) : ?>
							 <li data-id="<?php echo $menu2['menu_id'];?>" class="dd-item dd3-item">
								<div class="dd-handle dd3-handle"></div><div class="dd3-content"><?php echo $menu2['menu_name'];?>
									<span class="pull-right">
									<a href="<?php echo  site_url('sximo/menu/index/'.$menu2['menu_id'].'?pos='.$active);?>"><i class="fa fa-cogs"></i></a></span>
								</div>
								<?php if(count($menu2['childs']) > 0) : ?>
								<ol class="dd-list" style="">
									<?php foreach($menu2['childs'] as $menu3) : ?>
									 	<li data-id="<?php echo $menu3['menu_id'];?>" class="dd-item dd3-item">
											<div class="dd-handle dd3-handle"></div><div class="dd3-content"><?php echo  $menu3['menu_name'] ;?>
												<span class="pull-right">
												<a href="<?php echo  site_url('sximo/menu/index/'.$menu3['menu_id'].'?pos='.$active);?>"><i class="fa fa-cogs"></i></a>
												</span>
											</div>
										</li>	
									<?php endforeach ;?>
								</ol>
								<?php endif;?>
							</li>							
							<?php endforeach;?>
						</ol>
					<?php endif;?>
				</li>
			<?php endforeach; ?>			  
              </ol>
            </div>
			<form class="form-horizontal" action="<?php echo site_url('sximo/menu/saveOrder')?>" method="post">
			<input type="hidden" name="reorder" id="reorder" value="" />
			 <div class="infobox infobox-danger fade in">
			 <p><?php echo $this->lang->line('core.t_tipsnote'); ?>	</p>
			</div>			
		
			<button type="submit" class="btn btn-primary "><?php echo $this->lang->line('core.sb_reorder'); ?> </button>	
			</form>
		 </div>
		</div>
		<div class="col-sm-7">
		<form class="form-horizontal" action="<?php echo site_url('sximo/menu/save')?>" method="post" >
				<div class=" box">	

				
				<input type="hidden" name="menu_id" id="menu_id" value="<?php echo  $row['menu_id'] ;?>" />																					
				  <div class="form-group  " style="display:none;">
					<label for="ipt" class=" control-label col-md-4 text-right"> Parent Id </label>
					<div class="col-md-8">
						<input type="text" name="parent_id" id="reorder" value="<?php  echo $row['parent_id'];?>" class="form-control" />
					  
					 </div> 

				  </div> 
				  <div class="form-group  " >
					<label for="ipt" class=" control-label col-md-4 text-right"><?php echo $this->lang->line('core.fr_mtitle'); ?> </label>
					<div class="col-md-8">
						<input type="text" name="menu_name" id="menu_name" value="<?php  echo $row['menu_name'];?>" class="form-control" />	
					  <?php if(CNF_MULTILANG ==1) { 
					    $lang = SiteHelpers::langOption();
						foreach($lang as $l) { 
							if($l['folder'] !='en') {
							?>
								<div class="input-group input-group-sm" style="margin:1px 0 !important;">
								 <input name="language_title[<?php echo $l['folder'];?>]" type="text"   class="form-control" placeholder="Title for <?php echo $l['name'];?>"
								 value="<?php echo (isset($menu_lang['title'][$l['folder']]) ? $menu_lang['title'][$l['folder']] : '');?>" />
								<span class="input-group-addon xlick bg-default btn-sm " ><?php echo strtoupper($l['folder']);?></span>
							   </div> 								
							<?php
							}
						
						}
					   
					 } ?>

					  		  
					  
					 </div> 
				  </div> 
				  <div class="form-group   " >
					<label for="ipt" class=" control-label col-md-4 text-right"><?php echo $this->lang->line('core.fr_mtype'); ?> </label> 
					<div class="col-md-8 menutype">
					<label class="radio-inline  ">
						
					<input type="radio" name="menu_type" value="internal" class=""  
					<?php if($row['menu_type']=='internal' || $row['menu_type']=='') echo 'checked="checked"'?> />
					
					Internal
					</label>
					<label class="radio-inline">
					<input type="radio" name="menu_type" value="external"  class="" 
					<?php if($row['menu_type']=='external' ) echo 'checked="checked"';?>  /> External 
					</label>	  
					 </div> 
				  </div> 	
				  			  					
				  <div class="form-group  ext-link" >
					<label for="ipt" class=" control-label col-md-4 text-right"> Url  </label>
					<div class="col-md-8">
					    <input type="text" name="url" id="url" value="<?php echo $row['url'];?>" class="form-control" />
					 </div> 
				  </div> 	
								  					
				  <div class="form-group  int-link" >
					<label for="ipt" class=" control-label col-md-4 text-right"><?php echo $this->lang->line('core.t_module'); ?> </label>
					<div class="col-md-8">
					  <select name='module' rows='5' id='module'  class='form-control '    >
							<option value=""> -- Select Module or Page -- </option>
							<optgroup label="Module ">
							<?php foreach($modules as $mod) :?>
								<option value="<?php echo  $mod->module_name;?>"
								<?php if($row['module']== $mod->module_name ) echo 'selected="selected"'?>
								><?php echo  $mod->module_title;?></option>
							<?php endforeach;?>
							</optgroup>
							<optgroup label="Page CMS ">
							<?php foreach($pages->result() as $page): ?>
								<option value="<?php echo  $page->alias;?>"
								<?php if($row['module']== $page->alias ) echo 'selected="selected"'?>
								>Page : <?php echo  $page->title;?></option>
							<?php endforeach;?>	
							</optgroup>						
					</select> 		
					 </div> 
				  </div> 										
					

				  <div class="form-group  " >
					<label for="ipt" class=" control-label col-md-4 text-right"><?php echo $this->lang->line('core.fr_mposition'); ?> </label>
					<div class="col-md-8">
						<input type="radio" name="position"  value="top" required 
						<?php if($row['position']=='top' ) echo 'checked="checked"';?> /> Top Menu 
						<input type="radio" name="position"  value="sidebar"  required
						<?php if($row['position']=='sidebar' ) echo 'checked="checked"';?>  /> Side Menu 
					 </div> 
				  </div> 	 				
				  <div class="form-group  " >
					<label for="ipt" class=" control-label col-md-4 text-right"><?php echo $this->lang->line('core.fr_miconclass'); ?> </label>
					<div class="col-md-8">
						 <input type="text" name="menu_icons" id="menu_icons" value="<?php echo $row['menu_icons'];?>" class="form-control" />
					 
					  <p> Example : <span class="label label-info"> fa fa-desktop </span>  , <span class="label label-info"> fa fa-cloud-upload </span> </p>
					  <p>Usage : 
					  <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"> Font Awesome </a> class name</p>
					 </div> 
				  </div> 					
				  <div class="form-group  " >
					<label for="ipt" class=" control-label col-md-4 text-right"><?php echo $this->lang->line('core.fr_mactive'); ?> </label>
					<div class="col-md-8">
					<input type="radio" name="active"  value="1" 
					<?php if($row['active']=='1' ) echo 'checked="checked"';?> /> Active 
					<input type="radio" name="active" value="0" 
					<?php if($row['active']=='0' ) echo 'checked="checked"';?> /> Inactive 
										
					 
					 </div> 
				  </div> 

			  <div class="form-group">
				<label for="ipt" class=" control-label col-md-4"> Access   <code>*</code></label>
				<div class="col-md-8">
						<?php 
					$pers = json_decode($row['access_data'],true);
					foreach($groups->result() as $group) {
						$checked = '';
						if(isset($pers[$group->group_id]) && $pers[$group->group_id]=='1')
						{
							$checked= ' checked="checked"';
						}						
							?>		
				  <label class="checkbox">
				  <input type="checkbox" name="groups[<?php echo $group->group_id;?>]" value="<?php echo $group->group_id;?>" <?php echo $checked;?>  />   
				  <?php echo $group->name;?>  
				  </label>
			
				  <?php } ?>
						 </div> 
			  </div> 

				  <div class="form-group  " >
					<label for="ipt" class=" control-label col-md-4"><?php echo $this->lang->line('core.fr_mpublic'); ?> </label>
					<div class="col-md-8">
					<label class="checkbox"><input  type='checkbox' name='allow_guest' 
 						<?php if($row['allow_guest'] ==1 ) echo 'checked'; ?>	
					   value="1"	/> Yes  </lable>
					</label>   
				  </div>
				</div>
				  
			  <div class="form-group">
				<label class="col-sm-4 text-right"> </label>
				<div class="col-sm-8">	
				<button type="submit" class="btn btn-primary "><?php echo $this->lang->line('core.submit'); ?> </button>
				<?php if($row['menu_id'] !='') :?>
					<button type="button"onclick="SximoConfirmDelete('<?php echo  site_url('sximo/menu/destroy/'.$row['menu_id']);?>')" class="btn btn-danger ">  Delete </button>
				<?php endif ;?>	
				</div>	  
		
			  </div> 
			
		</div>	  
		 
		</form>
		
		
		
		</div>
		</div>
		<div style="clear:both;"></div>
		
	</div>


	
	
<script>
$(document).ready(function(){
	$('.dd').nestable();
    update_out('#list2',"#reorder");
    
    $('#list2').on('change', function() {
		var out = $('#list2').nestable('serialize');
		$('#reorder').val(JSON.stringify(out));	  

    });
		$('.ext-link').hide(); 

	$('.menutype input:radio').on('ifClicked', function() {
	 	 val = $(this).val();
  			mType(val);
	  
	});
	
	mType('<?php echo $row['menu_type'];?>'); 
	
			
});	

function mType( val )
{
		if(val == 'external') {
			$('.ext-link').show(); 
			$('.int-link').hide();
		} else {
			$('.ext-link').hide(); 
			$('.int-link').show();
		}
}		

	
function update_out(selector, sel2){
	
	var out = $(selector).nestable('serialize');
	$(sel2).val(JSON.stringify(out));

}
</script>		 
		 	  
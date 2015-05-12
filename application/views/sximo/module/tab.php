<ul class="nav nav-tabs" style="margin-bottom:10px;">
  <li <?php if($active == 'config') echo 'class="active"';?>><a href="<?php echo site_url('sximo/module/config/'.$module_name);?>"><?php echo $this->lang->line('core.modtab_info'); ?> </a></li>
  <li <?php if($active == 'sql') echo 'class="active"';?> >
  <a href="<?php echo site_url('sximo/module/sql/'.$module_name);?>"><?php echo $this->lang->line('core.modtab_sql'); ?> </a></li>
  <li <?php if($active == 'table') echo 'class="active"';?>>
  <a href="<?php echo site_url('sximo/module/table/'.$module_name);?>"><?php echo $this->lang->line('core.modtab_table'); ?> </a></li>
  <li <?php if($active == 'form') echo 'class="active"';?>>
  <a href="<?php echo site_url('sximo/module/form/'.$module_name);?>"><?php echo $this->lang->line('core.modtab_form'); ?> </a></li> 
  <li <?php if($active == 'permission') echo 'class="active"';?>>
  <a href="<?php echo site_url('sximo/module/permission/'.$module_name);?>"><?php echo $this->lang->line('core.modtab_permission'); ?> </a></li>
   <li <?php if($active == 'rebuild') echo 'class="active"';?> >
   <a href="javascript://ajax" onclick="SximoModal('<?php echo site_url('sximo/module/build/'.$module_name);?>','<?php echo $this->lang->line('core.modtab_rebuildtitle'); ?> <?php echo $module_name;?>')"><?php echo $this->lang->line('core.modtab_rebuild'); ?> </a></li>
</ul>
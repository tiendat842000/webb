<div class="row  ">
	<nav style="margin-bottom: 0;" role="navigation" class="navbar navbar-static-top gray-bg">
	<div class="navbar-header">
		<a href="javascript:void(0)" class="navbar-minimalize minimalize-btn btn btn-primary "><i class="fa fa-bars"></i> </a>			
	</div>
	
	
	 <ul class="nav navbar-top-links navbar-right">
		<?php if(CNF_MULTILANG ==1): ?>
		<li  class="user dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag"></i><i class="caret"></i></a>
			 <ul class="dropdown-menu dropdown-menu-right icons-right">
				<?php foreach(SiteHelpers::langOption() as $lang) : ?>
					<li><a href="<?php echo site_url('page/lang/'.$lang['folder']);?>"><i class="fa fa-flag"></i> <?php echo $lang['name'] ;?></a></li>
				<?php endforeach;?>	
			</ul>
		</li>	
		<?php endif; ?>
	 	<?php if($this->session->userdata('gid') ==1) : ?>

		<li class="user dropdown">
			<a class="dropdown-toggle" href="javascript:void(0)"  data-toggle="dropdown">
				<i class="fa  fa-desktop"></i> <span> <?php echo $this->lang->line('core.m_controlpanel'); ?> </span><i class="caret"></i>
			</a>
			<ul class="dropdown-menu dropdown-menu-right icons-right">
				<li><a href="<?php echo site_url('sximo/config') ;?>"><i class="fa  fa-wrench"></i> <?php echo $this->lang->line('core.m_setting'); ?> </a></li>
				<li><a href="<?php echo site_url('users') ;?>" ><i class="fa fa-user"></i> <?php echo $this->lang->line('core.m_usersgroups'); ?> </a></li>
				<li><a href="<?php echo site_url('sximo/config/blast') ;?>"><i class="fa fa-envelope"></i> <?php echo $this->lang->line('core.m_blastemail'); ?> </a></li>
				<li><a href="<?php echo site_url('logs') ;?>"><i class="fa fa-clock-o"></i> <?php echo $this->lang->line('core.m_logs'); ?> </a></li>
				<li class="divider"></li>
				<li><a href="<?php echo site_url('sximo/pages') ;?>"><i class="fa  fa-copy"></i> <?php echo $this->lang->line('core.m_pagecms'); ?> </a></li>
				<li><a href="<?php echo site_url('sximo/menu') ;?>" ><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('core.m_menu'); ?> </a></li>		
				<li class="divider"></li>		
				<li><a href="<?php echo site_url('sximo/module') ;?>" ><i class="fa fa-cogs"></i> <?php echo $this->lang->line('core.m_codebuilder'); ?> </a></li>	
                                <li class="divider"></li>	
                                <li><a href="<?php echo site_url('opm') ;?>" ><i class="fa fa-cogs"></i> <?php echo $this->lang->line('core.bbb_menu'); ?> </a></li>
			</ul>
		</li>	
	
		<?php endif;?>

		<li class="user dropdown">
			<a class="dropdown-toggle" href="javascript:void(0)"  data-toggle="dropdown">
				<i class="fa fa-user"></i> <span> <?php echo $this->lang->line('core.m_myaccount'); ?> </span><i class="caret"></i>
			</a>
			<ul class="dropdown-menu dropdown-menu-right icons-right">
				<li><a href="<?php echo site_url('dashboard') ;?>"><i class="icon-stats-up"></i><?php echo $this->lang->line('core.m_dashboard'); ?> </a></li>
				<li><a href="<?php echo site_url('') ;?>" target="_blank"><i class="icon-stats-up"></i> <?php echo $this->lang->line('core.m_mainsite'); ?> </a></li>
				<li><a href="<?php echo site_url('user/profile');?>"><i class="icon-user"></i> <?php echo $this->lang->line('core.m_myprofile'); ?> </a></li>
				<li><a href="<?php echo site_url('user/logout') ;?>"><i class="icon-exit"></i><?php echo $this->lang->line('core.m_logout'); ?> </a></li>
			</ul>
		</li>	
	</ul>	
	</nav>	 
	 
</div>	
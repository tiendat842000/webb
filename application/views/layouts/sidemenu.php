<nav role="navigation" class="navbar-default navbar-static-side">
	 <div class="sidebar-collapse">				  
	   <ul id="sidemenu" class="nav expanded-menu">
		<li class="logo-header" >
		 <a class="navbar-brand" href="<?php echo site_url('dashboard') ;?>">
		 <img width="30" align="middle" style="margin-right:5px;" alt="My Apps" src="<?php echo base_url() ;?>sximo/images/logo-sximo.png">
			<?php echo CNF_APPNAME;?>
		 </a>
		</li>
		<li class="nav-header">
			<div class="dropdown profile-element" style="text-align:center;"> 
				<span>
					<?php echo SiteHelpers::avatar('75');?>
					
				</span>
				<a href="<?php echo site_url('user/profile');?>" >
				<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata('fid');?> </strong>
				 <br /> Last Login : <br />
				<small><?php echo date("H:i M j, Y",strtotime($this->session->userdata('ll'))) ;?></small>				
				 </span> 
				 </span>
				 </a>
			</div>
			<div class="photo-header "> <?php echo SiteHelpers::avatar('50');?> </div>
		</li> 
<?php $sidebar = SiteHelpers::menus('sidebar');?>
<?php foreach ($sidebar as $menu) : ?>
	 <li>
		<a 
			<?php 
			if($menu['menu_type'] =='external') {	
				echo 'href="'.$menu['url'].'"';  
			} else {
				echo 'href="'.site_url($menu['module']).'"';
			}
			?>	
					
		
		 <?php  if(count($menu['childs']) > 0 ) echo 'class="expand level-closed"';?>>
			<i class="<?php echo $menu['menu_icons'];?>"></i> <span class="nav-label">

			<?php	

				if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][$this->session->userdata('lang')])):
					echo  $menu['menu_lang']['title'][$this->session->userdata('lang')] ;
				else:
					echo $menu['menu_name'];
				endif;
			?>		

				
			</span><span class="fa arrow"></span>	 
		</a> 
		<?php if(count($menu['childs']) > 0) :?>
			<ul class="nav nav-second-level">
				<?php foreach ($menu['childs'] as $menu2) : ?>
				 <li>
					<a 
						<?php 
						if($menu2['menu_type'] =='external') {	
							echo 'href="'.$menu2['url'].'"';  
						} else {
							echo 'href="'.site_url($menu2['module']).'"';
						}
						?>									
					> <i class="<?php echo $menu2['menu_icons'];?>"></i> 
					<?php	
					
						if(CNF_MULTILANG ==1 && isset($menu2['menu_lang']['title'][$this->session->userdata('lang')])):
							echo  $menu2['menu_lang']['title'][$this->session->userdata('lang')] ;
						else:
							echo $menu2['menu_name'];
						endif;
					?>						
					
					</a> 
					<?php if(count($menu2['childs']) > 0) : ?>
					<ul class="nav nav-third-level">
						<?php foreach($menu2['childs'] as $menu3) : ?>
							<li>
								<a 
									<?php 
									if($menu3['menu_type'] =='external') {	
										echo 'href="'.$menu3['url'].'"';  
									} else {
										echo 'href="'.site_url($menu3['module']).'"';
									}
									?>																
								> <i class="<?php echo $menu3['menu_icons'];?>"></i>	
								<?php	
								
									if(CNF_MULTILANG ==1 && isset($menu3['menu_lang']['title'][$this->session->userdata('lang')])):
										echo  $menu3['menu_lang']['title'][$this->session->userdata('lang')] ;
									else:
										echo $menu3['menu_name'];
									endif;
								?>																		
								
								</a>
							</li>	
						<?php endforeach;?>
					</ul>
					<?php endif;?>							
				</li>							
				<?php endforeach;?>
			</ul>
		<?php endif;?>
	</li>
<?php endforeach;?>						
	</div>
</nav>	
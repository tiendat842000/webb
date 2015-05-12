<?php $menus = SiteHelpers::menus('top') ;?>
 	  <ul class="nav navbar-nav navbar-collapse collapse navbar-right"  id="topmenu">
		<?php foreach ($menus as $menu) :?>
			 <li class="<?php if($this->uri->segment(1) == $menu['module']) echo 'active';?>" >
			 	<a  
				<?php if($menu['menu_type'] =='external') :?>
					href="<?php echo $menu['url'];?>" 
				<?php else : ?>
					href="<?php echo site_url($menu['module']);?>" 
				<?php endif; ?> 
			 
				 <?php if(count($menu['childs']) > 0 ) echo 'class="dropdown-toggle" data-toggle="dropdown" ';?>>
			 		<i class="<?php  echo $menu['menu_icons'];?>"></i> <span>
						<?php	
						
							if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][$this->session->userdata('lang')])):
								echo  $menu['menu_lang']['title'][$this->session->userdata('lang')] ;
							else:
								echo $menu['menu_name'];
							endif;
						?>	

					</span>
					<?php  if(count($menu['childs']) > 0 ) : ?>
					 <b class="caret"></b> 
					<?php endif;?>  
				</a> 
				<?php if(count($menu['childs']) > 0):?>
					 <ul class="dropdown-menu dropdown-menu-right">
						<?php foreach ($menu['childs'] as $menu2):?>
						 <li class=" 
						 <?php if(count($menu2['childs']) > 0) echo 'dropdown-submenu';?>
						 <?php if($this->uri->segment(1) == $menu2['module']) echo 'active ';?>">
						 	<a 
								<?php if($menu2['menu_type'] =='external'):?>
									href="<?php  echo $menu2['url'];?>" 
								<?php else:?>
									href="<?php  echo site_url($menu2['module']);?>" 
								<?php endif;?>
											
							>
								<i class="<?php echo $menu2['menu_icons'];?>"></i> 
								<?php	
								
									if(CNF_MULTILANG ==1 && isset($menu2['menu_lang']['title'][$this->session->userdata('lang')])):
										echo  $menu2['menu_lang']['title'][$this->session->userdata('lang')] ;
									else:
										echo $menu2['menu_name'];
									endif;
								?>	
							</a> 
							<?php if(count($menu2['childs']) > 0):?>
							<ul class="dropdown-menu dropdown-menu-right">
								<?php foreach($menu2['childs'] as $menu3):?>
									<li <?php  if($this->uri->segment(1) == $menu3['module']) echo 'class="active"';?>>
										<a 
											<?php if($menu3['menu_type'] =='external'):?>
												href="<?php  echo $menu3['url'];?>" 
											<?php else :?>
												href="<?php echo site_url($menu3['module']);?>" 
											<?php endif;?>										
										
										> <i class="<?php  echo $menu3['menu_icons'];?>"></i>
											<span>
											<?php	
											
												if(CNF_MULTILANG ==1 && isset($menu3['menu_lang']['title'][$this->session->userdata('lang')])):
													echo  $menu3['menu_lang']['title'][$this->session->userdata('lang')] ;
												else:
													echo $menu3['menu_name'];
												endif;
											?>	
											</span>  
										</a>
									</li>	
								<?php endforeach; ?>
							</ul>
							<?php endif	;?>						
							
						</li>							
						<?php endforeach;?>
					</ul>
				<?php endif;?>
			</li>
		<?php endforeach;?>  
			<li><a href="javascript://ajax" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-success"> My Account</span></a>
				 <ul class="dropdown-menu dropdown-menu-right">
                                     
                                     <?php echo $this->session->userdata('logged_in');
                                     ?>
					 <?php if(!$this->session->userdata('logged_in')):?> 
						<li><a href="<?php  echo site_url('user/login') ;?>"><i class="fa fa-sign-in"></i> Log In</a></li>
						<li><a href="<?php  echo site_url('user/register')  ;?>"><i class="fa fa-user"></i> Registration</a></li>
					 <?php else : ?>
						<li><a href="<?php  echo site_url('user/profile')  ;?>"><i class="fa fa-user "></i> My Profile </a></li>	
						<!--<li><a href="<?php  echo site_url('dashboard')  ;?>"><i class="fa fa-desktop"></i> Dashboard</a></li>-->	
						<li><a href="<?php  echo site_url('user/logout')  ;?>"><i class="fa  fa-sign-out"></i> Log Out</a></li>					 
					 <?php endif;?>						 
				 </ul>
				
			</li>

  </ul> 
 
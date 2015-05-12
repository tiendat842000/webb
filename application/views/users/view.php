<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>"><?php echo $this->lang->line('core.m_dashboard'); ?> </a></li>
			<li><a href="<?php echo site_url('users') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
		</ul>
	</div>  
	
 	<div class="page-content-wrapper m-t">   
	
		<div class="table-responsive">
			<table class="table table-striped table-bordered" >
				<tbody>	
			
					<tr>
						<td width='30%' class='label-view text-right'>Avatar</td>
						<td><?php echo SiteHelpers::showUploadedFile($row['avatar'],'/uploads/users/') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'><?php echo $this->lang->line('core.group'); ?> </td>
						<td><?php echo SiteHelpers::gridDisplayView($row['group_id'],'group_id','1:tb_groups:group_id:name') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Username</td>
						<td><?php echo $row['username'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'><?php echo $this->lang->line('core.firstname'); ?> </td>
						<td><?php echo $row['first_name'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'><?php echo $this->lang->line('core.lastname'); ?> </td>
						<td><?php echo $row['last_name'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Email</td>
						<td><?php echo $row['email'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created At</td>
						<td><?php echo $row['created_at'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'><?php echo $this->lang->line('core.lastlogin'); ?> </td>
						<td><?php echo $row['last_login'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Updated At</td>
						<td><?php echo $row['updated_at'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'><?php echo $this->lang->line('core.fr_mactive'); ?> </td>
						<td><?php echo $row['active'] ;?> </td>
						
					</tr>
				
				</tbody>	
			</table>    
		</div>
	</div>
	
</div>
	  
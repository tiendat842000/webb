<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('opm') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
		</ul>
	</div>  
	
 	<div class="page-content-wrapper m-t">   
		<div class="sbox animated fadeInRight">
			<div class="sbox-title"> <h4> <i class="fa fa-table"></i> <?php echo $pageTitle ;?> <small><?php echo $pageNote ;?></small></h4></div>
			<div class="sbox-content"> 		
				<div class="table-responsive">
					<table class="table table-striped table-bordered" >
						<tbody>	
					
					<tr>
						<td width='30%' class='label-view text-right'>MeetingID</td>
						<td><?php echo $row['meetingID'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>MeetingName</td>
						<td><?php echo $row['meetingName'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>MeetingVersion</td>
						<td><?php echo $row['meetingVersion'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>AttendeePW</td>
						<td><?php echo $row['attendeePW'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>ModeratorPW</td>
						<td><?php echo $row['moderatorPW'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>WaitForModerator</td>
						<td><?php echo $row['waitForModerator'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Recorded</td>
						<td><?php echo $row['recorded'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User Member Manager</td>
						<td><?php echo $row['user_member_manager'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Max Number</td>
						<td><?php echo $row['max_number'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Start Date</td>
						<td><?php echo $row['start_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>End Date</td>
						<td><?php echo $row['end_date'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Salt</td>
						<td><?php echo $row['salt'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Urt</td>
						<td><?php echo $row['urt'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>ServerId</td>
						<td><?php echo $row['serverId'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>ServerIP</td>
						<td><?php echo $row['serverIP'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>ServerName</td>
						<td><?php echo $row['serverName'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
			</div>
		</div>		
	

	</div>
</div>
	  
<?php usort($tableGrid, "SiteHelpers::_sort") ;?>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> <?php echo  $pageTitle ;?> <small><?php echo $pageNote ;?></small></h3>
      </div>
	  
      <ul class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard') ;?>"> Dashboard </a></li>
        <li class="active"><?php echo $pageTitle ;?></li>
      </ul>
	  	  
    </div>
	
	<div class="page-content-wrapper">
	<div class="toolbar-line "> 
			<?php if($access['is_add'] ==1) : ?>
	   		<a href="<?php echo site_url('sximo/pages/add');?>" class="tips btn btn-xs btn-primary" title="Create"><i class="fa fa-plus"></i> Create </a>
			<?php endif;?>  
			<?php if($access['is_remove'] ==1) : ?>
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-xs btn-danger" title="Remove"><i class="fa fa-trash-o"></i> Remove </a>
			<?php endif;?> 			
	</div>		

		<?php echo $this->session->flashdata('message');?>
	
	<form class="form-horizontal" action="<?php echo site_url('sximo/pages/destroy/');?>" method="post" id="SximoTable">	
	 <div class="table-responsive">
    <table class="table table-striped  ">
        <thead>
		<tr>
			<th> No </th>
			<th> <input type="checkbox" class="checkall i-checks-all " /></th>
		 <?php foreach ($tableGrid as $t): ?>
		 	<?php if($t['view'] =='1') :  ?>
			 <th><?php echo  $t['label'] ;?></th>
			 <?php endif;?>
		  <?php endforeach;?>
		  	<th> Url </th>
			<th> Action </th>
           </tr>
        </thead>

        <tbody>
            <?php foreach ($rowData as $row):?>
                <tr>
					<td width="50"> <?php echo ++$i ;?> </td>
					<td width="50">
					<?php if($row->pageID !='1'): ?>
					<input type="checkbox" class="ids  i-checks" name="id[]" value="<?php echo $row->pageID ;?>" />  
					<?php endif; ?>
					</td>				
				 <?php foreach ($tableGrid as $field):?>
					 <?php if($field['view'] =='1'):?>
					 <td>					 
							<?php echo $row->$field['field'] ;?>	
											 
					 </td>
					 <?php endif;?>
					 			 
				<?php endforeach; ?>
				 <td > <a href="<?php echo ($row->alias =='home' ? site_url('') : site_url('/'.$row->alias)) ;?>" 
				 	target="_blank"> <small class="text-mute">
				 <?php echo ($row->alias =='home' ? site_url('') : site_url($row->alias)) ;?></small> </a> </td>	
				 <td>
				 	<?php
					if($access['is_edit'] ==1):?>
					<a href="<?php echo site_url('sximo/pages/add/'.$row->pageID);?>" class="tips btn btn-xs btn-success" title="Edit">
					<i class="fa fa-edit"></i></a>
					<?php endif;?>
				
				</td>		
                </tr>
           <?php endforeach;?>
			
              
        </tbody>
      
    </table>
	</div>
	</form>
	
	</div>
	
	</div>
</div>

  <?php usort($tableGrid, "SiteHelpers::_sort"); ?>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> <?php echo $pageTitle ?> <small><?php echo $pageNote ?></small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
        <li class="active"><?php echo $pageTitle ?></li>
      </ul>

    </div>


	<div class="page-content-wrapper m-t">
    <div class="toolbar-line ">		
		<?php
		if($this->access['is_excel'] ==1) : ?>	
		<a href="<?php echo site_url('{class}/download') ?>" class="tips btn btn-xs btn-default" title="Download">
		<i class="fa fa-download"></i>&nbsp;Download</a>
		<?php endif;
		if($this->session->userdata('gid') ==1) : ?>	
		<a href="<?php echo site_url('sximo/module/config/{class}') ?>" class="tips btn btn-xs btn-default"  title="Configuration">
		<i class="fa fa-cog"></i>&nbsp;Configuration</a>
		<?php endif; ?>		

	</div>
	<?php echo $this->session->flashdata('message');?>
	 <form action='<?php echo site_url('{class}/destroy') ?>' class='form-horizontal' id ='SximoTable' method="post" >
	 <div class="table-responsive">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th> No </th>
				<?php foreach ($tableGrid as $k => $t) : ?>
					<?php if($t['view'] =='1'): ?>
						<th><?php echo $t['label'] ?></th>
					<?php endif; ?>
				<?php endforeach; ?>
			  </tr>
        </thead>

        <tbody>
			<tr >
			<?php foreach ( $rowData as $i => $row ) : ?>
                <tr>
					<td width="50"> <?php echo ($i+1+$page) ?> </td>
				 <?php foreach ( $tableGrid as $j => $field ) : ?>
					 <?php if($field['view'] =='1'): ?>
					 <td>
					 	<?php if($field['attribute']['image']['active'] =='1'): ?>
							<?php echo SiteHelpers::showUploadedFile($row->$field['field'] , $field['attribute']['image']['path'] ) ?>
						<?php else: ?>
							<?php 
							$conn = (isset($field['conn']) ? $field['conn'] : array() ) ;
							echo SiteHelpers::gridDisplay($row->$field['field'] , $field['field'] , $conn ) ?>
						<?php endif; ?>
					 </td>
					 <?php endif; ?>
				 <?php endforeach; ?>
                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>
	</div>
	</form>
	
	<?php echo $this->load->view('footer');?>
	</div>
</div>

<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','<?php echo site_url("{class}/multisearch");?>');
		$('#SximoTable').submit();
	});
	
});	
</script>

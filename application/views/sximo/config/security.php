
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> SXIMO VERSION  <small><?php echo $this->lang->line('core.t_generalsetting'); ?> </small></h3>
      </div>


	  <ul class="breadcrumb">
		<li><a href="<?php echo site_url('dashboard');?>"><?php echo $this->lang->line('core.m_dashboard'); ?> </a></li>
		<li><a href="<?php echo site_url('sximo/config');?>"><?php echo $this->lang->line('core.t_generalsetting'); ?> </a></li>
	  </ul>

    </div>
 	<div class="page-content-wrapper m-t">
		<?php echo $this->session->flashdata('message');?>	
		<div class="block-content">
			<ul class="nav nav-tabs" style="margin-bottom:10px;">
				<li class=""><a href="<?php echo site_url('sximo/config');?>"><?php echo $this->lang->line('core.tab_siteinfo'); ?> </a></li>
				<li ><a href="<?php echo site_url('sximo/config/email');?>" ><?php echo $this->lang->line('core.t_emailtemplate'); ?> </a></li>
				<li class="active"><a href="<?php echo site_url('sximo/config/security');?>"><?php echo $this->lang->line('core.tab_security'); ?> </a></li>
			</ul>

			<div class="tab-content m-t">
			  <div class="tab-pane active use-padding" id="info">

<div class="sbox m-t">
	<div class="sbox-title"><h5>   </h5></div>
	<div class="sbox-content">	

			 <form class="form-horizontal row" action="<?php echo site_url('sximo/config/postSecurity');?>" method="post">

	<div class="col-sm-12">
		<fieldset > 
			<legend><?php echo $this->lang->line('core.fr_securetools'); ?> </legend>

		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-3"><?php echo $this->lang->line('core.fr_recaptcha'); ?> </label>
			<div class="col-sm-8">
					<label class="checkbox">
						<input type="checkbox" name="cnf_recaptcha" value="true"  <?php if(CNF_RECAPTCHA =='true') echo 'checked';?>/>
						<?php echo $this->lang->line('core.enable'); ?>
					</label>
					
			</div>
			</div>

		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-3">Public Key </label>
			<div class="col-sm-8">
				<input class="form-control input-sm" type="" name="cnf_recaptcha_public" value="<?php echo CNF_RECAPTCHA_PUBLIC ?>" placeholder="public key" />
			</div>
			</div>

		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-3">Private Key </label>
			<div class="col-sm-8">
				<input type="" class="form-control" name="cnf_recaptcha_private" value="<?php echo CNF_RECAPTCHA_PRIVATE ?>" placeholder="private key" />
			</div>
			</div>


		</fieldset>

	</div>

	<div class="col-sm-12">


			<fieldset>
				<legend><?php echo $this->lang->line('core.fr_sociallogin'); ?> </legend>

			  <div class="form-group">
					<label for="ipt" class=" control-label col-sm-3"><?php echo $this->lang->line('core.fr_loginfb'); ?> </label>
					<div class="col-sm-8">
						<label class="checkbox">
							<input type="checkbox" name="cnf_loginfb" value="true"  <?php if(CNF_LOGINFB =='true') echo 'checked';?>/>
							<?php echo $this->lang->line('core.enable'); ?>
						</label>
						Api Documentation : <a href="https://developers.facebook.com/apps" target="_blank"> https://developers.facebook.com/apps </a> 
					</div>
				</div>
					
				<div class="form-group">
					<label for="ipt" class=" control-label col-sm-3">Id </label>
					<div class="col-sm-8">
						<input class="form-control input-sm" type="" name="cnf_loginfb_id" value="<?php echo CNF_LOGINFB_ID ?>" placeholder="key id" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="ipt" class=" control-label col-sm-3">Secret </label>
					<div class="col-sm-8">
						<input class="form-control input-sm" type="" name="cnf_loginfb_secret" value="<?php echo CNF_LOGINFB_SECRET ?>" placeholder="key secret" />
					</div>
				</div>
				
			  <div class="form-group">
					<label for="ipt" class=" control-label col-sm-3"><?php echo $this->lang->line('core.fr_logingg'); ?> </label>
					<div class="col-sm-8">
						<label class="checkbox">
							<input type="checkbox" name="cnf_logingg" value="true"  <?php if(CNF_LOGINGG =='true') echo 'checked';?>/>
							<?php echo $this->lang->line('core.enable'); ?>
						</label>
						Api Documentation : <a href="https://code.google.com/apis/console/" target="_blank"> https://code.google.com/apis/console/ </a> 
					</div>
				</div>
				
				<div class="form-group">
					<label for="ipt" class=" control-label col-sm-3">Id </label>
					<div class="col-sm-8">

						<input class="form-control input-sm" type="" name="cnf_logingg_id" value="<?php echo CNF_LOGINGG_ID ?>" placeholder="key id" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="ipt" class=" control-label col-sm-3">Secret </label>
					<div class="col-sm-8">
						<input class="form-control input-sm" type="" name="cnf_logingg_secret" value="<?php echo CNF_LOGINGG_SECRET ?>" placeholder="key secret" />
					</div>
				</div>
				
				
			  <div class="form-group">
					<label for="ipt" class=" control-label col-sm-3"><?php echo $this->lang->line('core.fr_logintw'); ?> </label>
					<div class="col-sm-8">
						<label class="checkbox">
							<input type="checkbox" name="cnf_logintw" value="true"  <?php if(CNF_LOGINTW =='true') echo 'checked';?>/>
							<?php echo $this->lang->line('core.enable'); ?>
						</label>
						Api Documentation : <a href="https://dev.twitter.com/apps" target="_blank"> https://dev.twitter.com/apps</a> 
					</div>
				</div>

				<div class="form-group">
					<label for="ipt" class=" control-label col-sm-3">Id </label>
					<div class="col-sm-8">
						<input class="form-control input-sm" type="" name="cnf_logintw_id" value="<?php echo CNF_LOGINTW_ID ?>" placeholder="key id" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="ipt" class=" control-label col-sm-3">Secret </label>
					<div class="col-sm-8">
						<input class="form-control input-sm" type="" name="cnf_logintw_secret" value="<?php echo CNF_LOGINTW_SECRET ?>" placeholder="key secret" />
					</div>
				</div>
				
				
				
			</fieldset>

			<div class="form-group">
				<label for="ipt" class=" control-label col-md-3"> </label>
				<div class="col-md-8">
					<button class="btn btn-primary" type="submit"><?php echo $this->lang->line('core.sb_savechanges'); ?> </button>
			 </div>
			</div>

	</div>
	</form>
	</div>
</div>	
</div>
</div>
</div>
</div>







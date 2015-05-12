<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3><?php echo $this->lang->line('core.m_blastemail'); ?> <small> Send Bulk Email</small></h3>
      </div>

      <ul class="breadcrumb">
    <li><a href="<?php echo site_url('dashboard');?>"><?php echo $this->lang->line('core.m_dashboard'); ?> </a></li>
    <li class="active"><?php echo $this->lang->line('core.m_blastemail'); ?> </li>
      </ul>
    </div>
  
 <div class="page-content-wrapper m-t">  
    <!-- Start blast email -->
    <?php echo $this->session->flashdata('message');?>
  <form class="form-horizontal" action="<?php echo site_url('sximo/config/doblast');?>" method="post" parsley-validate novalidate >
      
    <div class="col-sm-6">
          <div class="form-group  " >
          <label for="ipt" class=" control-label col-md-3"><?php echo $this->lang->line('core.fr_emailsubject'); ?> </label>
          <div class="col-md-9">
          <input type="text" name="subject" class="form-control" required="true" />
           </div> 
          </div> 
          <div class="form-group  " >
          <label for="ipt" class=" control-label col-md-3"><?php echo $this->lang->line('core.fr_emailsendto'); ?> </label>
          <div class="col-md-9">
           <?php foreach($groups->result() as $row) {?>
            <label class="checkbox">
                <input type="checkbox" required  name="groups[]" value="<?php echo  $row->group_id;?>" /> <?php echo $row->name ;?>
            </label>
      <?php } ?>  
           </div> 
          </div>        
      
</div>
<div class="col-sm-6">
          <div class="form-group  " >
          <label for="ipt" class=" control-label col-md-3"><?php echo $this->lang->line('core.status'); ?> </label>
          <div class="col-md-9">          
            <label class="radio">
              <input type="radio" required  name="uStatus" value="all" > All Status
            </label>
            <label class="radio">
              <input type="radio" required name="uStatus" value="1" > Active 
            </label>  
            <label class="radio">
              <input type="radio" required name="uStatus" value="0" > Unconfirmed
            </label>
            <label class="radio">
              <input type="radio" required name="uStatus" value="2"> Blocked
            </label>                                
           </div> 
          </div>  
</div>
 
 <div class="col-sm-12">


 
          <div class="form-group "  >
         
          <div style=" padding:10px;">
       <label for="ipt" class=" control-label "><?php echo $this->lang->line('core.fr_emailmessage'); ?> </label>
           <textarea class="form-control markItUp" rows="15" required name="message"></textarea> 
       </div>
           <p><?php echo $this->lang->line('core.t_availfield'); ?> :  : </p>
           <small> [fullname] [first_name] [last_name] [email]  </small>
         
          </div> 

            
                    

          
          <div class="form-group" >
          <label for="ipt" class=" control-label col-md-3"> </label>
          <div class="col-md-9">
              <button type="submit" name="submit" class="btn btn-primary"><?php echo $this->lang->line('core.t_sendbulkemail'); ?> </button>
           </div> 
          </div> 
  </div>                     
    </form>


    <!-- / blast email -->

</div>




</div>      



<section class="gray-section contact" id="contact">
    <div class="container">
        <div class="row m-b-lg animated fadeInDown delayp1">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Liên hệ</h1>
                <p>Nếu có bất kỳ câu hỏi nào vui lòng liên hệ với chúng tôi.</p>
            </div>
        </div>
        
		
            <div class="row text-center">
                <div class="contact-form col-md-6 col-sm-12 col-xs-12 col-md-offset-3 animated fadeInUp delayp3" style="opacity: 0;">
                    <?php echo $this->session->flashdata('message');?>
                    <ul class="parsley-error-list">
                        <?php echo $this->session->flashdata('errors');?>
                    </ul>                        
                    <form class="form" action="<?php echo site_url('page/submitcontact');?>"  method="post" enctype="multipart/form-data">                
                        <div class="form-group name">
                            <label for="name" class="sr-only">Name</label>
                            <input type="text" placeholder="Name:" class="form-control" name="name">
                        </div><!--//form-group-->
                        <div class="form-group email">
                            <label for="email" class="sr-only">Email</label>
                            <input type="text" placeholder="Email:" class="form-control" name="email">
                        </div><!--//form-group-->
                        <div class="form-group message">
                            <label for="message" class="sr-only">Nội dung</label>
                            <textarea placeholder="Message:" rows="6" class="form-control" name="message"></textarea>
                        </div><!--//form-group-->
                        <button class="btn btn-sm btn-primary" type="submit">Send us mail</button>
                    </form><!--//form-->                 
                </div><!--//contact-form-->
            </div><!--//row-->
		
        <div class="row">
            <div class="col-lg-12 text-center">

                <p class="m-t-sm">
                  
                </p>
                <ul class="list-inline social-icon">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg animated fadeInUp delayp1">
                <p><strong>&copy; 2015 Open meeting</strong><br> </p>
            </div>
        </div>
    </div>
</section>
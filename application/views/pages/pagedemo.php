<section class="gray-section contact" id="contact">
    <div class="container">
        <div class="row m-b-lg animated fadeInDown delayp1">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Try demo</h1>
                <p>Nhập tên đang nhập bạn muốn thử vào ô dưới và lựa chọn loại tham gia.</p>
            </div>
        </div>
        
		
            <div class="row text-center">
                <div class="contact-form col-md-6 col-sm-12 col-xs-12 col-md-offset-3 animated fadeInUp delayp3" style="opacity: 0;">
                    <?php echo $this->session->flashdata('message');?>
                    <ul class="parsley-error-list">
                        <?php echo $this->session->flashdata('errors');?>
                    </ul>                        
                    <form class="form" action="<?php echo site_url('page/demo');?>"  method="post" enctype="multipart/form-data">                
                        <div class="form-group name">
                            <label for="name" class="sr-only">Tên đăng nhập</label>
                            <input type="text" placeholder="Name:" class="form-control" name="name">
                            <br/>
                            
                            <label for="Nghe">Người nghe:</label><input type="radio" name="Nghe" class="radio-group" checked="true" >
                            <label for="Trinhbay"> Người trình bày:<label><input type="radio" name="Nghe" class="radio-group">
                           
                        </div><!--//form-group-->
                        <button class="btn btn-sm btn-primary" type="submit">Vào phòng</button>
                    </form><!--//form-->                 
                </div><!--//contact-form-->
            </div><!--//row-->
		
    </div>
</section>
<?php if(!empty($fasilitas)) { ?>
<section id="facilities" class="home-section paddingbot-30">
	<div class="container marginbot-50">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow fadeInDown" data-wow-delay="0.1s">
				<div class="section-heading text-center">
				<h2 class="h-bold">Fasilitas Kami</h2>
				<div class="divider-short"></div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
        	<div class="col-sm-12 col-md-12 col-lg-12" >
				<div class="wow bounceInUp" data-wow-delay="0.2s">
					<div id="owl-works" class="owl-carousel">
						<?php 
						foreach ($fasilitas as $f) {
							?>
							<div class="item">
						    	<a href="<?php echo base_url() ."images/fasilitas/original/" .$f->fasilitas_img; ?>" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="<?php echo base_url() ."images/fasilitas/original/" .$f->fasilitas_img; ?>">
						    	<img src="<?php echo base_url() ."images/fasilitas/thumb/thumb_" .$f->fasilitas_img; ?>" class="img-responsive" alt="img">
						    	</a>
						    </div>
							<?php
						}
						?>
					    
					    <!--div class="item">
					    	<a href="<?php// echo base_url() ."medicio/"; ?>img/photo/2.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="<?php ////echo base_url() ."medicio/"; ?>img/works/2@2x.jpg">
					    <img src="<?php //echo base_url() ."medicio/"; ?>img/photo/2.jpg" class="img-responsive " alt="img"></a>
					    </div>
					    <div class="item">
					    	<a href="<?php //echo base_url() ."medicio/"; ?>img/photo/3.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="<?php //echo base_url() ."medicio/"; ?>img/works/3@2x.jpg">
					    <img src="<?php //echo base_url() ."medicio/"; ?>img/photo/3.jpg" class="img-responsive " alt="img"></a>
					    </div>
					    <div class="item">
					    	<a href="<?php //echo base_url() ."medicio/"; ?>img/photo/4.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="<?php //echo base_url() ."medicio/"; ?>img/works/4@2x.jpg">
					    <img src="<?php //echo base_url() ."medicio/"; ?>img/photo/4.jpg" class="img-responsive " alt="img"></a>
					    </div>
					    <div class="item">
					    	<a href="<?php //echo base_url() ."medicio/"; ?>img/photo/5.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="<?php //echo base_url() ."medicio/"; ?>img/works/5@2x.jpg">
					    <img src="<?php //echo base_url() ."medicio/"; ?>img/photo/5.jpg" class="img-responsive " alt="img"></a>
					    	</div>
					    <div class="item">
					    	<a href="<?php //echo base_url() ."medicio/"; ?>img/photo/6.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="<?php //echo base_url() ."medicio/"; ?>img/works/6@2x.jpg">
					    <img src="<?php //echo base_url() ."medicio/"; ?>img/photo/6.jpg" class="img-responsive " alt="img"></a>
					    </div-->
					</div>
				</div>
            </div>
        </div>
	</div>
</section>
<?php } ?>
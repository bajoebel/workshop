<section id="partner" class="home-section paddingbot-60">	
	<div class="container marginbot-50">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h2 class="h-bold">Partner Kami</h2>
						<p></p>
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<?php 
			foreach ($partner as $p) {
				?>
				<div class="col-sm-6 col-md-2">
					<div class="partner">
						<a href="<?php echo $p->partner_link ?>"><img src="<?php echo base_url() ."images/partner/" .$p->partner_logo; ?>" alt="" style="width:180px;" /></a>
					</div>
				</div>
				<?php
			}
			?>
			<!--div class="col-sm-6 col-md-3">
				<div class="partner">
					<a href="#"><img src="<?php //echo base_url() ."medicio/"; ?>img/dummy/partner-1.jpg" alt="" /></a>
				</div>
			</div>
			
			<div class="col-sm-6 col-md-3">
				<div class="partner">
					<a href="#"><img src="<?php //echo base_url() ."medicio/"; ?>img/dummy/partner-2.jpg" alt="" /></a>
				</div>
			</div>
			
			<div class="col-sm-6 col-md-3">
				<div class="partner">
					<a href="#"><img src="<?php //echo base_url() ."medicio/"; ?>img/dummy/partner-3.jpg" alt="" /></a>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="partner">
					<a href="#"><img src="<?php //echo base_url() ."medicio/"; ?>img/dummy/partner-4.jpg" alt="" /></a>
				</div>
			</div-->
		</div>
    </div>
</section>	
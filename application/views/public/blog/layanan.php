<section id="service" class="home-section nopadding paddingtop-80">
	<div class="container">
		
		<div class="row">
			<div class="col-md-12">
				<div class="callaction bg-gray">
					<div class="row">
						<div class="col-md-8">
							<div class="wow fadeInUp" data-wow-delay="0.1s">
								<div class="cta-text">
									<h3>Apakah anda ingin dapat pelayanan cepat tanpa harus antri di pagi hari? anda butuh bantuan kami?</h3>
									<p>Smart hospital bisa membantu anda untuk membooking antrian terlebih dahulu sehingga anda tidak perlu datang terburu buru kerumah sakit </p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="wow lightSpeedIn" data-wow-delay="0.1s">
								<div class="cta-btn">
								<a href="<?php echo base_url() ."home"; ?>" class="btn btn-skin btn-lg">Smart Hospital</a>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12">&nbsp;</div>
			<div class="col-sm-6 col-md-6">
				<div class="wow fadeInUp" data-wow-delay="0.2s">
					<center>
						<img src="<?php echo base_url() ."images/dokter/contoh.jpg"; ?><?php //echo base_url() ."images/dokter/test.jpg"; ?>" class="img-responsive" alt="" width="70%"/>
					</center>
				</div>
            </div>
			<div class="col-sm-3">
            	<?php 
            	$i=0;
            	foreach ($layanan as $l) {
            		$i++;
            		?>
            		<div class="wow fadeInRight" data-wow-delay="0.1s">
		                <div class="service-box">
							<div class="service-icon">
								<span class="fa <?php echo $l->layanan_icon ?> fa-3x"></span> 
							</div>
							<div class="service-desc">
								<h5 class="h-light"><?php echo $l->layanan_nama ?></h5>
								<p><?php echo $l->layanan_desc ?></p>
							</div>
		                </div>
					</div>
            		<?php
            		if($i%3==0){
            			echo "</div><div class=\"col-sm-3\">";
            		}
            	} 
            	?>
            </div>
        </div>	
    </div>
</section>
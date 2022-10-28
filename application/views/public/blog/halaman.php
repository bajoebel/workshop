<section id="partner" class="page-section paddingtop-100">	
	
	<div class="container">
		<div class="row">
			<?php if(!empty($halaman)) { ?>
			<div class="col-md-9">
				<div class="judul">
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2">
							<div class="wow lightSpeedIn" data-wow-delay="0.1s">
								<div class="section-heading text-center">
									<h4 class="h-bold">
										<?php 
											echo $halaman->post_judul;
										?>
									</h4>
									
								</div>
							</div>
							<div class="divider-short"></div>
						</div>
					</div>
					
				</div>
				<div class="isi">
					<?php 
						echo $halaman->post_isi;
					?>
				</div>
			</div>

			<div class="col-md-3">
				<a href="<?php echo base_url() ."home"; ?>" class="btn btn-default btn-lg btn-block"><img src="<?php echo base_url() ."images/stikerrsudpp.png"; ?>" class="img img-responsive"> </a>
				<a href="<?php echo base_url() ."saluran-pengaduan" ?>" class="btn btn-default btn-lg btn-block"><img src="<?php echo base_url()."images/banner/pengaduan.png"; ?>" class="img img-responsive" ></a>
				<a href="<?php echo base_url() ."kritik-saran" ?>" class="btn btn-default btn-lg btn-block"><img src="<?php echo base_url()."images/banner/kritik_dan_saran.png"; ?>" class="img img-responsive"></a>
				<a href="https://lpse.lkpp.go.id" class="btn btn-default btn-lg btn-block"><!--img src="<?php echo base_url()."images/logo/lpse-logo.png"; ?>" class="img img-responsive"-->PPID</a>
				<a href="https://lpse.lkpp.go.id" class="btn btn-default btn-lg btn-block"><!--img src="<?php echo base_url()."images/logo/lpse-logo.png"; ?>" class="img img-responsive"-->DOWNLOAD</a>
				<a href="https://lpse.lkpp.go.id" class="btn btn-default btn-lg btn-block"><img src="<?php echo base_url()."images/logo/lpse-logo.png"; ?>" class="img img-responsive"></a>
				<div style="padding: 2px;border-top: 1px solid #deece4;border-collapse: collapse;"></div>
				<div class="sidebar">
					<div class="sidebar-title">Sertifikat Akreditasi</div>
					<div class="sidebar-content">
						<img src="<?php echo base_url() ."images/logopdgpjg.png" ?>" class="img img-responsive" />
					</div>
					<div class="sidebar-footer"></div>
				</div>
				<div class="sidebar">
					<div class="sidebar-title">Statistik</div>
					<div class="sidebar-content">

						<!--img src="<?php //echo base_url() ."images/logopdgpjg.png" ?>" class="img img-responsive" /-->
					</div>
					<div class="sidebar-footer"></div>
				</div>
			</div>
			<?php }else{ ?>
			<div class="col-sm-12">
				<div class="judul">
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2">
							<div class="wow lightSpeedIn" data-wow-delay="0.1s">
								<div class="section-heading text-center">
									<h4 class="h-bold">
										<h1>Maaf Kontent Tidak Tersedia</h1>
									</h4>
									
								</div>
							</div>
							<div class="divider-short"></div>
						</div>
					</div>
					
				</div>
				
			</div>
			<?php } ?>
		</div>
    </div>
</section>	
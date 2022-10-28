<?php if(!empty($halaman)) { ?>
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
		$tgl=explode(' ', $halaman->post_tanggal);
		$tgl_exp=explode('-', $tgl[0]);
		$link=base_url() .$tgl_exp[2] ."/" .$tgl_exp[1] ."/" .$tgl_exp[0] ."/" .$halaman->post_link;
		?>
		
		<?php 
		if(!empty($halaman->post_image)) {
			?>
			<img data-attachment-id="1591" data-permalink="<?php echo base_url() ."images/blog/original/" .$halaman->post_image; ?>" data-orig-file="<?php echo base_url() ."images/blog/original/" .$halaman->post_image; ?>" data-orig-size="960,639" data-comments-opened="1" data-image-meta="{" aperture":"0","credit":"","camera":"","caption":"","created_timestamp":"0","copyright":"","focal_length":"0","iso":"0","shutter_speed":"0","title":"","orientation":"0"}"="" data-image-title="<?php echo $halaman->post_image; ?>" data-image-description="" data-medium-file="<?php echo base_url() ."images/blog/original/" .$halaman->post_image; ?>" data-large-file="<?php echo base_url() ."images/blog/original/" .$halaman->post_image; ?>" class="img img-thumbnail" src="<?php echo base_url() ."images/blog/thumb/THUMB_" .$halaman->post_image; ?>" alt="" style="width: 100%;">
			<?php
		}
		echo $halaman->post_isi;
		if($halaman->post_status_komen=="Aktif"){
			$komentar=$this->Welcome_model->getKomentar($halaman->post_id);
			echo "<div id='komentar' class='bubble-list'>";
			foreach ($komentar as $kom) {
				?>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 ">
						<div class="bubble">
							<div class="col-md-2 col-sm-2 col-xs-2"><img src="<?php echo base_url() ."images/bubbles-icon.png" ?>"></div>
							<div class="col-md-10 col-sm-10 col-xs-10">
								<div class="bubble-content">
									<div class="point"></div>
									<div class="sidebar-title"><?php echo $kom->komentar_nama; ?></div>
									<p><?php echo  $kom->komentar_isi; ?></p>
								</div>
							</div>
							
						</div>

					</div>
				</div>
					
				
				<?php 
			}
			echo "</div>";
			?>
			<div class="row">
				<div class="col-md-12">
				<div class="box">
					<h3 class="sidebar-title">Komentar</h3>
					<form class="lead" method="POST" id="form" action="#">
						<div class="form-group">
							<div class="">
								<input type="hidden" name="post_id" id="post_id" value="<?php echo $halaman->post_id ?>">
								<input type="email" name="email" id="email" class="form-control input-md" value="" placeholder="Email" style="width: 100%">
							</div>
						</div>
						<div class="form-group">
							<div class="">
								<input type="text" name="nama" id="nama" class="form-control input-md" placeholder="Nama" style="width: 100%">
							</div>
						</div>
						<div class="form-group">
							<div class="form-input">
								<textarea name="komentar" id="komentar_isi" class="form-control" rows="5" placeholder="Komentar"></textarea>
							</div>
						</div>
						<div class="form-group" style="text-align: right;"> 
							<button class="btn btn-success" type="button" onclick="insertKomentar()">Submit</button>
						</div>

					</form>
				</div>
				</div>
			</div>
			
			<?php 
		}
		?>
	</div>
<?php } else{ ?>
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
<?php } ?>
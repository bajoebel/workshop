<?php if(!empty($media)) { ?>
	<div class="judul">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h4 class="h-bold">
						PPID
						</h4>
							
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>	
	</div>
	<div class="isi">
		<div class="row">
			<div class="col-md-12">
				<form>
					<div class="col-md-12">
					  <div class="input-group">
					  	<input type="hidden" name="dir_id" id="dir_id" value="0">
					    <input type="text" class="form-control" id="qmedia" placeholder="Search" onkeyup="getMedia_download(0)">
					    <div class="input-group-btn">
					      <button class="btn btn-success" type="button" onclick="getMedia_download(0)">
					        <i class="fa fa-search"></i>
					      </button>
					    </div>
					  </div>
					</div>
				</form>
				<br>&nbsp;
			</div>
		</div>
		<div id="media">
			<div class="row">
			<?php 
			//print_r(expression)
			

			if(empty($dir)){
				foreach ($media as $med) {
					if(!empty($med->dir_id)){
						?>
						<div class="col-md-4" style="text-align: center;">
						    <a href="#" onclick="openDir('<?php echo $med->dir_id ?>')">
						        <img src="<?php echo base_url() ."rsud-backend/public/img/media/folder.png" ?>">
						        <?php echo $med->dir_nama; ?>
						    </a>
						    
						</div>
						<?php
					}
				}
			}else{
				foreach ($media as $med) {
					if(!empty($med->dir_id)){
						$file=explode('.', $med->media_namafile);
						echo end($file);
						//print_r($file);
						?>
						<div class="col-md-4" style="text-align: center;">
						    <a href="#" onclick="openDir('<?php echo $med->dir_id ?>')">
						        <img src="<?php echo base_url() ."images/media/thumb/thumb_" .$med->media_namafile ?>">
						        <?php echo $med->media_keterangan; ?>
						    </a>
						    
						</div>
						<?php
					}
				}
			}
			?>

			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><div class="col-md-12"><div id="halaman"></div></div></div>
		</div>
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



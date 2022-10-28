<div class="box">
	<div class="sidebar-title"><b>Berita Terkini</b></div>
	<?php 
		foreach ($data as $row) {
			$tgl=explode(' ', $row->post_tanggal);
			$tgl_exp=explode('-', $tgl[0]);
			$link=base_url() .$tgl_exp[2] ."/" .$tgl_exp[1] ."/" .$tgl_exp[0] ."/" .$row->post_link;
			?>
			<div class="box-content">
				<div class="row">
					<div class="box-desc">
						<div class="box-img">
							<a href="<?php echo $link; ?>">
								<img src="<?php if(empty($row->post_image)) echo base_url() ."images/logopdgpjg.png"; else echo base_url() ."images/blog/thumb/THUMB_" .$row->post_image; ?>" class='img img-responsive'>
							</a>
						</div>
						<div class="desc">
							<div class="title"><a href="<?php echo $link; ?>"><b><?php echo $row->post_judul ?></b></a></div>
							
							<!--a href="<?php //echo $link; ?>"><b>RSUD Kota Padang Panjang <i><?php //echo $this->load_model->getDay($row->post_tanggal) ." - " .$this->load_model->longdate($row->post_tanggal); ?></i></b></a-->
							<?php echo substr(strip_tags($row->post_isi), 0,250); ?>...<br>
							
							<a href="<?php echo $link ?>" class="">Selanjutnya...</a>
							<div class="kaki">
								<a href="<?php echo $link ?>"><span class="fa fa-calendar"> </span> <?php echo $this->load_model->getDay($row->post_tglpublish) ." - " .$this->load_model->longdate($row->post_tglpublish) ; ?></a>
								<a href="<?php echo $link ?>"><span class="fa fa-eye"> </span> <?php echo $row->post_statistik; ?></a>
								<a href="<?php echo $link ?>"><span class="fa fa-comment"> </span> <?php echo $row->jml_komentar; ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	?>
	<div class="row">
		<?php 

		if($row_count>$limit){
			$lanjut=$start+$limit;
			$kembali=$start-$limit;
			$offset=$row_count%$limit;
			if($start==0){
				?>
				<div class="col-md-12">
					<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: right;"><a href="<?php echo base_url() ."?start=" .$lanjut ?>" class='btn btn-success btn-xs'> Selanjutnya</a></div>
				</div>
				<?php
			}else{
				if($start<$limit){
					?>
					<div class="col-md-12">
						<div class="col-md-6 col-sm-6 col-xs-6"><a href="<?php echo base_url()  ?>" class='btn btn-success btn-xs'> Sebelumnya</a></div>
						<div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;"><a href="<?php echo base_url() ."?start=" .$lanjut ?>" class='btn btn-success btn-xs'> Selanjutnya</a></div>
					</div>
					<?php
				}else{
					$a=$start+$offset;
					//echo "A : " .$a;
					//echo '<br>NUM ROWS ' .$row_count;
					if($a==$row_count){
						?>
						<div class="col-md-12">
							<div class="col-md-12 col-sm-12 col-xs-12"><a href="<?php echo base_url() ."?start=" .$kembali  ?>" class='btn btn-success btn-xs'> Sebelumnya</a></div>
						</div>
						<?php
					}else{
						?>
						<div class="col-md-12">
							<div class="col-md-6 col-sm-6 col-xs-6"><a href="<?php echo base_url() ."?start=" .$kembali  ?>" class='btn btn-success btn-xs'> Sebelumnya</a></div>
							<div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;"><a href="<?php echo base_url() ."?start=" .$lanjut ?>" class='btn btn-success btn-xs'> Selanjutnya</a></div>
						</div>
						<?php
					}
				}
			}
			?>
			
			<?php 
		} 
		?>
	</div>
	
</div>
<?php if(!empty($jadwal)) { ?>
	<div class="judul">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow lightSpeedIn" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h4 class="h-bold">
						Jadwal Dokter
						</h4>
							
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>	
	</div>
	<div class="isi">
		<table class="table table-bordered">
			<tr>
				<td>No</td>
				<td>Nama Dokter</td>
				<td>Senin</td>
				<td>Selasa</td>
				<td>Rabu</td>
				<td>Kamis</td>
				<td>Jumat</td>
				<td>Sabtu</td>
			</tr>
			<?php 
			$start=0;
			$poly="";
			foreach ($jadwal as $j) {
				
				if($poly==""){
					$start=1;
					?>
					<tr>
						<th colspan="8">
							<b><?= $j->poly_nama; ?></b>
						</th>
					</tr>
					<tr>
						<td><?= $start ?></td>
						<td><?= $j->dokter_nama ?></td>
						<td <?php if(empty($j->senin) ) echo "style='background:#093;'"; ?>><?= $j->senin ?></td>
						<td <?php if(empty($j->selasa) ) echo "style='background:#093;'"; ?>><?= $j->selasa ?></td>
						<td <?php if(empty($j->rabu) ) echo "style='background:#093;'"; ?>><?= $j->rabu ?></td>
						<td <?php if(empty($j->kamis) ) echo "style='background:#093;'"; ?>><?= $j->kamis ?></td>
						<td <?php if(empty($j->jumat) ) echo "style='background:#093;'"; ?>><?= $j->jumat ?></td>
						<td <?php if(empty($j->sabtu) ) echo "style='background:#093;'"; ?>><?= $j->sabtu ?></td>
					</tr>
					<?php
					$poly=$j->poly_nama;
				}else{
					if($poly==$j->poly_nama){
						$start++;
						?>
						<tr>
							<td><?= $start ?></td>
							<td><?= $j->dokter_nama ?></td>
							<td <?php if(empty($j->senin) ) echo "style='background:#093;'"; ?>><?= $j->senin ?></td>
							<td <?php if(empty($j->selasa) ) echo "style='background:#093;'"; ?>><?= $j->selasa ?></td>
							<td <?php if(empty($j->rabu) ) echo "style='background:#093;'"; ?>><?= $j->rabu ?></td>
							<td <?php if(empty($j->kamis) ) echo "style='background:#093;'"; ?>><?= $j->kamis ?></td>
							<td <?php if(empty($j->jumat) ) echo "style='background:#093;'"; ?>><?= $j->jumat ?></td>
							<td <?php if(empty($j->sabtu) ) echo "style='background:#093;'"; ?>><?= $j->sabtu ?></td>
						</tr>
						<?php
						$poly=$j->poly_nama;
					}else{
						$start=1;
						?>
						<tr>
							<th colspan="8">
								<b><?= $j->poly_nama; ?></b>
							</th>
						</tr>
						<tr>
							<td><?= $start ?></td>
							<td><?= $j->dokter_nama ?></td>
							<td <?php if(empty($j->senin) ) echo "style='background:#093;'"; ?>><?= $j->senin ?></td>
							<td <?php if(empty($j->selasa) ) echo "style='background:#093;'"; ?>><?= $j->selasa ?></td>
							<td <?php if(empty($j->rabu) ) echo "style='background:#093;'"; ?>><?= $j->rabu ?></td>
							<td <?php if(empty($j->kamis) ) echo "style='background:#093;'"; ?>><?= $j->kamis ?></td>
							<td <?php if(empty($j->jumat) ) echo "style='background:#093;'"; ?>><?= $j->jumat ?></td>
							<td <?php if(empty($j->sabtu) ) echo "style='background:#093;'"; ?>><?= $j->sabtu ?></td>
						</tr>
						<?php
						$poly=$j->poly_nama;
					}
				}
			}
			?>
			<tr>
				<th colspan="8">
					<b>Konseris</b>
				</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Ahmad Kamil S.Sos</td>
				<td >10:00 s/d 12:00</td>
				<td >10:00 s/d 12:00</td>
				<td >10:00 s/d 12:00</td>
				<td >10:00 s/d 12:00</td>
				<td >10:00 s/d 12:00</td>
				<td style='background:#093;'></td>
			</tr>
		</table>
		
		<?php 
		
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
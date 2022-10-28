<section id="partner" class="page-section <?php if(empty($slider)) echo "paddingtop-100"; ?>">	
	
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div id="content">
					<?php if(!empty($isi)) echo $isi ?>
				</div>
			</div>

			<div class="col-md-3">
				<div class="sidebar">
					<form>
					  <div class="input-group">
					    <input type="text" class="form-control input-sm" id="q" placeholder="Search">
					    <div class="input-group-btn">
					      <button class="btn btn-success" type="button" onclick="cari()">
					        <i class="fa fa-search"></i>
					      </button>
					    </div>
					  </div>
					</form> 
				</div>
					
				<?php 
				$banner=$this->Welcome_model->getBanner();
				foreach ($banner as $b) {
					?>
					<a href="<?php echo $b->banner_link; ?>" class="btn btn-default btn-lg btn-block" target="_blank"><img src="<?php echo base_url() ."rsud-backend/public/img/logo/" .$b->banner_img; ?>" class="img img-responsive"> </a>
					<?php
				}
				?>
				
				<div style="padding: 2px;border-top: 1px solid #deece4;border-collapse: collapse;"></div>
				<div class="sidebar" style="margin-top: 20px;">
					<div class="sidebar-title" style="text-align: center;"><b>Sertifikat & Penghargaan</b></div>
					<div class="sidebar-content">
						<img src="<?php echo base_url() ."rsud-backend/public/img/logo/Sertifikat_Akreditasi.jpg" ?>" class="img img-responsive" /><hr>
						<img src="<?php echo base_url() ."rsud-backend/public/img/logo/pelayanan-publik.jpg" ?>" class="img img-responsive" />
					</div>
					<div class="sidebar-footer"></div>
				</div>
				<!--div class="sidebar">
					<div class="sidebar-title">Statistik</div>
					<div class="sidebar-content">
					</div>
					<div class="sidebar-footer"></div>
				</div-->
				
			</div>
			<div class="row">&nbsp;-<div class="col-md-12"></div></div>
			
		</div>
    </div>
</section>	
<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url() ."js/app/blog.js"; ?>"></script>

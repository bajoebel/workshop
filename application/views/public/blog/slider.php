<section id="intro" class="home-section paddingtop" style="width: 100%;">
	<!--div class="container">
		<div class="row"-->
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<?php 
				$indikator="";
				$img="";
				$i=0;
				foreach ($slider as $row) {
					$i++;
					if($i==1) {
						$indikator.='<li data-target="#myCarousel" data-slide-to="' .$i .'" class="active"></li>';
						$img.='
							<div class="item active">
				    			<img src="' .base_url() ."images/slider/original/" .$row->slider_img .'" alt="' .$row->slider_img .'" class="img-slider">
				  			</div>';
					}
					else {
						$indikator.='<li data-target="#myCarousel" data-slide-to="' .$i .'" class=""></li>';
						$img.='
							<div class="item">
				    			<img src="' .base_url() ."images/slider/original/" .$row->slider_img .'" alt="' .$row->slider_img .'" class="img-slider">
				  			</div>';
					}
				}
				?>
				<ol class="carousel-indicators">
				  	<?php echo $indikator; ?>
				</ol>
				
				<div class="carousel-inner">
					<?php echo $img; ?>
				</div>
			</div>
		<!--/div>
			
	</div-->
</section>
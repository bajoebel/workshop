<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>images/padangpanjang.png">
	<title><?php echo instansi(); ?></title>

	<!-- css -->
	<link href="<?php echo base_url() . "medicio/"; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() . "medicio/"; ?>font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . "medicio/"; ?>plugins/cubeportfolio/css/cubeportfolio.min.css">
	<link href="<?php echo base_url() . "medicio/"; ?>css/nivo-lightbox.css" rel="stylesheet" />
	<link href="<?php echo base_url() . "medicio/"; ?>css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() . "medicio/"; ?>css/owl.carousel.css" rel="stylesheet" media="screen" />
	<link href="<?php echo base_url() . "medicio/"; ?>css/owl.theme.css" rel="stylesheet" media="screen" />
	<link href="<?php echo base_url() . "medicio/"; ?>css/animate.css" rel="stylesheet" />
	<link href="<?php echo base_url() . "medicio/"; ?>css/style.css" rel="stylesheet">
	<link href="<?php echo base_url() . "medicio/"; ?>css/custome-style.css" rel="stylesheet">
	<!-- boxed bg -->
	<link id="bodybg" href="<?php echo base_url() . "medicio/"; ?>bodybg/bg1.css" rel="stylesheet" type="text/css" />
	<!-- template skin -->
	<link id="t-colors" href="<?php echo base_url() . "medicio/"; ?>color/default.css" rel="stylesheet">
	<?php 
	if(!empty($jquery3)){
		?>
		<script src="<?php echo base_url() ?>assets/jquery/js/jquery-3.3.1.min.js"></script>
		<?php
	}else{
		?>
		<script src="<?php echo base_url() ."medicio/"; ?>js/jquery.min.js"></script>
		<?php
	}
	?>
	
	<script src="<?php echo base_url() ?>assets/jquery/js/jquery-ui.min.js"></script>
	<style type="text/css">
		.cbp-l-grid-team .cbp-caption {
			height: 130%;
			margin-bottom: 20px;
			border: 1px solid #E7E7E7;
		}

		.bg-green {
			background-color: #449d44;
			color: #fff;
		}
	</style>
	<script type="text/javascript">
		var base_url = "<?php echo base_url(); ?>"
	</script>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
	<div id="wrapper">

		<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<!--div class="top-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-md-6">
						<p class="bold text-left"><?php echo waktuPelayanan(); ?></p>
						</div>
						<div class="col-sm-6 col-md-6">
						<p class="bold text-right">Kontak <?php echo noTelp() ?></p>
						</div>
					</div>
				</div>
			</div-->
			<div class="container navigation">

				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
						<i class="fa fa-bars"></i>
					</button>
					<a class="navbar-brand" href="<?php echo base_url(); ?>">

						<img src="<?php echo base_url() . "/images/stikerrsudpp.png"; ?>" alt="" height="40" style="float: left" />
						<!--div style="padding: 8px; width:290px;">
	                    	RSUD Kota Padang Panjag
	                    </div-->

					</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
					<ul class="nav navbar-nav">

						<?php
						$menu = $this->load_model->getMenuinduk();
						$m = "";
						$idx = 0;
						foreach ($menu as $mn) {
							$idx++;
							if ($mn->menu_baseurl == 1) $link = base_url() . $mn->menu_link;
							else $link = $mn->menu_link;
							if ($this->uri->uri_string() == $mn->menu_link) $st = "active";
							else $st = "";
							$anak = $this->load_model->getMenuanak($mn->menu_idxutama);

							if (!empty($anak)) {
								$m .= '<li class="dropdown">';
								$m .= '<a href="' . $link . '" class="dropdown-toggle" data-toggle="dropdown">' . $mn->menu_judul . ' <b class="caret"></b></a>';
								$m .= '<ul class="dropdown-menu">';
								foreach ($anak as $an) {
									if ($an->menu_idxsub == 0) {
										$sub = $this->load_model->getSubmenu($mn->menu_idxutama, $an->menu_idxanak);
										if (!empty($sub)) {
											//Jika Ada Submenu
											if ($this->uri->uri_string() == $an->menu_link) $st = "active";
											else $st = "";
											if ($an->menu_baseurl == 1) $link = base_url() . $an->menu_link;
											else $link = $an->menu_link;
											$m .= '<li class="dropdown dropdown-submenu">
				  						<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $an->menu_judul . '</a>';
											$m .= '<ul class="dropdown-menu submenu" ><div style="overflow-y:auto">';
											foreach ($sub as $sm) {
												if ($this->uri->uri_string() == $sm->menu_link) $s_class = "active";
												else $s_class = "";
												if ($sm->menu_baseurl == 1) $link = base_url() . $sm->menu_link;
												else $link = $sm->menu_link;
												$m .= '<li class="' . $s_class . '"><a href="' . $link . '">' . $sm->menu_judul  . '</a></li>';
											}
											$m .= "</div></ul>";
											$m .= "</li>";
										} else {
											//JIka Tidak ada sub menu
											if ($this->uri->uri_string() == $an->menu_link) $st = "active";
											else $st = "";
											if ($an->menu_baseurl == 1) $link = base_url() . $an->menu_link;
											else $link = $an->menu_link;
											$m .= '<li class="' . $st . '"><a href="' . $link . '">' . $an->menu_judul  . '</a></li>';
										}
									} else {
										//if($this->uri->uri_string()==$an->menu_link) $st="active"; else $st="";	  				
										//if($an->menu_baseurl==1) $link=base_url() .$an->menu_link; else $link= $an->menu_link;
										//$m.='<li class="' .$st .'"><a href="' .$link .'">' .$an->menu_judul  .'</a></li>';
									}
								}
								$m .= '</ul>';
								$m .= "</li>";
							} else {
								if ($idx == 1) {
									if (empty($this->uri->uri_string)) $st = "active";
									else $st = '';
								}

								$m .= "<li class=\"" . $st . "\"><a href=\"" . base_url() . $mn->menu_link . "\">" . $mn->menu_judul  . "</a></li>";
							}
						}
						echo $m;
						?>


					</ul>


				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container -->
		</nav>
		<!--Slider-->
		<?php if (!empty($slider)) echo $slider; ?>
		<!--End Slider-->


		<!--Content-->
		<?php if (!empty($content)) echo $content ?>
		<!--/Content-->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-3">
						<div class="wow fadeInDown" data-wow-delay="0.1s">
							<div class="widget">
								<h5 class="font-white">Populer</h5>
								<ul>
									<?php
									$terbaru = $this->load_model->getTerbaru();
									foreach ($terbaru as $baru) {
									?>
										<li class='list-post '><a class="font-white" href="<?php echo base_url() . "" ?>"><?php echo $baru->post_judul; ?></a></li>
									<?php
									}
									?>
								</ul>

								<p>
									<?php //echo getInfo();  
									?>
								</p>
							</div>
						</div>

					</div>
					<div class="col-sm-6 col-md-3">
						<div class="wow fadeInDown" data-wow-delay="0.1s">
							<div class="widget">
								<h5 class="font-white">Kontak</h5>

								<ul>
									<li>
										<span class="fa-stack fa-lg">
											<i class="fa fa-circle fa-stack-2x"></i>
											<i class="fa fa-address-card-o fa-stack-1x fa-inverse"></i>
										</span> <?php echo getAlamat() ?>
									</li>
									<li>
										<span class="fa-stack fa-lg">
											<i class="fa fa-circle fa-stack-2x"></i>
											<i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
										</span> <?php echo noTelp() ?>
									</li>
									<li>
										<span class="fa-stack fa-lg">
											<i class="fa fa-circle fa-stack-2x"></i>
											<i class="fa fa-phone fa-stack-1x fa-inverse"></i>
										</span> <?php echo emergency() ?>
									</li>
									<li>
										<span class="fa-stack fa-lg">
											<i class="fa fa-circle fa-stack-2x"></i>
											<i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
										</span><?php echo getEmail() ?>
									</li>

								</ul>
								<?php $medsos = getMedsos() ?>
								<ul class="company-social">
									<li class="social-facebook"><a href="<?php echo $medsos["facebook"]; ?>"><i class="fa fa-facebook"></i></a></li>
									<li class="social-instagram"><a href="<?php echo $medsos["instagram"]; ?>"><i class="fa fa-instagram"></i></a></li>
									<li class="social-twitter"><a href="<?php echo $medsos["twiter"]; ?>"><i class="fa fa-twitter"></i></a></li>
									<li class="social-google"><a href="<?php echo $medsos["gplus"]; ?>"><i class="fa fa-google-plus"></i></a></li>


								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="wow fadeInDown" data-wow-delay="0.1s">
							<div class="widget">
								<h5 class="font-white">Lokasi</h5>

								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6897129985177!2d100.41608521532851!3d-0.46003949966435004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd52571555531bd%3A0xc6fb04647dedfc56!2sHospital+Padang+Panjang!5e0!3m2!1sen!2sid!4v1561430638932!5m2!1sen!2sid" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
							</div>
						</div>

					</div>
					<div class="col-sm-6 col-md-3">
						<div class="wow fadeInDown" data-wow-delay="0.1s">
							<div class="widget">
								<h5 class="font-white">Link Terkait</h5>
								<ul>
									<?php
									$link = $this->load_model->getPartner();
									foreach ($link as $l) {
									?>
										<li>- <a class="font-white" href="<?php echo $l->partner_link; ?>" target="_blank"><?php echo $l->partner_nama; ?></a></li>
									<?php
									}
									?>
								</ul>

							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="sub-footer">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="wow fadeInLeft" data-wow-delay="0.1s">
								<div class="text-left">
									<p style="color:#000;">&copy;Copyright 2019 - Tim IT RSUD Kota Padang Panjang. </p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="wow fadeInRight" data-wow-delay="0.1s">
								<div class="text-right">
									<p><a href="<?php echo base_url(); ?>">RSUD Kota Padang Panjang</a></p>
								</div>
								<!-- 
			                        All links in the footer should remain intact. 
			                        Licenseing information is available at: http://bootstraptaste.com/license/
			                        You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Medicio
			                    -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>

	<!-- Core JavaScript Files -->
	

	<script src="<?php echo base_url() . "medicio/"; ?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() . "medicio/"; ?>js/jquery.easing.min.js"></script>
	<script src="<?php echo base_url() . "medicio/"; ?>js/wow.min.js"></script>
	<script src="<?php echo base_url() . "medicio/"; ?>js/jquery.scrollTo.js"></script>
	<script src="<?php echo base_url() . "medicio/"; ?>js/jquery.appear.js"></script>
	<script src="<?php echo base_url() . "medicio/"; ?>js/stellar.js"></script>
	<script src="<?php echo base_url() . "medicio/"; ?>plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
	<script src="<?php echo base_url() . "medicio/"; ?>js/owl.carousel.min.js"></script>
	<script src="<?php echo base_url() . "medicio/"; ?>js/nivo-lightbox.min.js"></script>
	<script src="<?php echo base_url() . "medicio/"; ?>js/custom.js"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
					event.preventDefault();
					event.stopPropagation();
					$(this).parent().siblings().removeClass('open');
					$(this).parent().toggleClass('open');
				});
			});
		})(jQuery);
	</script>

	

</body>

</html>
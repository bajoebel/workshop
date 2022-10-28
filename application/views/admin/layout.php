<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?= WEBTITLE ?></title>
    
    <script type="text/javascript" src="<?= base_url() ."js/jquery.min.js"; ?>"></script>
    <script type="text/javascript" src="<?= base_url() ."js/bootstrap.min.js"; ?>"></script>

    <link href="<?= base_url() ."css/font-awesome.min.css"; ?>" rel="stylesheet">
	<!-- <link href="css/demo.css" rel="stylesheet"> -->

	<!-- jQuery & jQuery UI + theme (required) -->
	<link href="<?= base_url() ."css/jquery-ui.min.css"; ?>" rel="stylesheet">
	<!-- <script src="<?= base_url() ."js/jquery-latest-slim.min.js"; ?>"></script> -->
	<script src="<?= base_url() ."js/jquery-ui-custom.min.js"; ?>"></script>

	<!-- keyboard widget css & script (required) -->
	<link href="<?= base_url() ."css/keyboard.css"; ?>" rel="stylesheet">
	<script src="<?= base_url() ."js/jquery.keyboard.js"; ?>"></script>

	<!-- keyboard extensions (optional) -->
	<script src="<?= base_url() .""; ?>js/jquery.mousewheel.js"></script>
    <!-- <script src="js/jquery.keyboard.extension-scramble.js"></script> -->
    
    <link type="text/css" rel="stylesheet" href="<?= base_url() ."component/bootstrap-datepicker/dist/css/bootstrap-datepicker.css"; ?>">
    <link type="text/css" rel="stylesheet" href="<?= base_url() ."css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/style.css"?>"/>
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/profile.css"?>"/> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/loading.css"?>"/>
    <link async rel="stylesheet" type="text/css" href="<?php echo base_url() ."sweetalert/sweetalert.css" ?>">
    <script src="<?php echo base_url() ."sweetalert/sweetalert.min.js" ?>"></script>
    <script type='text/javascript'>
        var base_url="<?= base_url() ?>";
    </script>
</head>
<body style="background: #fff;">
<div id="loading">
<div class="loader2">Loading..</div>
</div>
<div class="template">
    <div id="green">
     </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="<?php if($aktif==1) echo "active" ?>"><a href="<?= base_url()."admin/dasboard" ?>"><span class="fa fa-home"></span> Home</a></li>
                <li class="<?php if($aktif==2) echo "active" ?>"><a data-toggle="tab" href="#menu1"><span class="fa fa-cubes"></span> Master</a></li>
                <li class="<?php if($aktif==3) echo "active" ?>"><a data-toggle="tab" href="#menu2"><span class="fa fa-newspaper-o"></span> Blog</a></li>
                <li class="<?php if($aktif==4) echo "active" ?>"><a data-toggle="tab" href="#menu3"><span class="fa fa-hospital-o"></span> Smart Hospital</a></li>
                <li class="<?php if($aktif==5) echo "active" ?>"><a data-toggle="tab" href="#menu4"><span class='fa fa-users'></span> Pengguna</a></li>
                <li class="<?php if($aktif==6) echo "active" ?>"><a data-toggle="tab" href="#menu5"><span class='fa fa-gear'></span> Pengaturan</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade <?php if($aktif==1) echo "in active" ?>">
                    
                </div>
                <div id="menu1" class="tab-pane fade <?php if($aktif==2) echo "in active" ?>">
                    <div class="box-icon">
                        <a href="<?= base_url() ."admin/carabayar" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/carabayar.png" ?>" alt=""  class='img img-circle'><br>Cara Bayar</a>
                        <a href="<?= base_url() ."admin/agama" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/agama.png" ?>" alt="" class='img img-circle'><br>Agama</a>
                        <a href="<?= base_url() ."admin/suku" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/suku.png" ?>" alt="" class='img img-circle'><br>Suku</a>
                        <a href="<?= base_url() ."admin/status" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/statuspernikhanan.png" ?>" alt="" class='img img-circle'><br>Status Kawin</a>
                        <a href="<?= base_url() ."admin/pekerjaan" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/pekerjaan.png" ?>" alt="" class='img img-circle'><br>Pekerjaan</a>
                        <a href="<?= base_url() ."admin/bahasa" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/bahasa.png" ?>" alt="" class='img img-circle'><br>Bahasa</a>
                        <a href="<?= base_url() ."admin/spesialis" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/spesialis.png" ?>" alt="" class='img img-circle'><br>Spesialis</a>
                        <a href="<?= base_url() ."admin/rujukan" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/rujukan.png" ?>" alt="" class='img img-circle'><br>Rujukan</a>
                        <a href="<?= base_url() ."admin/wilayah" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/lokasi.png" ?>" alt="" class='img img-circle'><br>Wilayah</a>
                        <a href="<?= base_url() ."admin/negara" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/master/negara.png" ?>" alt="" class='img img-circle'><br>Negara</a>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade <?php if($aktif==3) echo "in active" ?>">
                    <div class="box-icon">
                        <a href="<?= base_url() ."admin/kategori" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/category.png" ?>" alt=""  class='img img-circle'><br>Kategori</a>
                        <a href="<?= base_url() ."admin/berita" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/news.png" ?>" alt="" class='img img-circle'><br>Berita</a>
                        <a href="<?= base_url() ."admin/halaman" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/pages.png" ?>" alt="" class='img img-circle'><br>Halaman</a>
                        <a href="<?= base_url() ."admin/slider" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/slider.png" ?>" alt="" class='img img-circle'><br>Slider</a>
                        <a href="<?= base_url() ."admin/partner" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/partner.png" ?>" alt="" class='img img-circle'><br>Rekan</a>
                        <a href="<?= base_url() ."admin/menu" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/menu.png" ?>" alt="" class='img img-circle'><br>Menu</a>
                        <a href="<?= base_url() ."admin/media" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/blog/media.png" ?>" alt="" class='img img-circle'><br>Media</a>
                    </div>
                </div>
                <div id="menu3" class="tab-pane fade <?php if($aktif==4) echo "in active" ?>">
                    <div class="box-icon">
                        <a href="<?= base_url() ."admin/booking" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/smart/booking.png" ?>" alt="" class='img img-circle'><br>Booking</a>
                        <a href="<?= base_url() ."admin/pasien" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/smart/patient.png" ?>" alt="" class='img img-circle'><br>Pasien</a>
                        <a href="<?= base_url() ."admin/dokter" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/smart/doctor1.png" ?>" alt="" class='img img-circle'><br>Dokter</a>
                        <a href="<?= base_url() ."admin/jadwal" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/smart/jadwal_dokter.png" ?>" alt="" class='img img-circle'><br>Jadwal</a>
                        <a href="<?= base_url() ."admin/poliklinik" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/smart/poly.png" ?>" alt="" class='img img-circle'><br>Poliklinik</a>
                        <a href="<?= base_url() ."admin/bed" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/smart/bed.png" ?>" alt="" class='img img-circle'><br>Bed Monitoring</a>
                        <a href="<?= base_url() ."admin/liburnasional" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/smart/libur.png" ?>" alt="" class='img img-circle'><br>Hari Libur Naional</a>
                        <a href="<?= base_url() ."admin/liburdokter" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/smart/doctor.png" ?>" alt="" class='img img-circle'><br>Dokter Libur</a>
                    </div>
                </div>
                <div id="menu4" class="tab-pane fade <?php if($aktif==5) echo "in active" ?>">
                    <div class="box-icon">
                        <a href="<?= base_url() ."admin/user" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/pengguna/users.png" ?>" alt=""  class='img img-circle'><br>Users</a>
                        <a href="<?= base_url() ."admin/wsclient" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/pengguna/wsclient.png" ?>" alt="" class='img img-circle'><br>Web Service Client</a>
                    </div>
                </div>
                <div id="menu5" class="tab-pane fade <?php if($aktif==6) echo "in active" ?>">
                    <div class="box-icon">
                        <a href="<?= base_url() ."admin/pengaturan" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/pengaturan/pengaturan.png" ?>" alt=""  class='img img-circle'><br>Pengaturan Pendaftaran Online</a>
                        <a href="<?= base_url() ."admin/hakakses" ?>" class='btn btn-default'><img src="<?= base_url() ."img/icon/admin/pengaturan/hakakses.png" ?>" alt="" class='img img-circle'><br>Pengaturan Hak Akses</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(!empty($content)) echo $content; ?>
    <footer>
        <div class="ftl">&copy; Copyrights 2021 <a href="#" target="_blank">Team IT Simrs RSUD Kota Padang Panjang</a></div>
    </footer>
    
</div>
<?php 
if(!empty($libjs)){
    foreach ($libjs as $l ) {
        ?>
        <script type="text/javascript" src="<?= base_url() .$l ?>"></script>
        <?php
    }
}
?>
<script type="text/javascript">
<?php if (!empty($ajaxdata)) echo $ajaxdata; ?>
</script>
</body>
</html>

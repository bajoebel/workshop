<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?= WEBTITLE  ?></title>
    
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
    
    
    <link type="text/css" rel="stylesheet" href="<?= base_url() ."css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/style.css"?>"/>
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/profile.css"?>"/> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/loading.css"?>"/>
    <link async rel="stylesheet" type="text/css" href="<?php echo base_url() ."sweetalert/sweetalert.css" ?>">
    <script src="<?php echo base_url() ."sweetalert/sweetalert.min.js" ?>"></script>
    <script type='text/javascript'>
        var base_url="<?= base_url() ?>";
        var resource_url="<?= RESOURCE_URL ?>";
    </script>
    <style>
        /* footer{
            position: fixed;
        } */
        .ftl {
            font-size: 16px;
            padding: 20px 0 20px;
            margin: 0 auto;
            font-style: italic;
            text-align: center;
        }
        footer {
            position: relative;
            background-color: #390;
            height: 60px;
            bottom: 0;
            width: 100%;
            z-index: -1;
            color: #f5f5f5;
        }
        .my_text{
            min-height: 83vh;
        }
    </style>
</head>
<body style="background: #fff;">
<div id="loading">
<div class="loader2">Loading..</div>
</div>
<div class="template">
    <div id="green">
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
</body>
</html>

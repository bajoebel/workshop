<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?= WEBTITLE ?></title>
    <script type="text/javascript" src="<?= base_url() ."js/jquery.min.js"; ?>"></script>
    <script type="text/javascript" src="<?= base_url() ."js/bootstrap.min.js"; ?>"></script>
    <link href="<?= base_url() ."css/font-awesome.min.css"; ?>" rel="stylesheet">
	<link href="<?= base_url() ."css/jquery-ui.min.css"; ?>" rel="stylesheet">
	<script src="<?= base_url() ."js/jquery-ui-custom.min.js"; ?>"></script>
	<link href="<?= base_url() ."css/keyboard.css"; ?>" rel="stylesheet">
	<script src="<?= base_url() ."js/jquery.keyboard.js"; ?>"></script>
	<script src="<?= base_url() .""; ?>js/jquery.mousewheel.js"></script>
    <link type="text/css" rel="stylesheet" href="<?= base_url() ."css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/style.css"?>"/>
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/profile.css"?>"/> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."css/loading.css"?>"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ."plugins/wow/style.css"?>"/>
    <link async rel="stylesheet" type="text/css" href="<?php echo base_url() ."sweetalert/sweetalert.css" ?>">
    <script src="<?php echo base_url() ."sweetalert/sweetalert.min.js" ?>"></script>
    <link
    rel="stylesheet"
    href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
    />

    <style>
      html,
      body {
        position: relative;
        height: 100%;
      }

      body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
      }

      .swiper {
        width: 100%;
        height: 100%;
      }

      .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
        background-size:cover;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      .title-slider{
          width:100%;
          padding:30px;
          margin:0px;
          position:fixed;
          height:auto;
          background:#00000047;
          color:#fff;
          font-size:24pt;
          z-index: 1050;
      }


      

      .swiper1 {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
      }

      .swiper-slide1 {
        background-position: center;
        background-size: cover;
        width: 250px;
        height: 250px;
      }

      .swiper-slide1 img {
        display: block;
        width: 100%;
      }
      .template {
          background-image: url(img/bg.svg);
          background-repeat: no-repeat;
          background-size: cover;
      }
    </style>

    <script type='text/javascript'>
        var base_url="<?= base_url() ?>";
        
    </script>
</head>
<body style="background: #fff;" class="template">
<div id="loading">
<div class="loader2">Loading..</div>
</div>

<div class="template">
    <div id="green">
        <!-- <div class="left">
            <img src="<?= base_url() ."img/stikerrsudpp.png" ?>" class="img-header" alt="">
        </div> -->
     </div>
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <div class="container">
                </div>
            </div>
        </div>
    </div>
    <div class="" style="margin-top:0px">
        <nav class="navbar navbar-default">
            <div class="container no-padding">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> 
                    <!-- <a class="navbar-brand" href="#">Responive Menu</a> -->

                </div>
                <div id="navbar1" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                      <?php
                      $menu = $this->Welcome_model->getMenuinduk();
                      $m = "";
                      $idx = 0;
                      foreach ($menu as $mn) {
                        $idx++;
                        if ($mn->menu_baseurl == 1) $link = base_url() . $mn->menu_link;
                        else $link = $mn->menu_link;
                        if ($this->uri->uri_string() == $mn->menu_link) $st = "active";
                        else $st = "";
                        $anak = $this->Welcome_model->getMenuanak($mn->menu_idxutama);

                        if (!empty($anak)) {
                          $m .= '<li class="dropdown">';
                          $m .= '<a href="' . $link . '" class="dropdown-toggle" data-toggle="dropdown">' . $mn->menu_judul . ' <b class="caret"></b></a>';
                          $m .= '<ul class="dropdown-menu">';
                          foreach ($anak as $an) {
                            if ($an->menu_idxsub == 0) {
                              $sub = $this->Welcome_model->getSubmenu($mn->menu_idxutama, $an->menu_idxanak);
                              if (!empty($sub)) {
                                //Jika Ada Submenu
                                if ($this->uri->uri_string() == $an->menu_link) $st = "active";
                                else $st = "";
                                if ($an->menu_baseurl == 1) $link = base_url() . $an->menu_link;
                                else $link = $an->menu_link;
                                $m .= '<li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $an->menu_judul . '</a>';
                                $m .= '<ul class="dropdown-menu submenu" >';
                                foreach ($sub as $sm) {
                                  if ($this->uri->uri_string() == $sm->menu_link) $s_class = "active";
                                  else $s_class = "";
                                  if ($sm->menu_baseurl == 1) $link = base_url() . $sm->menu_link;
                                  else $link = $sm->menu_link;
                                  $m .= '<li class="' . $s_class . '"><a href="' . $link . '">' . $sm->menu_judul  . '</a></li>';
                                }
                                $m .= "</ul>";
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
            </div>
        </nav>
        <div class="row">
          <div class="col-md-12">
            <img src="<?= base_url() ."img/banner"?>" alt="">
          </div>
        </div>
    </div>

    
    <?php if(!empty($content)) echo $content; ?>

    
    <!-- <script type="text/javascript" src="<?= base_url() ?>plugins/wow/wowslider.js"></script>
	  <script type="text/javascript" src="<?= base_url() ?>plugins/wow/script.js"></script> -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    
    
    
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
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        effect: "creative",
        creativeEffect: {
          prev: {
            shadow: true,
            origin: "left center",
            translate: ["-5%", 0, -200],
            rotate: [0, 100, 0],
          },
          next: {
            origin: "right center",
            translate: ["5%", 0, -200],
            rotate: [0, -100, 0],
          },
        },
        spaceBetween: 5,
        centeredSlides: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination0",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

      var swiper1 = new Swiper(".mySwiper1", {
        loop: true,
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: true,
        },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
        },
      });
    (function ($) {
        $(document).ready(function () {
            $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).parent().siblings().removeClass('open');
                $(this).parent().toggleClass('open');
            });
        });
    })(jQuery);
</script>
<footer>
        <div class="ftl">&copy; Copyrights <?= "@".date('Y')?> <a href="#" target="_blank"><?= INSTITUSI ?></a></div>
    </footer>
</body>
</html>

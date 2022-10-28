<style type="text/css">
    .namadokter{
        position:relative; z-index:1020;top:-70px;color:#eee7e7;font-weight:bold;background:#33990073;height:70px
    }
</style>
<section>
    <div id="wowslider-container1">
        <div class="ws_images">
            <ul>
                <?php 
                $i=0;
                foreach ($slider as $s ) {
                    ?>
                    <li><a href="#"><img src="<?= base_url() ."img/slider/original/".$s->slider_img ?>" alt="<?= $s->slider_caption?>" title="<?= $s->slider_caption?>" id="wows1_<?= $i?>"/></a></li>
                    <?php
                    $i++;
                }
                ?>
                
            </ul>
        </div>
        <div class="ws_shadow"></div>
    </div>
</section>
    	
<!-- <section >
    <div class="container">
        <div class="box-shorcut">
            <div class="row">
                <div class="col-md-2 col-xs-4 text-center">
                    <a href="<?= base_url() ."pendaftaran"; ?>" class='btn btn-default btn-block'>
                        <img src="<?= base_url() ."img/icon/pendaftaran.png" ?>" class='img img-responsive img-circle' alt="">
                    </a>
                    <p>Pendaftaran Online</p> 
                </div>
                <div class="col-md-2 col-xs-4 text-center">
                    <a class='btn btn-default btn-block'><img src="<?= base_url() ."img/icon/bed.jpg" ?>" class='img img-responsive img-circle' alt="">
                    </a>
                    <p>Bed Monitoring</p>
                </div>
                <div class="col-md-2 col-xs-4 text-center">
                    <a class='btn btn-default btn-block'><img src="<?= base_url() ."img/icon/jadwal.png" ?>" class='img img-responsive img-circle' alt="">
                    </a>
                    <p>Jadwal Dokter</p>
                </div>
                <div class="col-md-2 col-xs-4 text-center">
                    <a class='btn btn-default btn-block'><img src="<?= base_url() ."img/icon/news.png" ?>" class='img img-responsive img-circle' alt="">
                    </a>
                    <p>Berita</p> 
                </div>
                <div class="col-md-2 col-xs-4 text-center">
                    <a class='btn btn-default btn-block'><img src="<?= base_url() ."img/icon/pengaduan.jpg" ?>" class='img img-responsive img-circle' alt="">
                    </a>
                    <p>Pengaduan Online</p>
                </div>
                <div class="col-md-2 col-xs-4 text-center">
                    <a class='btn btn-default btn-block'><img src="<?= base_url() ."img/icon/kotaksaran.png" ?>" class='img img-responsive img-circle' alt="">
                    </a>
                    <p>Kritik Dan Saran</p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="dokter">
    <div class="container">
        <div class='section-judul'> DOKTER SPESIALIS </div>
        <div class="box-dokter">
            <div class="swiper mySwiper1">
                <div class="swiper-wrapper">
                    <?php 
                    foreach ($dokter as $d ) {
                        ?>
                        <div class="swiper-slide swiper-slide1">
                            <a href="<?= base_url() ."jadwal_dokter/".$d->dokter_id; ?>">
                            <img src="<?= base_url() ."rsud-backend/public/img/dokter/".$d->dokter_fhoto ?>" class='img img-responsivesql' />
                            <p class="namadokter"><?= $d->dokter_nama ?></p>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

<section class="blog">
    <div class="container">
        <div class='section-judul text-white'> BLOG </div>
        <div class="row">
            <?php 
                $i=0;
                foreach ($berita as $b ) {
                    $tag=array('tag-teal','tag-purple','tag-pink','tag-teal');
                    $tanggal=$b->post_tanggal;
                    $tgl=explode('-',$tanggal);
                    ?>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <img src="<?= base_url() ."rsud-backend/public/img/blog/thumb/THUMB_" .$b->post_image; ?>" alt="rover" />
                            </div>
                            <div class="card-body">
                                <span class="tag <?= $tag[$i] ?>"><?= $b->kategori_nama ?></span>
                                <h4><a href="<?= base_url() .$b->post_link ?>"><?= $b->post_judul ?></a></h4>
                                <p>
                                <?= substr(strip_tags($b->post_isi),0,250)?> <a href="<?= base_url() .$b->post_link ?>">Selanjutnya ...</a>
                                </p>
                                <div class="user">
                                    <div class="user-info">
                                        <h5><?= tglindo($b->post_tglpublish) ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                    if($i==5)$i=0;
                }
            ?>
        </div>
    <div>
</section>

<section class="partner">
    <div class="container">
        <div class='section-judul'> PARTNER </div>
            <div class="row">
                <?php 
                foreach ($partner as $p ) {
                    ?>
                    <div class="col-md-2">
                        <a href="<?= $p->partner_link ?>" class="" target="_blank">
                            <img src="<?= base_url() ."rsud-backend/public/img/partner/".$p->partner_logo; ?>" class="img img-responsive"> 
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
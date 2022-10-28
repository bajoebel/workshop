<?php 
$jml=0;
// print_r($ruang);exit;
foreach ($ruang as $r ) {
    $jml++;
    ?>
    <div class="box">
        <button type="button" class="btn btn-default btn-block no-border" onclick="setPoliklinikOnline('<?= $r->poly_id ?>','<?= $r->poly_nama?>')">
        <img src="<?= RESOURCE_URL. "rsud-backend/public/img/Icon/poliklinik/thumb_".$r->poly_image?>" class="img img-circle img-thumbnail img-responsive" alt="">
        <!-- <br><?= $r->poly_nama ?> -->
        </button>
        <div class="heading"><?= $r->poly_nama ?></div>   
        
    </div>
    
    <?php
    if($jml%8==0) echo "<div class='row'>&nbsp;</div>";
    // echo "<option value='$r->idx'>$r->ruang</option>";
}
?>
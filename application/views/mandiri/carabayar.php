<?php 
// print_r($carabayar); 
// echo $carabayar->idx;
// exit;
if($jml==1){
    ?>
    <input type="hidden" name="id_cara_bayar" id="id_cara_bayar" value="<?= $carabayar->idx ?>">
    <input type="hidden" name="cara_bayar" id="cara_bayar" value="<?= $carabayar->cara_bayar ?>">
    <?= $carabayar->cara_bayar ?>
    <?php
}else{
    ?>
    <select name="id_cara_bayar" id="id_cara_bayar" class="form-control">
                    <option value="">Pilih Asuransi</option>
                    <?php  
                    foreach ($carabayar as $b ) {
                        ?>
                        <option value="<?= $b->idx ?>"><?= $b->cara_bayar ?></option>
                        <?php
                    }
                    ?>
                </select>
                <input type="hidden" name="cara_bayar" id="cara_bayar" value="">
    <!-- <div class="row ">
        <div class="form-group">
            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Pilih Asuransi</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="input-group">
                <select name="id_cara_bayar" id="id_cara_bayar" class="form-control">
                    <option value="">Pilih Asuransi</option>
                    <?php  
                    foreach ($carabayar as $b ) {
                        ?>
                        <option value="<?= $b->idx ?>"><?= $b->cara_bayar ?></option>
                        <?php
                    }
                    ?>
                </select>
                <input type="hidden" name="cara_bayar" id="cara_bayar" value="">
                </div>
            </div>
        </div>
    </div> -->
    
    <?php
}
?>
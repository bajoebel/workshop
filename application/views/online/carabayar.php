<?php 
// print_r($carabayar); 
// echo $carabayar->idx;
// exit;
if($jml==1){
    ?>
    <input type="hidden" name="id_cara_bayar" id="id_cara_bayar" value="<?= $carabayar->id_cara_bayar ?>">
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
                        <option value="<?= $b->id_cara_bayar ?>"><?= $b->cara_bayar ?></option>
                        <?php
                    }
                    ?>
                </select>
                <input type="hidden" name="cara_bayar" id="cara_bayar" value="">
    
    <?php
}
?>
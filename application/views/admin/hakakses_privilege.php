<input type="hidden" name="hak" id="hak" value="<?php if(!empty($hak)) echo implode(",",$hak) ?>">
<?php 
foreach ($menu as $m ) {
    ?>
    <input type="hidden" value="<?= $m->idx ?>" name="idx_modul[]" id="idx_modul[]">
    <?php
    if($m->idx_utama>0){
        ?>
        <div style='padding-left:20px'>
        <input type="checkbox" class="pilih<?= $m->idx_utama ?>" value="<?= $m->idx ?>" name="pilih<?= $m->idx ?>" id="pilih<?= $m->idx ?>" <?php if(in_array($m->idx,$hak))  echo "checked" ?>> <?= $m->judul_menu."<br>" ?>
        </div>
        <?php
    }else{
        ?>
        <div>
        <input type="checkbox" value="<?= $m->idx ?>" name="pilih<?= $m->idx ?>" id="pilih<?= $m->idx ?>" onclick="checkAll(<?= $m->idx ?>)" <?php if(in_array($m->idx,$hak))  echo "checked" ?>> <?= $m->judul_menu."<br>" ?>
        </div>
        <?php
    }
}
?>
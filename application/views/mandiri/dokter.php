<div class="row">
<?php 

foreach ($dokter as $d ) {
    if($d->foto=="") {
        if($d->pgwJenkel==0) $img='dokterp.png'; else $img='dokterl.png';
    }else{
        $img=$d->foto;
    }
    
    ?>
    
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-2" style='padding-left:10px'>
                            <img src="<?= base_url() ."img/dokter/".$img  ?>" class='img img-responsive img-circle  img-thumbnail' alt="">
                        </div>
                        <div class="col-md-10"><h3><?= $d->pgwNama ?></h3></div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                    
                        <table class="table table-hover">
                            <tr>
                                <th>No</th>
                                <th>Jam Layanan</th>
                                <th style="text-align:right">Terisi / Jumlah Tersedia</th>
                            </tr>
                        <?php 
                            $batch=$this->Mandiri_model->getBatch($d->group);
                            $no=0;
                            
                            foreach ($batch as $b ) {
                                $terisi=$this->Mandiri_model->getTersedia($b->label,$d->jadwal_poly_id,$d->NRP);
                                $no++;
                                ?>
                                <tr 
                                <?php 
                                if($terisi <= $b->tersedia) echo 'style="background-color:#000"'
                                ?>
                                onclick="pilihDokter('<?= $d->NRP ?>','<?= $d->pgwNama ?>','<?= $b->label ?>','<?= $b->name ?>','<?= $b->jam ?>','<?= $b->tersedia ?>')">
                                    <td><?= $no ?></td>
                                    <td><?= $b->name ?></td>
                                    <td style="text-align:right"><b><?= $terisi ."/".$b->tersedia ?></b></td>
                                </tr>
                                <?php
                            }
                        ?>
                        </table>
                    </div>
                    
                    
                </div>
            </div>
            
        </div>
        
    
    <?php
}
?>
</div>

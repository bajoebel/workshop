<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <?php 
            $no=0;
            // print_r($tglbuka);
            foreach ($tglbuka as $t ) {
                $no++;
                if($no==1) $active='active';
                else $active='';
                ?>
                <li class="<?= $active ?>"><a data-toggle="tab" href="#tab<?= $t->id ?>"><h4><b><?= $t->name?></b></h4></a></li>
                <?php
            }
            ?>
        </ul>

        <div class="tab-content">
            <?php 
            $i=0;
            foreach ($tglbuka as $t ) {
                $i++;
                if($i==1) $active='active'; else $active=''
            ?>
                <div id="tab<?= $t->id ?>" class="tab-pane fade in <?= $active?>">
                    <!-- <h3><?= "Dokter Tanggal ". $t->name;?></h3> -->
                    <hr>
                    <div class="row">
                        <?php 
                        // print_r($tglbuka);
                        $dokter=$t->dokter;
                        foreach ($dokter as $d ) {
                            if($d->dokter_fhoto=="") {
                                if($d->dokter_jekel=="P") $img=base_url() ."img/dokter/dokterp.png"; 
                                else $img=base_url() ."img/dokter/dokterl.png";
                            }else{
                                $img = RESOURCE_URL ."rsud-backend/public/img/dokter/".$d->dokter_fhoto;
                            }
                            ?>
                                <div class="col-md-6">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-md-2" style='padding-left:10px'>
                                                    <img src="<?= $img  ?>" class='img img-responsive img-circle  img-thumbnail' alt="">
                                                </div>
                                                <div class="col-md-10"><h3><?= $d->dokter_nama ?></h3></div>
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
                                                    $batch=$d->batch;
                                                    $no=0;
                                                    $terisi=10;
                                                    foreach ($batch as $b ) {
                                                        // echo $t->tanggal;
                                                        // $isi=$this->Online_model->getTersedia($b->label,$idruang,$d->nrp,$t->tanggal,$token);
                                                        
                                                        // if($isi){
                                                        //     $te=json_decode($isi);
                                                        //     if($te->code==200)
                                                        //     $terisi=$te->data;
                                                        //     else
                                                        //     $terisi="-";
                                                        // }
                                                        $terisi=intval($b->terisi);
                                                        // echo $terisi; exit;
                                                        $no++;
                                                        ?>
                                                        <tr 
                                                        <?php 
                                                        if($terisi <= $b->tersedia) echo 'style="background-color:#fff"'
                                                        ?>
                                                        onclick="pilihDokterOnlineBaru('<?= $d->nrp ?>','<?= $d->dokter_nama ?>','<?= $b->label ?>','<?= $b->name ?>','<?= $b->jam ?>','<?= $b->tersedia ?>','<?= $t->tanggal ?>')">
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
                    
                </div>
            <?php
            }
            ?>
        <!-- <div id="home" class="tab-pane fade in active">
            <h3>HOME</h3>
            <p>Some content.</p>
        </div>
        <div id="menu1" class="tab-pane fade">
            <h3>Menu 1</h3>
            <p>Some content in menu 1.</p>
        </div>
        <div id="menu2" class="tab-pane fade">
            <h3>Menu 2</h3>
            <p>Some content in menu 2.</p>
        </div> -->
        </div>
    </div>
    

</div>

<div class="row">
    <div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">Biodata Pegawai</div>
            <div class="panel-body">
                <div class="row">

                <label for="" class='col-md-4'>Nik </label>
                <div class="col-md-8">
                <label for="" class="">:<?= $pegawai->nik; ?></label>
                </div>

                </div>
                <div class="row">

                    <label for="" class='col-md-4'>Nip </label>
                    <div class="col-md-8">
                    <label for="" class="">:<?= $pegawai->nip; ?></label>
                    </div>
                    
                </div>
                <div class="row">
                    <label for="" class='col-md-4'>Nama </label>
                    <div class="col-md-8">
                    <label for="" class="">:<?= $pegawai->nama_pegawai; ?></label>
                    </div>
                    
                </div>
                <div class="row">
                    <label for="" class='col-md-4'>Tujuan </label>
                    <div class="col-md-8">
                    <label for="" class="">:Bekerja</label>
                    </div>
                    
                </div>

                <div class="row">
                    <label for="" class='col-md-4'>Tanggal Kunjungan </label>
                    <div class="col-md-8">
                    <label for="" class="">:<?= date('d M Y'); ?></label>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">

        <div class="panel panel-success">
            <div class="panel-heading">Kajian Mandiri Covid-19</div>
            <div class="panel-body">
            <div class = "row" > 
                <div class="col-md-12">
                    <br>
                    <div class="alert alert-warning">
                        <strong>Warning !
                        </strong>
                        <br>
                            <p>
                                <i>Jawablah pertanyaan dibawah ini dengan sebenar benarnya demi kesehatan dan
                                    keselamatan bersama sebelum berkunjung ke Rumah Sakit</i>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 ">
                        <div class="pertanyaan">
                            <div style="font-size:20pt;font-weight:bold;text-align:center;">Dalam 14 Hari terakhir apakah anda pernah mengalami hal hal berikut?</div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="nama_lengkap" id='nama_lengkap' value='<?= $pegawai->nama_pegawai ?>'>
                
                <input type="hidden" name="keperluan" id='keperluan' value='Bekerja'>
                <input type="hidden" name="tanggal_kunjungan" id='tanggal_kunjungan' value='<?= date('Y-m-d') ?>'>
                <input type="hidden" name='ref_id' id='ref_id' value='<?= $pegawai->idx ?>'>

                <?php 

                if(empty($pegawai->nik)){
                    ?>
                    <div class="col-md-12">
                    <div class="form-group">
                    <label for="">Input NIK</label>
                    <input type="text" name="nik" id="nik" value='' class='form-control' required>
                    </div>
                    </div>
                    
                    <?php
                }else{
                    ?>
                    <input type="hidden" name="nik" id='nik' value='<?= $pegawai->nik ?>'>
                    <?php
                }
                $i=0;
                foreach ($kajian as $k ) {
                    $i++;
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pertanyaan" id="pertanyaan<?= $i ?>">
                                <div class="col-md-12">
                                    <input type="hidden" name='idx[]' id='idx<?= $i ?>' value='<?= $k->idx ?>'>
                                    <input
                                        type="hidden"
                                        name='pertanyaan<?= $k->idx ?>'
                                        id='pertanyaan<?= $k->idx ?>'
                                        value="<?= $k->pertanyaan ?>">
                                    <label for=""><?= $k->pertanyaan; ?></label>

                                </div>
                                <hr>
                                <div class="col-md-12">
                                    
                                        <div class="col-md-1">
                                        <label for="ya"><input type="radio" name="point<?= $k->idx ?>" value="<?= $k->point ?>">Ya</label>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="Tidak"><input type="radio" name="point<?= $k->idx ?>" value="0" required="required">Tidak</label>
                                        </div>
                                    
                                    
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <button class='btn btn-success btn-block' type='submit' id="simpan">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

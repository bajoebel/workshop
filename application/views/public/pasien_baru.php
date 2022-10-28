<style type="text/css">
.pasienbaru{
    border:solid #0eab4c; border-collapse: collapse;padding: 5px;border-radius: 90pt
}
</style>
<div class="container">
    <center>
        <div class="my_text">
            <div id="o-control-form" style="display:block">
                <form id="o-form" method="POST" class="form-horizontal" action="<?= base_url() ."online/pasien/simpan_pendaftaran"; ?>" >
                    <div class="o-step" id="o-step1">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pasien Baru</a></li>
                            <li class="active">Biodata</li>
                        </ol>
                        <div class="panel panel-success">
                            <div class="panel-heading bg-green">
                                <h3 class="panel-title"><span class="fa fa-user" ></span> Biodata Pasien</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row top20">
                                <input type="hidden" name="kajian_mandiri_covid19" id="kajian_mandiri_covid19" value="<?= $config->set_kajian_mandiri_covid ?>">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">NIK:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="Masukkan NIK">
                                            <span class="text-error" id="err_no_ktp"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Nama:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                                            <span class="text-error" id="err_nama"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2 col-xs-12" for="pwd">Tempat / Tgl Lahir:</label>
                                            <div class="col-sm-5 col-xs-6">
                                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir">
                                                <span class="text-error" id="err_tempat_lahir"></span>    
                                            </div>
                                            <div class="col-sm-5 col-xs-6">
                                                <div class="has-feedback">
                                                    <input type="text" class="form-control tanggal" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir">
                                                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                                </div>
                                                <span class="text-error" id="err_tgl_lahir"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Jenis Kelamin:</label>
                                            <div class="col-sm-10">
                                            <input type="radio" id="laki" name="jns_kelamin" value="1" > Laki-Laki &nbsp;&nbsp;
                                            <input type="radio" id="perempuan" name="jns_kelamin" value="0" > Perempuan<br>
                                            <span class="text-error" id="err_jns_kelamin"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Status Kawin:</label>
                                            <div class="col-sm-10">
                                            <select name="status_kawin" id="status_kawin" class="form-control">
                                                <option value="">Pilih</option>
                                                <?php 
                                                foreach ($status_kawin as $s) {
                                                    ?>
                                                    <option value="<?= $s->status?>"><?= $s->status ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="text-error" id="err_status_kawin"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Pekerjaan:</label>
                                            <div class="col-sm-10">
                                            <select name="pekerjaan" id="pekerjaan" class="form-control">
                                                <option value="">Pilih</option>
                                                <?php 
                                                foreach ($pekerjaan as $s) {
                                                    ?>
                                                    <option value="<?= $s->pekerjaan_nama?>"><?= $s->pekerjaan_nama ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="text-error" id="err_pekerjaan"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Agama:</label>
                                            <div class="col-sm-10">
                                            <select name="agama" id="agama" class="form-control">
                                                <option value="">Pilih</option>
                                                <?php 
                                                foreach ($agama as $s) {
                                                    ?>
                                                    <option value="<?= $s->agama ?>"><?= $s->agama ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="text-error" id="err_agama"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Suku:</label>
                                            <div class="col-sm-10">
                                            <select name="suku" id="suku" class="form-control">
                                                <option value="">Pilih</option>
                                                <?php 
                                                foreach ($suku as $s) {
                                                    ?>
                                                    <option value="<?= $s->suku_nama ?>"><?= $s->suku_nama ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="text-error" id="err_suku"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Bahasa:</label>
                                            <div class="col-sm-10">
                                            <select name="bahasa" id="bahasa" class="form-control">
                                                <option value="">Pilih</option>
                                                <?php 
                                                foreach ($bahasa as $s) {
                                                    ?>
                                                    <option value="<?= $s->bahasa_nama ?>"><?= $s->bahasa_nama ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="text-error" id="err_bahasa"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">No Telp:</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="no_telpon" name="no_telpon" placeholder="Masukkan No Telp">
                                            <span class="text-error" id="err_no_telpon"></span>
                                            </div>
                                        </div><div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">No BPJS(Kalau ada):</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="o-no_bpjs" name="no_bpjs" placeholder="Masukkan No BPJS (Jika Ada)">
                                            <span class="text-error" id="err_no_bpjs"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="col-sm-12 text-right">
                                            <button type="button" class="btn btn-success " onclick="goTo(2)"> <span  class="fa fa-arrow-right"></span> Selanjutnya</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="o-step" id="o-step2" style="display:none">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pasien Baru</a></li>
                            <li class="active">Alamat</li>
                        </ol>
                        <div class="panel panel-success">
                            <div class="panel-heading bg-green">
                                <h3 class="panel-title"><span class="fa fa-arrow-left" onclick="goTo(1)"></span> Alamat Pasien</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row top20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Provinsi:</label>
                                            <div class="col-sm-10">
                                            <select name="nama_provinsi" id="nama_provinsi" class="form-control" onchange="getKabupaten()">
                                                <option value="">Pilih Provinsi</option>
                                                <?php 
                                                foreach ($provinsi as $row ) {
                                                    ?>
                                                    <option value="<?= $row->provinsi ?>"><?= $row->provinsi ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="text-error" id="err_nama_provinsi"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Kab/Kota:</label>
                                            <div class="col-sm-10">
                                            <select name="nama_kab_kota" id="nama_kab_kota" class="form-control" onchange="getKecamatan()">
                                                <option value="">Pilih Kabupaten / Kota</option>
                                            </select>
                                            <input type="hidden" id="kabkota" name="kabkota"> 
                                            <input type="hidden" id="dalam_kota" name="dalam_kota"> 
                                            <span class="text-error" id="err_nama_kab_kota"></span>
                                            </div>
                                        </div>
                                        <div id="dalamkota">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Kecamatan:</label>
                                                <div class="col-sm-10">
                                                <select name="nama_kecamatan" id="nama_kecamatan" class="form-control" onchange="getKelurahan()">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                                <span class="text-error" id="err_nama_kecamatan"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Kelurahan:</label>
                                                <div class="col-sm-10">
                                                <select name="nama_kelurahan" id="nama_kelurahan" class="form-control">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                                <span class="text-error" id="err_nama_kelurahan"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Alamat:</label>
                                            <div class="col-sm-10">
                                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                                            <span class="text-error" id="err_alamat"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="col-sm-12 text-right">
                                            <button type="button" class="btn btn-success " onclick="goTo(3)"> <span  class="fa fa-arrow-right"></span> Selanjutnya</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="o-step" id="o-step3" style="display:none">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pasien Baru</a></li>
                            <li class="active">Data Keluarga</li>
                        </ol>
                        <div class="panel panel-success">
                            <div class="panel-heading bg-green">
                                <h3 class="panel-title"><span class="fa fa-arrow-left" onclick="goTo(2)"></span> Data Keluarga</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row top20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Keluarga / Hubungan:</label>
                                            <div class="col-sm-7 col-xs-6">
                                                <input type="text" class="form-control" id="o-pjPasienNama" name="pjPasienNama" placeholder="Masukkan Nama Keluarga">
                                                <span class="text-error" id="err_pjPasienNama"></span>
                                            </div>
                                            <div class="col-md-3 col-xs-6">
                                                <select name="pjPasienHubKel" id="o-pjPasienHubKel" class="form-control">
                                                    <option value="">Pilih Hubungan</option>
                                                    <option value="Istri">Istri</option>
                                                    <option value="Suami">Suami</option>
                                                    <option value="Ayah">Ayah</option>
                                                    <option value="Ibu">Ibu</option>
                                                    <option value="Paman">Paman</option>
                                                    <option value="Keponakan">Keponakan</option>
                                                    <option value="Kakak">Kakak</option>
                                                    <option value="Adik">Adik</option>
                                                    <option value="Kakek">Kakek</option>
                                                    <option value="Nenek">Nenek</option>
                                                </select>
                                                <span class="text-error" id="err_pjPasienHubKel"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">No Telp Keluarga:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="o-pjPasienTelp" name="pjPasienTelp" placeholder="Masukkan No Telp Keluarga">
                                                <span class="text-error" id="err_pjPasienTelp"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Pekerjaan:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="o-pjPasienPekerjaan" name="pjPasienPekerjaan" placeholder="Masukkan Pekerjaan Keluarga">
                                                <span class="text-error" id="err_pjPasienPekerjaan"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="pwd">Alamat:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="o-pjPasienAlamat" name="pjPasienAlamat" placeholder="Masukkan Alamat Keluarga">
                                                <span class="text-error" id="err_pjPasienAlamat"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="col-sm-12 text-right">
                                            <button type="button" class="btn btn-success " onclick="goTo(4)"> <span  class="fa fa-arrow-right"></span> Selanjutnya</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="o-step" id="o-step4" style="display:none">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pendaftaran</a></li>
                            <li class="active">Pilih Cara Bayar</li>
                        </ol>
                        <div class="panel panel-success">
                            <div class="panel-heading bg-green">
                                <h3 class="panel-title"><span class="fa fa-arrow-left" onclick="goTo(3)"></span> Pilih Cara Bayar</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row top20">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-default btn-block" onclick="pilihJenisBayarOnlineBaru(0)">
                                            <!-- <span class="glyphicon glyphicon-registration-mark font-icon"></span> -->
                                            <img src="<?= base_url() ."img/asuransi/umum.png" ?>" class='icon-img' alt="">
                                            <br>
                                            <div class='shorcut-title'>Umum</div>
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button"  class="btn btn-default btn-block" onclick="pilihJenisBayarOnlineBaru(1)">
                                            <!-- <span class="glyphicon glyphicon-registration-mark font-icon"></span> -->
                                            <img src="<?= base_url() ."img/asuransi/bpjs.png" ?>" class='icon-img' alt=""><br>
                                            <div class='shorcut-title'>BPJS Kesehatan</div>
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button"  class="btn btn-default btn-block" onclick="pilihJenisBayarOnlineBaru(3)">
                                            <!-- <span class="glyphicon glyphicon-registration-mark font-icon"></span> -->
                                            <img src="<?= base_url() ."img/asuransi/bpjstk.png" ?>" class='icon-img' alt=""><br>
                                            <div class='shorcut-title'>BPJS Ketenagakerjaan</div>
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button"  class="btn btn-default btn-block" onclick="pilihJenisBayarOnlineBaru(2)">
                                            <!-- <span class="glyphicon glyphicon-registration-mark font-icon"></span> -->
                                            <img src="<?= base_url() ."img/asuransi/asuransilain.png" ?>" class='icon-img' alt=""><br>
                                            <div class='shorcut-title'>Asuransi Lain</div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="o-step" id="o-step5" style="display:none" >
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pendaftaran</a></li>
                            <li class="active">Pilih Asal Rujukan</li>
                        </ol>
                        <div class="panel panel-success">
                            <div class="panel-heading bg-green">
                                <h3 class="panel-title"><span class="fa fa-arrow-left" onclick="goTo(4)"></span> Pilih Asal Rujukan</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row top20">
                                <?php 
                                // print_r($rujukan);
                                    foreach ($rujukan as $r ) {
                                        ?>
                                        <div class="col-md-2">
                                            <button type='button' id='o-asal<?= $r->id_rujukan ?>' class='btn btn-default btn-block' onclick="pilihRujukanOnlineBaru('<?= $r->id_rujukan ?>','<?= $r->rujukan ?>','<?= $r->jenis ?>')">
                                                <img src="<?= base_url() ."img/asuransi/asuransilain.png"?>" alt="" class='img img-responsive img-circle img-thumnail'>
                                                <?= $r->rujukan ?>
                                            </button>
                                        </div>
                                    <?php
                                    // echo "<option value='$r->idx'>$r->rujukan</option>";
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="o-step" id="o-step6" style="display:none">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pendaftaran</a></li>
                            <li class="active">Pilih Rujukan BPJS Kesehatan</li>
                        </ol>
                        <div class="panel panel-success">
                            <div class="panel-heading bg-green">
                                <h3 class="panel-title"><span class="fa fa-arrow-left" onclick="goTo(5)"></span> Pilih Rujukan BPJS Kesehatan</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row top20" id="o-rujukanbpjs"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="o-step" id="o-step7" style="display:none">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pendaftaran</a></li>
                            <li class="active">Pilih Poliklinik Tujuan</li>
                        </ol>
                        <div class="panel panel-success">
                            <div class="panel-heading bg-green">
                                <h3 class="panel-title"><span class="fa fa-arrow-left" onclick="goTo(6)"></span> Pilih Poliklinik Tujuan</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row top20">
                                    <div id="o-poliklinik">
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="o-step" id="o-step8" style="display:none">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pendaftaran</a></li>
                            <li class="active">Pilih Jam Antrian</li>
                        </ol>
                        <div class="panel panel-success">
                            <div class="panel-heading bg-green">
                                <h3 class="panel-title"><span class="fa fa-arrow-left" onclick="goTo(7)"></span> Pilih Dokter</h3>
                            </div>
                            <div class="panel-body">
                                <div class='top20' id="o-dokter"></div>
                            </div>
                        </div>
                    </div>
                    <?php 
                                if($config->set_kajian_mandiri_covid==1){
                                    ?>
                                    <div class="o-step" id="kajiancovid"  style="display:none">
                                        <ol class="breadcrumb">
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">Pendaftaran</a></li>
                                            <li class="active">Kajian Mandiri Covid19</li>
                                        </ol>
                                        <div class="panel panel-success">
                                            <div class="panel-heading bg-green">
                                                <h3 class="panel-title"><span class="fa fa-arrow-left" onclick="o_step4()"></span>Pilih Asal Rujukan</h3>
                                            </div>
                                            <div class="panel-body">
                                                
                                                <br>
                                                <div class='row'>
                                                    <div class="col-md-12">
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
                                                <?php 
                                                $i=0;
                                                foreach ($pertanyaan as $p ) {
                                                    ?>
                                                    <div class="col-md-12 " >
                                                        <input type="hidden" name="idx[]" id="idx<?= $p->idx ?>" value="<?= $p->idx ?>">
                                                        <input type="hidden" name="pertanyaan<?= $p->idx ?>" id="pertanyaan<?= $p->idx ?>" value="<?= $p->pertanyaan ?>">
                                                        <div class="pertanyaan">
                                                        <?= $p->pertanyaan ?><br>
                                                        <input type="checkbox" name="jawaban<?= $p->idx ?>" id="jawabanya<?= $p->idx ?>" value="<?= $p->point ?>">Ya
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                                <div class="col-md-12">
                                                        <a href="#"  class='btn btn-success' onclick="goFinish()"> Selanjutnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <?php
                                }
                                ?>
                    <div class="o-step" id="o-step-finish" style="display:none">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pendaftaran</a></li>
                            <li class="active">Konfirmasi Data Pendaftaran</li>
                        </ol>
                        <div class="panel panel-success">
                            <div class="panel-heading bg-green">
                                <h3 class="panel-title"><span class="fa fa-arrow-left" onclick="goTo(8)"></span> Konfirmasi</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row top20">
                                    <div class="col-md-12">
                                        <!--Data Pasien-->
                                        <!-- <input type="hidden" name="id_pasien" id="o-id_pasien" value="">
                                        <input type="hidden" name="nomr" id="o-nomr" value="">
                                        <input type="hidden" name="nama_pasien" id="o-nama_pasien" value="">
                                        <input type="hidden" name="no_ktp" id="o-no_ktp" value="">
                                        <input type="hidden" name="tempat_lahir" id="o-tempat_lahir" value="">
                                        <input type="hidden" name="tgl_lahir" id="o-tgl_lahir" value="">
                                        <input type="hidden" name="jns_kelamin" id="o-jns_kelamin" value="">
                                        <input type="hidden" name="status_kawin" id="o-status_kawin" value="">
                                        <input type="hidden" name="pekerjaan" id="o-pekerjaan" value="">
                                        <input type="hidden" name="agama" id="o-agama" value="">
                                        <input type="hidden" name="no_telpon" id="o-no_telpon" value="">
                                        <input type="hidden" name="kewarganegaraan" id="o-kewarganegaraan" value="">
                                        <input type="hidden" name="nama_negara" id="o-nama_negara" value="">
                                        <input type="hidden" name="nama_provinsi" id="o-nama_provinsi" value="">
                                        <input type="hidden" name="nama_kab_kota" id="o-nama_kab_kota" value="">
                                        <input type="hidden" name="nama_kecamatan" id="o-nama_kecamatan" value="">
                                        <input type="hidden" name="nama_kelurahan" id="o-nama_kelurahan" value="">
                                        <input type="hidden" name="suku" id="o-suku" value="">
                                        <input type="hidden" name="bahasa" id="o-bahasa" value="">
                                        <input type="hidden" name="alamat" id="o-alamat" value="">
                                        <input type="hidden" name="penanggung_jawab" id="o-penanggung_jawab" value="">
                                        <input type="hidden" name="no_penanggung_jawab" id="o-no_penanggung_jawab" value=" "> -->
                                        <input type="hidden" name="nomr" id="o-nomr" value="">
                                        <input type="hidden" name="txtTanggal" id="o-txtTanggal" value="<?= date('Y-m-d') ?>">
                                        <!--Data Pendaftaran-->
                                        <input type="hidden" name="jns_layanan" id="o-jns_layanan" value="RJ">
                                        <input type="hidden" name="tgl_masuk" id="o-tgl_masuk" value="<?= date('Y-m-d') ?>">
                                        <input type="hidden" name="tgl_daftar" id="o-tgl_daftar" value="">
                                        <input type="hidden" id="sekarang" name="o-sekarang" value="<?= date('Y-m-d') ?>">
                                        <input type="hidden" name="jkn" id="o-jkn" value="">
                                        
                                        <input type="hidden" name="id_ruang" id="o-id_ruang" value="">
                                        <input type="hidden" name="nama_ruang" id="o-nama_ruang" value="">
                                        <input type="hidden" name="id_dokter" id="o-id_dokter" value="">
                                        <input type="hidden" name="namaDokterJaga" id="o-namaDokterJaga" value="">
                                        <input type="hidden" name="label_antrian" id="o-label_antrian" value="">
                                        <input type="hidden" name="name_antrian" id="o-name_antrian" value="">
                                        <input type="hidden" name="jam_antrian" id="o-jam_antrian" value="">
                                        <input type="hidden" name="quota_antrian" id="o-quota_antrian" value="">

                                        
                                        <input type="hidden" name="id_rujuk" id="o-id_rujuk" value="">
                                        <input type="hidden" name="rujukan" id="o-rujukan" value="">
                                        <!-- <input type="hidden" name="pjPasienNama" id="o-pjPasienNama" value="">
                                        <input type="hidden" name="pjPasienTelp" id="o-pjPasienTelp" value="">
                                        <input type="hidden" name="pjPasienHubKel" id="o-pjPasienHubKel" value="">
                                        <input type="hidden" name="pjPasienPekerjaan" id="o-pjPasienPekerjaan" value="">
                                        <input type="hidden" name="pjPasienAlamat" id="o-pjPasienAlamat" value=""> -->
                                        
                                        <!-- Data keperluan bpjs -->
                                        <input type="hidden" name="status_peserta" id="o-status_peserta" value="">
                                        <input type="hidden" name="faskes" id="o-faskes" value="1">
                                        <input type="hidden" name="id_jenis_peserta" id="o-id_jenis_peserta"  value="">
                                        <input type="hidden" name="jenis_peserta" id="o-jenis_peserta"value="">
                                        <input type="hidden" name="no_rujuk" id="o-no_rujuk" value="">
                                        <input type="hidden" name="encryptdata" id="o-encryptdata" value="">
                                        <input type="hidden" name="id_pengirim" id="o-id_pengirim">
                                        <input type="hidden" name="pjPasienDikirimOleh" id="o-pjPasienDikirimOleh" class="form-control">
                                        <input type="hidden" name="pjPasienAlmtPengirim" id="o-pjPasienAlmtPengirim" class="form-control" >
                                        <input name="no_jaminan" id="o-no_jaminan" type="hidden" class="form-control" >

                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading"  style="text-align:center">
                                                        <div class="row">
                                                            <div class="col-md-4">&nbsp;</div>
                                                            <div class="col-md-4" id="o-v-foto">
                                                                <img src="<?= base_url()."img/dokter/dokterl.png" ?>" class="img img-responsive img-circle  img-thumbnail" alt="">
                                                            </div>
                                                            <div class="col-md-4">&nbsp;</div>
                                                            <div class="col-md-12" id="o-v-nama">Nama Pasien</div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <fieldset>
                                                                <legend>Informasi Pasien </legend>
                                                                <table class="table table-hover">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:30%">NIK</th>
                                                                            <td id="o-v-nik"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Nama</th>
                                                                            <td id="o-v-namapasien"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>No Telp</th>
                                                                            <td id="o-v-notelp"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>TTL</th>
                                                                            <td id="o-v-ttl"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Jenis Kelamin</th>
                                                                            <td id="o-v-jekel"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                
                                                            </fieldset>
                                                            
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>Informasi Pendaftaran</legend>
                                                            <table class="table">
                                                                
                                                                <tr>
                                                                    <td style="width:30%">Cara Bayar / Asuransi</td>
                                                                    <td id="o-v-carabayar"></td>
                                                                </tr>
                                                                <tr class="o-v-jkn">
                                                                    <td>No BPJS</td>
                                                                    <td id="o-v-nobpjs"></td>
                                                                </tr>
                                                                <tr class="o-v-jkn">
                                                                    <td>Jenis Kepesertaan</td>
                                                                    <td id="o-v-jnspeserta"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Asal Rujukan</td>
                                                                    <td id="o-v-asalrujukan"></td>
                                                                </tr>
                                                                <tr class="o-v-jkn">
                                                                    <td>No Rujukan</td>
                                                                    <td id="o-v-norujukan"></td>
                                                                </tr>
                                                                <tr class="o-v-jkn">
                                                                    <td>Faskes Perujuk</td>
                                                                    <td id="o-v-namafaskes"></td>
                                                                </tr>
                                                                <!-- <tr class="jkn">
                                                                    <td>Alamat Faskes</td>
                                                                    <td id="o-v-alamatfaskes"></td>
                                                                </tr> -->
                                                                <tr>
                                                                    <td>Poliklinik Tujuan</td>
                                                                    <td id="o-v-poliklinik"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Dokter</td>
                                                                    <td id="o-v-namadokter"></td>
                                                                </tr>
                                                            </table>
                                                            <legend>Informasi Penanggung Jawab <div class='pull-right'><span class="fa fa-pencil"></span></div></legend>
                                                            <table class="table table-hover">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width:30%">Nama</th>
                                                                        <td id="o-v-pjnama"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>No Telp</th>
                                                                        <td id="o-v-pjtelp"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Hubungan Keluarga</th>
                                                                        <td id="o-v-pjhubungan"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Pekerjaan</th>
                                                                        <td id="o-v-pjpekerjaan"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Alamat</th>
                                                                        <td id="o-v-pjalamat"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            
                                                        </fieldset>
                                                        
                                                    </div>
                                                </div>
                                                

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <!-- <button type="submit" id="batal" class="btn btn-danger">
                                                                <i class="fa fa-rotate-left"></i> Submit</button> -->
                                                                <button type="button" id="batal" class="btn btn-danger" onclick="daftarBaru()">
                                                                <i class="fa fa-rotate-left"></i> Batal</button>
                                                                <button type="button" id="daftar" class="btn btn-primary" onclick="daftarPasienBaru()">
                                                                Daftar <i class="fa fa-arrow-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="o-step" id="o-reservasi" style="display:none">
                        <div id="buktireservasi" style="border:1px solid #ccc; border-collapse:collapse;padding:5px">
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="text-center" id="qrcode"></div>
                                    <table class="table">
                                        <tr>
                                            <td style="width:130px">Tgl Daftar </td>
                                            <td>: <span id="res_tgldaftar"></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Nomr</td>
                                            <td>: <span id="res_nomr"></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>: <span id="res_nama"></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Kunjungan</td>
                                            <td>: <span id="res_tglkunjungan"></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Jam Kunjungan</td>
                                            <td>: <span id="res_jam_kunjungan"></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Poli Tujuan</td>
                                            <td>: <span id="res_poli"></span> </td>
                                        </tr>
                                        <tr>
                                            <td>Cara Bayar</td>
                                            <td>: <span id="res_cara_bayar"></span> </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-8 col-xs-12">
                                <div id="point_kajian"></div>
                                    <h1 class="text-center">Nomor Antrian<span id="res_antrian"></span></h1>
                                    <h3 class="text-center">Jam Antrian<span  id="res_jam_antrian"></span></h3>

                                    <b><p>Mohon Diperhatikan</p></b>
                                    <ol>
                                        <li>Pasien DIharapkan Hadir sebelum pukul <span id="res_estimasi"></span></li>
                                        <li>Silahkan Datang ke Counter Checkin Yang sudah DIsediakan</li>
                                        <li>Bawa Bukti Reservasi, Kartu Pasien</li>
                                        <li>Khusus Pasien BPJS Bawa Kartu BPJS, Surat Rujukan.Kontrol Ulang Yang masih Berlaku </li>
                                    </ol>
                                    <b><p>Catatan</p></b>
                                    <ol>
                                        <li>Pasien yang mendaftar online akan dilayani jika membawa bukti reservasi mendaftar online dan bagi pasien BPJS harus membawa kartu BPJS, Surat Rujukan/Surat Kontrol Yangmasih berlaku</li>
                                        <li>Jika Pasien datang ewat dari jam antrian, pasien tidak akan dilayani, silahkan mendaftar kembali melalui loket pendaftaran</li>
                                    </ol>
                                </div>
                                <duv class="col-md-12 text-center" id="btn-cetak">
                                    <button class="btn btn-warning" onclick="printReservasi()"><span class="fa fa-print"></span> Cetak Bukti Reservasi</button>
                                </duv>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </center>
</div>

    <!-- Modal no bpjs -->
    <div id="modal_nobpjs" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align:center">Cek Status Kepesertaan BPJS</h4>
                </div>
                <div class="modal-body">
                    <h3 style="text-align:center;margin-bottom:10px">Masukkan No Kartu BPJS Anda</h3>
                    <div class="input-group">
                        <input type="text" class="form-control input-lg num_keybord" name="cek_nobpjs" id="cek_nobpjs" value="" placeholder="Masukkan No BPJS">
                        <span class="input-group-btn">
                            <button class="btn btn-success btn-lg" onclick="cekStatus()">Cek Status</button>
                        </span>
                    </div>
                    <h3 style="text-align:center">&nbsp;</h3>
                </div>
            </div>

        </div>
    </div>
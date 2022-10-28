<div class="row" id="user-profile">
    <div class="col-lg-3 col-md-4 col-sm-4">
        <div class="main-box clearfix">
            <h2><?= $cek->nama ?></h2>
            
            <img src="<?php if($cek->jns_kelamin=="1" || $cek->jns_kelamin=="L") echo base_url() ."img/avatar/male.png"; else echo base_url() ."img/avatar/female.png"; ?>" alt="" class="profile-img img-responsive center-block">
            <!-- <div class="profile-label">
                <span class="label label-danger">Admin</span>
            </div> -->

            <!-- <div class="profile-stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                <span><?= $cek->nama ?></span>
            </div> -->

            <div class="profile-since">
                Tgl Daftar<br> <?php $tgl = longDate($cek->tgl_daftar); echo $tgl['label']; ?>
            </div>

            <div class="profile-details">
                <!-- <ul class="fa-ul">
                    <li><i class="fa-li fa fa-truck"></i>Orders: <span>456</span></li>
                    <li><i class="fa-li fa fa-comment"></i>Posts: <span>828</span></li>
                    <li><i class="fa-li fa fa-tasks"></i>Tasks done: <span>1024</span></li>
                </ul> -->
                <div class="profile-header">
                <h3><span>Informasi Pasien</span></h3>
                
            </div>

            <div class="row profile-user-info">
                <div class="col-sm-12">
                    <div class="profile-user-details clearfix">
                        <div class="profile-user-details-label">
                            Nik
                        </div>
                        <div class="profile-user-details-value">
                            <?= $cek->no_ktp ?>
                        </div>
                    </div>
                    <div class="profile-user-details clearfix">
                        <div class="profile-user-details-label">
                            Nomr
                        </div>
                        <div class="profile-user-details-value">
                            <?= $cek->nomr ?>
                        </div>
                    </div>
                    <div class="profile-user-details clearfix">
                        <div class="profile-user-details-label">
                        Nama Pasien
                        </div>
                        <div class="profile-user-details-value">
                        <?= $cek->nama ?>
                        </div>
                    </div>
                    <div class="profile-user-details clearfix">
                        <div class="profile-user-details-label">
                        Tempat Lahir
                        </div>
                        <div class="profile-user-details-value">
                        <?= $cek->tempat_lahir?>
                        </div>
                    </div>
                    <div class="profile-user-details clearfix">
                        <div class="profile-user-details-label">
                        Tgl Lahir
                        </div>
                        <div class="profile-user-details-value">
                        <?php $tgl=longDate($cek->tgl_lahir); echo $tgl['label']; ?>
                        </div>
                    </div>
                    <div class="profile-user-details clearfix">
                        <div class="profile-user-details-label">
                        Jenis Kelamin
                        </div>
                        <div class="profile-user-details-value">
                        <?php if($cek->jns_kelamin=="1" || $cek->jns_kelamin=="L") echo "Laki-Laki"; else echo "Perempuan"; ?>
                        </div>
                    </div>
                </div>
                
            </div>
            </div>

            
        </div>
    </div>

    <div class="col-lg-9 col-md-8 col-sm-8">
        <div class="main-box clearfix">
            <form id="form" method="POST" class="form-horizontal" action="#">
                <div id="step1" class='step'>
                    <div class="row">
                        <div class="profile-header">
                            <h3><span>Pilih Cara Bayar</span></h3>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-block" onclick="pilihJenisBayar(0)">
                                    <span class="glyphicon glyphicon-registration-mark font-icon"></span><br>
                                    <div class='shorcut-title'>Umum</div>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success btn-block" onclick="pilihJenisBayar(1)">
                                    <span class="glyphicon glyphicon-registration-mark font-icon"></span><br>
                                    <div class='shorcut-title'>BPJS Kesehatan</div>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-danger btn-block" onclick="pilihJenisBayar(2)">
                                    <span class="glyphicon glyphicon-registration-mark font-icon"></span><br>
                                    <div class='shorcut-title'>Asuransi Lain</div>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div id="step2" class='step' style="display:none">
                    
                    <div class="row">
                        <!-- <div class="profile-header">
                            <h3><span>Pilih Rujukan</span></h3>
                        </div> -->
                        <div class="row">
                            <input type="hidden" name="status_peserta" id="status_peserta" value="AKTIF">
                            <div class="form-group divRegCredit" style="display:block">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">No Peserta (<em>No BPJS</em>)</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <input name="no_bpjs" id="no_bpjs" type="text" class="form-control" value="0000017430491" onkeydown="enter_nobpjs(event)">
                                        <span class="input-group-addon">
                                        <a id="btnUpdateNoBPJS" href="Javascript:updateNoBPJS()"><i class="fa fa-save"></i> Update</a>
                                        </span>
                                        <span class="input-group-addon" id="status"><a id="cekStatus" href="Javascript:cekPeserta()"><i class="fa fa-check"></i> AKTIF</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group divRegCredit" style="display:block">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Jenis Peserta</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="width:10px;padding:0px;">
                                        <input type="text" name="id_jenis_peserta" id="id_jenis_peserta" class="form-control" readonly="" value="">
                                        </span>
                                        <span class="input-group-addon" style="width:90px;padding:0px;">
                                        <input type="text" name="jenis_peserta" id="jenis_peserta" class="form-control" readonly="" value="">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Rujukan</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <select class="form-control" name="id_rujuk" id="id_rujuk" onkeydown="enter_rujukan(event)" onchange="getPengirim()">
                                            <option value="">Pilih Rujukan</option>
                                            <?php 
                                            foreach ($rujukan as $r ) {
                                                echo "<option value='$r->idx'>$r->rujukan</option>";
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" id="faskes" name="faskes" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group adarujukan" style="">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">No Rujukan</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group ">
                                        <input type="text" id="txtNorujuk" name="txtNorujuk" class="form-control" value="" placeholder="Enter Nomor Rujukan" onkeyup="enter_norujukan(event)">
                                        <input type="hidden" name="encryptdata" id="encryptdata" value="">
                                        <div class="input-group-btn">
                                            <button type="button" id="cariRujukan" class="btn btn-default" onclick="getListRujukan()">
                                            <i class="fa fa-search"></i> Cari Rujukan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group adarujukan" style="">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Dikirim Oleh<br><em>Jika pasien rujukan</em></label>
                                <div class="col-md-9 col-sm-9 col-xs-12 pengirim" onkeydown="enter_pengirim(event)">
                                <input type="hidden" name="id_pengirim" id="id_pengirim">
                                <input type="text" name="pjPasienDikirimOleh" id="pjPasienDikirimOleh" class="form-control">
                                </div>
                                <div class="pengirim" id="lainnya" style="display: none;"><input name="pjPasienDikirimOleh" id="pjPasienDikirimOleh" type="text" class="form-control" onkeydown="enter_pengirim1(event)"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group adarujukan" style="">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Alamat Pengirim<br><em>Jika pasien rujukan</em></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="pjPasienAlmtPengirim" id="pjPasienAlmtPengirim" class="form-control" onkeydown="enter_alamatpengirim(event)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="step3" class='step' style="display:none">
                    <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Tujuan Layanan</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="">
                                        <select class="form-control" name="id_ruang" id="id_ruang" style='width:100%' onchange="getDokter()">
                                            <option value="">Pilih Poliklinik</option>
                                            <?php 
                                                foreach ($ruang as $r ) {
                                                    echo "<option value='$r->idx'>$r->ruang</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Dokter</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="">
                                        <select class="form-control" name="dokterJaga" id="dokterJaga" onkeydown="enter_dokter(event)">
                                            <option value="">Pilih Dokter</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group divRegCredit" style="display:block">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">No Jaminan (<em>SEP</em>)</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group ">
                                        <input name="no_jaminan" id="no_jaminan" type="text" class="form-control" onkeydown="controlSEP(event)">
                                        <div class="input-group-btn" id="prosessep">
                                        <a href="Javascript:formSEP()" class="btn btn-danger">Create SEP (<em>Bridging</em>)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row" style="display:none;">
                    <div class="col-md-12">
                        <!--Data Pasien-->
                        <input type="hidden" name="id_pasien" id="id_pasien" value="">
                        <input type="hidden" name="nomr" id="nomr" value="">
                        <input type="hidden" name="nama_pasien" id="nama_pasien" value="">
                        <input type="hidden" name="no_ktp" id="no_ktp" value="">
                        <input type="hidden" name="tempat_lahir" id="tempat_lahir" value="">
                        <input type="hidden" name="tgl_lahir" id="tgl_lahir" value="">
                        <input type="hidden" name="jns_kelamin" id="jns_kelamin" value="P">
                        <input type="hidden" name="status_kawin" id="status_kawin" value="1">
                        <input type="hidden" name="pekerjaan" id="pekerjaan" value="">
                        <input type="hidden" name="agama" id="agama" value="ISLAM">
                        <input type="hidden" name="no_telpon" id="no_telpon" value="081363484939 ">
                        <input type="hidden" name="kewarganegaraan" id="kewarganegaraan" value="WNI">
                        <input type="hidden" name="nama_negara" id="nama_negara" value="">
                        <input type="hidden" name="nama_provinsi" id="nama_provinsi" value="">
                        <input type="hidden" name="nama_kab_kota" id="nama_kab_kota" value="">
                        <input type="hidden" name="nama_kecamatan" id="nama_kecamatan" value="">
                        <input type="hidden" name="nama_kelurahan" id="nama_kelurahan" value="">
                        <input type="hidden" name="suku" id="suku" value="">
                        <input type="hidden" name="bahasa" id="bahasa" value="">
                        <input type="hidden" name="alamat" id="alamat" value="JL A. YANI RT 06 - EKOR LUBUK">
                        <input type="hidden" name="penanggung_jawab" id="penanggung_jawab" value="SUAMI : SYAUKANI">
                        <input type="hidden" name="no_penanggung_jawab" id="no_penanggung_jawab" value="081363484939 ">
                        <input type="hidden" name="txtTanggal" id="txtTanggal" value="2021-07-31">

                        <!--Data Pendaftaran-->
                        <input type="hidden" name="daftar_id" id="daftar_id" value="67304">
                        <input type="hidden" name="jns_layanan" id="jns_layanan" value="RJ">
                        <input type="hidden" name="tgl_masuk" id="tgl_masuk" value="2021-07-31">
                        <input type="hidden" name="no_rujuk" id="no_rujuk" value="">
                        <input type="hidden" name="id_dokter" id="id_dokter" value="30">
                        <input type="hidden" name="namaDokterJaga" id="namaDokterJaga" value="dr. SRI ANGRAENI, Sp.PD">

                        <input type="hidden" name="antrian_poly" id="antrian_poly" value="32">
                        <div class="row ">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Cara Bayar</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <input type="hidden" id="sekarang" name="sekarang" value="2021-07-31">
                                        <select class="form-control" name="id_cara_bayar" id="id_cara_bayar" onkeydown="enter_carabayar(event)" style="width: 100%;">
                                        <option value="">Pilih Cara Bayar</option>
                                        </select>
                                        <input type="hidden" name="jkn" id="jkn" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-12">
                                    <div class="input-group">
                                        <button type="button" id="batal" class="btn btn-danger">
                                        <i class="fa fa-rotate-left"></i> Batal</button>
                                        <button type="button" id="daftar" class="btn btn-primary" onclick="aprovePasien()">
                                        Daftar <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Nama</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="pjPasienNama" id="pjPasienNama" type="text" class="form-control ui-autocomplete-input" value="SUAMI : SYAUKANI" onkeydown="enter_pjnama_aprove(event)" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Telp/HP</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="pjPasienTelp" id="pjPasienTelp" type="text" class="form-control" value="081363484939" onkeydown="enter_pjtelp(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Hubungan Keluarga</label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <input name="pjPasienHubKel" id="pjPasienHubKel" type="text" class="form-control" value="" onkeydown="enter_pjhubungan_aprove(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Umur</label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <input name="pjPasienUmur" id="pjPasienUmur" type="text" class="form-control" value="0" onkeydown="enter_pjumur(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Pekerjaan</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="pjPasienPekerjaan" id="pjPasienPekerjaan" type="text" class="form-control" value="" onkeydown="enter_pjpekerjaan(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Alamat</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="pjPasienAlamat" id="pjPasienAlamat" value="" class="form-control" onkeydown="enter_pjalamatonline(event)">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</div>
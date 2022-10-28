<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a bref="#">Admin</a></li>
                <li><a bref="#">Pengaturan</a></li>
                <li class="active">Pengaturan Pendaftaran Online</li>
            </ol>
            <div class="row">
                
                <div class='col-md-6' id="form_box" >
                    <div class="form-box">
                        <div class="form-header">
                            Form Pengaturan
                        </div>
                        <div class="form-body">
                            <form action="#"  id="form" method="POST">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="email">Jadwal Pendaftaran (H-x sampai H-x):</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" id="set_id" name="set_id" value="<?php if(!empty($set)) echo $set->set_id ?>" >
                                            <input type="text" class="form-control" id="set_jadwal_daftar_m" name="set_jadwal_daftar_m" placeholder="Mulai dari H - " value="<?php if(!empty($set)) echo $set->set_jadwal_daftar_m ?>">
                                            <div class="text-error" id="err_set_jadwal_daftar_m"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="set_jadwal_daftar_s" name="set_jadwal_daftar_s" placeholder="Sampai H-" value="<?php if(!empty($set)) echo $set->set_jadwal_daftar_s ?>">
                                            <div class="text-error" id="err_set_jadwal_daftar_s"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="email">Jam Selesai:</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="set_jam_daftar_s" name="set_jam_daftar_s" placeholder="Jam Daftar Selesai" value="<?php if(!empty($set)) echo $set->set_jam_daftar_s ?>">
                                            <div class="text-error" id="err_set_jadwal_daftar_s"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="email">Lama Blokir (Jika pasien tidak hadir diblokir beberapa hari kedepan):</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="set_lama_blokir" name="set_lama_blokir" placeholder="Lama Blokir" value="<?php if(!empty($set)) echo $set->set_lama_blokir ?>">
                                            <div class="text-error" id="err_set_jadwal_daftar_s"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="email">Pesan Saat Pendaftaran Tutup:</label>
                                        <div class="col-sm-12">
                                            <textarea name="set_pesan" id="set_pesan" cols="30" rows="5" class="form-control" ><?php if(!empty($set)) echo $set->set_pesan ?></textarea>
                                            <div class="text-error" id="err_set_pesan"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <?php if(!empty($set)) $set_kajian_mandiri_covid = $set->set_kajian_mandiri_covid; else $set_kajian_mandiri_covid=0; ?>
                                            <input type="checkbox" value="1" name="set_kajian_mandiri_covid" id="set_kajian_mandiri_covid" <?php if($set_kajian_mandiri_covid==1) echo "checked" ?>> Munculkan Kajian Mandiri Covid 19
                                            <div class="text-error" id="err_status"></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <?php if(!empty($set)) $status = $set->set_status; else $status="Non Aktif"; ?>
                                            <input type="checkbox" value="Aktif" name="set_status" id="set_status" <?php if($status=="Aktif") echo "checked" ?>> Aktif
                                            <div class="text-error" id="err_status"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <button type="button" class="btn btn-success" onclick="simpan()">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>


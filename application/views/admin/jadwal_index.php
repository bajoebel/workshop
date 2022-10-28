<style>
	select{
		font-family: fontAwesome
	}
</style>
<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Smart Hospital</a></li>
                <li class="active">Dokter</li>
            </ol>
            <div class="row">
                <div class="tombol" id="tombol">
                    <a href="#" onclick="add()" class="btn">
                    <span class="fa fa-plus"></span>
                    </a>
                </div>
                <div class='col-md-5' id="form_box" style="display:none">
                    <div class="form-box">
                        <div class="form-header">
                            Form Jadwal Dokter
                        </div>
                        <div class="form-body">
                            <form action="#" class="form-horizontal" id="form" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Dokter:</label>
                                    <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="jadwal_id" name="jadwal_id">
                                        <select name="jadwal_dokter_id" id="jadwal_dokter_id" class="form-control">
                                            <option value="">Pilih Dokter</option>
                                            <?php 
                                            foreach ($dokter as $s ) {
                                                ?>
                                                <option value="<?= $s->dokter_id?>"><?= $s->dokter_nama ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="text-error" id="err_jadwal_dokter_id"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Poliklinik:</label>
                                    <div class="col-sm-10">
                                        
                                        <select name="jadwal_poly_id" id="jadwal_poly_id" class="form-control">
                                            <option value="">Pilih Poliklinik</option>
                                            <?php 
                                            foreach ($poly as $s ) {
                                                ?>
                                                <option value="<?= $s->poly_id?>"><?= $s->poly_nama ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="text-error" id="err_jadwal_poly_id"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email"> Hari:</label>
                                    <div class="col-sm-10">
                                        <select name="jadwal_hari" id="jadwal_hari" class="form-control" >
                                            <option value="">Pilih Hari</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                        </select>
                                        <div class="text-error" id="err_jadwal_hari"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Pekan:</label>
                                    <div class="col-sm-10">
                                        <select name="jadwal_pekan" id="jadwal_pekan" class="form-control">
                                            <option value="0">Semua Pekan</option>
                                            <option value="1">Ganjil</option>
                                            <option value="2">Genap</option>
                                        </select>
                                        <div class="text-error" id="err_jadwal_pekan"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Batch:</label>
                                    <div class="col-md-10">
                                        <select name="jadwalgroup" id="jadwalgroup" class="form-control" onchange="viewGroup()">
                                            <option value="">Pilih Batch</option>
                                            <?php 
                                            foreach ($group as $g) {
                                                ?>
                                                <option value="<?= $g->idx ?>"><?= $g->group_label ?></option>
                                                <?php
                                            }
                                            ?>
                                            <option value="baru">&#xf055; Buat Batch Baru</option>
                                        </select>
                                        <div class="text-error" id="err_jadwalgroup"></div>
                                    </div>
                                </div>
                                <div id="group"></div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">&nbsp;</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" value="Aktif" name="jadwal_status" id="jadwal_status"> Aktif
                                        <div class="text-error" id="err_status"></div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-danger" onclick="resetApp()">Batal</button>
                                    <button type="button" class="btn btn-success" onclick="simpan()">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="col-md-12" id="tabel_box">
                    <div class="tabel-box">
                        <div class="filter-box">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="has-feedback">
                                        <input type="hidden" id="start" name="start" value="1">
                                        <input type="text" class="form-control input-sm" id="q" name="q" onkeyup="getData(1)" placeholder="Keyword">
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select name="poly" id="poly" class="form-control" onchange="getData(1)">
                                        <option value="">Pilih Poly</option>
                                        <?php 
                                        foreach ($poly as $d ) {
                                            ?>
                                            <option value="<?= $d->poly_id ?>"><?= $d->poly_nama ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="dokter" id="dokter" class="form-control" onchange="getData(1)">
                                        <option value="">Pilih Dokter</option>
                                        <?php 
                                        foreach ($dokter as $d ) {
                                            ?>
                                            <option value="<?= $d->dokter_id ?>"><?= $d->dokter_nama ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="hari" id="hari" class="form-control" onchange="getData(1)">
                                        <option value="">Pilih Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="pekan" id="pekan" class="form-control" onchange="getData(1)">
                                        <option value="0">Semua Pekan</option>
                                        <option value="1">Ganjil</option>
                                        <option value="2">Genap</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <select name="limit" id="limit" class="form-control input-sm" onchange="getData(1)">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row top10">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Poliklinik</th>
                                            <th>Dokter</th>
                                            <th>Hari</th>
                                            <th>Pekan</th>
                                            <th>Status</th>
                                            <th style="width:150px">#</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>


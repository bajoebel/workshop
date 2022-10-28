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
                <div class='col-md-4' id="form_box" style="display:none">
                    <div class="form-box">
                        <div class="form-header">
                            Form Dokter
                        </div>
                        <div class="form-body">
                            <form action="#" class="form-horizontal" id="form" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">NRP (Harus sama dengan SIMRS):</label>
                                    <div class="col-sm-8">
                                    <input type="hidden" class="form-control" id="dokter_id" name="dokter_id">
                                        <input type="text" class="form-control" id="nrp" name="nrp" placeholder="Enter NRP ">
                                        <div class="text-error" id="err_nrp"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Spesialis:</label>
                                    <div class="col-sm-8">
                                        
                                        <select name="dokter_spesialis_id" id="dokter_spesialis_id" class="form-control">
                                            <?php 
                                            foreach ($spesialis as $s ) {
                                                ?>
                                                <option value="<?= $s->spesialis_id?>"><?= $s->spesialis_nama ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="text-error" id="err_dokter_spesialis_id"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Nama Dokter:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="dokter_nama" name="dokter_nama" placeholder="Enter Nama Dokter ">
                                        <div class="text-error" id="err_dokter_nama"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Jekel:</label>
                                    <div class="col-sm-8">
                                        <select name="dokter_jekel" id="dokter_jekel" class="form-control">
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <div class="text-error" id="err_dokter_jekel"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">No Telp:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="dokter_notelp" name="dokter_notelp" placeholder="No telp ">
                                        <div class="text-error" id="err_dokter_notelp"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Jenis Dokter:</label>
                                    <div class="col-sm-8">
                                        <select name="dokter_jenis" id="dokter_jenis" class="form-control">
                                            <option value="UMUM">UMUM</option>
                                            <option value="SPESIALIS">SPESIALIS</option>
                                        </select>
                                        <div class="text-error" id="err_dokter_jenis"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Foto:</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="dokter_fhoto" name="dokter_fhoto[]" placeholder="Foto ">
                                        <div class="text-error" id="err_dokter_notelp"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" value="Aktif" name="dokter_status" id="dokter_status"> Aktif
                                        <div class="text-error" id="err_status"></div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
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
                                <div class="col-md-11">
                                    <div class="has-feedback">
                                        <input type="hidden" id="start" name="start" value="1">
                                        <input type="text" class="form-control input-sm" id="q" name="q" onkeyup="getData(1)" placeholder="Keyword">
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                    </div>
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
                                            <th>NRP</th>
                                            <th>Spesialis</th>
                                            <th>Nama</th>
                                            <th>Jekel</th>
                                            <th>No Telp</th>
                                            <th>Jenis</th>
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


<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Smart Hospital</a></li>
                <li class="active">Poliklinik</li>
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
                            Form Poliklinik
                        </div>
                        <div class="form-body">
                            <form action="#" class="form-horizontal" id="form" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">ID (Sesuai Simrs):</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="poly_id" name="poly_id" placeholder="Enter Poly Id">
                                        <div class="text-error" id="err_poly_id"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Poly Kode BPJS:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="poly_kode" name="poly_kode" placeholder="Enter Kode">
                                        <div class="text-error" id="err_poly_kode"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Poliklinik:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="poly_nama" name="poly_nama" placeholder="Enter Nama poly">
                                        <div class="text-error" id="err_poly_nama"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Group Layanan :</label>
                                    <div class="col-sm-8">
                                        <select name="poly_glid" id="poly_glid" class="form-control">
                                            <?php 
                                            foreach ($group as $gr ) {
                                                ?>
                                                <option value="<?= $gr->glId ?>"><?= $gr->glNama  ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="text-error" id="err_poly_glid"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Icon:</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="poly_image[]" id="poly_image" class="form-control">
                                        <div class="text-error" id="err_poly_induk"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" value="1" name="poly_induk" id="poly_induk"> Sebagai Poliklinik Utama
                                        <div class="text-error" id="err_poly_induk"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" value="Aktif" name="poly_status" id="poly_status"> Aktif
                                        <div class="text-error" id="err_poly_status"></div>
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
                                <div class="col-md-9">
                                    <div class="has-feedback">
                                        <input type="hidden" id="start" name="start" value="1">
                                        <input type="text" class="form-control input-sm" id="q" name="q" onkeyup="getData(1)" placeholder="Keyword">
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select name="group" id="group" class="form-control" onchange="getData(1)">
                                            <?php 
                                            foreach ($group as $gr ) {
                                                ?>
                                                <option value="<?= $gr->glId ?>"><?= $gr->glNama  ?></option>
                                                <?php
                                            }
                                            ?>
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
                                            <th>ID(Sesuai SIMRS)</th>
                                            <th>Poliklinik</th>
                                            <th>Group Layanan</th>
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


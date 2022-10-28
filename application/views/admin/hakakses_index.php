<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Pengaturan</a></li>
                <li class="active">Pengaturan Hak Akses</li>
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
                            Form Hak Akses
                        </div>
                        <div class="form-body">
                            <form action="#" class="form-horizontal" id="form" method="POST">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Level:</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" id="idx" name="idx" >
                                        <input type="text" class="form-control" id="level" name="level" placeholder="Enter Level">
                                        <div class="text-error" id="err_level"></div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Hak akses</label>
                                    <div class="col-sm-8" id="hakakses">
                                        <?php 
                                        foreach ($menu as $m ) {
                                            ?>
                                            <input type="hidden" value="<?= $m->idx ?>" name="idx_modul[]" id="idx_modul[]">
                                            <?php
                                            if($m->idx_utama>0){
                                                ?>
                                                <div style='padding-left:20px'>
                                                <input type="checkbox" class="pilih<?= $m->idx_utama ?>" value="<?= $m->idx ?>" name="pilih<?= $m->idx ?>" id="pilih<?= $m->idx ?>" > <?= $m->judul_menu."<br>" ?>
                                                </div>
                                                <?php
                                            }else{
                                                ?>
                                                <div>
                                                <input type="checkbox" value="<?= $m->idx ?>" name="pilih<?= $m->idx ?>" id="pilih<?= $m->idx ?>" onclick="checkAll(<?= $m->idx ?>)"> <?= $m->judul_menu."<br>" ?>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <div class="text-error" id="err_modul"></div>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label class="control-label col-sm-4" for="pwd">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" value="1" name="aktif" id="aktif"> Aktif
                                        <div class="text-error" id="err_aktif"></div>
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
                                            <th>Level</th>
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


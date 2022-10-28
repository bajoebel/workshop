<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Pengguna</a></li>
                <li class="active">Users</li>
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
                            Form User
                        </div>
                        <div class="form-body">
                            <form action="#" class="form-horizontal" id="form" method="POST"  enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Nama Lengkap:</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" id="user_id" name="user_id" >
                                        <input type="text" class="form-control" id="user_nama_lengkap" name="user_nama_lengkap"placeholder="Enter Nama lengkap">
                                        <div class="text-error" id="err_user_nama_lengkap"></div>
                                    </div>
                                    
                                </div>
                                <div class="form-group" >
                                    <label class="control-label col-sm-4" for="email">Email:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Enter Email">
                                        <div class="text-error" id="err_user_email"></div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Password:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter Password">
                                        <div class="text-error" id="err_user_password"></div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Level:</label>
                                    <div class="col-sm-8">
                                        
                                        <select name="user_idxlevel" id="user_idxlevel" class="form-control">
                                            <option value="">Pilih Level</option>
                                            <?php 
                                            foreach ($level as $l ) {
                                                ?>
                                                <option value="<?= $l->idx ?>"><?= $l->level?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="text-error" id="err_user_idxlevel"></div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="email">Foto:</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="user_photo" name="user_photo[]">
                                        <div class="text-error" id="err_user_photo"></div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" name="user_status" id="user_status" value="Aktif">Aktif
                                        <div class="text-error" id="err_user_status"></div>
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
                                            <th>Nama</th>
                                            <th>Email</th>
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


<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Blog</a></li>
                <li class="active">Kategori</li>
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
                            Form Menu
                        </div>
                        <div class="form-body">
                            <form action="#" class="form-horizontal" id="form" method="POST">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Judul:</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="menu_id" name="menu_id" >
                                        <input type="text" class="form-control" id="menu_judul" name="menu_judul" placeholder="Judul">
                                        <div class="text-error" id="err_menu_judul"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Link:</label>
                                    <div class="col-md-2">
                                        <input type="checkbox" name="menu_base_url" id="menu_base_url" value="1"> Base Url
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="menu_link" name="menu_link" placeholder="Link">
                                        <div class="text-error" id="err_menu_link"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Kode:</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="menu_idxutama" name="menu_idxutama" placeholder="Utama">
                                        <div class="text-error" id="err_menu_idxutama"></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="menu_idxanak" name="menu_idxanak" placeholder="Anak">
                                        <div class="text-error" id="err_menu_idxanak"></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="menu_idxsub" name="menu_idxsub" placeholder="Sub Anak">
                                        <div class="text-error" id="err_menu_idxsub"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">&nbsp;</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" value="1" name="menu_status" id="menu_status"> Aktif
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
                                            <th>Kode</th>
                                            <th>Judul</th>
                                            <th>Link</th>
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


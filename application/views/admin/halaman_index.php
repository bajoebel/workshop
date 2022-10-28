<!-- <script src="https://cdn.tiny.cloud/1/exvkmwmfvqrouariv43t1vn1dnrh79uyq6um6p1z00wscr84/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
<script src="<?= base_url() ."js/tinymce.min.js"?>" referrerpolicy="origin"></script>
<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Blog</a></li>
                <li class="active">Berita</li>
            </ol>
            <div class="row">
                <div class="tombol" id="tombol">
                    <a href="#" onclick="add()" class="btn">
                    <span class="fa fa-plus"></span>
                    </a>
                </div>
                <div class='col-md-12' id="form_box" style="display:none;">
                    <div class="form-box">
                        <div class="form-header">
                            Form Berita
                        </div>
                        <div class="form-body">
                            <form action="<?= base_url() ."admin/halaman/simpan"; ?>" id="form" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="email">Judul:</label>
                                        <div class="col-sm-12">
                                            <input type="hidden" id="post_id" name="post_id" >
                                            <input type="hidden" id="post_kategori_id" name="post_kategori_id" >
                                            <input type="text" class="form-control" id="post_judul" name="post_judul" placeholder="Judul" required>
                                            <div class="text-error" id="err_post_judul"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="email">Isi Halaman:</label>    
                                        <div class="col-md-12">
                                        <textarea id="full-featured-non-premium" name="post_isi"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="email">Tanggal Publish:</label>
                                        <div class="col-sm-12">
                                            <div class="has-feedback">
                                            <input type="text" class="form-control" id="post_tglpublish" name="post_tglpublish" placeholder="Tanggal Publish" required>
                                                <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                            </div>
                                            
                                            <div class="text-error" id="err_post_judul"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="email">Thumb:</label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" id="post_image" name="post_image[]" >
                                            <div class="text-error" id="err_post_image"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label class="control-label" for="email">Status:</label>
                                            <select name="post_status" id="post_status" class="form-control">
                                                <option value="Draft">Draft</option>
                                                <option value="Publish">Publish</option>
                                                <option value="Unpublish">Unpublish</option>
                                            </select>
                                            <div class="text-error" id="err_status"></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="checkbox" value="Aktif" name="post_status_komen" id="post_status_komen"> Bisa Meninggalkan Komentar
                                            <div class="text-error" id="err_post_status_komen"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <button type="button" class="btn btn-danger" onclick="resetApp()">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
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
                                            <th>Judul</th>
                                            <th>Link</th>
                                            <th>Tgl Publish</th>
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


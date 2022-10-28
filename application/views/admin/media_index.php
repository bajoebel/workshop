<style>
    .custom-menu {
        display: none;
        z-index: 1000;
        position: absolute;
        overflow: hidden;
        border: 1px solid #CCC;
        white-space: nowrap;
        font-family: sans-serif;
        background: #FFF;
        color: #333;
        border-radius: 5px;
    }

    .custom-menu li {
        padding: 8px 12px;
        cursor: pointer;
    }

    .custom-menu li:hover {
        background-color: #DEF;
    }
</style>
<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Blog</a></li>
                <li class="active">Media</li>
            </ol>
            <div class="row">
                <div class="tombol" id="tombol">
                    <a href="#" class="btn"  onclick="create()">
                    <span class="fa fa-plus"></span> Buat Folder
                    </a>
                </div>
                <div class="col-md-12" id="tabel_box">
                    <div class="tabel-box">
                        <div class="filter-box">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="has-feedback">
                                        <input type="hidden" id="root" name="root" value="./media">
                                        <input type="text" class="form-control input-sm" id="filepath" name="filepath" onkeyup="filemanager()" placeholder="Keyword">
                                        <span class="glyphicon glyphicon-folder-open form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <!-- <input type="file" name="files" id="files" class='btn btn-default'> -->
                                    <button class="btn btn-default btn-block" onclick="viewUpload()"><span class="fa fa-upload" ></span> Upload File</button>
                                </div>
                            </div>
                        </div>
                        <div class="row top10">
                            <div class="col-md-12">
                            <div id="files"></div>
                            </div>
                            
                        </div>
                    </div>
                    <div id="pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="newfolder" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Folder</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form">
                    <div class="input-group">
                        <input type="hidden" name="curent_dir" id="curent_dir">
                        <input type="text" class="form-control" id="newfolder" name="newfolder" placeholder="Nama Folder">
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="button" onclick="createFolder()">
                                <i class="glyphicon glyphicon-plus"></i> Create
                            </button>
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>
<div id="uploadfile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload File</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form1"  enctype="multipart/form-data">
                    <div class="input-group">
                        <input type="hidden" name="curent_dir1" id="curent_dir1">
                        <input type="file" class="form-control" id="userfile" name="userfile[]" placeholder="Nama Folder">
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="button" onclick="uploadFile()">
                                <i class="glyphicon glyphicon-plus"></i> Upload
                            </button>
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>
<style type="text/css">
.pasienbaru{
    border:solid #0eab4c; border-collapse: collapse;padding: 5px;border-radius: 90pt
}
.pertanyaan {
    display: table;
    top: 0px;
    left: 0px;
    z-index: 1;
    width: 100%;
    padding: 10px;
    background: #fefefe;
    font-size: .875em;
    border-radius: 5px;
    box-shadow: 0 1px 3px #ccc;
    border: 1px solid #ddd;
    margin-bottom: 10px;
}
</style>
<div class="container">
            
                <center>
                    <div class="my_text">
                        <div id="o-control-keyword">
                            
                            <ol class="breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li class="active"><a href="#">Registrasi</a></li>
                            </ol>
                            <div class="panel panel-success">
                                <div class="panel-heading bg-green">
                                    <h3 class="panel-title">Registrasi</h3>
                                </div>
                                <div class="panel-body">
                                    
                                    <form action="#" id="o-cari" method="POST" onsubmit="return false" >
                                        <div class="top20">
                                        
                                            <div class="row">
                                                <div class="form-input">
                                                    <div class="col-md-6 col-lg-6 col-xs-12" style="margin-top:15px">
                                                        <label for="Nama Lengkap">Nama Lengkap</label>
                                                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap & gelar">
                                                    </div>
                                                </div>
                                                <div class="form-input">
                                                    <div class="col-md-6 col-lg-6 col-xs-12" style="margin-top:15px">
                                                        <label for="Email">Email</label>
                                                        <input type="text" name="email" class="form-control" placeholder="Masukkan Email">
                                                    </div>
                                                </div>
                                                <div class="form-input">
                                                    <div class="col-md-4 col-lg-4 col-xs-12" style="margin-top:15px">
                                                        <label for="Email">Fax</label>
                                                        <input type="text" name="institusi" class="form-control" placeholder="Masukkan Email">
                                                    </div>
                                                </div>
                                                <div class="form-input">
                                                    <div class="col-md-4 col-lg-4 col-xs-12" style="margin-top:15px">
                                                        <label for="Email">Institusi</label>
                                                        <input type="text" name="institusi" class="form-control" placeholder="Masukkan Email">
                                                    </div>
                                                </div>
                                                <div class="form-input">
                                                    <div class="col-md-4 col-lg-4 col-xs-12" style="margin-top:15px">
                                                        <label for="Email">No Telp</label>
                                                        <input type="text" name="notelp" class="form-control" placeholder="Masukkan No telp">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-input">
                                                    <div class="col-md-3 col-lg-3 col-xs-12" style="margin-top:15px">
                                                        <label for="Email">Peserta Diatas 70 Tahun</label><br>
                                                        <label for=""><input type="radio" name="umur70" id="ya" value="1" onclick="cekHarga()">Ya</label> &nbsp;
                                                        <label for=""><input type="radio" name="umur70" id="tidak" value="0" onclick="cekHarga()">Tidak</label> &nbsp;
                                                    </div>
                                                </div>
                                                
                                                <div class="form-input">
                                                    <div class="col-md-3 col-md-3 col-xs-12" style="margin-top:15px">
                                                        <label for="">Kategori Peserta</label><br>
                                                        <?php 
                                                        foreach ($peserta as $p) {
                                                            ?>
                                                            <input type="radio" name="kategoripesertaid" id="kategoripesertaid<?= $p->kategoripesertaid ?>" value="<?= $p->kategoripesertaid ?>" onclick="cekHarga()"> <?= $p->kategorinama ?><br>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-input">
                                                    <div class="col-md-6 col-lg-6 col-xs 12" style="margin-top:15px">
                                                        <label for="kategori">Kategori Kegiatan</label><br>
                                                        <?php 
                                                        foreach ($kegiatan as $k ) {
                                                            ?>
                                                            <input type="checkbox" name="kategoriregistrasiid[]" id="kategoriregistrasiid<?= $k->kategoriregistrasiid?>" value="<?= $k->kategoriregistrasiid?>" onclick="cekHarga()"> <?= $k->kategoriregistrasi?>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="row">
                                                <div class="form-input">
                                                    <div class="col-md-2 col-xs-12" style="margin-top:15px">
                                                        <button class="btn btn-success">Simpan Pendaftaran</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </center>
            
        </div>

    <!-- Modal no bpjs -->
    <div id="modal_nobpjs" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align:center">Cek Status Kepesertaan BPJS</h4>
                </div>
                <div class="modal-body">
                    <h3 style="text-align:center;margin-bottom:10px">Masukkan No Kartu BPJS Anda</h3>
                    <div class="input-group">
                        <input type="text" class="form-control input-lg num_keybord" name="cek_nobpjs" id="cek_nobpjs" value="" placeholder="Masukkan No BPJS">
                        <span class="input-group-btn">
                            <button class="btn btn-success btn-lg" onclick="cekStatus()">Cek Status</button>
                        </span>
                    </div>
                    <h3 style="text-align:center">&nbsp;</h3>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>
    <script>
        
    </script>
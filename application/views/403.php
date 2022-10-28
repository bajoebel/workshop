<div class="row">
    <div class="col-md-12">
        
        <div class="content-admin">
            <ol class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><a href="#">403</a></li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="error-box">
                    <h1>403</h1>
                    <?php 
                    if(empty($this->session->userdata('level'))) 
                    $inst="Maaf anda tidak punya hak akses ke halaman ini karena session anda sudah expire silahkan login kembali untuk melanjutkan <br>Terima kasih";
                    else $inst="Maaf anda tidak punya hak akses ke halaman ini silahkan kontak administrator";
                    ?>
                    <p><?= $inst ?></p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
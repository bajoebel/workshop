<style type="text/css">
    .form-group{
        padding: 10px;
    }
</style>
<div class="">
    <div class="my_text ">
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="isi" style="height: 75vh ;">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">Login</li>
                        </ol>
                        <div class="login-box">
                            <div class="login-form">
                                <div class="panel panel-success">
                                    
                                    <div class="panel-body">
                                        <form action="#" id="form" class="form-horizontal" method="POST" onclick="return false" >
                                            <div class="logo-login">
                                                <img src="<?= base_url() ."img/icon/login.jpg"?>" alt="">
                                            </div>
                                            <div id="message"></div>
                                            <div class="form-group marginhorizontal5">
                                                <div class="has-feedback">
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                                    
                                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                                </div>
                                                <span id='err_username' class="text-error"></span>
                                            </div>
                                            <div class="form-group marginhorizontal5">
                                                <div class="has-feedback">
                                                <input type="password" class="form-control input-sm" id="password" name="password" placeholder="Password">
                                                <span class="fa fa-key form-control-feedback"></span>
                                                </div>
                                                <span id='err_password' class="text-error"></span>
                                            </div>
                                            <div class="form-group marginhorizontal5">
                                                <div class="chapcha">
                                                    <?php 
                                                    $opt=rand(1,10);
                                                    $opt1=rand(1,10);
                                                    $tot=$opt+$opt1;
                                                    ?>
                                                    <label for=""><?= "<span id='opt1'>".$opt ."</span> + <span id='opt2'>" .$opt1 ?></span> = ?</label>
                                                </div>
                                            </div>
                                            <div class="form-group marginhorizontal5">
                                                <div class="has-feedback">
                                                    <input type="text" class="form-control" id="jawaban" name="jawaban" placeholder="Masukkan Jawaban">
                                                    <span class="fa fa-reply form-control-feedback"></span>
                                                </div>
                                                <span id='err_jawaban' class="text-error"></span>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-success" onclick="login()">Log In</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
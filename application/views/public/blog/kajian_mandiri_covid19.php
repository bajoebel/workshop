<style type=text/css>
    .ui-autocomplete-loading {
        background: white url("<?php echo base_url() ?>ui-anim_basic_16x16.gif") right center no-repeat;
    }
    .ui-autocomplete-input {
        border: none;
        font-size: 14px;
        border: 1px solid #DDD !important;
        /*z-index: 1511;*/
        position: relative;
    }
    .ui-menu .ui-menu-item a {
        font-size: 12px;
    }
    .ui-autocomplete {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1510 !important;
        float: left;
        display: none;
        min-width: 160px;
        width: 160px;
        padding: 4px 0;
        margin: 2px 0 0 0;
        list-style: none;
        background-color: #ffffff;
        border-color: #ccc;
        border-color: rgba(0, 0, 0, 0.2);
        border-style: solid;
        border-width: 1px;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
        *border-right-width: 2px;
        *border-bottom-width: 2px;
    }

    .ui-menu-item>a.ui-corner-all {
        display: block;
        padding: 3px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;
        text-decoration: none;
    }

    .ui-state-hover,
    .ui-state-active {
        color: #ffffff;
        text-decoration: none;
        background-color: #0088cc;
        border-radius: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        background-image: none;
    }
    .pertanyaan{
        display: table;
        /*
        * position: absolute;
        */
        top: 0px;
        left: 0px;
        z-index: 1;
        width:100%;
        padding:5px;
        background:#fefefe;
        font-size:.875em;
        border-radius:5px;
        box-shadow:0 1px 3px #ccc;
        border:1px solid #ddd;
        margin-bottom:10px;
    }
</style>
<section id="partner" class="page-section <?php if(empty($slider)) echo "paddingtop-100"; ?>">	
	
	<div class="container my_text">
		<div class="row">
			<div class="col-md-12">
				<div id="content">
                    <div class="judul">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="wow lightSpeedIn animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: lightSpeedIn;">
                                    <div class="section-heading text-center">
                                        <h4 class="h-bold">
                                        Form Kajian Mandiri Resiko Covid-19 Pegawai RSUD Kota Padang Panjang
                                        </h4>
                                            
                                    </div>
                                </div>
                                <div class="divider-short"></div>
                            </div>
                        </div>	
                    </div>

                    <div class="isi">
                        <div class="row">
                            <div class="col-md-12 ">
                                <form>
                                    <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" id="qpegawai" placeholder="Masukkan nama atau nip" >
                                        <div class="input-group-btn">
                                        <button class="btn btn-success" type="button" onclick="getPegawai(0)">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                                <br>&nbsp;
                            </div>
                        </div>
                        <div id="media">
                            <form action="<?= base_url() ."welcome/simpankajian"; ?>" method="POST" id="form" class='form-horizontal'>
                                <!--div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                                    </div>
                                </div-->
                                <?php 
                                $message=$this->session->flashdata('message');
                                if ($message!=""||$message!=null) {
                                    if($message=="-") {
                                        $warna = "danger";
                                        $resiko = "Data Pegawai Tidak Ditemukan";
                                        $sop="";
                                    }elseif($message=="Data kajian mandiri covid-19 anda sudah diinput untuk hari ini, silahkan isi lagi besok"){
                                        $warna = "success";
                                        $resiko = $message;
                                        $sop="";
                                    }else{
                                        if($message>4) {
                                            $resiko = "(".$message.") Resiko tinggi";
                                            $warna = "danger";
                                            $sop = "Untuk anda yang beresiko Tinggi, segera hubungi tim tracking 
                                            <ol>
                                            <li>dr. Rio akhdanelly No.HP 0822 8300 0797</li>
                                            <li>Zilda engreni No.HP 0812 6791 148</li>
                                            <li>Oltia Sri madona No.HP 0813 7414 6673</li>
                                            </ol>
                                            Atau hubungi bagian kepegawaian Risa No HP : 0812 6713 7477, Keputusan selanjutnya adalah hasil tracking dari tim
                                            ";
                                        }elseif ($message>=1 && $message<=4) {
                                            $resiko = "(".$message.") Resiko sedang";
                                            $warna = "warning";
                                            $sop="Untuk anda yang beresiko sedang, selamat anda dapat melaksanakan pekerjaan hari ini, tetap melaksanakan pekerjaan dengan protokol <b>3M</b>
                                            <ol>
                                            <li><b>M</b>encuci Tangan</li>
                                            <li><b>M</b>emakai Masker</li>
                                            <li><b>M</b>enjaga Jarak</li>
                                            </ol>
                                            Tingkatkan imun tubuh";
                                        }else{
                                            $resiko = "(".$message.") Resiko rendah";
                                            $warna = "success";
                                            $sop="Untuk anda yang beresiko rendah, selamat anda dapat melaksanakan pekerjaan hari ini, tetap melaksanakan pekerjaan dengan protokol <b>3M</b>
                                            <ol>
                                            <li><b>M</b>encuci Tangan</li>
                                            <li><b>M</b>emakai Masker</li>
                                            <li><b>M</b>enjaga Jarak</li>
                                            </ol>
                                            Pertahakan keadaan ini untuk selanjutnya ";
                                        }
                                    }

                                    ?>
                                    <div class='panel panel-<?= $warna ?>'>
                                        <div class="panel-body">Berdasarkan hasil penilaian kajian mandiri covid-19 yang telah diisi tingkat resiko anda yaitu 
                                        </div>
                                    </div>
                                    <div class="alert alert-<?= $warna ?>">
                                      <p><?php echo $resiko ; ?></p>
                                    </div>
                                    <div class='panel panel-<?= $warna ?>'>
                                        <div class="panel-body">
                                            <p><?= $sop ?> </p>
                                        </div>
                                    </div>
                                  <?php
                                }
                                ?>
                            </form>
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><div class="col-md-12"><div id="halaman"></div></div></div>
                        </div>
                    </div>
				</div>
			</div>

			
			<div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    
                </div>
            </div>
            </div>
			<!--div class="col-md-6">
				<div class="sidebar">
					<div class="sidebar-title">Info Ketersediaan Kamar</div>
					<div class="sidebar-content">

					</div>
					<div class="sidebar-footer"></div>
				</div>
			</div-->
			
		</div>
    </div>
</section>	

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    $(document).ready(function() {
        console.clear();
        console.log("starting app...")
        $("#qpegawai").autocomplete({ 
                source: function (request, response) {
                    $.ajax({
                        url: "<?php echo base_url() . 'welcome/pegawai' ?>",
                        dataType: "JSON",
                        method: "POST",
                        data: {
                            param1: request.term
                        },
                        success: function (data) {
                            console.clear();
                            console.log(data);
                            
                            response(data.slice(0, 15));
                        },
                        error: function (jqXHR, ajaxOption, errorThrown) {
                            console.log(errorThrown);
                        }
                    });
                },
                minLength: 2,
                focus: function (event, ui) {
                    //$("#tujuan").val(ui.item['kode']);
                    //$("#txtnmpoli").val(ui.item['nama']);
                    //$("#txtnmpoli").removeClass("ui-autocomplete-loading");
                    return false;
                },
                select: function (event, ui) {
                    $('#qpegawai').val("");
                    viewFormKajian(ui.item['idx'])
                    //$("#tujuan").val(ui.item['kode']);
                    //$("#txtnmpoli").val(ui.item['nama']);
                    //$("#txtnmpoli").removeClass("ui-autocomplete-loading");
                    return false;
                }
        })
        .autocomplete("instance")
        ._renderItem = function (table, item) {
                return $("<tr class='autocomplete'>")
                    .append(
                        "<td style='width:200px'>" + item['nip'] + "</td><td style='width:70%'>" +
                        item['nama_pegawai'] + "</td>"
                    )
                    .appendTo(table);
        };
    });

    function viewFormKajian(idx){
        var url = "<?= base_url()."welcome/form_kajian/" ?>"+idx;
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: 'HTML',
            success: function(data)
            {
                $('#form').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert(url);
                //$.Notify({style: {background: 'red', color: 'white'}, content: "Error saat Penyimpanan Data"});
            }
        });
        return false;
    }
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Resertvasi</title>
    <link type="text/css" rel="stylesheet" href="<?= base_url() ."css/bootstrap.min.css"; ?>">
    <style type="text/css">
        @page {
            margin: 5px;
        }
    </style>
</head>
<body>
<div id="buktireservasi" class="container" style="border:1px solid #ccc; border-collapse:collapse;padding:5px;">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Bukti Reservasi Pendaftaran Online</h1>
            <p>RSUD Kota Padang Panjang</p>
        </div>
        <hr>

        
    <div class="col-md-4 col-xs-6">
        <div class="text-center" id="qrcode">
            <img src="<?= base_url() ."welcome/qr/".encrypt_decrypt('encrypt', $idx, true); ?>" alt="">
        </div>
        <table class="table">
            <tr>
                <td style="width:130px">Tgl Daftar </td>
                <td>: <span id="res_tgldaftar"><?= $tanggal_daftar ?></span> </td>
            </tr>
            <tr>
                <td>Nomr</td>
                <td>: <span id="res_nomr"><?= $nomr  ?></span> </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: <span id="res_nama"><?= $nama_pasien ?></span> </td>
            </tr>
            <tr>
                <td>Tgl Kunjungan</td>
                <td>: <span id="res_tglkunjungan"><?= $tanggal_kunjungan ?></span> </td>
            </tr>
            <tr>
                <td>Jam Kunjungan</td>
                <td>: <span id="res_jam_kunjungan"><?= $jam_kunjunganLabel ?></span> </td>
            </tr>
            <tr>
                <td>Poli Tujuan</td>
                <td>: <span id="res_poli"><?= $nama_ruang ?></span> </td>
            </tr>
            <tr>
                <td>Cara Bayar</td>
                <td>: <span id="res_cara_bayar"><?= $cara_bayar ?></span> </td>
            </tr>
        </table>
    </div>
    <div class="col-md-8 col-xs-6">
    <?php 
        $kajian_mandiri=1;
        if($kajian_mandiri==1){?>
            <div class="col-md-12">
                <?php 
                if($point_kajian_covid ==0){
                    ?>
                    <div class='panel panel-success'>
                        <div class="panel-body">
                        <b>Pemberitahuan</b><br>Berdasarkan hasil penilaian kajian mandiri covid-19 yang telah diisi tingkat resiko anda yaitu 
                        </div>
                    </div>
                    
                    <div class="alert alert-success" role="alert">
                    (<?= $point_kajian_covid; ?>) Resiko Rendah
                    </div>
                    <div class='panel panel-success'>
                        <div class="panel-body">
                        Silahkan datang untuk berkunjung berobat ke RSUD Padang Panjang dan tetap melaksanakan protokol kesehatan dengan 3M 
                        <ol>
                            <li><b>M</b>emakai Masker</li>
                            <li><b>M</b>encuci Tangan</li>
                            <li><b>M</b>enjaga Jarak</li>
                        </ol>
                        pertahankan kondisi ini agar anda tetap sehat
                        </div>
                    </div>
                    <?php
                }elseif($point_kajian_covid >=1 && $point_kajian_covid <= 4){
                    ?>
                    <div class='panel panel-warning'>
                        <div class="panel-body">
                        <b>Pemberitahuan</b><br>Berdasarkan hasil penilaian kajian mandiri covid-19 yang telah diisi tingkat resiko anda yaitu 
                        </div>
                    </div>
                    <div class="alert alert-warning" role="alert">
                    (<?= $point_kajian_covid; ?>) Resiko Sedang 
                    </div>
                    <div class='panel panel-warning'>
                        <div class="panel-body">
                        Silahkan datang untuk berkunjung berobat ke RSUD Padang Panjang dan tetap melaksanakan protokol kesehatan dengan 3M 
                        <ol>
                            <li><b>M</b>emakai Masker</li>
                            <li><b>M</b>encuci Tangan</li>
                            <li><b>M</b>enjaga Jarak</li>
                        </ol>
                        tingkatkan imunitas tubuh
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class='panel panel-danger'>
                        <div class="panel-body">
                        <b>Pemberitahuan</b><br>Berdasarkan hasil penilaian kajian mandiri covid-19 yang telah diisi tingkat resiko anda yaitu 
                        </div>
                    </div>
                    <div class="alert alert-danger" role="alert">
                    (<?= $point_kajian_covid; ?>) Resiko Tinggi
                    </div>
                    <div class='panel panel-danger'>
                        <div class="panel-body">
                        Silahkan datang untuk berkunjung berobat ke RSUD Padang Panjang dan melapor pada petugas di pintu masuk utama, dat tetap mematuhi protokol kesehatan 3M
                        <ol>
                            <li><b>M</b>emakai Masker</li>
                            <li><b>M</b>encuci Tangan</li>
                            <li><b>M</b>enjaga Jarak</li>
                        </ol>
                        tingkatkan imunitas tubuh
                        </div>
                    </div>
                    <?php
                }
                
                ?>
            </div>
        <?php } ?>
        <h1 class="text-center">Nomor Antrian<span id="res_antrian"><?= $label_antrian .".".$nomor_daftar ?></span></h1>
        <h3 class="text-center">Jam Antrian <span  id="res_jam_antrian"><?= $jam_kunjunganAntrian ?></span></h3>

        <b><p>Mohon Diperhatikan</p></b>
        <ol>
            <li>Pasien DIharapkan Hadir sebelum pukul <span id="res_estimasi"><?= $jam_kunjunganAntrian ?></span></li>
            <li>Silahkan Datang ke Counter Checkin Yang sudah DIsediakan</li>
            <li>Bawa Bukti Reservasi, Kartu Pasien</li>
            <li>Khusus Pasien BPJS Bawa Kartu BPJS, Surat Rujukan.Kontrol Ulang Yang masih Berlaku </li>
        </ol>
        <b><p>Catatan</p></b>
        <ol>
            <li>Pasien yang mendaftar online akan dilayani jika membawa bukti reservasi mendaftar online dan bagi pasien BPJS harus membawa kartu BPJS, Surat Rujukan/Surat Kontrol Yangmasih berlaku</li>
            <li>Jika Pasien datang ewat dari jam antrian, pasien tidak akan dilayani, silahkan mendaftar kembali melalui loket pendaftaran</li>
        </ol>
    </div>
    <!-- <div class="col-md-12 text-center" id="btn-cetak">
        <button class="btn btn-warning" onclick="printReservasi()"><span class="fa fa-print"></span> Cetak Bukti Reservasi</button>
    </div> -->
</div>
</div>
<script type="text/javascript">
    window.print();
</script>
</body>
</html>
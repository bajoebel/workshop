$(document).ready(function() {
    // $('#no_ktp').focus();
    $('.tanggal').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    });
    $('.tanggal').datepicker({
        autoclose : true,
        format    : "dd/mm/yyyy"
    }) 
});

function pilih(val){
    if(val==1) $('#ya').prop('checked',true);
    else $('#tidak').prop('checked',true);
}
function cariPasien() {
    var nomr=$('#o-keyword-nomr').val();
    // alert(nomr);
    var url;
    url = base_url + "online/pasien/cari";
    var formData = new FormData($('#o-cari')[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
            $('#o-icon-cari').removeClass('glyphicon-search');
            $('#o-icon-cari').addClass('glyphicon-refresh spin');
        },
        success: function (data) {
            console.log(data);
            if (data.status == true) {
                $('#o-id_pasien').val(data.data.idx)
                $('#o-nomr').val(data.data.nomr)
                $('#o-nama_pasien').val(data.data.nama)
                $('#o-no_ktp').val(data.data.no_ktp)
                $('#o-no_bpjs').val(data.data.no_bpjs)
                $('#o-tempat_lahir').val(data.data.tempat_lahir)
                $('#o-tgl_lahir').val(data.data.tgl_lahir)
                $('#o-jns_kelamin').val(data.data.jns_kelamin)
                $('#o-status_kawin').val(data.data.status_kawin)
                $('#o-pekerjaan').val(data.data.pekerjaan)
                $('#o-agama').val(data.data.agama)
                $('#o-no_telpon').val(data.data.no_telpon)
                $('#o-kewarganegaraan').val(data.data.kewarganegaraan)
                $('#o-nama_negara').val(data.data.nama_negara)
                $('#o-nama_provinsi').val(data.data.nama_provinsi)
                $('#o-nama_kab_kota').val(data.data.nama_kab_kota)
                $('#o-nama_kecamatan').val(data.data.nama_kecamatan)
                $('#o-nama_kelurahan').val(data.data.nama_kelurahan)
                $('#o-bahasa').val(data.data.bahasa)
                $('#o-suku').val(data.data.suku)
                $('#o-alamat').val(data.data.alamat)
                $('#o-penanggung_jawab').val(data.data.penanggung_jawab)
                $('#o-pjPasienNama').val(data.pjnama)
                $('#o-pjPasienTelp').val(data.pjnotelp)
                $('#o-pjPasienHubKel').val(data.pjhubungan)
                $('#o-pjPasienPekerjaan').val(data.pjpekerjaan)
                $('#o-pjPasienAlamat').val(data.pjalamat);
                $('#o-tgl_daftar').val(data.data.tgl_daftar);
                $('#o-control-form').show();
                $('#o-control-keyword').hide();
                $('.o-step').hide();
                $('#o-step1').show();
            }
            else {
                var nomr = $('#nomr').val();
                sweetAlert({
                    title: "Peringatan",
                    text: data.message,
                    type: "warning",
                    timer: 5000
                });
            }

        },
        complete: function() {
            $('#loading').hide();
            $('#icon-cari').removeClass('glyphicon-refresh');
            $('#icon-cari').addClass('glyphicon-search');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            sweetAlert({
                title: "Peringatan",
                text: "Terjadi Kesalahan " + jqXHR,
                type: "error",
                timer: 5000
            });
        }
    });
}

function pilihJenisBayarOnline(asuransi){
    $('#o-jkn').val(asuransi)
    
    if(asuransi==0){
        //Jika jenis Bayar Umum
        $('.o-step').hide();
        $('#o-step2').show();
        $('#o-asal1').prop('disabled', false);
        $('#o-id_rujuk').val('1')
        $('#o-rujukan').val('DATANG SENDIRI')
        $('#o-id_jenis_peserta').val('1');
        $('#o-jenis_peserta').val('Umum');
    }else if(asuransi==1){
        //Jika Jenis Bayar BPJS Kesehatan
        $('#o-asal1').prop('disabled', true);
        $('#o-id_rujuk').val('')
        $('#o-rujukan').val('')
        $('.o-step').hide();
        $('#o-step2').show();
    }else{
        $('#o-asal1').prop('disabled', false);
        $('#o-id_rujuk').val('1')
        $('#o-rujukan').val('DATANG SENDIRI')
        $('.o-step').hide();
        $('#o-step2').show();
    }
    getCaraBayarOnline(asuransi);
}
function pilihJenisBayarOnlineBaru(asuransi){
    $('#o-jkn').val(asuransi)
    
    if(asuransi==0){
        //Jika jenis Bayar Umum
        $('.o-step').hide();
        $('#o-step5').show();
        $('#o-asal1').prop('disabled', false);
        $('#o-id_rujuk').val('1')
        $('#o-rujukan').val('DATANG SENDIRI')
        $('#o-id_jenis_peserta').val('1');
        $('#o-jenis_peserta').val('Umum');
    }else if(asuransi==1){
        //Jika Jenis Bayar BPJS Kesehatan
        $('#o-asal1').prop('disabled', true);
        $('#o-id_rujuk').val('')
        $('#o-rujukan').val('')
        $('.o-step').hide();
        $('#o-step5').show();
    }else{
        $('#o-asal1').prop('disabled', false);
        $('#o-id_rujuk').val('1')
        $('#o-rujukan').val('DATANG SENDIRI')
        $('.o-step').hide();
        $('#o-step5').show();
    }
    getCaraBayarOnline(asuransi);
}
function getCaraBayarOnline(asuransi){
    var url = base_url + "online/pasien/carabayar/" + asuransi;
    console.log(url)
    // alert(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function (data) {
            $('#o-v-carabayar').html(data);
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function pilihRujukanOnline(idx,rujukan,faskes){
    var jkn=$('#o-jkn').val();
    $('#o-id_rujuk').val(idx);
    $('#o-rujukan').val(rujukan);
    $('#o-faskes').val(faskes)
    if(jkn==1){
        
        var nobpjs=$('#o-no_bpjs').val();
        if(nobpjs.length==13){
            // sweetAlert({
            //     title: "Terjadi Kesalahan..!",
            //     text: "Cek Rujukan Pasien",
            //     type: "success",
            //     timer: 5000
            // });
            generateRujukanOnline(nobpjs,faskes)
        }else{
            $("#o-modal_nobpjs").modal("show");
        }
        
    }else{
        getPoly();
        $('.o-step').hide();
        $('#o-step4').show();
    }
    
}
function pilihRujukanOnlineBaru(idx,rujukan,faskes){
    var jkn=$('#o-jkn').val();
    $('#o-id_rujuk').val(idx);
    $('#o-rujukan').val(rujukan);
    $('#o-faskes').val(faskes)
    if(jkn==1){
        
        var nobpjs=$('#o-no_bpjs').val();
        if(nobpjs.length==13){
            // sweetAlert({
            //     title: "Terjadi Kesalahan..!",
            //     text: "Cek Rujukan Pasien",
            //     type: "success",
            //     timer: 5000
            // });
            generateRujukanOnlineBaru(nobpjs,faskes)
        }else{
            $("#o-modal_nobpjs").modal("show");
        }
        
    }else{
        getPolyBaru();
        $('.o-step').hide();
        $('#o-step7').show();
    }
    
}
function getPoly(){
    var q='';
    var url = base_url + "online/pasien/poliklinik?q="+q;
    console.log(url)
    // alert(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function (data) {
            $('#o-poliklinik').html(data);
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function getPolyBaru(){
    var q='';
    var url = base_url + "online/pasien/poliklinikbaru?q="+q;
    console.log(url)
    // alert(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function (data) {
            $('#o-poliklinik').html(data);
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function generateRujukanOnline(nobpjs,faskes){
    var url = base_url + "mandiri/pasien/cekstatus/" + nobpjs;
    console.log(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function (data) {
            console.log(data);
            if(data.metaData.code=="200"){
                if(data.response.peserta.statusPeserta.kode=="0"){
                    $('#o-status_peserta').val(data.response.peserta.statusPeserta.keterangan)
                    $('#o-id_jenis_peserta').val(data.response.peserta.jenisPeserta.kode);
                    $('#o-jenis_peserta').val(data.response.peserta.jenisPeserta.keterangan);
                    if(faskes==3){
                        sweetAlert({
                            title: "Silahkan Pilih Faskes Asal Rujukan",
                            text: "Pilih Faskes 1 Jika rujukan sebelumnya dari puskesmas atau dokter keluarga\nDan Pilih Faskes 2 jika rujukan sebelumnya dari Rumah Sakit Lain",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#390',
                            confirmButtonText: 'Faskes 2',
                            cancelButtonColor:'#DD6B55',
                            cancelButtonText: "Faskes 1",
                            closeOnConfirm: false,
                            closeOnCancel: false
                         },
                         function(isConfirm){
                           if (isConfirm){
                                listRujukanOnline(nobpjs,2);
                            } else {
                                listRujukanOnline(nobpjs,1);
                            }
                         });
                          
                        // listRujukan(nobpjs,1);
                        // listRujukan(nobpjs,2);
                    }else{
                        // alert('List Rujukan');
                        listRujukanOnline(nobpjs,faskes);
                    }
                }else{
                    sweetAlert({
                        title: "Maaf Pendaftaran Tidak bisa dilanjutkan..!",
                        text: "Karena Status Peserta "+data.response.peserta.statusPeserta.keterangan,
                        type: "error",
                        timer: 5000
                    });
                }
                
            }else{
                sweetAlert({
                    title: "Error Saat Mencari Rujukan BPJS!",
                    text: data.metaData.message,
                    type: "error",
                    timer: 5000
                });
            }
            
            
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#o-rujukanbpjs').html("Rujukan Tidak Ditemukan");
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}

function generateRujukanOnlineBaru(nobpjs,faskes){
    var url = base_url + "mandiri/pasien/cekstatus/" + nobpjs;
    console.log(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function (data) {
            console.log(data);
            if(data.metaData.code=="200"){
                if(data.response.peserta.statusPeserta.kode=="0"){
                    $('#o-status_peserta').val(data.response.peserta.statusPeserta.keterangan)
                    $('#o-id_jenis_peserta').val(data.response.peserta.jenisPeserta.kode);
                    $('#o-jenis_peserta').val(data.response.peserta.jenisPeserta.keterangan);
                    if(faskes==3){
                        sweetAlert({
                            title: "Silahkan Pilih Faskes Asal Rujukan",
                            text: "Pilih Faskes 1 Jika rujukan sebelumnya dari puskesmas atau dokter keluarga\nDan Pilih Faskes 2 jika rujukan sebelumnya dari Rumah Sakit Lain",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#390',
                            confirmButtonText: 'Faskes 2',
                            cancelButtonColor:'#DD6B55',
                            cancelButtonText: "Faskes 1",
                            closeOnConfirm: false,
                            closeOnCancel: false
                         },
                         function(isConfirm){
                           if (isConfirm){
                                listRujukanOnlineBaru(nobpjs,2);
                            } else {
                                listRujukanOnlineBaru(nobpjs,1);
                            }
                         });
                          
                        // listRujukan(nobpjs,1);
                        // listRujukan(nobpjs,2);
                    }else{
                        // alert('List Rujukan');
                        listRujukanOnlineBaru(nobpjs,faskes);
                    }
                }else{
                    sweetAlert({
                        title: "Maaf Pendaftaran Tidak bisa dilanjutkan..!",
                        text: "Karena Status Peserta "+data.response.peserta.statusPeserta.keterangan,
                        type: "error",
                        timer: 5000
                    });
                }
                
            }else{
                sweetAlert({
                    title: "Error Saat Mencari Rujukan BPJS!",
                    text: data.metaData.message,
                    type: "error",
                    timer: 5000
                });
            }
            
            
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#o-rujukanbpjs').html("Rujukan Tidak Ditemukan");
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}

function listRujukanOnline(nobpjs,faskes,split=0){
    var url = base_url + "online/pasien/listrujukan/" + nobpjs+"/"+faskes;
    console.clear();
    console.log(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function (data) {
            console.log(data);
            if(data.metaData.code=="200"){
                $('.o-step').hide();
                $('#o-step3').show();
                var rujukan=data.response.rujukan;
                var list="";
                for (let index = 0; index < rujukan.length; index++) {
                    list+='<div class="col-sm-3">'+
                        '<div class="thumbnail">'+
                            '<div class="caption text-center" onclick="setRujukanOnline(\''+rujukan[index].noKunjungan+'\',\''+rujukan[index].provPerujuk.kode+'\',\''+rujukan[index].provPerujuk.nama+'\',\''+rujukan[index].poliRujukan.kode+'\',\''+rujukan[index].tglKunjungan+'\')">'+
                                '<div class="position-relative">'+
                                '<img src="'+resource_url+'rsud-backend/public/img/Icon/polybpjs/'+rujukan[index].poliRujukan.kode+'.jpg" class="img img-responsive img-circle"/>'+
                                '</div>'+
                                '<h4 id="thumbnail-label"><a href="#" target="_blank">'+rujukan[index].poliRujukan.nama+'<br>'+rujukan[index].noKunjungan+'</a></h4>'+
                                '<p><i class="glyphicon glyphicon-home light-red lighter bigger-120"></i> '+rujukan[index].provPerujuk.nama+'</p>'+
                                '<div class="thumbnail-description smaller">'+rujukan[index].tglKunjungan+'</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                }
                var f = $('#o-faskes').val();
                if(f==3){
                    sweetAlert({
                        title: "Informasi!",
                        text: "Silahkan pilih rujukan anda",
                        type: "success",
                        timer: 5000
                    });
                }
                
                $('#o-rujukanbpjs').html(list);
            }else{
                sweetAlert({
                    title: "Maaf Pendaftaran Tidak bisa dilanjutkan..!",
                    text: "Karena "+data.metaData.message,
                    type: "error",
                    timer: 5000
                });
            }
            
            
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#o-rujukanbpjs').html("Rujukan Tidak Ditemukan");
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function listRujukanOnlineBaru(nobpjs,faskes,split=0){
    var url = base_url + "online/pasien/listrujukan/" + nobpjs+"/"+faskes;
    console.clear();
    console.log(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function (data) {
            console.log(data);
            if(data.metaData.code=="200"){
                $('.o-step').hide();
                $('#o-step6').show();
                var rujukan=data.response.rujukan;
                var list="";
                for (let index = 0; index < rujukan.length; index++) {
                    list+='<div class="col-sm-3">'+
                        '<div class="thumbnail">'+
                            '<div class="caption text-center" onclick="setRujukanOnlineBaru(\''+rujukan[index].noKunjungan+'\',\''+rujukan[index].provPerujuk.kode+'\',\''+rujukan[index].provPerujuk.nama+'\',\''+rujukan[index].poliRujukan.kode+'\',\''+rujukan[index].tglKunjungan+'\')">'+
                                '<div class="position-relative">'+
                                '<img src="'+resource_url+'rsud-backend/public/img/Icon/polybpjs/'+rujukan[index].poliRujukan.kode+'.jpg" class="img img-responsive img-circle"/>'+
                                '</div>'+
                                '<h4 id="thumbnail-label"><a href="#" target="_blank">'+rujukan[index].poliRujukan.nama+'<br>'+rujukan[index].noKunjungan+'</a></h4>'+
                                '<p><i class="glyphicon glyphicon-home light-red lighter bigger-120"></i> '+rujukan[index].provPerujuk.nama+'</p>'+
                                '<div class="thumbnail-description smaller">'+rujukan[index].tglKunjungan+'</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                }
                var f = $('#o-faskes').val();
                if(f==3){
                    sweetAlert({
                        title: "Informasi!",
                        text: "Silahkan pilih rujukan anda",
                        type: "success",
                        timer: 5000
                    });
                }
                console.log(list)
                $('#o-rujukanbpjs').html(list);
            }else{
                sweetAlert({
                    title: "Maaf Pendaftaran Tidak bisa dilanjutkan..!",
                    text: "Karena "+data.metaData.message,
                    type: "error",
                    timer: 5000
                });
            }
            
            
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#o-rujukanbpjs').html("Rujukan Tidak Ditemukan");
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function setPoliklinikOnline(idx,ruang){
    $('#o-id_ruang').val(idx);
    $('#o-nama_ruang').val(ruang);
    $('.o-step').hide();
    $('#o-step5').show();
    getDokterOnline(idx);
}

function setPoliklinikOnlineBaru(idx,ruang){
    $('#o-id_ruang').val(idx);
    $('#o-nama_ruang').val(ruang);
    $('.o-step').hide();
    $('#o-step8').show();
    getDokterOnlineBaru(idx);
}

function getDokterOnline() {
    var id =$('#o-id_ruang').val();
    var url = base_url + "online/pasien/dokter/" + id;
    console.log(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function (data) {
            
            $('#o-dokter').html(data);
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function o_step1(){
    $('.o-step').hide();
    var jkn=$('#o-jkn').val();
    $('.o-step').hide();
    $('#o-step1').show();
    //$('#step2').show();
}
function o_step2(){
    $('.o-step').hide();
    var jkn=$('#o-jkn').val();
    $('.o-step').hide();
    if(jkn==1) $('#o-step2').show();
    else $('#o-step1').show();
    //$('#step2').show();
}
function o_step3(){
    var jkn=$('#o-jkn').val();
    $('.o-step').hide();
    $('#o-step2').show();
}
function o_step4(){
    $('.o-step').hide();
    $('#o-step4').show();
}
function o_step5(){
    var kajian=$('#kajian_mandiri_covid19').val();
    $('.o-step').hide();
    if(kajian==1){
        $('#kajiancovid').show();
    }else{
        $('#o-step5').show();
    }
    
}

function pilihDokterOnline(nrp,nama,label,name,jam,quota,$tanggal){
    $('#o-id_dokter').val(nrp)
    $('#o-namaDokterJaga').val(nama);
    $('#o-label_antrian').val(label);
    $('#o-name_antrian').val(name);
    $('#o-jam_antrian').val(jam);
    $('#o-quota_antrian').val(quota);
    $('#o-tgl_masuk').val($tanggal);
    var kajian=$('#kajian_mandiri_covid19').val();
    $('.o-step').hide();
    if(kajian==1){
        $('#kajiancovid').show();
    }else{
        $('#o-step-finish').show();
    }
    
    generateProfileOnline()
}
function goFinish(){
    $('.o-step').hide();
    $('#o-step-finish').show();
}
function pilihDokterOnlineBaru(nrp,nama,label,name,jam,quota,$tanggal){
    $('#o-id_dokter').val(nrp)
    $('#o-namaDokterJaga').val(nama);
    $('#o-label_antrian').val(label);
    $('#o-name_antrian').val(name);
    $('#o-jam_antrian').val(jam);
    $('#o-quota_antrian').val(quota);
    $('#o-tgl_masuk').val($tanggal);
    var kajian=$('#kajian_mandiri_covid19').val();
    $('.o-step').hide();
    if(kajian==1){
        $('#kajiancovid').show();
    }else{
        $('#o-step-finish').show();
    }
    generateProfileOnlineBaru()
}
function generateProfileOnline(){
    var jkn=$('#o-jkn').val();
    var carabayar=$('#o-id_cara_bayar :selected').html();
    //$('#o-cara_bayar').val(cara_bayar);
    if(jkn!=1){
        $(".o-v-jkn").hide();
        carabayar=$('#o-cara_bayar').val();
    }
    //alert(carabayar);
    var nomr=$('#o-nomr').val();
    var no_bpjs=$('#o-no_bpjs').val();
    var jnspeserta=$('#o-jenis_peserta').val();
    var norujuk=$('#o-no_rujuk').val();
    var namafaskes=$('#o-pjPasienDikirimOleh').val();
    var alamatfaskes=$('#o-pjPasienAlmtPengirim').val();
    var id_pengirim=$('#o-id_pengirim').val();
    var nik=$('#o-no_ktp').val();
    var nama_pasien=$('#o-nama_pasien').val();
    var no_telpon = $('#o-no_telpon').val();
    var tempat_lahir=$('#o-tempat_lahir').val();
    var tgl_lahir=$('#o-tgl_lahir').val();
    var jns_kelamin = $("input[name='jns_kelamin']:checked").val();
    if(!jns_kelamin){
        jns_kelamin="";
    }
    // alert(no_telp)
    if(jns_kelamin=="0"||jns_kelamin=="P") {
        var jekel="Perempuan"; 
        var img="<img src='"+base_url+"img/avatar/female.png"+"' class='img img-responsive img-circle img-thumbnail'>";
    }
    else {
        var jekel="Laki-Laki";
        var img="<img src='"+base_url+"img/avatar/male.png"+"' class='img img-responsive img-circle img-thumbnail'>";
    }
    $('#o-v-foto').html(img)
    $('#o-v-nomr').html(nomr);
    $('#o-v-nobpjs').html(no_bpjs);
    $('#o-v-jnspeserta').html(jnspeserta);
    $('#o-v-norujukan').html(norujuk);
    $('#o-v-namafaskes').html(id_pengirim+" - "+namafaskes);
    $('#o-v-alamatfaskes').html(alamatfaskes);

    $('#o-v-nik').html(nik)
    $('#o-v-nama').html(nama_pasien)
    $('#o-v-namapasien').html(nama_pasien)
    $('#o-v-notelp').html(no_telpon)
    $('#o-v-ttl').html(tempat_lahir+" / " +tgl_lahir)
    $('#o-v-jekel').html(jekel)
    var no_bpjs = $('#o-no_bpjs').val();
    var carabayar = $('#o-cara_bayar').val();
    var jnspeserta = $('#o-jnspeserta').val();
    var asalrujukan = $('#o-rujukan').val();
    var norujukan = $('#o-norujukan').val();
    var namafaskes = $('#o-namafaskes').val();
    var alamatfaskes=$('#o-alamatfaskes').val();
    var poliklinik=$('#o-nama_ruang').val();
    var namadokter = $('#o-namaDokterJaga').val();
    var pjnama=$('#o-pjPasienNama').val()
    // $('#o-pjPasienNama').val(data.pjnama)
    var pjnotelp = $('#o-pjPasienTelp').val()
    
    var pjhubungan = $('#o-pjPasienHubKel').val()
    var pjpekerjaan = $('#o-pjPasienPekerjaan').val()
    var pjalamat = $('#o-pjPasienAlamat').val();
    // alert(poliklinik);
    $('#o-v-carabayar').html(carabayar)
    $('#o-v-no_bpjs').html(no_bpjs)
    $('#o-v-jnspeserta').html(jnspeserta)
    $('#o-v-asalrujukan').html(asalrujukan)
    $('#o-v-norujukan').html(norujukan)
    $('#o-v-namafaskes').html(namafaskes)
    $('#o-v-alamatfaskes').html(alamatfaskes)
    $('#o-v-poliklinik').html(poliklinik)
    $('#o-v-namadokter').html(namadokter)

    $('#o-v-pjnama').html(pjnama)
    $('#o-v-pjtelp').html(pjnotelp)
    $('#o-v-pjhubungan').html(pjhubungan)
    $('#o-v-pjpekerjaan').html(pjpekerjaan)
    $('#o-v-pjalamat').html(pjalamat)
}

function generateProfileOnlineBaru(){
    var jkn=$('#o-jkn').val();
    var carabayar=$('#o-id_cara_bayar :selected').html();
    //$('#o-cara_bayar').val(cara_bayar);
    if(jkn!=1){
        $(".o-v-jkn").hide();
        carabayar=$('#o-cara_bayar').val();
    }
    //alert(carabayar);
    var nomr=$('#nomr').val();
    var no_bpjs=$('#o-no_bpjs').val();
    var jnspeserta=$('#o-jenis_peserta').val();
    var norujuk=$('#o-no_rujuk').val();
    var namafaskes=$('#o-pjPasienDikirimOleh').val();
    var alamatfaskes=$('#o-pjPasienAlmtPengirim').val();
    var id_pengirim=$('#o-id_pengirim').val();
    var nik=$('#no_ktp').val();
    var nama_pasien=$('#nama').val();
    var no_telpon = $('#no_telpon').val();
    var tempat_lahir=$('#tempat_lahir').val();
    var tgl_lahir=$('#tgl_lahir').val();
    var jns_kelamin = $("input[name='jns_kelamin']:checked").val();
    if(!jns_kelamin){
        jns_kelamin="";
    }
    // alert(no_telp)
    if(jns_kelamin=="0"||jns_kelamin=="P") {
        var jekel="Perempuan"; 
        var img="<img src='"+base_url+"img/avatar/female.png"+"' class='img img-responsive img-circle img-thumbnail'>";
    }
    else {
        var jekel="Laki-Laki";
        var img="<img src='"+base_url+"img/avatar/male.png"+"' class='img img-responsive img-circle img-thumbnail'>";
    }
    $('#o-v-foto').html(img)
    $('#o-v-nomr').html(nomr);
    $('#o-v-nobpjs').html(no_bpjs);
    $('#o-v-jnspeserta').html(jnspeserta);
    $('#o-v-norujukan').html(norujuk);
    $('#o-v-namafaskes').html(id_pengirim+" - "+namafaskes);
    $('#o-v-alamatfaskes').html(alamatfaskes);

    $('#o-v-nik').html(nik)
    $('#o-v-nama').html(nama_pasien)
    $('#o-v-namapasien').html(nama_pasien)
    $('#o-v-notelp').html(no_telpon)
    $('#o-v-ttl').html(tempat_lahir+" / " +tgl_lahir)
    $('#o-v-jekel').html(jekel)
    var no_bpjs = $('#o-no_bpjs').val();
    var carabayar = $('#o-cara_bayar').val();
    var jnspeserta = $('#o-jnspeserta').val();
    var asalrujukan = $('#o-rujukan').val();
    var norujukan = $('#o-norujukan').val();
    var namafaskes = $('#o-namafaskes').val();
    var alamatfaskes=$('#o-alamatfaskes').val();
    var poliklinik=$('#o-nama_ruang').val();
    var namadokter = $('#o-namaDokterJaga').val();
    var pjnama=$('#o-pjPasienNama').val()
    // $('#o-pjPasienNama').val(data.pjnama)
    var pjnotelp = $('#o-pjPasienTelp').val()
    
    var pjhubungan = $('#o-pjPasienHubKel').val()
    var pjpekerjaan = $('#o-pjPasienPekerjaan').val()
    var pjalamat = $('#o-pjPasienAlamat').val();
    // alert(poliklinik);
    $('#o-v-carabayar').html(carabayar)
    $('#o-v-no_bpjs').html(no_bpjs)
    $('#o-v-jnspeserta').html(jnspeserta)
    $('#o-v-asalrujukan').html(asalrujukan)
    $('#o-v-norujukan').html(norujukan)
    $('#o-v-namafaskes').html(namafaskes)
    $('#o-v-alamatfaskes').html(alamatfaskes)
    $('#o-v-poliklinik').html(poliklinik)
    $('#o-v-namadokter').html(namadokter)

    $('#o-v-pjnama').html(pjnama)
    $('#o-v-pjtelp').html(pjnotelp)
    $('#o-v-pjhubungan').html(pjhubungan)
    $('#o-v-pjpekerjaan').html(pjpekerjaan)
    $('#o-v-pjalamat').html(pjalamat)
}

function setRujukanOnline(norujuk,idpengirim,namapengirim,polibpjs,tglrujukan){
    $('#o-no_rujuk').val(norujuk);
    $('#o-id_pengirim').val(idpengirim);
	$('#o-pjPasienDikirimOleh').val(namapengirim);
    var faskes = $('#o-faskes').val();
    var url = base_url + "online/pasien/polibpjs/" + polibpjs+"/"+tglrujukan+"/"+idpengirim;
    console.log(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function (data) {
            console.log(data);
            if(data.status==true){
                // alert(data.data.idx)
                if(data.data==null){
                    getPoly();
                    $('.o-step').hide();
                    $('#o-step4').show();
                }else{
                    $('#o-id_ruang').val(data.data.poly_id);
                    $('#o-nama_ruang').val(data.data.poly_nama);
                    // alert(faskes);
                    if(faskes<3){
                        //jika kunjungan pertama
                        $('.o-step').hide();
                        $('#o-step5').show();
                        // alert(data.data.poly_id);
                        getDokterOnline(data.data.poly_id);
                        // setPoliklinik(data.data.idx,data.data.ruang);
                    }else{
                        //Jika Kontrol Ulang
                        $('.o-step').hide();
                        $('#o-step4').show();
                    }
                }
                if(data.perujuk != null){
                    $('#o-pjPasienAlmtPengirim').val(data.perujuk.alamat_pengirim);
                }
                
            }else{
                sweetAlert({
                    title: "Terjadi Kesalahan..!",
                    text: data.message,
                    type: "warning",
                    timer: 5000
                });
            }
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function setRujukanOnlineBaru(norujuk,idpengirim,namapengirim,polibpjs,tglrujukan){
    $('#o-no_rujuk').val(norujuk);
    $('#o-id_pengirim').val(idpengirim);
	$('#o-pjPasienDikirimOleh').val(namapengirim);
    var faskes = $('#o-faskes').val();
    var url = base_url + "online/pasien/polibpjs/" + polibpjs+"/"+tglrujukan+"/"+idpengirim;
    console.log(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function (data) {
            console.log(data);
            if(data.status==true){
                // alert(data.data.idx)
                if(data.data==null){
                    getPolyBaru();
                    $('.o-step').hide();
                    $('#o-step7').show();
                }else{
                    $('#o-id_ruang').val(data.data.poly_id);
                    $('#o-nama_ruang').val(data.data.poly_nama);
                    // alert(faskes);
                    if(faskes<3){
                        //jika kunjungan pertama
                        $('.o-step').hide();
                        $('#o-step8').show();
                        // alert(data.data.poly_id);
                        getDokterOnlineBaru(data.data.poly_id);
                        // setPoliklinik(data.data.idx,data.data.ruang);
                    }else{
                        //Jika Kontrol Ulang
                        $('.o-step').hide();
                        $('#o-step7').show();
                    }
                }
                if(data.perujuk != null){
                    $('#o-pjPasienAlmtPengirim').val(data.perujuk.alamat_pengirim);
                }
                
            }else{
                sweetAlert({
                    title: "Terjadi Kesalahan..!",
                    text: data.message,
                    type: "warning",
                    timer: 5000
                });
            }
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function getDokterOnline(id="") {
    if(id=="") id =$('#o-id_ruang').val();
    // alert(id);
    var url = base_url + "online/pasien/dokter/" + id;
    console.log(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        
        success: function (data) {
            
            $('#o-dokter').html(data);
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function getDokterOnlineBaru(id="") {
    if(id=="") id =$('#o-id_ruang').val();
    // alert(id);
    var url = base_url + "online/pasien/dokterbaru/" + id;
    console.log(url)
    $.ajax({
        url: url,
        type: "GET",
        dataType: "HTML",
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        
        success: function (data) {
            
            $('#o-dokter').html(data);
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function daftarPasienOnline(){
    var url = base_url+"online/pasien/simpan_pendaftaran";

    // ajax adding data to database
    $.ajax({
        url: url,
        type: "POST",
        data: $('#o-form').serialize(),
        dataType: 'JSON',
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function(data) {
            console.log(data)
            if(data.status===200){
                sweetAlert({
                    title: "Peringatan",
                    text: data.message,
                    type: "warning",
                    timer: 5000
                });
                var qrcode="<img src='"+base_url+"welcome/qr/"+data.unikID+"' />"
                $('#qrcode').html(qrcode);
                $('#res_tgldaftar').html(data.data.tanggal_daftar)
                $('#res_nomr').html(data.data.nomr);
                $('#res_nama').html(data.data.nama_pasien);
                $('#res_tglkunjungan').html(data.data.tanggal_kunjungan);
                $('#res_poli').html(data.data.nama_ruang);
                $('#res_cara_bayar').html(data.data.cara_bayar);
                $('#res_antrian').html(data.data.label_antrian+"."+data.data.nomor_daftar);
                $('#res_jam_antrian').html(data.data.jam_kunjunganAntrian);
                $('#res_jam_kunjungan').html(data.data.jam_kunjunganLabel);
                $('#res_estimasi').html(data.data.jam_kunjunganAntrian);
                var tombol='<button type="button" class="btn btn-warning" onclick="printReservasi('+data.data.idx+')"><span class="fa fa-print"></span> Cetak Bukti Reservasi</button>';
                $('#btn-cetak').html(tombol);
                var status_kajian=$('#kajian_mandiri_covid19').val();
                if(status_kajian==1){
                    if(data.point==0){
                        var pesan='<div class=\'panel panel-success\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    '<b>Pemberitahuan</b><br>Berdasarkan hasil penilaian kajian mandiri covid-19 yang telah diisi tingkat resiko anda yaitu '+
                                    '</div>'+
                                '</div>'+
                                '<div class="alert alert-success" role="alert">'+
                                '('+data.point+') Resiko Rendah'+
                                '</div>'+
                                '<div class=\'panel panel-success\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    'Silahkan datang untuk berkunjung berobat ke RSUD Padang Panjang dan tetap melaksanakan protokol kesehatan dengan 3M '+
                                    '<ol>'+
                                        '<li><b>M</b>emakai Masker</li>'+
                                        '<li><b>M</b>encuci Tangan</li>'+
                                        '<li><b>M</b>enjaga Jarak</li>'+
                                    '</ol>'+
                                    'pertahankan kondisi ini agar anda tetap sehat'+
                                    '</div>'+
                                '</div>';
                    }else if(data.point>=1 &&data.point<=4){
                        var pesan='<div class=\'panel panel-warning\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    '<b>Pemberitahuan</b><br>Berdasarkan hasil penilaian kajian mandiri covid-19 yang telah diisi tingkat resiko anda yaitu '+
                                    '</div>'+
                                '</div>'+
                                '<div class="alert alert-warning" role="alert">'+
                                '('+data.point+') Resiko Sedang'+
                                '</div>'+
                                '<div class=\'panel panel-warning\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    'Silahkan datang untuk berkunjung berobat ke RSUD Padang Panjang dan tetap melaksanakan protokol kesehatan dengan 3M '+
                                    '<ol>'+
                                        '<li><b>M</b>emakai Masker</li>'+
                                        '<li><b>M</b>encuci Tangan</li>'+
                                        '<li><b>M</b>enjaga Jarak</li>'+
                                    '</ol>'+
                                    'Tingkatkan Imunitas Tubuh'+
                                    '</div>'+
                                '</div>';
                    }else{
                        var pesan='<div class=\'panel panel-danger\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    '<b>Pemberitahuan</b><br>Berdasarkan hasil penilaian kajian mandiri covid-19 yang telah diisi tingkat resiko anda yaitu '+
                                    '</div>'+
                                '</div>'+
                                '<div class="alert alert-danger" role="alert">'+
                                '('+data.point+') Resiko Tinggi'+
                                '</div>'+
                                '<div class=\'panel panel-danger\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    'Silahkan datang untuk berkunjung berobat ke RSUD Padang Panjang dan tetap melaksanakan protokol kesehatan dengan 3M '+
                                    '<ol>'+
                                        '<li><b>M</b>emakai Masker</li>'+
                                        '<li><b>M</b>encuci Tangan</li>'+
                                        '<li><b>M</b>enjaga Jarak</li>'+
                                    '</ol>'+
                                    'Tingkatkan Imunitas Tubuh'+
                                    '</div>'+
                                '</div>';
                    }
                    $('#point_kajian').html(pesan);
                }
                $('.o-step').hide();
                $('#o-reservasi').show();
            }else{
                sweetAlert({
                    title: "Peringatan",
                    text: data.message,
                    type: "error",
                    timer: 5000
                });
                
                // printReservasi();
            }
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(textStatus);
        }
    });
}
function daftarPasienBaru(){
    var url = base_url+"online/pasien/daftarpasienbaru";

    // ajax adding data to database
    $.ajax({
        url: url,
        type: "POST",
        data: $('#o-form').serialize(),
        dataType: 'JSON',
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function(data) {
            console.log(data)
            if(data.status===200){
                sweetAlert({
                    title: "Peringatan",
                    text: data.message,
                    type: "warning",
                    timer: 5000
                });
                // printReservasi();
                var qrcode="<img src='"+base_url+"welcome/qr/"+data.unikID+"' />"
                $('#qrcode').html(qrcode);
                $('#res_tgldaftar').html(data.data.tanggal_daftar)
                $('#res_nomr').html(data.data.nomr);
                $('#res_nama').html(data.data.nama_pasien);
                $('#res_tglkunjungan').html(data.data.tanggal_kunjungan);
                $('#res_poli').html(data.data.nama_ruang);
                $('#res_cara_bayar').html(data.data.cara_bayar);
                $('#res_antrian').html(data.data.label_antrian+"."+data.data.nomor_daftar);
                $('#res_jam_antrian').html(data.data.jam_kunjunganAntrian);
                $('#res_jam_kunjungan').html(data.data.jam_kunjunganLabel);
                $('#res_estimasi').html(data.data.jam_kunjunganAntrian);
                var tombol='<button type="button" class="btn btn-warning" onclick="printReservasi('+data.data.idx+')"><span class="fa fa-print"></span> Cetak Bukti Reservasi</button>';
                $('#btn-cetak').html(tombol);
                var status_kajian=$('#kajian_mandiri_covid19').val();
                if(status_kajian==1){
                    if(data.point==0){
                        var pesan='<div class=\'panel panel-success\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    '<b>Pemberitahuan</b><br>Berdasarkan hasil penilaian kajian mandiri covid-19 yang telah diisi tingkat resiko anda yaitu '+
                                    '</div>'+
                                '</div>'+
                                '<div class="alert alert-success" role="alert">'+
                                '('+data.point+') Resiko Rendah'+
                                '</div>'+
                                '<div class=\'panel panel-success\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    'Silahkan datang untuk berkunjung berobat ke RSUD Padang Panjang dan tetap melaksanakan protokol kesehatan dengan 3M '+
                                    '<ol>'+
                                        '<li><b>M</b>emakai Masker</li>'+
                                        '<li><b>M</b>encuci Tangan</li>'+
                                        '<li><b>M</b>enjaga Jarak</li>'+
                                    '</ol>'+
                                    'pertahankan kondisi ini agar anda tetap sehat'+
                                    '</div>'+
                                '</div>';
                    }else if(data.point>=1 &&data.point<=4){
                        var pesan='<div class=\'panel panel-warning\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    '<b>Pemberitahuan</b><br>Berdasarkan hasil penilaian kajian mandiri covid-19 yang telah diisi tingkat resiko anda yaitu '+
                                    '</div>'+
                                '</div>'+
                                '<div class="alert alert-warning" role="alert">'+
                                '('+data.point+') Resiko Sedang'+
                                '</div>'+
                                '<div class=\'panel panel-warning\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    'Silahkan datang untuk berkunjung berobat ke RSUD Padang Panjang dan tetap melaksanakan protokol kesehatan dengan 3M '+
                                    '<ol>'+
                                        '<li><b>M</b>emakai Masker</li>'+
                                        '<li><b>M</b>encuci Tangan</li>'+
                                        '<li><b>M</b>enjaga Jarak</li>'+
                                    '</ol>'+
                                    'Tingkatkan Imunitas Tubuh'+
                                    '</div>'+
                                '</div>';
                    }else{
                        var pesan='<div class=\'panel panel-danger\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    '<b>Pemberitahuan</b><br>Berdasarkan hasil penilaian kajian mandiri covid-19 yang telah diisi tingkat resiko anda yaitu '+
                                    '</div>'+
                                '</div>'+
                                '<div class="alert alert-danger" role="alert">'+
                                '('+data.point+') Resiko Tinggi'+
                                '</div>'+
                                '<div class=\'panel panel-danger\' style="border-radius: 0px 0px 0px 0px;">'+
                                    '<div class="panel-body">'+
                                    'Silahkan datang untuk berkunjung berobat ke RSUD Padang Panjang dan tetap melaksanakan protokol kesehatan dengan 3M '+
                                    '<ol>'+
                                        '<li><b>M</b>emakai Masker</li>'+
                                        '<li><b>M</b>encuci Tangan</li>'+
                                        '<li><b>M</b>enjaga Jarak</li>'+
                                    '</ol>'+
                                    'Tingkatkan Imunitas Tubuh'+
                                    '</div>'+
                                '</div>';
                    }
                    $('#point_kajian').html(pesan);
                }

                $('.o-step').hide();
                $('#o-reservasi').show();
            }else{
                sweetAlert({
                    title: "Peringatan",
                    text: data.message,
                    type: "error",
                    timer: 5000
                });
                
            }
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(textStatus);
        }
    });
}
function cekStatus(){
    var nobpjs= $('#cek_nobpjs').val();
    var faskes= $('#o-faskes').val();
    // alert(nobpjs);
    if(nobpjs.length == 13){
        generateRujukanOnline(nobpjs,faskes);
    }else{
        sweetAlert({
            title: "Peringatan..!",
            text: "No BPJS Anda Tidak Valid, no bpjs harus terdiri dari 13 karakter",
            type: "error",
            timer: 5000
        });
    }
}
function printReservasi(idx){
    var url=base_url+"welcome/reservasi/"+idx;
    location.href=url;
    // alert(url);
    // $.ajax({
    //     url : url,
    //     type: "POST",
    //     data: $('#form').serialize(),
    //     dataType: 'HTML',
    //     success: function(data)
    //     {
    //         console.log(data);
    //         // alert("print Reservasi")
    //         // location.reload();
    //     },
    //     error: function (jqXHR, textStatus, errorThrown)
    //     {
    //         //alert(url);
    //         //$.Notify({style: {background: 'red', color: 'white'}, content: "Error saat Penyimpanan Data"});
    //     }
    // });
    // return false;
}
function goTo(index){
    if (index==2) {
        var next=true;
        var no_ktp = $('#no_ktp').val();
        var nama = $('#nama').val();
        var tempat_lahir = $('#tempat_lahir').val();
        var tgl_lahir = $('#tgl_lahir').val();
        var jns_kelamin = $("input[name='jns_kelamin']:checked").val();
        var status_kawin = $('#status_kawin').val();
        var pekerjaan = $('#pekerjaan').val();
        var agama = $('#agama').val();
        var suku = $('#suku').val();
        var bahasa = $('#bahasa').val();
        var notelp = $('#notelp').val();
        if(!jns_kelamin){
            jns_kelamin="";
        }
        if(status_kawin==""){
            $('#err_status_kawin').html('Status Kawin Tidak boleh kosong')
            next=false
        }else $('#err_status_kawin').html('')
        if(agama==""){
            $('#err_agama').html('Agama Tidak boleh kosong')
            next=false
        }else $('#err_agama').html('')
        if(suku==""){
            $('#err_suku').html('SukuTidak boleh kosong')
            next=false
        }else $('#err_suku').html('')
        if(bahasa==""){
            $('#err_bahasa').html('Bahasa Kawin Tidak boleh kosong')
            next=false
        }else $('#err_bahasa').html('')
        if(no_ktp.length!=16){
            $('#err_no_ktp').html('No KTP Harus Diisi 16 Karakter')
            next=false
        }else $('#err_no_ktp').html('')
        if(nama==""){
            $('#err_nama').html('Nama Tidak boleh kosong')
            next=false
        }else $('#err_nama').html('')
        if(tempat_lahir==""){
            $('#err_tempat_lahir').html('Tempat Lahir Tidak boleh kosong')
            next=false
        }else $('#err_tempat_lahir').html('')
        if(tgl_lahir==""){
            $('#err_tgl_lahir').html('Tanggal Lahir Tidak boleh kosong')
            next=false
        }else $('#err_tgl_lahir').html('')
        if(pekerjaan==""){
            $('#err_pekerjaan').html('Pekerjaan Tidak boleh kosong')
            next=false
        }else $('#err_pekerjaan').html('')
        if(notelp==""){
            $('#err_notelp').html('Notelp Tidak boleh kosong')
            next=false
        }else $('#err_notelp').html('')
        if(jns_kelamin==""){
            $('#err_jns_kelamin').html('Jenis Kelamin Tidak boleh kosong')
            next=false
        }else $('#err_jns_kelamin').html('')
        if(next==true){
            $('.o-step').hide();
            $('#o-step'+index).show();
        }
        // $('.o-step').hide();
        // $('#o-step'+index).show();
    }else if(index==3){
        var next=true;
        var provinsi = $('#nama_provinsi').val();
        var kab_kota = $('#nama_kab_kota').val();
        var kecamatan = $('#nama_kecamatan').val();
        var kelurahan = $('#nama_kelurahan').val();
        var alamat = $('#alamat').val();

        if(provinsi==""){
            $('#err_provinsi').html('Provinsi Tidak boleh kosong')
            next=false
        }else $('#err_provinsi').html('')

        if(kab_kota==""){
            $('#err_kab_kota').html('Kab / Kota Tidak boleh kosong')
            next=false
        }else $('#err_kab_kota').html('')

        if(kecamatan==""){
            $('#err_kecamatan').html('Kecamatan Tidak boleh kosong')
            next=false
        }else $('#err_kecamatan').html('')

        if(kelurahan==""){
            $('#err_kelurahan').html('Kelurahan Tidak boleh kosong')
            next=false
        }else $('#err_kelurahan').html('')
        if(alamat==""){
            $('#err_alamat').html('Alamat Tidak boleh kosong')
            next=false
        }else $('#err_alamat').html('')
        if(next==true){
            $('.o-step').hide();
            $('#o-step'+index).show();
        }
        // $('.o-step').hide();
        // $('#o-step'+index).show();
    }else if(index==4){
        var next=true;
        var nama_keluarga = $('#o-pjPasienNama').val();
        var hub_keluarga = $('#o-pjPasienHubKel').val();
        var notelp_keluarga = $('#o-pjPasienTelp').val();
        var pekerjaan = $('#o-pjPasienPekerjaan').val();
        var alamat_keluarga = $('#o-pjPasienAlamat').val();
        if(nama_keluarga==""){
            $('#err_pjPasienNama').html('Nama Keluarga Tidak boleh kosong')
            next=false
        }else $('#err_pjPasienNama').html('')

        if(hub_keluarga==""){
            $('#err_pjPasienHubKel').html('Hubungan Keluarga Tidak boleh kosong')
            next=false
        }else $('#err_pjPasienHubKel').html('')

        if(notelp_keluarga==""){
            $('#err_notelp_keluarga').html('No Telp Keluarga Tidak boleh kosong')
            next=false
        }else $('#err_notelp_keluarga').html('')

        if(next==true){
            $('.o-step').hide();
            $('#o-step'+index).show();
        }
        // $('.o-step').hide();
        // $('#o-step'+index).show();

    }else if(index==6){
        var jkn=$('#o-jkn').val();
        if(jkn==1){
            $('.o-step').hide();
            $('#o-step'+index).show();
        }else{
            $('.o-step').hide();
            $('#o-step4').show();
        }
    }else if(index==8){
        var kajian=$('#kajian_mandiri_covid19').val();
        $('.o-step').hide();
        if(kajian==1){
            $('#kajiancovid').show();
        }else{
            $('#o-step8').show();
        }
    }
    else{
        $('.o-step').hide();
        $('#o-step'+index).show();
    }
    
}
function daftarBaru(){
    window.location.href= base_url+"pasien_baru";
}
function getKabupaten(){
    var prov=$('#nama_provinsi').val();
    var url = base_url+'welcome/kabkota?provinsi=' + prov
    console.clear()
    console.log(url)
    var option="";
    $.ajax({
        url     : url,
        type    : "GET",
        dataType: "json",
        data    : {get_param : 'value'},
        success : function(data){
            //menghitung jumlah data
            console.log(data);
            var option="<option value=''>Pilih Kabupaten</option>"
            if(data.status==true){
                // alert(data.status);
                for(var i=0; i<data.data.length;i++){
                    option+="<option value='"+data.data[i].nama_kabkota+"'>"+data.data[i].nama_kabkota+"</option>";
                }
                $('#nama_kab_kota').html(option);
                // alert(option)
            }else{
                alert(data.status)
            }
        },
        error: function(xhr) { // if error occured
            alert("Error occured.please try again");
            // $('#kecamatan').append(xhr.statusText + xhr.responseText);
            // $(placeholder).removeClass('loading');
        },
    });
}

function getKecamatan(){
    var nama_kabkota=$('#nama_kab_kota').val();
    var url = base_url+'welcome/kecamatan?nama_kabkota=' + nama_kabkota
    console.clear()
    console.log(url)
    var option="";
    $.ajax({
        url     : url,
        type    : "GET",
        dataType: "json",
        data    : {get_param : 'value'},
        success : function(data){
            //menghitung jumlah data
            console.log(data);
            var option="<option value=''>Pilih Kecamatan</option>"
            if(data.status==true){
                // alert(data.status);
                for(var i=0; i<data.data.length;i++){
                    option+="<option value='"+data.data[i].kecamatan+"'>"+data.data[i].kecamatan+"</option>";
                }
                $('#nama_kecamatan').html(option);
                $('#kabkota').val(data.data[0].kabkota)
                if(data.data[0].nama_kabkota=="Padang Panjang") var dk=1; else var dk=0;
                $('#dalam_kota').val(dk)
                // alert(option)
            }else{
                alert(data.status)
            }
        },
        error: function(xhr) { // if error occured
            alert("Error occured.please try again");
            // $('#kecamatan').append(xhr.statusText + xhr.responseText);
            // $(placeholder).removeClass('loading');
        },
    });
}
function getKelurahan(){
    var kecamatan=$('#nama_kecamatan').val();
    var url = base_url+'welcome/kelurahan?kecamatan=' + kecamatan
    console.clear()
    console.log(url)
    $.ajax({
        url     : url,
        type    : "GET",
        dataType: "json",
        data    : {get_param : 'value'},
        success : function(data){
            //menghitung jumlah data
            console.log(data);
            var option="<option value=''>Pilih Kelurahan</option>"
            var res=data.data;
            if(data["status"]==true){
                for(var i=0; i<res.length;i++){
                    option+="<option value='"+res[i].desa+"'>"+res[i].desa+"</option>";
                }
                $('#nama_kelurahan').html(option);
            }
        },
        error: function(xhr) { // if error occured
            alert("Error occured.please try again");
            // $('#kecamatan').append(xhr.statusText + xhr.responseText);
            // $(placeholder).removeClass('loading');
        },
    });
}
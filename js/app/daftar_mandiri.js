function cekNomr() {
    var url;
    url = base_url + "mandiri/pasien/cari";
    var formData = new FormData($('#cari')[0]);
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
            $('#icon-cari').removeClass('glyphicon-search');
            $('#icon-cari').addClass('glyphicon-refresh spin');
        },
        success: function (data) {
            console.log(data);
            if (data.status == true) {
                $('#id_pasien').val(data.data.idx)
                $('#nomr').val(data.data.nomr)
                $('#nama_pasien').val(data.data.nama)
                $('#no_ktp').val(data.data.no_ktp)
                $('#no_bpjs').val(data.data.no_bpjs)
                $('#tempat_lahir').val(data.data.tempat_lahir)
                $('#tgl_lahir').val(data.data.tgl_lahir)
                $('#jns_kelamin').val(data.data.jns_kelamin)
                $('#status_kawin').val(data.data.status_kawin)
                $('#pekerjaan').val(data.data.pekerjaan)
                $('#agama').val(data.data.agama)
                $('#no_telpon').val(data.data.no_telpon)
                $('#kewarganegaraan').val(data.data.kewarganegaraan)
                $('#nama_negara').val(data.data.nama_negara)
                $('#nama_provinsi').val(data.data.nama_provinsi)
                $('#nama_kab_kota').val(data.data.nama_kab_kota)
                $('#nama_kecamatan').val(data.data.nama_kecamatan)
                $('#nama_kelurahan').val(data.data.nama_kelurahan)
                $('#bahasa').val(data.data.bahasa)
                $('#suku').val(data.data.suku)
                $('#alamat').val(data.data.alamat)
                $('#penanggung_jawab').val(data.data.penanggung_jawab)
                $('#pjPasienNama').val(data.pjnama)
                $('#pjPasienTelp').val(data.pjnotelp)
                $('#pjPasienHubKel').val(data.pjhubungan)
                $('#pjPasienPekerjaan').val(data.pjpekerjaan)
                $('#pjPasienAlamat').val(data.pjalamat);
                $('#tgl_daftar').val(data.data.tgl_daftar);
                $('#control-form').show();
                $('#control-keyword').hide();
                
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
            $('#icon-cari').removeClass('glyphicon-refresh');
            $('#icon-cari').addClass('glyphicon-search');
            $('#loading').hide();
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

function getDokter() {
    var id =$('#id_ruang').val();
    var url = base_url + "mandiri/pasien/dokter/" + id;
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
            
            $('#dokter').html(data);
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

function pilihJenisBayar(asuransi){
    $('#jkn').val(asuransi)
    getCaraBayar(asuransi);
    if(asuransi==0){
        //Jika jenis Bayar Umum
        $('.step').hide();
        $('#step2').show();
        $('#asal1').prop('disabled', false);
        $('#id_rujuk').val('1')
        $('#rujukan').val('DATANG SENDIRI')
        $('#id_jenis_peserta').val('1');
        $('#jenis_peserta').val('Umum');
    }else if(asuransi==1){
        //Jika Jenis Bayar BPJS Kesehatan
        $('#asal1').prop('disabled', true);
        $('#id_rujuk').val('')
        $('#rujukan').val('')
        $('.step').hide();
        $('#step2').show();
    }else{
        $('#asal1').prop('disabled', false);
        $('#id_rujuk').val('1')
        $('#rujukan').val('DATANG SENDIRI')
        $('.step').hide();
        $('#step2').show();
    }
}
function pilihRujukan(idx,rujukan,faskes){
    var jkn=$('#jkn').val();
    $('#id_rujuk').val(idx);
    $('#rujukan').val(rujukan);
    $('#faskes').val(faskes)
    if(jkn==1){
        
        var nobpjs=$('#no_bpjs').val();
        if(nobpjs.length==13){
            // sweetAlert({
            //     title: "Terjadi Kesalahan..!",
            //     text: "Cek Rujukan Pasien",
            //     type: "success",
            //     timer: 5000
            // });
            generateRujukan(nobpjs,faskes)
        }else{
            $("#modal_nobpjs").modal("show");
        }
        
    }else{
        $('.step').hide();
        $('#step4').show();
    }
    
}
function cekStatus(){
    var nobpjs= $('#cek_nobpjs').val();
    var faskes= $('#faskes').val();
    // alert(nobpjs);
    if(nobpjs.length == 13){
        generateRujukan(nobpjs,faskes);
    }else{
        sweetAlert({
            title: "Peringatan..!",
            text: "No BPJS Anda Tidak Valid, no bpjs harus terdiri dari 13 karakter",
            type: "error",
            timer: 5000
        });
    }
}
function generateRujukan(nobpjs,faskes){
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
                    $('#status_peserta').val(data.response.peserta.statusPeserta.keterangan)
                    $('#id_jenis_peserta').val(data.response.peserta.jenisPeserta.kode);
                    $('#jenis_peserta').val(data.response.peserta.jenisPeserta.keterangan);
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
                                listRujukan(nobpjs,2);
                            } else {
                                listRujukan(nobpjs,1);
                            }
                         });
                          
                        // listRujukan(nobpjs,1);
                        // listRujukan(nobpjs,2);
                    }else{
                        listRujukan(nobpjs,faskes);
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
                
            }
            
            
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#rujukanbpjs').html("Rujukan Tidak Ditemukan");
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function listRujukan(nobpjs,faskes,split=0){
    var url = base_url + "mandiri/pasien/listrujukan/" + nobpjs+"/"+faskes;
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
                $('.step').hide();
                $('#step3').show();
                var rujukan=data.response.rujukan;
                var list="";
                for (let index = 0; index < rujukan.length; index++) {
                    list+='<div class="col-sm-3">'+
                    '<div class="thumbnail">'+
                        '<div class="caption text-center" onclick="setRujukan(\''+rujukan[index].noKunjungan+'\',\''+rujukan[index].provPerujuk.kode+'\',\''+rujukan[index].provPerujuk.nama+'\',\''+rujukan[index].poliRujukan.kode+'\',\''+rujukan[index].tglKunjungan+'\')">'+
                            '<div class="position-relative">'+
                            '<img src="'+base_url+'img/polybpjs/'+rujukan[index].poliRujukan.kode+'.jpg" class="img img-responsive img-circle"/>'+
                            '</div>'+
                            '<h4 id="thumbnail-label"><a href="#" target="_blank">'+rujukan[index].poliRujukan.nama+'<br>'+rujukan[index].noKunjungan+'</a></h4>'+
                            '<p><i class="glyphicon glyphicon-home light-red lighter bigger-120"></i> '+rujukan[index].provPerujuk.nama+'</p>'+
                            '<div class="thumbnail-description smaller">'+rujukan[index].tglKunjungan+'</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
                }
                var f = $('#faskes').val();
                if(f==3){
                    sweetAlert({
                        title: "Informasi!",
                        text: "Silahkan pilih rujukan anda",
                        type: "success",
                        timer: 5000
                    });
                }
                
                $('#rujukanbpjs').html(list);
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
            $('#rujukanbpjs').html("Rujukan Tidak Ditemukan");
            sweetAlert({
                title: "Terjadi Kesalahan..!",
                text: "Gagal Saat Pengambilan data",
                type: "error",
                timer: 5000
            });
        }
    });
}
function setRujukan(norujuk,idpengirim,namapengirim,polibpjs,tglrujukan){
    $('#no_rujuk').val(norujuk);
    $('#id_pengirim').val(idpengirim);
	$('#pjPasienDikirimOleh').val(namapengirim);
    var faskes = $('#faskes').val();
    var url = base_url + "mandiri/pasien/polibpjs/" + polibpjs+"/"+tglrujukan+"/"+idpengirim;
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
                    $('.step').hide();
                    $('#step4').show();
                }else{
                    $('#id_ruang').val(data.data.idx);
                    $('#nama_ruang').val(data.data.ruang);
                    if(faskes<3){
                        //jika kunjungan pertama
                        $('.step').hide();
                        $('#step5').show();
                        getDokter(data.data.idx);
                        // setPoliklinik(data.data.idx,data.data.ruang);
                    }else{
                        //Jika Kontrol Ulang
                        $('.step').hide();
                        $('#step4').show();
                    }
                }
                if(data.perujuk != null){
                    $('#pjPasienAlmtPengirim').val(data.perujuk.alamat_pengirim);
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
function getCaraBayar(asuransi){
    var url = base_url + "mandiri/pasien/carabayar/" + asuransi;
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
            
            $('#v-carabayar').html(data);
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
function setPoliklinik(idx,ruang){
    $('#id_ruang').val(idx);
    $('#nama_ruang').val(ruang);
    $('.step').hide();
    $('#step5').show();
    getDokter(idx);
}
function pilihDokter(nrp,nama,label,name,jam,quota){
    $('#id_dokter').val(nrp)
    $('#namaDokterJaga').val(nama);
    $('#label_antrian').val(label);
    $('#name_antrian').val(name);
    $('#jam_antrian').val(jam);
    $('#quota_antrian').val(quota);
    $('.step').hide();
    $('#step-finish').show();
    generateProfile()
}
function generateProfile(){
    var jkn=$('#jkn').val();
    var carabayar=$('#id_cara_bayar :selected').html();
    //$('#cara_bayar').val(cara_bayar);
    if(jkn!=1){
        $(".jkn").hide();
        carabayar=$('#cara_bayar').val();
    }
    //alert(carabayar);
    var nomr=$('#nomr').val();
    var no_bpjs=$('#no_bpjs').val();
    var jnspeserta=$('#jenis_peserta').val();
    var norujuk=$('#no_rujuk').val();
    var namafaskes=$('#pjPasienDikirimOleh').val();
    var alamatfaskes=$('#pjPasienAlmtPengirim').val();
    var id_pengirim=$('#id_pengirim').val();
    var nik=$('#no_ktp').val();
    var nama_pasien=$('#nama_pasien').val();
    var no_telpon = $('#no_telpon').val();
    var tempat_lahir=$('#tempat_lahir').val();
    var tgl_lahir=$('#tgl_lahir').val();
    var jns_kelamin=$('#jns_kelamin').val();
    // alert(no_telp)
    if(jns_kelamin=="0"||jns_kelamin=="P") {
        var jekel="Perempuan"; 
        var img="<img src='"+base_url+"img/avatar/female.png"+"' class='img img-responsive img-circle img-thumbnail'>";
    }
    else {
        var jekel="Laki-Laki";
        var img="<img src='"+base_url+"img/avatar/male.png"+"' class='img img-responsive img-circle img-thumbnail'>";
    }
    $('#v-foto').html(img)
    $('#v-nomr').html(nomr);
    $('#v-nobpjs').html(no_bpjs);
    $('#v-jnspeserta').html(jnspeserta);
    $('#v-norujukan').html(norujuk);
    $('#v-namafaskes').html(id_pengirim+" - "+namafaskes);
    $('#v-alamatfaskes').html(alamatfaskes);

    $('#v-nik').html(nik)
    $('#v-nama').html(nama_pasien)
    $('#v-namapasien').html(nama_pasien)
    $('#v-notelp').html(no_telpon)
    $('#v-ttl').html(tempat_lahir+" / " +tgl_lahir)
    $('#v-jekel').html(jekel)
    var no_bpjs = $('#no_bpjs').val();
    // var carabayar = $('#cara_bayar').val();
    var jnspeserta = $('#jnspeserta').val();
    var asalrujukan = $('#rujukan').val();
    var norujukan = $('#norujukan').val();
    var namafaskes = $('#namafaskes').val();
    var alamatfaskes=$('#alamatfaskes').val();
    var poliklinik=$('#nama_ruang').val();
    var namadokter = $('#namaDokterJaga').val();
    var pjnama=$('#pjPasienNama').val()
    // $('#pjPasienNama').val(data.pjnama)
    var pjnotelp = $('#pjPasienTelp').val()
    
    var pjhubungan = $('#pjPasienHubKel').val()
    var pjpekerjaan = $('#pjPasienPekerjaan').val()
    var pjalamat = $('#pjPasienAlamat').val();
    // $('#v-carabayar').html(carabayar)
    $('#v-no_bpjs').html(no_bpjs)
    $('#v-jnspeserta').html(jnspeserta)
    $('#v-asalrujukan').html(asalrujukan)
    $('#v-norujukan').html(norujukan)
    $('#v-namafaskes').html(namafaskes)
    $('#v-alamatfaskes').html(alamatfaskes)
    $('#v-poliklinik').html(poliklinik)
    $('#v-namadokter').html(namadokter)

    $('#v-pjnama').html(pjnama)
    $('#v-pjtelp').html(pjnotelp)
    $('#v-pjhubungan').html(pjhubungan)
    $('#v-pjpekerjaan').html(pjpekerjaan)
    $('#v-pjalamat').html(pjalamat)
}
function daftarPasien(){
    var url = base_url+"mandiri/pasien/simpan_pendaftaran";

    // ajax adding data to database
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: 'JSON',
        beforeSend: function() {
            // setting a timeout
            $('#loading').show();
        },
        success: function(data) {
            if(data.status===false){
                sweetAlert({
                    title: "Peringatan",
                    text: data.message,
                    type: "warning",
                    timer: 5000
                });
            }else{
                sweetAlert({
                    title: "Peringatan",
                    text: data.message,
                    type: "success",
                    timer: 5000
                });
                printReservasi();
            }
        },
        complete: function() {
            $('#loading').hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(url);
        }
    });
}

function printReservasi(){
    alert('Print Reservasi');
}
function step1(){
    $('.step').hide();
    $('#step1').show();
}
function step2(){
    $('.step').hide();
    var jkn=$('#jkn').val();
    $('.step').hide();
    if(jkn==1) $('#step2').show();
    else $('#step1').show();
    //$('#step2').show();
}
function step3(){
    // $('#jkn').val(asuransi)
    // getCaraBayar(asuransi);
    // if(asuransi==0){
    //     //Jika jenis Bayar Umum
    //     $('.step').hide();
    //     $('#step4').show();
    //     $('#id_rujuk').val('1')
    //     $('#rujukan').val('DATANG SENDIRI')
    //     $('#id_jenis_peserta').val('1');
    //     $('#jenis_peserta').val('Umum');
    // }else if(asuransi==1){
    //     //Jika Jenis Bayar BPJS Kesehatan
    //     $('#id_rujuk').val('')
    //     $('#rujukan').val('')
    //     $('.step').hide();
    //     $('#step3').show();
    // }else{
    //     $('#id_rujuk').val('1')
    //     $('#rujukan').val('DATANG SENDIRI')
    //     $('.step').hide();
    //     $('#step4').show();
    // }
    var jkn=$('#jkn').val();
    $('.step').hide();
    $('#step2').show();
    
}
function step4(){
    $('.step').hide();
    $('#step4').show();
}
function step5(){
    $('.step').hide();
    $('#step5').show();
}
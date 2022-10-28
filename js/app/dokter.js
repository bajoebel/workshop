function add(){
    $('#tombol').hide();
    $('#form_box').show()
    $('#form_box').addClass('col-md-4')
    $('#tabel_box').removeClass('col-md-12');
    $('#tabel_box').addClass('col-md-8');
}
function resetApp(){
    $('#tombol').show();
    $('#form_box').hide()
    // $('#form_box').addClass('col-md-4')
    $('#tabel_box').removeClass('col-md-8');
    $('#tabel_box').addClass('col-md-12');
    $('#dokter_id').val("");
    $('#dokter_nama').val("")
    $('#dokter_status').val("")
    $('#nrp').val("")
    $('#dokter_spesalis_id').val("")
    $('#dokter_jekel').val("")
    $('#dokter_notelp').val("")
    $('#dokter_jenis').val("")
    $('#err_dokter_nama').html("")
    $('#err_dokter_status').html("")
    $('#err_nrp').html("")
    $('#err_dokter_spesalis_id').html("")
    $('#err_dokter_jekel').html("")
    $('#err_dokter_notelp').html("")
    $('#err_dokter_jenis').html("")
}
function edit(dokter_id,nrp,spesialis_id,dokter_nama,notelp,jenis,dokter_status,jekel){
    add();
    $('#dokter_id').val(dokter_id);
    $('#dokter_nama').val(dokter_nama)
    $('#nrp').val(nrp)
    $('#dokter_spesialis_id').val(spesialis_id)
    $('#dokter_notelp').val(notelp)
    $('#dokter_jenis').val(jenis)
    $('#dokter_jekel').val(jekel)
    if(dokter_status=="Aktif") {
        $('#dokter_status').prop('checked',true);
        // alert("checked")
    }
    else  $('#dokter_status').prop('checked',false);
}
function simpan(){
    var url;
    url = base_url + "admin/dokter/simpan";
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data : formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(data)
        {
            if(data["status"]==true){
                if(data["error"]==true){
                    // $('#csrf').val(data["csrf"]);
                    if(data["err_dokter_nama"]!="") $('#err_dokter_nama').html(data["err_dokter_nama"]); else $('#err_dokter_nama').html("");
                    if(data["err_dokter_spesialis_id"]!="") $('#err_dokter_spesialis_id').html(data["err_dokter_spesialis_id"]); else $('#err_dokter_spesialis_id').html("");
                    if(data["err_dokter_notelp"]!="") $('#err_dokter_notelp').html(data["err_dokter_notelp"]); else $('#err_dokter_notelp').html("");
                    if(data["err_nrp"]!="") $('#err_nrp').html(data["err_nrp"]); else $('#err_nrp').html("");
                    if(data["err_dokter_status"]!="") $('#err_dokter_status').html(data["err_dokter_status"]); else $('#err_dokter_status').html("");
                
                }else{
                    var start=$('#start').val();
                    getData(start);
                    resetApp();
                    swal({
                     title: "Sukses",
                     text: data["message"],
                     type: "success",
                     timer: 5000
                    });
                }
            }
            else{
                swal({
                    title: "Peringatan",
                    text: data["message"],
                    type: "warning",
                    timer: 5000
                });
            }
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal({
             title: "Terjadi Kesalahan ",
             text: "Gagal Menyimpan Data",
             type: "error",
             timer: 5000
            });
        }
    });
}

function hapus(id) {
    var isConfirm = confirm("Apakah anda yakin akan menghapus")
    if (isConfirm) {
        $.ajax({
            url: base_url + "admin/dokter/hapus/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                var start=$('#start').val();
                getData(start);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error')
            }
        });
    }
}
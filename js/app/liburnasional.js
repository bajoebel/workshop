$(document).ready(function() {
    // $('#no_ktp').focus();
    $('#libur_tgl').inputmask('yyyy-mm-dd', {
        'placeholder': 'yyyy-mm-dd'
    });
    $('#libur_tgl').datepicker({
        autoclose : true,
        format    : "yyyy-mm-dd"
    }) 
});
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
    $('#libur_id').val("");
    $('#libur_tgl').val("")
    $('#libur_keterangan').val("")
    $('#err_libur_tgl').html("")
    $('#err_libur_keterangan').html("")
}
function edit(libur_id,libur_tgl,libur_keterangan){
    add();
    $('#libur_id').val(libur_id);
    $('#libur_tgl').val(libur_tgl)
    $('#libur_keterangan').val(libur_keterangan)
}
function simpan(){
    var url;
    url = base_url + "admin/liburnasional/simpan";
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
                    if(data["err_libur_tgl"]!="") $('#err_libur_tgl').html(data["err_libur_tgl"]); else $('#err_libur_tgl').html("");
                    if(data["err_libur_keterangan"]!="") $('#err_libur_keterangan').html(data["err_libur_keterangan"]); else $('#err_libur_keterangan').html("");
                
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
            url: base_url + "admin/liburnasional/hapus/" + id,
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
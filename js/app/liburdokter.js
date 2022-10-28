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
    $('#libur_jadwalid').val("")
    $('#libur_keterangan').val("")
    $('#err_libur_tgl').html("")
    $('#err_libur_jadwalid').html("")
    $('#err_libur_keterangan').html("")
}
function edit(libur_id,libur_tgl,libur_jadwalid,libur_keterangan){
    add();
    $.ajax({
        url: base_url + "admin/liburdokter/jadwal/" + libur_tgl,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var option="";
            for (let index = 0; index < data.length; index++) {
                if(libur_jadwalid==data[index].jadwal_id){
                    option+="<option value='"+data[index].jadwal_id+"' selected>"+data[index].dokter_nama +"("+data[index].poly_nama+")" +"</option>";
                }else{
                    option+="<option value='"+data[index].jadwal_id+"'>"+data[index].dokter_nama +"("+data[index].poly_nama+")" +"</option>";
                }
                
            }
            $('#libur_jadwalid').html(option);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error');
        }
    });
    $('#libur_id').val(libur_id);
    $('#libur_tgl').val(libur_tgl)
    $('#libur_jadwalid').val(libur_jadwalid)
    $('#libur_keterangan').val(libur_keterangan)
}
function simpan(){
    var url;
    url = base_url + "admin/liburdokter/simpan";
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
                    if(data["err_libur_jadwalid"]!="") $('#err_libur_jadwalid').html(data["err_libur_jadwalid"]); else $('#err_libur_jadwalid').html("");
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
            url: base_url + "admin/liburdokter/hapus/" + id,
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

function getJadwal(){
    var tanggal=$('#libur_tgl').val();
    $.ajax({
        url: base_url + "admin/liburdokter/jadwal/" + tanggal,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var option="";
            for (let index = 0; index < data.length; index++) {
                option+="<option value='"+data[index].jadwal_id+"'>"+data[index].dokter_nama +"("+data[index].poly_nama+")" +"</option>";
            }
            $('#libur_jadwalid').html(option);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error');
        }
    });
}
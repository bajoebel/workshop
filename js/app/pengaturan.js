function add(){
    $('#tombol').hide();
    $('#form_box').show()
    $('#form_box').addClass('col-md-4')
    $('#tabel_box').removeClass('col-md-12');
    $('#tabel_box').addClass('col-md-8');
}

function simpan(){
    var url;
    url = base_url + "admin/pengaturan/simpan";
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
                    if(data["err_set_jadwal_daftar_m"]!="") $('#err_set_jadwal_daftar_m').html(data["err_set_jadwal_daftar_m"]); else $('#err_set_jadwal_daftar_m').html("");
                    if(data["err_set_jadwal_daftar_s"]!="") $('#err_set_jadwal_daftar_s').html(data["err_set_jadwal_daftar_s"]); else $('#err_set_jadwal_daftar_s').html("");
                    if(data["err_set_jadwal_daftar_s"]!="") $('#err_set_jadwal_daftar_s').html(data["err_set_jadwal_daftar_s"]); else $('#err_set_jadwal_daftar_s').html("");
                    if(data["err_set_jadwal_daftar_s"]!="") $('#err_set_jadwal_daftar_s').html(data["err_set_jadwal_daftar_s"]); else $('#err_set_jadwal_daftar_s').html("");
                }else{
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
            url: base_url + "admin/kategori/hapus/" + id,
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
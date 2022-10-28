function add(){
    $('#tombol').hide();
    $('#form_box').show()
    $('#form_box').addClass('col-md-4')
    $('#tabel_box').removeClass('col-md-12');
    $('#tabel_box').addClass('col-md-8');
    $('#poly_id').prop('readonly',false);
}
function resetApp(){
    $('#tombol').show();
    $('#form_box').hide()
    // $('#form_box').addClass('col-md-4')
    $('#tabel_box').removeClass('col-md-8');
    $('#tabel_box').addClass('col-md-12');
    $('#poly_id').val("");
    $('#poly_id').prop('readonly',false);
    $('#poly_nama').val("")
    $('#poly_glid').val("")
    $('#poly_kode').val("")
    $('#err_poly_nama').html("")
    $('#err_poly_id').html("")
    $('#poly_status').prop('checked',false);
    $('#poly_induk').prop('checked',false);
}
function edit(poly_id,poly_nama,poly_glid,poly_status,poly_kode,poly_induk){
    add();
    $('#poly_id').val(poly_id);
    $('#poly_id').prop('readonly',true);
    $('#poly_nama').val(poly_nama)
    $('#poly_glid').val(poly_glid)
    $('#poly_kode').val(poly_kode)
    if(poly_status=="Aktif") $('#poly_status').prop('checked',true);
    else  $('#poly_status').prop('checked',false);
    if(poly_induk==1) $('#poly_induk').prop('checked',true);
    else  $('#poly_induk').prop('checked',false);
}
function simpan(){
    var url;
    url = base_url + "admin/poliklinik/simpan";
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
                    if(data["err_poly_nama"]!="") $('#err_poly_nama').html(data["err_poly_nama"]); else $('#err_poly_nama').html("");
                    if(data["err_poly_id"]!="") $('#err_poly_id').html(data["err_poly_id"]); else $('#err_poly_id').html("");
                
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
            url: base_url + "admin/poliklinik/hapus/" + id,
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
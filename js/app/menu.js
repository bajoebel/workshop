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
    $('#menu_id').val("");
    $('#menu_judul').val("")
    $('#menu_link').val("")
    $('#menu_idxutama').val("")
    $('#menu_idxanak').val("")
    $('#menu_idxsub').val("")
    $('#menu_baseurl').prop('checked',false)
    $('#menu_status').prop('checked',false)
    $('#err_menu_judul').html("")
    $('#err_menu_link').html("")
}
function edit(menu_id,menu_judul,menu_link,menu_idxutama,menu_idxanak,menu_idxsub,menu_baseurl,menu_status){
    add();
    $('#menu_id').val(menu_id);
    $('#menu_judul').val(menu_judul)
    $('#menu_link').val(menu_link)
    $('#menu_idxutama').val(menu_idxutama)
    $('#menu_idxanak').val(menu_idxanak)
    $('#menu_idxsub').val(menu_idxsub)
    if(menu_baseurl==1) {
        $('#menu_baseurl').prop('checked',true);
    }
    else  $('#menu_baseurl').prop('checked',false);
    if(menu_status==1) {
        $('#menu_status').prop('checked',true);
    }
    else  $('#menu_status').prop('checked',false);
}
function simpan(){
    var url;
    url = base_url + "admin/menu/simpan";
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
                    if(data["err_menu_judul"]!="") $('#err_menu_judul').html(data["err_menu_judul"]); else $('#err_menu_judul').html("");
                    if(data["err_menu_link"]!="") $('#err_menu_link').html(data["err_menu_link"]); else $('#err_menu_link').html("");
                
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
            url: base_url + "admin/menu/hapus/" + id,
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
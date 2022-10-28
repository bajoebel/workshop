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
    $('#client_id').val("");
    $('#client_name').val("")
    $('#client_secret_key').val("")
    $('#client_status').val("")
    $('#err_client_name').html("")
    $('#err_client_status').html("")
    $('#err_client_secret_key').html("")
    $('#client_id').prop('readonly',false);
    $('#client_secret_key').prop('readonly',false);
}
function edit(client_id,client_name,client_secret_key,client_status){
    add();
    $('#client_id').val(client_id);
    $('#client_name').val(client_name)
    $('#client_secret_key').val(client_secret_key)
    if(client_status=="Aktif") {
        $('#client_status').prop('checked',true);
        // alert("checked")
    }
    else  $('#client_status').prop('checked',false);
    $('#client_id').prop('readonly',true);
    $('#client_secret_key').prop('readonly',true);
}
function simpan(){
    var url;
    url = base_url + "admin/wsclient/simpan";
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
                    if(data["err_client_name"]!="") $('#err_client_name').html(data["err_client_name"]); else $('#err_client_name').html("");
                    if(data["err_client_id"]!="") $('#err_client_id').html(data["err_client_id"]); else $('#err_client_id').html("");
                    if(data["err_client_secret_key"]!="") $('#err_client_secret_key').html(data["err_client_secret_key"]); else $('#err_client_secret_key').html("");
                    if(data["err_client_status"]!="") $('#err_client_status').html(data["err_client_status"]); else $('#err_client_status').html("");
                
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
            url: base_url + "admin/wsclient/hapus/" + id,
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
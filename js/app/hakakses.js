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
    $('#idx').val("");
    $('#level').val("")
    $('#err_level').html("")
    $('#aktif').prop('checked',false);
    getHakAkses(0);
}
function edit(idx,level,status){
    add();
    $('#idx').val(idx);
    $('#level').val(level)
    getHakAkses(idx);
    if(status==1) {
        $('#aktif').prop('checked',true);
        // alert("checked")
    }
    else  $('#aktif').prop('checked',false);
}
function simpan(){
    var url;
    url = base_url + "admin/hakakses/simpan";
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
                    if(data["err_level"]!="") $('#err_level').html(data["err_level"]); else $('#err_level').html("");
                    if(data["err_status"]!="") $('#err_status').html(data["err_status"]); else $('#err_status').html("");
                
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
            url: base_url + "admin/hakakses/hapus/" + id,
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
function checkAll(classid){
    // alert("pilih"+classid)
    if ($('#pilih'+classid).is(':checked')) {
        $('.pilih'+classid).prop('checked',true);
    }else{
        $('.pilih'+classid).prop('checked',false);
    }
}
function getHakAkses(idx){
    $.ajax({
        url: base_url + "admin/hakakses/level/" + idx,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if(data.status==true){
                $('#hakakses').html(data.hakakses);
            }else{
                swal({
                    title: "Peringatan",
                    text: data.message,
                    type: "warning",
                    timer: 5000
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error')
        }
    });
}
$(document).ready(function() {
    // // $('#no_ktp').focus();
    // $('#user_nama_lengkap').inputmask('yyyy-mm-dd', {
    //     'placeholder': 'yyyy-mm-dd'
    // });
    // $('#user_nama_lengkap').datepicker({
    //     autoclose : true,
    //     format    : "yyyy-mm-dd"
    // }) 
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
    $('#user_id').val("");
    $('#user_nama_lengkap').val("")
    $('#user_email').val("")
    $('#user_password').val("")
    $('#err_user_nama_lengkap').html("")
    $('#err_user_email').html("")
    $('#err_user_password').html("")
}
function edit(user_id,user_nama_lengkap,user_email,user_idxlevel,user_password,user_status){
    add();
    // $.ajax({
    //     url: base_url + "admin/user/jadwal/" + user_nama_lengkap,
    //     type: "GET",
    //     dataType: "JSON",
    //     success: function (data) {
    //         var option="";
    //         for (let index = 0; index < data.length; index++) {
    //             if(user_email==data[index].jadwal_id){
    //                 option+="<option value='"+data[index].jadwal_id+"' selected>"+data[index].dokter_nama +"("+data[index].poly_nama+")" +"</option>";
    //             }else{
    //                 option+="<option value='"+data[index].jadwal_id+"'>"+data[index].dokter_nama +"("+data[index].poly_nama+")" +"</option>";
    //             }
                
    //         }
    //         $('#user_email').html(option);
    //     },
    //     error: function (jqXHR, textStatus, errorThrown) {
    //         alert('Error');
    //     }
    // });
    $('#user_id').val(user_id);
    $('#user_nama_lengkap').val(user_nama_lengkap)
    $('#user_email').val(user_email)
    $('#user_idxlevel').val(user_idxlevel)
    $('#user_password').val(user_password)
    if(user_status=='Aktif') $('#user_status').prop('checked',true);
    else  $('#user_status').prop('checked',false);
    $('#user_email').prop('readonly',true);
    $('#user_password').prop('readonly',true);
}
function simpan(){
    var url;
    url = base_url + "admin/user/simpan";
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
                    if(data["err_user_nama_lengkap"]!="") $('#err_user_nama_lengkap').html(data["err_user_nama_lengkap"]); else $('#err_user_nama_lengkap').html("");
                    if(data["err_user_email"]!="") $('#err_user_email').html(data["err_user_email"]); else $('#err_user_email').html("");
                    if(data["err_user_password"]!="") $('#err_user_password').html(data["err_user_password"]); else $('#err_user_password').html("");
                
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
            url: base_url + "admin/user/hapus/" + id,
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
    var tanggal=$('#user_nama_lengkap').val();
    $.ajax({
        url: base_url + "admin/user/jadwal/" + tanggal,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var option="";
            for (let index = 0; index < data.length; index++) {
                option+="<option value='"+data[index].jadwal_id+"'>"+data[index].dokter_nama +"("+data[index].poly_nama+")" +"</option>";
            }
            $('#user_email').html(option);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error');
        }
    });
}
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
    $('#id_rujukan').val("");
    $('#rujukan').val("")
    $('#err_rujukan').html("")
}
function edit(Id,rujukan,jenis){
    add();
    $('#id_rujukan').val(Id);
    $('#rujukan').val(rujukan)
    $('#jenis').val(jenis)
}
function simpan(){
    var url;
    url = base_url + "admin/rujukan/simpan";
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
                    if(data["err_rujukan"]!="") $('#err_rujukan').html(data["err_rujukan"]); else $('#err_rujukan').html("");
                
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
        error: function (jqXHR, textrujukan, errorThrown)
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
            url: base_url + "admin/rujukan/hapus/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                var start=$('#start').val();
                getData(start);
            },
            error: function (jqXHR, textrujukan, errorThrown) {
                alert('Error')
            }
        });
    }
}
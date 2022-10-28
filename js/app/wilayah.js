function add(){
    resetApp();
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
    $('#wilayah_id').val("");
    $('#provinsi').val("")
    $('#kabkota').val("")
    $('#nama_kabkota').val("")
    $('#kecamatan').val("")
    $('#desa').val("")
    $('#err_provinsi').html("")
    $('#err_kabkota').html("")
    $('#err_nama_kabkota').html("")
    $('#err_kecamatan').html("")
    $('#err_desa').html("")
}
function edit(Id,provinsi,kabkota,nama_kabkota,kecamatan,desa){
    add();
    $('#wilayah_id').val(Id);
    $('#provinsi').val(provinsi)
    $('#kabkota').val(kabkota)
    $('#nama_kabkota').val(nama_kabkota)
    $('#kecamatan').val(kecamatan)
    $('#desa').val(desa)
}
function simpan(){
    var url;
    url = base_url + "admin/wilayah/simpan";
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
                    if(data["err_provinsi"]!="") $('#err_provinsi').html(data["err_provinsi"]); else $('#err_provinsi').html("");
                    if(data["err_kabkota"]!="") $('#err_kabkota').html(data["err_kabkota"]); else $('#err_kabkota').html("");
                    if(data["err_nama_kabkota"]!="") $('#err_nama_kabkota').html(data["err_nama_kabkota"]); else $('#err_werr_nama_kabkotailayah').html("");
                    if(data["err_kecamatan"]!="") $('#err_kecamatan').html(data["err_kecamatan"]); else $('#err_kecamatan').html("");
                    if(data["err_desa"]!="") $('#err_desa').html(data["err_desa"]); else $('#err_desa').html("");
                
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
        error: function (jqXHR, textwilayah, errorThrown)
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
            url: base_url + "admin/wilayah/hapus/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                var start=$('#start').val();
                getData(start);
            },
            error: function (jqXHR, textwilayah, errorThrown) {
                alert('Error')
            }
        });
    }
}
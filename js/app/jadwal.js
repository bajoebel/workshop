function add(){
    $('#tombol').hide();
    $('#form_box').show()
    $('#form_box').addClass('col-md-5')
    $('#tabel_box').removeClass('col-md-12');
    $('#tabel_box').addClass('col-md-7');
}
function resetApp(){
    $('#tombol').show();
    $('#form_box').hide()
    // $('#form_box').addClass('col-md-4')
    $('#tabel_box').removeClass('col-md-7');
    $('#tabel_box').addClass('col-md-12');
    $('#jadwal_id').val("");
    $('#jadwal_dokter_id').val("")
    $('#jadwal_status').val("")
    $('#jadwal_poly_id').val("")
    $('#jadwal_hari').val("")
    $('#jadwal_pekan').val("")
    $('#jadwalgroup').val("")
    $('#err_jadwal_dokter_id').html("")
    $('#err_jadwal_status').html("")
    $('#err_jadwal_poly_id').html("")
    $('#err_jadwal_hari').html("")
    $('#err_jadwal_pekan').html("")
    $('#err_jadwalgroup').html("")
    $('#group').html("")
}
function edit(jadwal_id,jadwal_dokter_id,jadwal_poly_id,jadwal_hari,jadwal_pekan,jadwalgroup,jadwal_status){
    add();
    $('#jadwal_id').val(jadwal_id);
    $('#jadwal_dokter_id').val(jadwal_dokter_id)
    $('#jadwal_poly_id').val(jadwal_poly_id)
    $('#jadwal_hari').val(jadwal_hari)
    $('#jadwalgroup').val(jadwalgroup)
    $('#jadwal_pekan').val(jadwal_pekan)
    if(jadwal_status=="Aktif") {
        $('#jadwal_status').prop('checked',true);
        // alert("checked")
    }
    else  $('#jadwal_status').prop('checked',false);
    viewGroup();
}
function simpan(){
    var url;
    url = base_url + "admin/jadwal/simpan";
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
                    if(data["err_jadwal_dokter_id"]!="") $('#err_jadwal_dokter_id').html(data["err_jadwal_dokter_id"]); else $('#err_jadwal_dokter_id').html("");
                    if(data["err_jadwal_poly_id"]!="") $('#err_jadwal_poly_id').html(data["err_jadwal_poly_id"]); else $('#err_jadwal_poly_id').html("");
                    if(data["err_jadwal_hari"]!="") $('#err_jadwal_hari').html(data["err_jadwal_hari"]); else $('#err_jadwal_hari').html("");

                    if(data["err_jadwalgroup"]!="") $('#err_jadwalgroup').html(data["err_jadwalgroup"]); else $('#err_jadwalgroup').html("");
                    if(data["err_group_mulai"]!="") $('#err_group_mulai').html(data["err_group_mulai"]); else $('#err_group_mulai').html("");
                    if(data["err_group_selesai"]!="") $('#err_group_selesai').html(data["err_group_selesai"]); else $('#err_group_selesai').html("");
                    if(data["err_err_group_quotaperjam"]!="") $('#err_group_quotaperjam').html(data["err_group_quotaperjam"]); else $('#err_group_quotaperjam').html("");
                
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
            url: base_url + "admin/jadwal/hapus/" + id,
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
function viewGroup(){
    var groupid=$('#jadwalgroup').val();
    $.ajax({
        url: base_url + "admin/jadwal/group/" + groupid,
        type: "GET",
        dataType: "HTML",
        success: function (data) {
            $('#group').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error')
        }
    });
}
function priviewGroup(){
    var dari=$('#group_mulai').val();
    var sampai=$('#group_selesai').val();
    var quota=$('#group_quotaperjam').val();
    $.ajax({
        url: base_url + "admin/jadwal/groupbaru/"+dari+"/"+sampai+"/"+quota,
        type: "GET",
        dataType: "HTML",
        success: function (data) {
            $('#priview_group').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error')
        }
    });
}
function getJamSampai(){
    var id=$('#group_mulai').val();
    $.ajax({
        url: base_url + "admin/jadwal/sampai/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if(data.status==true){
                var option="";
                for (let index = 0; index < data.data.length; index++) {
                    option+="<option value='"+data.data[index].id+"'>"+data.data[index].jam+"</option>";
                }
                $('#group_selesai').html(option);
            }else{
                alert(data.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error')
        }
    });
}

function pilihSemua(){
    // alert('checkall')
    if ($('#checkall').is(':checked')) {
        $('.pilih').prop('checked',true);
    }else{
        $('.pilih').prop('checked',false);
    }
}
function getData(start){
    $('#start').val(start);
    var search = $('#q').val();
    var limit = $('#limit').val();
    var url = base_url+'admin/partner/getdata?keyword=' + search + "&start=" + start + "&limit=" + limit 
    console.clear()
    console.log(url)
    $.ajax({
        url     : url,
        type    : "GET",
        dataType: "json",
        data    : {get_param : 'value'},
        beforeSend: function () {
            var tabel = "<tr id='loading'><td colspan='6'><b>Loading...</b></td></tr>";
            $('#data').html(tabel);
            $('#pagination').html('');
        },
        success : function(data){
        //menghitung jumlah data
        console.log(data);
            if(data["status"]==true){
                $('#data').html('');
                var res    = data["data"];
                console.log(res);
                var jmlData=res.length;
                var limit   = data["limit"];
                var tabel   = "";
                //Create Tabel
                var no = (parseInt(start)*parseInt(limit))-parseInt(limit);
                var dari = no+1;
                var sampai = no+parseInt(limit);
                var desc = "<button class='btn btn-default btn-sm' type='button'>Showing "+ dari + " To " + sampai + " of " +data["row_count"]+"</button>";
                for(var i=0; i<jmlData;i++){
                    no++;
                    tabel="<tr>";tabel+="<td>"+no+"</td>";
                    tabel+="<td><img src='"+base_url+"rsud-backend/public/img/partner/"+res[i]['partner_logo']+"' style='width:250px'></td>";
                    tabel+="<td>"+res[i]['partner_nama']+"</td>";
                    tabel+="<td>"+res[i]['partner_link']+"</td>";
                    tabel+="<td>"+res[i]['partner_status']+"</td>";
                    tabel+="<td style='text-align:right;'><div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit("+res[i]["partner_id"]+",\""+res[i]["partner_nama"]+"\",\""+res[i]["partner_link"]+"\",\""+res[i]["partner_status"]+"\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus("+res[i]["partner_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div></td>";tabel+="</tr>";
                    $('#data').append(tabel);
                }
                console.log(data);
                //Create Pagination
                if(data["row_count"]<=limit){
                    $('#pagination').html("");
                }else{
                    console.log("buat Pagination");
                    var pagination="";
                    var btnIdx="";
                    jmlPage = Math.ceil(data["row_count"]/limit);
                    offset  = data["start"] % limit;
                    /*curIdx  = Math.ceil((data["start"]/data["limit"])+1);
                    prev    = (curIdx-2) * data["limit"];
                    next    = (curIdx) * data["limit"];*/

                    
                    //var curSt=(curIdx*data["limit"])-jmlData;
                    //var mulai = start;
                    var curIdx = start;
                    var btn="btn-default";
                    //var lastSt=jmlPage;
                    var btnFirst="<button class='btn btn-default btn-sm' onclick='getData(1)'><span class='fa fa-angle-double-left'></span></button>";
                    if (curIdx > 1) {
                        var prevSt=curIdx-1;
                        btnFirst+="<button class='btn btn-default btn-sm' onclick='getData("+prevSt+")'><span class='fa fa-angle-left'></span></button>";
                    }

                    var btnLast="";
                    if(curIdx<jmlPage){
                        var nextSt=curIdx+1;
                        btnLast+="<button class='btn btn-default btn-sm' onclick='getData("+nextSt+")'><span class='fa fa-angle-right'></span></button>";
                    }
                    console.log(curIdx);
                    btnLast+="<button class='btn btn-default btn-sm' onclick='getData("+jmlPage+")'><span class='fa fa-angle-double-right'></span></button>";
                    
                    if(jmlPage>=5){
                        console.clear();
                        console.log('Jumlah Halaman > 5');
                        if(curIdx>=3){
                            console.log('Cur Idx >= 3');
                            var idx_start=curIdx - 2;
                            var idx_end=curIdx + 2;
                            if(idx_end>=jmlPage) idx_end=jmlPage;
                        }else{
                            var idx_start=1;
                            var idx_end=5;
                        }
                        for (var j = idx_start; j<=idx_end; j++) {
                            if(curIdx==j)  btn="btn-primary"; else btn= "btn-default";
                            btnIdx+="<button class='btn " +btn +" btn-sm' onclick='getData("+ j +")'>" + j +"</button>";
                        }
                    }else{

                        for (var j = 1; j<=jmlPage; j++) {
                            if(curIdx==j)  btn="btn-primary"; else btn= "btn-default";
                            btnIdx+="<button class='btn " +btn +" btn-sm' onclick='getData("+ j +")'>" + j +"</button>";
                        }
                    }
                    pagination+="<div class='tabel-box'><div class='btn-group'>"+desc+btnFirst + btnIdx + btnLast+"</div></div>";
                    $('#pagination').html(pagination);
                }
            }
        },
        error: function(xhr) { // if error occured
            alert("Error occured.please try again");
            $('#data').append(xhr.statusText + xhr.responseText);
            // $(placeholder).removeClass('loading');
        },
        complete : function(){
            //$('#loading').hide();
        }
    });
}
getData(1)
function add(){
    $('#tombol').hide();
    $('#form_box').show()
    $('#form_box').addClass('col-md-4')
    $('#tabel_box').removeClass('col-md-12');
    $('#tabel_box').addClass('col-md-8');
    $('#partner_id').prop('readonly',false);
}
function resetApp(){
    $('#tombol').show();
    $('#form_box').hide()
    // $('#form_box').addClass('col-md-4')
    $('#tabel_box').removeClass('col-md-8');
    $('#tabel_box').addClass('col-md-12');
    $('#partner_id').val("");
    $('#partner_nama').val("")
    $('#partner_logo').val("")
    $('#partner_link').val("")
    $('#err_partner_nama').html("")
    $('#err_partner_logo').html("")
    $('#err_partner_link').html("")
    $('#partner_status').prop('checked',false);
    $('#poly_induk').prop('checked',false);
}
function edit(partner_id,partner_nama,partner_link,partner_status){
    add();
    $('#partner_id').val(partner_id);
    $('#partner_nama').val(partner_nama)
    $('#partner_link').val(partner_link)
    if(partner_status==1) $('#partner_status').prop('checked',true);
    else  $('#partner_status').prop('checked',false);
}
function simpan(){
    var url;
    url = base_url + "admin/partner/simpan";
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
                    if(data["err_partner_nama"]!="") $('#err_partner_nama').html(data["err_partner_nama"]); else $('#err_partner_nama').html("");
                    if(data["err_partner_id"]!="") $('#err_partner_id').html(data["err_partner_id"]); else $('#err_partner_id').html("");
                
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
            url: base_url + "admin/partner/hapus/" + id,
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
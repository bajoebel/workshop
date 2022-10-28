$(document).ready(function() {
    // $('#no_ktp').focus();
    $('#tanggal').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    });
    $('#tanggal').datepicker({
        autoclose : true,
        format    : "dd/mm/yyyy"
    }) 
    getData(1)
});
function getData(start){
    $('#start').val(start);
    var search = $('#q').val();
    var limit = $('#limit').val();
    var tgl = $('#tanggal').val();
    var ruang = $('#poliklinik').val();
    var url = base_url+'admin/booking/getdata?keyword=' + search + "&start=" + start + "&limit=" + limit +"&tgl=" + tgl+"&ruang=" + ruang
    console.clear()
    console.log(url)
    $.ajax({
        url     : url,
        type    : "GET",
        dataType: "json",
        data    : {get_param : 'value'},
        beforeSend: function () {
            var tabel = "<tr id='loading'><td colspan='14'><b>Loading...</b></td></tr>";
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
                    tabel+="<td>"+res[i]['nomr']+"</td>";
                    tabel+="<td>"+res[i]['no_ktp']+"</td>";
                    tabel+="<td>"+res[i]['nama_pasien']+"</td>";
                    tabel+="<td>"+res[i]['tanggal_daftar']+"</td>";
                    tabel+="<td><b style='font-size:16pt'>"+res[i]['tanggal_kunjungan']+"</b></td>";
                    tabel+="<td><b style='font-size:16pt'>"+res[i]["label_antrian"]+"."+res[i]["nomor_daftar"]+"</b></td>";
                    tabel+="<td>"+res[i]['jam_kunjunganAntrian']+"</td>";
                    tabel+="<td>"+res[i]['nama_ruang']+"</td>";
                    tabel+="<td>"+res[i]['rujukan']+"</td>";
                    tabel+="<td>"+res[i]['cara_bayar']+"</td>";
                    tabel+="<td>"+res[i]['namaDokterJaga']+"</td>";
                    if(res[i]['status_berobat']=='Mendaftar') {
                        tabel+="<td><span class='btn btn-info btn-xs'>"+res[i]['status_berobat']+"</span></td>";
                        tabel+="<td style='text-align:right;'><div class='btn-group'><button onclick='hapus("+res[i]["idx"]+")' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Batal</button></div></td>";tabel+="</tr>";
                        
                    }
                    else if(res[i]['status_berobat']=='Checkin') {
                        tabel+="<td><span class='btn btn-success btn-xs'>"+res[i]['status_berobat']+"</span></td>";
                        tabel+="<td style='text-align:right;'><div class='btn-group'><button class='btn btn-warning btn-xs'><span class='fa fa-check'></span> Sudah Chekin</button></div></td>";tabel+="</tr>";
                    }else{
                        tabel+="<td><span class='btn btn-danger btn-xs'>"+res[i]['status_berobat']+"</span></td>";
                        tabel+="<td style='text-align:right;'><div class='btn-group'><button class='btn btn-success btn-xs' onclick='kembali("+res[i]["idx"]+")' ><span class='fa fa-check'></span> Kembalikan</button></div></td>";tabel+="</tr>";
                    }
                    
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

function hapus(id) {
    var isConfirm = confirm("Apakah anda yakin akan membatalkan ")
    if (isConfirm) {
        $.ajax({
            url: base_url + "admin/booking/batal/" + id,
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

function kembali(id) {
    var isConfirm = confirm("Apakah kunjungan ini tidak jadi dibatalkan")
    if (isConfirm) {
        $.ajax({
            url: base_url + "admin/booking/kembali/" + id,
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
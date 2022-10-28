function getKomentar(){
	var post_id = $('#post_id').val();
	var url = base_url + "utama/komentar/"+post_id;
	$.ajax({
        url : url,
        type: "GET",
        dataType: "json",
        data: {get_param : 'value'},
        success : function(data){
            //onsole.log(data["data"]);
            var media="";
            var jmlData=data.length;
            console.log(jmlData);
            for(var i=0;i<jmlData;i++){
            	media+='<div class="row">';
				media+='<div class="col-md-12 col-sm-12 col-xs-12 ">';
				media+='<div class="bubble">';
				media+='<div class="col-md-2 col-sm-2 col-xs-2"><img src="'+base_url+'images/bubbles-icon.png' +'"></div>';
				media+='<div class="col-md-10 col-sm-10 col-xs-10">';
				media+='<div class="bubble-content">';
				media+='<div class="point"></div>';
				media+='<div class="sidebar-title">'+data[i]["komentar_nama"]+'</div>';
				media+='<p>'+data[i]["komentar_isi"]+'</p>';
				media+='</div>';
				media+='</div>';
				media+='</div>';
				media+='</div>';
				media+='</div>';
             	
            }
            console.log(media);
            $('#komentar').html(media);
	    }
    });
}
function insertKomentar(){
	var formData = new FormData($('#form')[0]);
	var url = base_url + "utama/insertkomentar";
    $.ajax({
        url : url,
        type: "POST",
        data : formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(data)
        {
        	//$('#form').reset();
        	$('#email').val("");
        	$('#nama').val("");
        	$('#komentar_isi').val("");
        	getKomentar();
        },
        error: function (jqXHR, textStatus, errorThrown)
       {
            alert("Komentar Gagal Di Posting");
            //show_notif('Error','Error Saat Penyimpanan Data','danger');
        }
    });
}

function cari(){
	var q = $('#q').val();
	var url = base_url + "utama/list_berita/?q="+q;
	console.log(url);
	$.ajax({
        url : url,
        type: "GET",
        dataType: "json",
        data: {get_param : 'value'},
        success : function(data){
            //onsole.log(data["data"]);
            
            $('#content').html(data["data"]);
	    }
    });
}

function getMedia(start){
        var search=$('#qmedia').val();
        var dir=$('#dir_id').val();
        var url=base_url +"media/data?q="+search+"&start="+start+"&dir="+dir;
        console.log(url);
        var media="";
        var idx=0;
        $.ajax({
            url : url,
            type: "GET",
            dataType: "json",
            data: {get_param : 'value'},
            success : function(data){
                //onsole.log(data["data"]);

                if(dir<1){
                    var row    = data["data"];
                    var jmlData=row.length;
                    console.log(jmlData);
                    media+='<div class="col-md-2" style="text-align: center;">';
                    media+='<a href="#" onclick="show()">';
                    media+='<img src="'+base_url+'images/media/tambah.png">';
                    media+='</a>';
                    media+='</div>';
                    for(var i=0;i<jmlData;i++){
                        media+='<div class="col-md-2" style="text-align: center;">';
                        media+='<div style="text-align: right;">';
                        media+='<div class="btn-group">';
                        if(row[i]["dir_status"]==1){
                            media+='<button class="btn btn-success btn-xs">Aktif</button>';
                        }else{
                            media+='<button class="btn btn-danger btn-xs">Non Aktif</button>';
                        }
                        media+='<a href="#" class="btn btn-warning btn-xs" onclick="edit(\''+ row[i]["dir_id"] +'\')"><span class="fa fa-pencil"></span></a>';
                        media+='<a href="#" class="btn btn-danger btn-xs" onclick="remove(\''+ row[i]["dir_id"] +'\')"><span class="fa fa-remove"></span></a>';
                        media+='</div>'
                        media+='</div>'
                        media+='<a href="#" onclick="openDir(\''+ row[i]["dir_id"] +'\')">';
                        media+='<img src="'+base_url+'images/media/folder.png">'+row[i]["dir_nama"];
                        media+='</a>';
                        media+='</div>';
                    }
                    
                }else{
                    var row    = data["data"];
                    var jmlData=row.length;
                    console.log(jmlData);
                    var file="";
                    var ext="";
                    var jml=0;
                    var akhir=0;
                    for(var i=0;i<jmlData;i++){
                        file=row[i]["media_namafile"];
                        ext=file.split(".");
                        jml=ext.length;
                        akhir=jml-1;
                        console.log(ext);
                        console.log("Extent : " + ext[akhir])
                        console.log("AKHIR : " + akhir);
                        console.log("JUMLAH : " +jml);
                        media+='<div class="col-md-2" style="text-align: center;">';
                        if(ext[akhir]=="jpg"||ext[akhir]=="gif"||ext[akhir]=="png"){
                            media+='<img src="'+base_url+'images/media/thumb/thumb_'+row[i]["media_namafile"]+'"><button type="button" class="btn btn-default btn-xs btn-block">'+row[i]["media_keterangan"]+"</button>";
                        }else{
                            media+='<img src="'+base_url+'images/logo/'+ext[akhir]+'.png"><button type="button" class="btn btn-default btn-xs btn-block">'+row[i]["media_keterangan"]+"</button>";
                        }
                        media+='<div class ="btn-group"><button type="button" class="btn btn-primary btn-xs" onclick="edit(\''+row[i]["media_id"]+'\')">EDIT</button><button type="button" class="btn btn-danger btn-xs"  onclick="remove(\''+row[i]["media_id"]+'\')">DELETE</button></div>'
                        media+='</div>';
                        if(i>0&&i%6==5) media+='<div class="row"><br>&nbsp;</div>';
                    }
                    media+='<div class="col-md-2" style="text-align: center;">';
                    media+='<a href="#" onclick="show()">';
                    media+='<img src="'+base_url+'images/media/tambah.png">';
                    media+='</a>';
                    media+='</div>';
                    media+='<div class="col-md-2" style="text-align: center;">';
                    media+='<a href="#" onclick="openDir(0)"><img src="'+base_url+'images/media/back.png"></a>';
                    media+='</div>';
                }
                var page="";
                pagination_count=data["row_count"]/data["limit"];
                sisa=data["start"]%data["limit"];
                cur_idx=(data["start"]/data["limit"])+1;
                cur_idx=Math.ceil(cur_idx);
                prev=(cur_idx-2) * data["limit"];
                next=(cur_idx) * data["limit"];
                paging=Math.ceil(pagination_count);
                if(cur_idx<=2) {
                    min=0; 
                    max=3;
                }else {
                    min=cur_idx-2;
                    max=cur_idx+2;
                }
                for(i=0;i<paging;i++){
                    active='';
                    num=i+1;
                    if(i==0){
                        page+="<div class='btn-group'><a class='btn btn-success btn-sm' >Record Count : " + data["row_count"] + "</a><a  class='btn btn-default btn-sm' onclick='view(" + idx +")'>First</a></li>";
                        if(next<=data["row_count"]-sisa) 
                        page+="<a class='btn btn-default btn-sm' onclick='getMedia(" + next + ")'>Next</a>";
                        if(num==cur_idx) active="class='btn btn-success btn-sm'"; else active="class='btn btn-default btn-sm'";
                        page+="<a "+ active + " onclick='getMedia(" + idx + ")'>" + num + "</a></li>";  
                    }else if (i>0 && i<paging-1) {
                        if(num>=min && num<=max){
                            idx=data["limit"]*i;
                            if(num==cur_idx) active="class='btn btn-success btn-sm'"; else active="class='btn btn-default btn-sm'";
                            page+="<a "+ active + " onclick='getMedia(" + idx + ")'>" + num + "</a>";
                        }
                    }else{
                        idx=data["limit"]*i;
                        if(num==cur_idx) active="class='btn btn-success btn-sm'"; else active="class='btn btn-default btn-sm'";
                        page=page +"<a "+ active + " onclick='getMedia(" + idx + ")'>" + num +"</a>"; 
                        if(prev>=0) page+="<a class='btn btn-default btn-sm' onclick='getMedia(" + prev  + ")'>Prev</a>";
                        page+="<a class='btn btn-default btn-sm' onclick='getMedia(" +idx + ")'>Last</a></nav>";
                    }
                    if(idx==cur_idx) active="class='btn btn-success btn-sm'"; else active="class='btn btn-default btn-sm'";
                }
                if(data["row_count"]<=data["limit"]) page="";

                $('#media').html(media);
                console.log(page);
                $('#halaman').html(page);
            }
        });
        
    }
    function openDir(id){
        $('#dir_id').val(id);
        $('#qmedia').val("");
        getMedia();
    }
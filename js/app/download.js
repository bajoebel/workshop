getMedia_download(0);
function getMedia_download(start){
    console.clear();
    //alert(start);
        var search=$('#qmedia').val();
        var dir=$('#dir_id').val();
        var url=base_url +"welcome/data_download?q="+search+"&start="+start+"&dir="+dir;
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
                    media+='<div class="row">';
                    for(var i=0;i<jmlData;i++){
                        
                        media+='<div class="col-md-2" style="text-align: center;">';
                        media+='<a href="#" onclick="openDir_download(\''+ row[i]["dir_id"] +'\')">';
                        media+='<img src="'+base_url+'rsud-backend/public/img/media/folder.png">'+row[i]["dir_nama"];
                        media+='</a>';
                        media+='</div>';
                        //media+='</div>';
                    }
                    media+='</div>';
                }else{
                    var row    = data["data"];
                    var jmlData=row.length;
                    console.log(jmlData);
                    var file="";
                    var ext="";
                    var jml=0;
                    console.log(row);

                    var akhir=0;
                    media+='<table class="table table-bordered">';
                    media+='<tr>';
                    media+='<th>No</th>';
                    media+='<th>FILE</th>';
                    media+='<th style="text-align:right">UNDUH</th>';
                    media+='</tr>';
                    var no=0;
                    for(var i=0;i<jmlData;i++){
                        start++;
                        console.log("DATA KE "+no+" : ");
                        console.log(row[i]);
                        media+='<tr>';
                        media+='<th>'+start+'</th>';
                        media+='<th>'+row[i]["media_keterangan"]+'</th>';
                        media+='<th style="text-align:right"><a href="'+base_url+'images/media/original/'+row[i]["media_namafile"]+'" class="btn btn-success btn-sm">Download</a></th>';
                        media+='</tr>';
                    }
                    media+='<tr>';
                    media+='<td colspan="3">';
                    media+='<div class="col-md-6" style="text-align: right;">';
                    media+='<div id=""></div>';
                    media+='</div>';
                    media+='<div class="col-md-6" style="text-align: right;">';
                    media+='<a href="#" onclick="openDir_download(0)" class="btn btn-info btn-sm">Kembali</a>';
                    media+='</div>';
                    media+='</td>';
                    
                    media+='</tr>';
                    media+='</table>';
                    /*for(var i=0;i<jmlData;i++){
                        file=row[i]["media_namafile"];
                        ext=file.split(".");
                        jml=ext.length;
                        akhir=jml-1;
                        media+='<div class="row">'
                        media+='<div class="col-md-2" style="text-align: center;">';
                        if(ext[akhir]=="jpg"||ext[akhir]=="gif"||ext[akhir]=="png"){
                            media+='<img src="'+base_url+'images/media/thumb/thumb_'+row[i]["media_namafile"]+'"><button type="button" class="btn btn-default btn-xs btn-block">'+row[i]["media_keterangan"]+"</button>";
                        }else{
                            media+='<img src="'+base_url+'images/logo/'+ext[akhir]+'.png"><button type="button" class="btn btn-default btn-xs btn-block">'+row[i]["media_keterangan"]+"</button>";
                        }
                        media+='</div>';
                        media+='</div>';
                        if(i>0&&i%6==5) media+='<div class="row"><br>&nbsp;</div>';
                    }
                    
                    media+='<div class="col-md-2" style="text-align: center;">';
                    media+='<a href="#" onclick="openDir_download(0)"><img src="'+base_url+'images/media/back.png"></a>';
                    media+='</div>';*/
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
                        page+="<a class='btn btn-default btn-sm' onclick='getMedia_download(" + next + ")'>Next</a>";
                        if(num==cur_idx) active="class='btn btn-success btn-sm'"; else active="class='btn btn-default btn-sm'";
                        page+="<a "+ active + " onclick='getMedia_download(" + idx + ")'>" + num + "</a></li>";  
                    }else if (i>0 && i<paging-1) {
                        if(num>=min && num<=max){
                            idx=data["limit"]*i;
                            if(num==cur_idx) active="class='btn btn-success btn-sm'"; else active="class='btn btn-default btn-sm'";
                            page+="<a "+ active + " onclick='getMedia_download(" + idx + ")'>" + num + "</a>";
                        }
                    }else{
                        idx=data["limit"]*i;
                        if(num==cur_idx) active="class='btn btn-success btn-sm'"; else active="class='btn btn-default btn-sm'";
                        page=page +"<a "+ active + " onclick='getMedia_download(" + idx + ")'>" + num +"</a>"; 
                        if(prev>=0) page+="<a class='btn btn-default btn-sm' onclick='getMedia_download(" + prev  + ")'>Prev</a>";
                        page+="<a class='btn btn-default btn-sm' onclick='getMedia_download(" +idx + ")'>Last</a></nav>";
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
    function openDir_download(id){
        $('#dir_id').val(id);
        $('#qmedia').val("");
        getMedia_download(0);
    }
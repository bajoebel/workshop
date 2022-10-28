<?php

function getData(
    $config = array(
        'function'      => 'getData',
        'url'           => 'controller/function/',
        'param'         => '',
        'field'         => array('field1', 'field2'),
        'variable'      => array('idx' => 'idx'),
        'start'         => 1,
        'limit'         => 10,
        'row_count'     => 10,
        'keyword_id'    => 'q',
        'limit_id'      => 'limit',
        'data_id'       => 'data',
        'page_id'       => 'pagination',
        'jquery'        => 'assets/bower_components/jquery/dist/jquery.js',
        'number'        => true,
        'action'        => true,
        'load'          => true,
        'action_button' => ''
    )
) {
    
    //Buat Header
    $colspan = count($config["field"]);
    if ($config["number"] == true) $colspan++;
    if ($config["action"] == true) $colspan++;
    $html = '';
    $html .= '
    function ' . $config["function"] . '(start){';
    $html .= "
        $('#start').val(start);";
    $html .= "
        var search = $('#" . $config["keyword_id"] . "').val();";
    $html .= "
        var limit = $('#" . $config["limit_id"] . "').val();";
    if(is_array($config["param_id"])){
        $param="";
        foreach ($config["param_id"] as $key => $value) {
            $html .= "
            var $key = $('#" . $value . "').val();";
            $param.= "+\"&$key=\" + $key";
        }
    }else{
        $html .= "
        var param = $('#" . $config["param_id"] . "').val();";
        $param="+\"&param=\" + param";
    }
    //$parameter="";
    //if(!empty($param)) $parameter.="+".$param;
    
    $html .= "
        var url = '" . base_url() . $config["url"] . "?keyword=' + search + \"&start=\" + start + \"&limit=\" + limit ".$param;
    $html .= "
        console.clear()";
    $html .= "
        console.log(url)";
    $html .= "
        $.ajax({
            url     : url,
            type    : \"GET\",
            dataType: \"json\",
            data    : {get_param : 'value'},
            beforeSend: function () {
                var tabel = \"<tr id='loading'><td colspan='" . $colspan . "'><b>Loading...</b></td></tr>\";
                $('#" . $config["data_id"] . "').html(tabel);
                $('#" . $config["page_id"] . "').html('');
            },";
    $html .= "
            success : function(data){
            //menghitung jumlah data
            console.log(data);
        if(data[\"status\"]==true){
            $('#" . $config["data_id"] . "').html('');
            var res    = data[\"data\"];
            console.log(res);
            var jmlData=res.length;
            var limit   = data[\"limit\"];
            var tabel   = \"\";
            //Create Tabel
            var no = (parseInt(start)*parseInt(limit))-parseInt(limit);
            var dari = no+1;
            var sampai = no+parseInt(limit);
            var desc = \"<button class='btn btn-default btn-sm' type='button'>Showing \"+ dari + \" To \" + sampai + \" of \" +data[\"row_count\"]+\"</button>\";
            for(var i=0; i<jmlData;i++){
                no++;
                tabel=\"<tr>\";";
    if ($config["number"] == true) $html .= "tabel+=\"<td>\"+no+\"</td>\";";
    $field = $config["field"];
    //$field = array('as', 'as');
    $jmldata = count($field);
    for ($i = 0; $i < $jmldata; $i++) {
        $exp = explode('{{', $field[$i]);
        $f = '';
        if (count($exp) > 1) {
            $f = $field[$i];
            $no = 0;
            foreach ($config["variable"] as $var => $val) {
                $no++;
                if ($no == 1) {
                    if (substr($f, 0, 1) == "=") $f = str_replace('{{' . $var . '}}', 'res[i]["' . $val . '"]', $f);
                    else $f = str_replace('{{' . $var . '}}', '+res[i]["' . $val . '"]+"', $f);
                }
                else {
                    if (substr($f, 0, 1) == "=") $f = $f = str_replace('{{' . $var . '}}', 'res[i]["' . $val . '"]', $f);
                    else $f = $f = str_replace('{{' . $var . '}}', '"+res[i]["' . $val . '"]+"', $f);
                }
                
            }
        } else {
            $f = "\"+res[i]['" . $field[$i] . "']+\"";
        }
        if (substr($f, 0, 1) == "=") {
            $f = str_replace("=","",$f);
            $html.= "tabel+=\"<td>\"+" . $f . "+\"</td>\";";
        }else{
            $html .= "
        tabel+=\"<td>" . $f . "</td>\";";
        }
        
    }
    if ($config['action'] == true) {
        $exp = explode('{{', $config["action_button"]);
        if (count($exp) > 1) {
            $no = 0;
            $ab = $config["action_button"];
            foreach ($config["variable"] as $var => $val) {
                $no++;
                $ab = $ab = str_replace('{{' . $var . '}}', '"+res[i]["' . $val . '"]+"', $ab);
            }
            //echo $ab;
        }else{
            $ab = $config["action_button"];
        }
        $html .= "
        tabel+=\"<td style='text-align:right;'>" . $ab . "</td>\";";
    }
    $html .= "tabel+=\"</tr>\";
                $('#" . $config["data_id"] . "').append(tabel);
            }
            console.log(data);
            //Create Pagination
            if(data[\"row_count\"]<=limit){
                $('#" . $config["page_id"] . "').html(\"\");
            }else{
                console.log(\"buat Pagination\");
                var pagination=\"\";
                var btnIdx=\"\";
                jmlPage = Math.ceil(data[\"row_count\"]/limit);
                offset  = data[\"start\"] % limit;
                /*curIdx  = Math.ceil((data[\"start\"]/data[\"limit\"])+1);
                prev    = (curIdx-2) * data[\"limit\"];
                next    = (curIdx) * data[\"limit\"];*/
    
                
                //var curSt=(curIdx*data[\"limit\"])-jmlData;
                //var mulai = start;
                var curIdx = start;
                var btn=\"btn-default\";
                //var lastSt=jmlPage;
                var btnFirst=\"<button class='btn btn-default btn-sm' onclick='" . $config['function'] . "(1)'><span class='fa fa-angle-double-left'></span></button>\";
                if (curIdx > 1) {
                    var prevSt=curIdx-1;
                    btnFirst+=\"<button class='btn btn-default btn-sm' onclick='" . $config['function'] . "(\"+prevSt+\")'><span class='fa fa-angle-left'></span></button>\";
                }
    
                var btnLast=\"\";
                if(curIdx<jmlPage){
                    var nextSt=curIdx+1;
                    btnLast+=\"<button class='btn btn-default btn-sm' onclick='" . $config['function'] . "(\"+nextSt+\")'><span class='fa fa-angle-right'></span></button>\";
                }
                console.log(curIdx);
                btnLast+=\"<button class='btn btn-default btn-sm' onclick='" . $config['function'] . "(\"+jmlPage+\")'><span class='fa fa-angle-double-right'></span></button>\";
                
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
                        if(curIdx==j)  btn=\"btn-primary\"; else btn= \"btn-default\";
                        btnIdx+=\"<button class='btn \" +btn +\" btn-sm' onclick='" . $config['function'] . "(\"+ j +\")'>\" + j +\"</button>\";
                    }
                }else{
    
                    for (var j = 1; j<=jmlPage; j++) {
                        if(curIdx==j)  btn=\"btn-primary\"; else btn= \"btn-default\";
                        btnIdx+=\"<button class='btn \" +btn +\" btn-sm' onclick='" . $config['function'] . "(\"+ j +\")'>\" + j +\"</button>\";
                    }
                }
                pagination+=\"<div class='tabel-box'><div class='btn-group'>\"+desc+btnFirst + btnIdx + btnLast+\"</div></div>\";
                $('#" . $config["page_id"] . "').html(pagination);
            }
        }
    },
    error: function(xhr) { // if error occured
        alert(\"Error occured.please try again\");
        $('#data').append(xhr.statusText + xhr.responseText);
        // $(placeholder).removeClass('loading');
    },
    complete : function(){
        //$('#loading').hide();
    }";
    $html .= "});";
    $html .= '}';
    if ($config["load"] == 1) $html .= $config['function'] . "(1)";
    return $html;
    //Buat Body

}

function encrypt_decrypt($action, $string, $output = false)
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'a4a072432557901f24bcca133d1410256f0fab06';
    $secret_id = '000001';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_id), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function validemail($email){
    $cek1=explode('@',$email);
    if(count($cek1)>1){
        $cek2=explode('.',$cek1[1]);
        if(count($cek2)>1) return true;
        else return false;
    }else{
        return false;
    }
}
function validtelp($notelp){
    $panjang=strlen($notelp);
    if($panjang<8 || $panjang>13){
        
    }
}
function getAkses($link,$level)
{
    $CI = &get_instance();
    $CI->db->where('link_menu', $link);
    $CI->db->where('a.idx_level', $level);
    $CI->db->join('stx_modul b','a.idx_modul=b.idx');
    return $CI->db->get('stx_hakakses a')->row();
}
function instansi(){
    return "RSUD Kota Padang Panjang";
}
function waktuPelayanan(){
    return "Senin - Sabtu, 07:30 Wib Sampai 16:00 Wib (IGD Setiap Hari 24 Jam)";
}
function noTelp(){
    return "(0811)-6661-414 (Pengaduan)";
}
function emergency(){
    return "(0811) 6667118 (IGD)";
}
function getEmail(){
    return "rsud.pp@padangpanjang.go.id ";
}
function getAlamat(){
    return "Jl. Tabek Gadang Kel.Ganting";
}
function getMedsos(){
    $data=array(
        'facebook'  => 'https://www.facebook.com/',
        'twiter'  => 'https://www.twiter.com/',
        'gplus'  => 'https://www.google.com/',
        'instagram'=>'https://www.instagram.com/'
    );
    return $data;
}
function getInfo(){
    return "RSUD Kota Padang Panjang adalah ...";
}


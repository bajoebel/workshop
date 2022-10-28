<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Online_model extends CI_Model
{
    function http_request($data, $url,$token="",$method="POST")
    {
        //echo $token; exit;
        //$data = array("name" => "Hagrid", "age" => "36");                                                                    
        $data_string = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(empty($token)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            ));
        }else{
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'X-Token: ' .$token
            ));
        }
        
        $result = curl_exec($ch);
        return $result;
    }

    function getDokter($idruang,$tgl){
        $tgl=longDate($tgl);
        $hari=$tgl['hari'];
        $this->db->select("b.NRP,b.pgwNama,b.pgwJenkel,b.foto,a.group,a.jadwal_poly_id");
        $this->db->where('a.jadwal_hari',$hari);
        $this->db->where('a.jadwal_poly_id',$idruang);
        $this->db->join('tbl01_pegawai b','a.jadwal_dokter_id=b.NRP');
        return $this->db->get('tbl02_jadwal_dokter a')->result();
    }
    function getBatch($group){
        // $sekarang = date('Y-m-d H:i:s');
        // $jam=date('H')*60+date('m')-60;
        // // echo $sekarang;
        // $this->db->where("((SUBSTR(jam,1,2) * 60)+(SUBSTR(jam,4,2)*1)) > ",$jam);
        $this->db->where('groupid',$group);
        return $this->db->get('tb02_config_batch')->result();
    }
    function getTersedia($label,$poly,$dokter,$tgl_kunjungan,$token){
        $param=array(
            'tgl_kunjungan'=>$tgl_kunjungan,
            'label_antrian'=>$label,
            'id_ruang'=>$poly,
            'dokterJaga'=>$dokter
        );
        // print_r($token);
        // print_r($param);
        $request=array(
            'param'=>$param
        );
        $response=$this->http_request($request,SMART_CALL_BACK ."sim/pendaftaran/jmlantrian",$token,"POST");
        // echo $response;exit;
        return $response;
    }
    function getConfig(){
        return $this->db->get('stx_pengaturan')->row();
    }
    function getPertanyaan(){
        return $this->db->get('stx_pertanyaan_kajian_covid')->result();
    }
}
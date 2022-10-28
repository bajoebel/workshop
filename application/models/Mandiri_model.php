<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mandiri_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
    function cekPasien($nomr){
        // $x_token=$this->session->userdata('token');
        // if(empty($token)){
        //     $param=array(
        //         'client'=>SMART_ID,
        //         'key'=> SMART_KEY
        //     );
        //     $response = $this->Smart_model->http_request($param,SMART_CALL_BACK ."sim/auth/gettoken");
        //     $token=json_decode($response);
        //     $x_token = $token->response->token;
        //     $this->session->set_userdata(array('token'=>$x_token));
        // }
        $this->db->where('nomr',$nomr);
        return $this->db->get('tbl01_pasien')->row();
    }

    function getRujukan(){
        $this->db->where_in('id_faskes',array(0,1,2,3));
        return $this->db->get('tbl01_rujukan')->result();
    }
    function getRuang(){
        $this->db->where('grid',1);
        $this->db->where('status_ruang',1);
        $this->db->where('status_daftar_mandiri',1);
        return $this->db->get('tbl01_ruang')->result();
    }
    function getDokter($idruang){
        $sekarang=date('Y-m-d');
        $tgl=longDate($sekarang);
        $hari=$tgl['hari'];
        $date = new DateTime($sekarang);
        $week = $date->format("W");
        if($week%2==0) $periode=2; else $periode=1;
        $this->db->select("b.NRP,b.pgwNama,b.pgwJenkel,b.foto,a.group,a.jadwal_poly_id");
        $this->db->where('a.jadwal_hari',$hari);
        $this->db->where('a.jadwal_poly_id',$idruang);
        $this->db->where_in('jadwal_pekan',array(0,$periode));
        $this->db->join('tbl01_pegawai b','a.jadwal_dokter_id=b.NRP');
        return $this->db->get('tbl02_jadwal_dokter a')->result();
    }
    function getBatch($group){
        $sekarang = date('Y-m-d H:i:s');
        $jam=date('H')*60+date('m')-60;
        // echo $sekarang;
        $this->db->where("((SUBSTR(jam,1,2) * 60)+(SUBSTR(jam,4,2)*1)) > ",$jam);
        $this->db->where('groupid',$group);
        return $this->db->get('tb02_config_batch')->result();
    }
    function getTersedia($label,$poly,$dokter){
        $this->db->where("tgl_kunjungan",date('Y-m-d'));
        $this->db->where("label_antrian",$label);
        $this->db->where("ruangid",$poly);
        $this->db->where("nrpdokter",$dokter);
        return $this->db->get("tbl02_antrianv2")->num_rows();
    }
    function getCaraBayar($asuransi){
        $this->db->where('jkn',$asuransi);
        $res=$this->db->get('tbl01_cara_bayar');
        $jml=$res->num_rows();
        if($jml>1) $data=$res->result();
        else $data=$res->row();
        return array('jml'=>$jml,'carabayar'=>$data);
    }
    function cekPj($nomr){
        $this->db->where('nomr',$nomr);
        $this->db->order_by('idx','desc');
        return $this->db->get('tbl01_penanggung_jawab')->row();
    }
    function cekKunjungan($nomr,$tgl_kunjungan,$id_ruang,$jkn){
        if($jkn==1){
            $this->db->where('id_cara_bayar',2);
        }else{
            $this->db->where('id_ruang',$id_ruang);
        }
        $this->db->where('nomr',$nomr);
        $this->db->where("DATE_FORMAT(tgl_masuk,'%Y-%m-%d')",$tgl_kunjungan);
        $this->db->group_start();
        $this->db->where('jns_layanan','RJ');
        $this->db->or_where('jns_layanan','GD');
        $this->db->group_end();
        return $this->db->get('tbl02_pendaftaran')->num_rows();
    }
    function cekPendaftaran($nomr,$tgl_kunjungan,$id_ruang,$jkn){
        if($jkn==1){
            $this->db->where('id_cara_bayar',2);
        }else{
            $this->db->where('id_ruang',$id_ruang);
        }
        $this->db->where('nomr',$nomr);
        $this->db->where("DATE_FORMAT(tgl_masuk,'%Y-%m-%d')",$tgl_kunjungan);
        $this->db->group_start();
        $this->db->where('jns_layanan','RJ');
        $this->db->or_where('jns_layanan','GD');
        $this->db->group_end();
        return $this->db->get('tbl02_pendaftaran_atm')->num_rows();
    }
    function insertPendaftaran($data){
        $this->db->insert('tbl02_pendaftaran_atm',$data);
        return $this->db->insert_id();
    }
    function createAntrian($tgl,$label_antrian,$ruang,$dokter,$quota_antrian){
        $this->db->where('tgl_kunjungan',$tgl);
        $this->db->where('label_antrian',$label_antrian);
        $this->db->where('ruangid',$ruang);
        $this->db->where('nrpdokter',$dokter);
        $this->db->order_by('nomor_antrian','DESC');
        $this->db->limit(1);
        $antrian=$this->db->get('tbl02_antrianv2')->row();
        if(empty($antrian)){
            return 1;
        }else{
            $nomor=$antrian->nomor_antrian;
            if($nomor<$quota_antrian){
                //JIka nomor  kecil quota
                $nomor++;
                return $nomor;
            }else{
                // jika quota Penuh
                return false;
            }
            
        }
    }
    function initCURL($url){
        $result = $this->getResult();
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array($result));
        $json_response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);
        if (!empty($error_msg)) {
            $error = array('metaData' => array('code' => 201, 'message' => $error_msg));
            $json_response = json_encode($error);
        }
        return $json_response;
    }

    function getResult(){
        $data = CONS_ID_VC;
        $tStamp = $this->getTimestamp();
        $encodedSignature = $this->getSignature();
        $result = "";
        $result .= "X-cons-id: " . $data . "\r\n";
        $result .= "X-timestamp: " . $tStamp . "\r\n";
        $result .= "X-signature: " . $encodedSignature;
        return $result;
    }
    function getTimestamp(){
        $scretId = CONS_ID_VC;
        $scretKey =SECREET_ID_VC;
        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        return $tStamp;
    }

    function getSignature(){
        $scretId = CONS_ID_VC;
        $scretKey = SECREET_ID_VC;
        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $scretId . "&" . $tStamp, $scretKey, true);
        $encodedSignature = base64_encode($signature);
        return $encodedSignature;
    }
    function getPesertaByKartuBPJS($nokartu, $tglpelayanan){
        $tglSEP = date("Y-M-d", strtotime($tglpelayanan));
        $url = HOST_VC . "Peserta/nokartu/$nokartu/tglSEP/$tglSEP";
        echo $this->initCURL($url);
    }

    function listrujukanfaskes1($nokartu){
        $url = HOST_VC . "Rujukan/List/Peserta/$nokartu";
        return $this->initCURL($url);
    }
    function listrujukanfaskes2($nokartu)
    {
        $url = HOST_VC . "Rujukan/RS/List/Peserta/$nokartu";
        return $this->initCURL($url);
    }
    function getPoliByKodeBpjs($kode){
        $this->db->where('kodejkn',$kode);
        return $this->db->get('tbl01_ruang')->row();
    }
    function getPerujuk($kode){
        $this->db->where('idx',$kode);
        return $this->db->get('tbl01_pengirim')->row();
    }
}
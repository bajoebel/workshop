<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bed_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q=""){
        $this->db->select(" a.`map_id`,a.`map_ruangid`,b.`ruang_perawatan`,a.`map_kelasid`,c.`kelas_nama`,a.`map_kamarid`,d.`grNama`,
        SUM(a.`map_kapasitas`) as map_kapasitas,SUM(a.`map_isipr`) as map_isipr,SUM(a.`map_isilk`) as map_isilk,a.`map_penempatan`,SUM(a.`map_waiting`) as map_waiting,a.`map_tglupdate`,a.`map_userupdate`");
        $this->db->join("tb_ruang_perawatan b",'a.`map_ruangid`=b.`ruang_id`');
        $this->db->join("tb_kelas c","a.`map_kelasid`=c.`kelas_id`");
        $this->db->join("group_ruang d","a.`map_kamarid` = d.`grId`");
        $this->db->group_start();
        $this->db->like('ruang_perawatan',$q);
        $this->db->or_like('kelas_nama',$q);
        $this->db->or_like('grNama',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->group_by("a.`map_kamarid`,a.map_kelasid");
        $this->db->order_by('a.`map_kamarid`,a.map_kelasid');
        return $this->db->get('tb_ketersediaan a')->result();
    }
    function countData($q=""){
        $this->db->select("a.`map_id`,a.`map_ruangid`,b.`ruang_perawatan`,
        a.`map_kelasid`,c.`kelas_nama`,a.`map_kamarid`,d.`grNama`,a.`map_kapasitas`,
        a.`map_isipr`,a.`map_isilk`,a.`map_penempatan`,a.`map_waiting`,a.`map_tglupdate`,a.`map_userupdate`");
        $this->db->join("tb_ruang_perawatan b",'a.`map_ruangid`=b.`ruang_id`');
        $this->db->join("tb_kelas c","a.`map_kelasid`=c.`kelas_id`");
        $this->db->join("group_ruang d","a.`map_kamarid` = d.`grId`");
        $this->db->group_start();
        $this->db->like('ruang_perawatan',$q);
        $this->db->or_like('kelas_nama',$q);
        $this->db->or_like('grNama',$q);
        $this->db->group_end();
        $this->db->group_by("a.`map_kamarid`,a.map_kelasid");
        return $this->db->get('tb_ketersediaan a')->num_rows();
    }
    function getRuang(){
        $this->db->where('grStatus',1);
        return $this->db->get('group_ruang')->result();
    }
    function getKelas(){
        $this->db->where('kelas_status',1);
        return $this->db->get('tb_kelas')->result();
    }
    function getDataByid($idx){
        $this->db->where('idx',$idx);
        return $this->db->get('tb_ketersediaan')->row();
    }
    // function simpanData($data){
    //     $this->db->insert('tb_ketersediaan',$data);
    //     return $this->db->insert_id();
    // }
    
    function batalDaftar($idx){
        $data=array('status_berobat'=>'Batal');
        $this->db->where('idx',$idx);
        $this->db->update('tb_ketersediaan',$data);
    }

    function kembaliDaftar($idx){
        $data=array('status_berobat'=>'Mendaftar');
        $this->db->where('idx',$idx);
        $this->db->update('tb_ketersediaan',$data);
    }
}
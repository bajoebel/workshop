<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hakakses_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('level',$q);
        $this->db->or_like('aktif',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('idx','desc');
        return $this->db->get('stx_level a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('level',$q);
        $this->db->or_like('aktif',$q);
        $this->db->group_end();
        return $this->db->get('stx_level a')->num_rows();
    }
    function getDataByid($idx){
        $this->db->where('idx',$idx);
        return $this->db->get('stx_level')->row();
    }
    function simpanData($data){
        $this->db->insert('stx_level',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$idx){
        $this->db->where('idx',$idx);
        $this->db->update('stx_level',$data);
    }

    function hapusData($idx){
        $this->db->where('idx',$idx);
        $this->db->delete('stx_level');
    }
    function getModul(){
        $this->db->where('aktif',1);
        return $this->db->get('stx_modul')->result();
    }
    function getHakakses($idx){
        $this->db->select("GROUP_CONCAT(idx_modul) AS modul");
        $this->db->where('idx_level',$idx);
        $data= $this->db->get("stx_hakakses")->row();
        if(!empty($data)) return explode(',',$data->modul);
        else return array();
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Spesialis_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('spesialis_nama',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('spesialis_id','desc');
        return $this->db->get('stx_spesialis a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('spesialis_nama',$q);
        $this->db->group_end();
        return $this->db->get('stx_spesialis a')->num_rows();
    }
    function getDataByid($spesialis_id){
        $this->db->where('spesialis_id',$spesialis_id);
        return $this->db->get('stx_spesialis')->row();
    }
    function simpanData($data){
        $this->db->insert('stx_spesialis',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$spesialis_id){
        $this->db->where('spesialis_id',$spesialis_id);
        $this->db->update('stx_spesialis',$data);
    }
    function hapusData($spesialis_id){
        $this->db->where('spesialis_id',$spesialis_id);
        $this->db->delete('stx_spesialis');
    }
}
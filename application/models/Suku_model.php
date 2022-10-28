<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Suku_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('suku_nama',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('suku_id','desc');
        return $this->db->get('m_suku a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('suku_nama',$q);
        $this->db->group_end();
        return $this->db->get('m_suku a')->num_rows();
    }
    function getDataByid($suku_id){
        $this->db->where('suku_id',$suku_id);
        return $this->db->get('m_suku')->row();
    }
    function simpanData($data){
        $this->db->insert('m_suku',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$suku_id){
        $this->db->where('suku_id',$suku_id);
        $this->db->update('m_suku',$data);
    }
    function hapusData($suku_id){
        $this->db->where('suku_id',$suku_id);
        $this->db->delete('m_suku');
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bahasa_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('bahasa_nama',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('bahasa_id','desc');
        return $this->db->get('m_bahasa a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('bahasa_nama',$q);
        $this->db->group_end();
        return $this->db->get('m_bahasa a')->num_rows();
    }
    function getDataByid($bahasa_id){
        $this->db->where('bahasa_id',$bahasa_id);
        return $this->db->get('m_bahasa')->row();
    }
    function simpanData($data){
        $this->db->insert('m_bahasa',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$bahasa_id){
        $this->db->where('bahasa_id',$bahasa_id);
        $this->db->update('m_bahasa',$data);
    }
    function hapusData($bahasa_id){
        $this->db->where('bahasa_id',$bahasa_id);
        $this->db->delete('m_bahasa');
    }
}
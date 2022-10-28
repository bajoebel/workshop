<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Status_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('status',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('Id','desc');
        return $this->db->get('m_status_kawin a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('status',$q);
        $this->db->group_end();
        return $this->db->get('m_status_kawin a')->num_rows();
    }
    function getDataByid($Id){
        $this->db->where('Id',$Id);
        return $this->db->get('m_status_kawin')->row();
    }
    function simpanData($data){
        $this->db->insert('m_status_kawin',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$Id){
        $this->db->where('Id',$Id);
        $this->db->update('m_status_kawin',$data);
    }
    function hapusData($Id){
        $this->db->where('Id',$Id);
        $this->db->delete('m_status_kawin');
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pekerjaan_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.pekerjaan_idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('pekerjaan_nama',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('pekerjaan_id','desc');
        return $this->db->get('m_pekerjaan a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('pekerjaan_nama',$q);
        $this->db->group_end();
        return $this->db->get('m_pekerjaan a')->num_rows();
    }
    function getDataByid($pekerjaan_id){
        $this->db->where('pekerjaan_id',$pekerjaan_id);
        return $this->db->get('m_pekerjaan')->row();
    }
    function simpanData($data){
        $this->db->insert('m_pekerjaan',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$pekerjaan_id){
        $this->db->where('pekerjaan_id',$pekerjaan_id);
        $this->db->update('m_pekerjaan',$data);
    }
    function hapusData($pekerjaan_id){
        $this->db->where('pekerjaan_id',$pekerjaan_id);
        $this->db->delete('m_pekerjaan');
    }
}
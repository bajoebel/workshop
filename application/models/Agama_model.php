<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Agama_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.id_agama');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('agama',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('id_agama','desc');
        return $this->db->get('stx_agama a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('agama',$q);
        $this->db->group_end();
        return $this->db->get('stx_agama a')->num_rows();
    }
    function getDataByid($id_agama){
        $this->db->where('id_agama',$id_agama);
        return $this->db->get('stx_agama')->row();
    }
    function simpanData($data){
        $this->db->insert('stx_agama',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$id_agama){
        $this->db->where('id_agama',$id_agama);
        $this->db->update('stx_agama',$data);
    }
    function hapusData($id_agama){
        $this->db->where('id_agama',$id_agama);
        $this->db->delete('stx_agama');
    }
}
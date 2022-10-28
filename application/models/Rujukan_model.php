<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rujukan_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('rujukan',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('id_rujukan','desc');
        return $this->db->get('stx_rujukan a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('rujukan',$q);
        $this->db->group_end();
        return $this->db->get('stx_rujukan a')->num_rows();
    }
    function getDataByid($id_rujukan){
        $this->db->where('id_rujukan',$id_rujukan);
        return $this->db->get('stx_rujukan')->row();
    }
    function simpanData($data){
        $this->db->insert('stx_rujukan',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$id_rujukan){
        $this->db->where('id_rujukan',$id_rujukan);
        $this->db->update('stx_rujukan',$data);
    }
    function hapusData($id_rujukan){
        $this->db->where('id_rujukan',$id_rujukan);
        $this->db->delete('stx_rujukan');
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Negara_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('nama_negara',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('id_negara','desc');
        return $this->db->get('stx_negara a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('nama_negara',$q);
        $this->db->group_end();
        return $this->db->get('stx_negara a')->num_rows();
    }
    function getDataByid($id_negara){
        $this->db->where('id_negara',$id_negara);
        return $this->db->get('stx_negara')->row();
    }
    function simpanData($data){
        $this->db->insert('stx_negara',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$id_negara){
        $this->db->where('id_negara',$id_negara);
        $this->db->update('stx_negara',$data);
    }
    function hapusData($id_negara){
        $this->db->where('id_negara',$id_negara);
        $this->db->delete('stx_negara');
    }
}
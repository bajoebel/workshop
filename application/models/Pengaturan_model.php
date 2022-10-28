<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getSet(){
        
        return $this->db->get('stx_pengaturan a')->row();
    }
    
    function simpanData($data){
        $this->db->insert('stx_pengaturan',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$set_id){
        $this->db->where('set_id',$set_id);
        $this->db->update('stx_pengaturan',$data);
    }
    function getDataByid($kategori_id){
        $this->db->where('set_id',$kategori_id);
        return $this->db->get('stx_pengaturan')->row();
    }
}
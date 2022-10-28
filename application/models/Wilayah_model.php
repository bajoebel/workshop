<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wilayah_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('provinsi',$q);
        $this->db->or_like('kabkota',$q);
        $this->db->or_like('nama_kabkota',$q);
        $this->db->or_like('kecamatan',$q);
        $this->db->or_like('desa',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('wilayah_id','desc');
        return $this->db->get('m_wilayah a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('provinsi',$q);
        $this->db->or_like('kabkota',$q);
        $this->db->or_like('nama_kabkota',$q);
        $this->db->or_like('kecamatan',$q);
        $this->db->or_like('desa',$q);
        $this->db->group_end();
        return $this->db->get('m_wilayah a')->num_rows();
    }
    function getDataByid($wilayah_id){
        $this->db->where('wilayah_id',$wilayah_id);
        return $this->db->get('m_wilayah')->row();
    }
    function simpanData($data){
        $this->db->insert('m_wilayah',$data);
        // return $this->db->insert_id();
    }
    function updateData($data,$wilayah_id){
        $this->db->where('wilayah_id',$wilayah_id);
        $this->db->update('m_wilayah',$data);
    }
    function hapusData($wilayah_id){
        $this->db->where('wilayah_id',$wilayah_id);
        $this->db->delete('m_wilayah');
    }
    function createId(){
        $this->db->select("wilayah_id");
        $this->db->order_by('wilayah_id','desc');
        $cek=$this->db->get('m_wilayah');
        if($cek->num_rows() <= 0){
            $id="00000";
        }else{
            $data=$cek->row();
            $new_id=intval($data->wilayah_id)+1;
            $id=str_pad($new_id,5,"0",STR_PAD_LEFT);
        }
        return $id;
    }
}
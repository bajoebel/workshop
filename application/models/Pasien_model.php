<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q=""){
        
        $this->db->group_start();
        $this->db->like('nomr',$q);
        $this->db->or_like('no_ktp',$q);
        $this->db->or_like('nama',$q);
        $this->db->or_like('tempat_lahir',$q);
        $this->db->or_like('tgl_lahir',$q);
        $this->db->or_like('jns_kelamin',$q);
        $this->db->or_like('alamat',$q);
        $this->db->or_like('nama_provinsi',$q);
        $this->db->or_like('nama_kab_kota',$q);
        $this->db->or_like('nama_kecamatan',$q);
        $this->db->or_like('nama_kelurahan',$q);
        $this->db->or_like('no_telpon',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('idx','desc');
        return $this->db->get('m_pasien a')->result();
    }
    function countData($q=""){
        
        $this->db->group_start();
        $this->db->like('nomr',$q);
        $this->db->or_like('no_ktp',$q);
        $this->db->or_like('nama',$q);
        $this->db->or_like('tempat_lahir',$q);
        $this->db->or_like('tgl_lahir',$q);
        $this->db->or_like('jns_kelamin',$q);
        $this->db->or_like('alamat',$q);
        $this->db->or_like('nama_provinsi',$q);
        $this->db->or_like('nama_kab_kota',$q);
        $this->db->or_like('nama_kecamatan',$q);
        $this->db->or_like('nama_kelurahan',$q);
        $this->db->or_like('no_telpon',$q);
        $this->db->group_end();
        return $this->db->get('m_pasien a')->num_rows();
    }
    function getPoly(){
        $this->db->where('poly_status','Aktif');
        $this->db->where('poly_glid','GL002');
        return $this->db->get('stx_poly')->result();
    }
    function getDataByid($idx){
        $this->db->where('idx',$idx);
        return $this->db->get('m_pasien')->row();
    }
    // function simpanData($data){
    //     $this->db->insert('m_pasien',$data);
    //     return $this->db->insert_id();
    // }
    
    function batalDaftar($idx){
        $data=array('status_berobat'=>'Batal');
        $this->db->where('idx',$idx);
        $this->db->update('m_pasien',$data);
    }

    function kembaliDaftar($idx){
        $data=array('status_berobat'=>'Mendaftar');
        $this->db->where('idx',$idx);
        $this->db->update('m_pasien',$data);
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q="",$tgl="",$ruang=0){
        $this->db->where_in('status_berobat',array('Mendaftar','Checkin','Batal'));
        if(!empty($tgl)){
            $t=explode('/',$tgl);
            $tanggal=$t[2]."-".$t[1]."-".$t[0];
            $this->db->where('tanggal_kunjungan',$tanggal);
        }
        if(!empty($ruang)) $this->db->where('id_ruang',$ruang);
        $this->db->group_start();
        $this->db->like('nomr',$q);
        $this->db->or_like('no_ktp',$q);
        $this->db->or_like('nama_pasien',$q);
        $this->db->or_like('tempat_lahir',$q);
        $this->db->or_like('tgl_lahir',$q);
        $this->db->or_like('jns_kelamin',$q);
        $this->db->or_like('tanggal_daftar',$q);
        $this->db->or_like('tgl_masuk',$q);
        $this->db->or_like('tanggal_kunjungan',$q);
        $this->db->or_like('jam_kunjunganLabel',$q);
        $this->db->or_like('jam_kunjunganAntrian',$q);
        $this->db->or_like('nama_ruang',$q);
        $this->db->or_like('label_antrian',$q);
        $this->db->or_like('rujukan',$q);
        $this->db->or_like('cara_bayar',$q);
        $this->db->or_like('namaDokterJaga',$q);
        $this->db->or_like('status_berobat',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('idx','desc');
        return $this->db->get('tbl02_pendaftaran a')->result();
    }
    function countData($q="",$tgl="",$ruang=0){
        $this->db->where_in('status_berobat',array('Mendaftar','Checkin','Batal'));
        if(!empty($tgl)){
            $t=explode('/',$tgl);
            $tanggal=$t[2]."-".$t[1]."-".$t[0];
            $this->db->where('tanggal_kunjungan',$tanggal);
        }
        if(!empty($ruang)) $this->db->where('id_ruang',$ruang);
        $this->db->group_start();
        $this->db->like('nomr',$q);
        $this->db->or_like('no_ktp',$q);
        $this->db->or_like('nama_pasien',$q);
        $this->db->or_like('tempat_lahir',$q);
        $this->db->or_like('tgl_lahir',$q);
        $this->db->or_like('jns_kelamin',$q);
        $this->db->or_like('tanggal_daftar',$q);
        $this->db->or_like('tgl_masuk',$q);
        $this->db->or_like('tanggal_kunjungan',$q);
        $this->db->or_like('jam_kunjunganLabel',$q);
        $this->db->or_like('jam_kunjunganAntrian',$q);
        $this->db->or_like('nama_ruang',$q);
        $this->db->or_like('label_antrian',$q);
        $this->db->or_like('rujukan',$q);
        $this->db->or_like('cara_bayar',$q);
        $this->db->or_like('namaDokterJaga',$q);
        $this->db->or_like('status_berobat',$q);
        $this->db->group_end();
        return $this->db->get('tbl02_pendaftaran a')->num_rows();
    }
    function getPoly(){
        $this->db->where('poly_status','Aktif');
        $this->db->where('poly_glid','GL002');
        return $this->db->get('stx_poly')->result();
    }
    function getDataByid($idx){
        $this->db->where('idx',$idx);
        return $this->db->get('tbl02_pendaftaran')->row();
    }
    // function simpanData($data){
    //     $this->db->insert('tbl02_pendaftaran',$data);
    //     return $this->db->insert_id();
    // }
    
    function batalDaftar($idx){
        $data=array('status_berobat'=>'Batal');
        $this->db->where('idx',$idx);
        $this->db->update('tbl02_pendaftaran',$data);
    }

    function kembaliDaftar($idx){
        $data=array('status_berobat'=>'Mendaftar');
        $this->db->where('idx',$idx);
        $this->db->update('tbl02_pendaftaran',$data);
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q,$poly,$dokter,$hari,$pekan){
        if(!empty($poly)) $this->db->where('jadwal_poly_id',$poly);
        if(!empty($dokter)) $this->db->where('jadwal_dokter_id',$dokter);
        if(!empty($hari)) $this->db->where('jadwal_hari',$hari);
        if(!empty($pekan)) $this->db->where('jadwal_pekan',$pekan);
        $this->db->group_start();
        $this->db->like('dokter_nama',$q);
        $this->db->or_like('poly_nama',$q);
        $this->db->or_like('jadwal_hari',$q);
        $this->db->or_like('jadwal_status',$q);
        $this->db->group_end();
        $this->db->join('stx_dokter b', 'a.jadwal_dokter_id=b.dokter_id');
        $this->db->join('stx_poly c', 'a.jadwal_poly_id=c.poly_id');
        $this->db->limit($limit, $mulai);
        $this->db->order_by('jadwal_id','desc');
        return $this->db->get('trx_jadwal_dokter a')->result();
    }
    function countData($q,$poly,$dokter,$hari,$pekan){
        if(!empty($poly)) $this->db->where('jadwal_poly_id',$poly);
        if(!empty($dokter)) $this->db->where('jadwal_dokter_id',$dokter);
        if(!empty($hari)) $this->db->where('jadwal_hari',$hari);
        if(!empty($pekan)) $this->db->where('jadwal_pekan',$pekan);
        $this->db->group_start();
        $this->db->like('dokter_nama',$q);
        $this->db->or_like('poly_nama',$q);
        $this->db->or_like('jadwal_hari',$q);
        $this->db->or_like('jadwal_status',$q);
        $this->db->group_end();
        $this->db->join('stx_dokter b', 'a.jadwal_dokter_id=b.dokter_id');
        $this->db->join('stx_poly c', 'a.jadwal_poly_id=c.poly_id');
        return $this->db->get('trx_jadwal_dokter a')->num_rows();
    }
    function getDokter(){
        $this->db->where('dokter_status','Aktif');
        $this->db->order_by('dokter_nama');
        return $this->db->get('stx_dokter')->result();
    }
    function getGroupBatch(){
        return $this->db->get('tb_config_batch_group')->result();
    }
    function getBatch($group){
        $this->db->where('groupid',$group);
        return $this->db->get('tb_config_batch')->result();
    }

    function getBatchMaster($min=0){
        $this->db->where('id >',$min);
        return $this->db->get('tb_batch_master')->result();
    }
    function getRangeBatchMaster($dari,$sampai){
        $this->db->where('id >= ',$dari);
        $this->db->where('id < ', $sampai);
        return $this->db->get('tb_batch_master')->result();
    }
    function getBatchMasterByid($idx){
        $this->db->where('id',$idx);
        return $this->db->get('tb_batch_master')->row();
    }
    function getPoly(){
        $this->db->where('poly_status','Aktif');
        return $this->db->get('stx_poly')->result();
    }
    function getDataByid($jadwal_id){
        $this->db->where('jadwal_id',$jadwal_id);
        return $this->db->get('trx_jadwal_dokter')->row();
    }
    function simpanData($data){
        $this->db->insert('trx_jadwal_dokter',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$jadwal_id){
        $this->db->where('jadwal_id',$jadwal_id);
        $this->db->update('trx_jadwal_dokter',$data);
    }
    function upload_files($path, $title, $files, $allow_types)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => $allow_types,
            'overwrite'     => 1,
        );
        $this->load->library('upload', $config);
        $images = array();
        $i = 0;
        $sukses=0;
        $gagal=0;
        foreach ($files['name'] as $key => $image) {
            $i++;
            $_FILES['images[]']['name'] = $files['name'][$key];
            $_FILES['images[]']['type'] = $files['type'][$key];
            $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['images[]']['error'] = $files['error'][$key];
            $_FILES['images[]']['size'] = $files['size'][$key];

            $fileName = str_replace(' ', '_', $_FILES['images[]']['name']);
            //$ext = explode('/', $_FILES['images[]']['type']);
            //$images = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $upload_data = $this->upload->data();
                $file_name[]=$upload_data["file_name"];
                $sukses++;
                // $images = array('status' => true, 'message' => $path . $upload_data["file_name"]);
            } else {
                $gagal++;
                // $images = array('status' => false, 'message' => $this->upload->display_errors());
            }
        }
        if($gagal>0){
            $message="$sukses dari $i file berhasil di upload";
            // $response= array('status'=>true,'message'=>$message,'images'=>$images);
        }else{
            $message="Berhasil upload data";
        }
        if(empty($files)) $files=array();
        if(!empty($file_name)) return array('status'=>true,'message'=>$message,'images'=>$file_name);
        else return array('status'=>false,'message'=>$message,'images'=>array());
    }

    function hapusData($jadwal_id){
        $this->db->where('jadwal_id',$jadwal_id);
        $this->db->delete('trx_jadwal_dokter');
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dokter_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q){
        $this->db->group_start();
        $this->db->like('dokter_nama',$q);
        $this->db->or_like('spesialis_nama',$q);
        $this->db->or_like('nrp',$q);
        $this->db->or_like('dokter_jekel',$q);
        $this->db->or_like('dokter_notelp',$q);
        $this->db->or_like('dokter_jenis',$q);
        $this->db->group_end();
        $this->db->join('stx_spesialis b', 'a.dokter_spesialis_id=b.spesialis_id','LEFT');
        $this->db->limit($limit, $mulai);
        $this->db->order_by('dokter_id','desc');
        return $this->db->get('stx_dokter a')->result();
    }
    function countData($q){
        $this->db->group_start();
        $this->db->like('dokter_nama',$q);
        $this->db->or_like('spesialis_nama',$q);
        $this->db->or_like('nrp',$q);
        $this->db->or_like('dokter_jekel',$q);
        $this->db->or_like('dokter_notelp',$q);
        $this->db->or_like('dokter_jenis',$q);
        $this->db->group_end();
        $this->db->join('stx_spesialis b', 'a.dokter_spesialis_id=b.spesialis_id','LEFT');
        return $this->db->get('stx_dokter a')->num_rows();
    }
    function getSpesialis(){
        return $this->db->get('stx_spesialis')->result();
    }
    function getDataByid($dokter_id){
        $this->db->where('dokter_id',$dokter_id);
        return $this->db->get('stx_dokter')->row();
    }
    function simpanData($data){
        $this->db->insert('stx_dokter',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$dokter_id){
        $this->db->where('dokter_id',$dokter_id);
        $this->db->update('stx_dokter',$data);
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

    function hapusData($dokter_id){
        $this->db->where('dokter_id',$dokter_id);
        $this->db->delete('stx_dokter');
    }
}
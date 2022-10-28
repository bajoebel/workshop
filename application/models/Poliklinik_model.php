<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Poliklinik_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q,$group){
        $this->db->join('stx_group_layanan b','a.poly_glid=b.glid');
        $this->db->where('poly_glid',$group);
        $this->db->group_start();
        $this->db->like('poly_nama',$q);
        $this->db->or_like('poly_status',$q);
        $this->db->or_like('glnama',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('poly_id','desc');
        return $this->db->get('stx_poly a')->result();
    }
    function countData($q,$group){
        $this->db->join('stx_group_layanan b','a.poly_glid=b.glid');
        $this->db->where('poly_glid',$group);
        $this->db->group_start();
        $this->db->like('poly_nama',$q);
        $this->db->or_like('poly_status',$q);
        $this->db->or_like('glnama',$q);
        $this->db->group_end();
        return $this->db->get('stx_poly a')->num_rows();
    }
    function getDataByid($poly_id){
        $this->db->where('poly_id',$poly_id);
        return $this->db->get('stx_poly')->row();
    }
    function simpanData($data){
        $this->db->insert('stx_poly',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$poly_id){
        $this->db->where('poly_id',$poly_id);
        $this->db->update('stx_poly',$data);
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
        if(empty($file_name)) {
            $file_name=array();
            return array('status'=>false,'message'=>'Tidak ada file yang diupload','images'=>$file_name);
        }else  return array('status'=>true,'message'=>$message,'images'=>$file_name);
    }

    function hapusData($poly_id){
        $this->db->where('poly_id',$poly_id);
        $this->db->delete('stx_poly');
    }
    function getGroup(){
        return $this->db->get('stx_group_layanan')->result();
    }
}
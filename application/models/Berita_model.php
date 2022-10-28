<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Berita_model extends CI_Model
{
    function getAkses($level,$link){
        $this->db->where('idx_level',$level);
        $this->db->where('link_menu',$link);
        $this->db->join('menu_admin b','a.idx_menu=b.idx');
        return $this->db->get('hak_akses a')->num_rows();
    }
    function getData($limit=10,$mulai=0,$q,$jenis="Halaman Dinamis"){
        $this->db->select("*,DATE_FORMAT(post_tglpublish,'%d/%m/%Y') as post_tglpublish");
        $this->db->where('post_jenis',$jenis);
        $this->db->join('stx_kategori b','a.post_kategori_id=b.kategori_id','LEFT');
        $this->db->group_start();
        $this->db->like('post_judul',$q);
        $this->db->or_like('post_status',$q);
        $this->db->group_end();
        $this->db->limit($limit, $mulai);
        $this->db->order_by('post_id','desc');
        return $this->db->get('trx_post a')->result();
    }
    function countData($q,$jenis="Halaman Dinamis"){
        $this->db->where('post_jenis',$jenis);
        $this->db->join('stx_kategori b','a.post_kategori_id=b.kategori_id','LEFT');
        $this->db->group_start();
        $this->db->like('post_judul',$q);
        $this->db->or_like('post_status',$q);
        $this->db->group_end();
        return $this->db->get('trx_post a')->num_rows();
    }
    function getDataByid($post_id){
        $this->db->select("*,DATE_FORMAT(post_tglpublish,'%d/%m/%Y') as post_tglpublish");
        $this->db->where('post_id',$post_id);
        return $this->db->get('trx_post')->row();
    }
    function simpanData($data){
        $this->db->insert('trx_post',$data);
        return $this->db->insert_id();
    }
    function updateData($data,$post_id){
        $this->db->where('post_id',$post_id);
        $this->db->update('trx_post',$data);
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

            $fileName = $title . '_' . $i . "_" . str_replace(' ', '_', $_FILES['images[]']['name']);
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
        if(empty($file_name)) return array('status'=>false,'message'=>$message);
        else return array('status'=>true,'message'=>$message, 'path'=>$path,'images'=>$file_name);
    }

    public function _file_resize($source=null, $dest=null, $width=0, $height=0){
        $thumb['image_library']     = 'gd2';
        $thumb['source_image']      = $source;
        $thumb['create_thumb']      = FALSE;
        $thumb['maintain_ratio']    = TRUE;
        $thumb['width']             = $width;
        $thumb['height']            = $height;
        $thumb['new_image']         = $dest; 
        $this->load->library('image_lib', $thumb);
        $this->image_lib->clear();
        $this->image_lib->initialize($thumb);
        if (!$this->image_lib->resize()) {
            $error['thumb']= $this->image_lib->display_errors();
        }else{
            $error['thumb']= "";
        }
        $this->image_lib->clear();
        return $error['thumb'];
    }


    function hapusData($post_id){
        $this->db->where('post_id',$post_id);
        $this->db->delete('trx_post');
    }
    function getKategori(){
        $this->db->where('kategori_status','Aktif');
        return $this->db->get('stx_kategori')->result();
    }
}
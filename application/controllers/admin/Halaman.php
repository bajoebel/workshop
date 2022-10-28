<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Berita_model');
    }
    function index(){
        $link='admin/halaman';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('post_judul', 'post_link','post_tglpublish','post_status');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}})'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/halaman/getdata',
                'variable'      => array('idx' => 'post_id','post_judul'=>'post_judul','post_status'=>'post_status'),
                'field'         => $field,
                'function'      => 'getData',
                'keyword_id'    => 'q',
                'param_id'      => array(),
                'limit_id'      => 'limit',
                'data_id'       => 'data',
                'page_id'       => 'pagination',
                'number'        => true,
                'action'        => true,
                'load'          => true,
                'action_button' => $action,
            );
            $res=array(
                'kategori'=>$this->Berita_model->getKategori()
            );
            $data=array(
                'libjs'=>array(
                    'component/inputmask/dist/jquery.inputmask.bundle.js',
                    'component/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
                    'js/app/halaman.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/halaman_index',$res,true),
                'aktif'=>$priv->urut_menu
            );
            $this->load->view('admin/layout',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>3
            );
            $this->load->view('admin/layout',$data);
        }
        
    }
    
    function getdata()
    {
        $link='admin/halaman';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $q = urldecode($this->input->get('keyword', TRUE));
            $start = intval($this->input->get('start'));
            $limit = intval($this->input->get('limit'));
            $mulai = ($start * $limit) - $limit;
            $response = array(
                'status'    => true,
                'message'   => "OK",
                'start'     => $mulai,
                'row_count' => $this->Berita_model->countData($q,'Halaman Statis'),
                'limit'     => $limit,
                'data'      => $this->Berita_model->getData($limit, $mulai, $q, 'Halaman Statis'),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/halaman';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $post_id=$this->input->post('post_id');
            $post_link=str_replace(' ','_',strtolower($this->input->post('post_judul')));
            $post_link=str_replace('&','dan',$post_link);
            $post_link=preg_replace('~[\\\\/:*?"<>|]~', '', $post_link);
            $row=$this->Berita_model->getDataByid($post_id);
            if(empty($row)){
                $post_status_komen=$this->input->post('post_status_komen');
                if($post_status_komen!='Aktif') $post_status="Non Aktif";
                $tgl=explode("/",$this->input->post('post_tglpublish'));
                $tglpublish=$tgl[2]."-".$tgl[1]."-".$tgl[0];
                $create_dir = "rsud-backend/public/img/blog/original";
                $file_type="jpg|jpeg|gif|tiff";
                if (!file_exists($create_dir)) {
                    mkdir($create_dir, 0777, true);
                }
                $res = $this->Berita_model->upload_files($create_dir, '', $_FILES['post_image'], $file_type);
                if($res['status']==true) {
                    $post_image = $res["images"][0]; 
                    $error[]=$this->Berita_model->_file_resize($create_dir."/" .$post_image, './rsud-backend/public/img/blog/thumb/THUMB_' .$post_image, 300,300);
                    $icon[]=$this->Berita_model->_file_resize($create_dir."/" .$post_image, '../rsud-backend/public/img/blog/icon/ICON_' .$post_image, 50,50);
                }else $post_image="";
                $data=array(
                    'post_judul'=>$this->input->post('post_judul'),
                    'post_kategori_id'=>$this->input->post('post_kategori_id'),
                    'post_jenis'=>'Halaman Statis',
                    'post_isi'=>$this->input->post('post_isi'),
                    'post_status_komen'=>$post_status_komen,
                    'post_link'=>$post_link,
                    'post_image'=>$post_image,
                    'post_statistik'=>0,
                    'post_tanggal'=>date('Y-m-d H:i:s'),
                    'post_tglpublish'=>$tglpublish,
                    'post_status'=>$this->input->post('post_status'),
                );

                $this->form_validation->set_rules('post_judul', 'Judul Berita', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Berita_model->simpanData($data);
                    header('location:'.base_url()."admin/halaman");
                    // header('Content-Type: application/json');
                    // echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_post_judul' => form_error('post_judul'),
                        'err_post_kategori_id' => form_error('post_kategori_id'),
                        'err_post_status' => form_error('post_status'),
                    );
                    
                    // header('Content-Type: application/json');
                    // echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('post_judul', 'Judul Berita', 'required');
                if($this->form_validation->run())
                {
                    $post_status_komen=$this->input->post('post_status_komen');
                    if($post_status_komen!='Aktif') $post_status="Non Aktif";
                    $tgl=explode("/",$this->input->post('post_tglpublish'));
                    $tglpublish=$tgl[2]."-".$tgl[1]."-".$tgl[0];
                    $create_dir = "rsud-backend/public/img/blog/original";
                    $file_type="jpg|jpeg|gif|tiff";
                    if (!file_exists($create_dir)) {
                        mkdir($create_dir, 0777, true);
                    }
                    $res = $this->Berita_model->upload_files($create_dir, '', $_FILES['post_image'], $file_type);
                    if($res['status']==true) {
                        $post_image = $res["images"][0]; 
                        $error[]=$this->Berita_model->_file_resize($create_dir."/" .$post_image, './rsud-backend/public/img/blog/thumb/THUMB_' .$post_image, 300,300);
                        $icon[]=$this->Berita_model->_file_resize($create_dir."/" .$post_image, '../rsud-backend/public/img/blog/icon/ICON_' .$post_image, 50,50);
                    }else $post_image=$row->post_image;
                    $data=array(
                        'post_judul'=>$this->input->post('post_judul'),
                        'post_kategori_id'=>$this->input->post('post_kategori_id'),
                        'post_jenis'=>'Halaman Statis',
                        'post_isi'=>$this->input->post('post_isi'),
                        'post_status_komen'=>$post_status_komen,
                        'post_link'=>$post_link,
                        'post_image'=>$post_image,
                        'post_tglpublish'=>$tglpublish,
                        'post_status'=>$this->input->post('post_status'),
                    );
                    // print_r($res); exit;
                    $this->Berita_model->updateData($data,$post_id);
                    // header('Content-Type: application/json');
                    // echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                    header('location:'.base_url()."admin/halaman");
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_post_judul' => form_error('post_judul'),
                        'err_post_kategori_id' => form_error('post_kategori_id'),
                        'err_post_status' => form_error('post_status'),
                    );
                    // header('Content-Type: application/json');
                    // echo json_encode($array);
                }
            }
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>3
            );
            $this->load->view('admin/layout',$data);
        }
    }

    function hapus($idx)
    {
        $link='admin/halaman';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Berita_model->hapusData($idx);
            $response = array(
                'status'    => true,
                'message'   => "Data berhasil dihapus",
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function edit($idx){
        $link='admin/halaman';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $response = array(
                'status'    => true,
                'message'   => "Data berhasil dihapus",
                'data'=>$this->Berita_model->getDataByid($idx)
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function upload(){
        /***************************************************
         * Only these origins are allowed to upload images *
         ***************************************************/
        $accepted_origins = array("http://localhost", "http://192.168.137.1", "http://rsud.padangpanjang.go.id/");

        /*********************************************
         * Change this line to set the upload folder *
         *********************************************/
        $imageFolder = "rsud-backend/public/img/berita/";

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // same-origin requests won't set an origin. If the origin is set, it must be valid.
            if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            } else {
            header("HTTP/1.1 403 Origin Denied");
            return;
            }
        }

        // Don't attempt to process the upload on an OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Methods: POST, OPTIONS");
            return;
        }

        reset ($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])){
            /*
            If your script needs to receive cookies, set images_upload_credentials : true in
            the configuration and enable the following two headers.
            */
            // header('Access-Control-Allow-Credentials: true');
            // header('P3P: CP="There is no P3P policy."');

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            // Determine the base URL
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://";
            $baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/";

            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            echo json_encode(array('location' => base_url() . $filetowrite));
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }
    }
}
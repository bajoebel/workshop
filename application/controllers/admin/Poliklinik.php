<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poliklinik extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Poliklinik_model');
    }
    function index(){
        $link='admin/poliklinik';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('poly_id','poly_nama', 'glNama','poly_status');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{poly_nama}}\\\",\\\"{{poly_glid}}\\\",\\\"{{poly_status}}\\\",\\\"{{poly_kode}}\\\",\\\"{{poly_induk}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/poliklinik/getdata',
                'variable'      => array('idx' => 'poly_id','poly_nama'=>'poly_nama','poly_status'=>'poly_status','poly_glid'=>'poly_glid','poly_kode'=>'poly_kode','poly_induk'=>'poly_induk'),
                'field'         => $field,
                'function'      => 'getData',
                'keyword_id'    => 'q',
                'param_id'      => array('group'=>'group'),
                'limit_id'      => 'limit',
                'data_id'       => 'data',
                'page_id'       => 'pagination',
                'number'        => true,
                'action'        => true,
                'load'          => true,
                'action_button' => $action,
            );
            $row=array(
                'group'=>$this->Poliklinik_model->getGroup()
            );
            $data=array(
                'libjs'=>array('js/app/poliklinik.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/poliklinik_index',$row,true),
                'aktif'=>$priv->urut_menu
            );
            $this->load->view('admin/layout',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>4
            );
            $this->load->view('admin/layout',$data);
        }
        
    }

    function getdata()
    {
        $link='admin/poliklinik';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $q = urldecode($this->input->get('keyword', TRUE));
            $group = urldecode($this->input->get('group', TRUE));
            $start = intval($this->input->get('start'));
            $limit = intval($this->input->get('limit'));
            $mulai = ($start * $limit) - $limit;
            $response = array(
                'status'    => true,
                'message'   => "OK",
                'start'     => $mulai,
                'row_count' => $this->Poliklinik_model->countData($q,$group),
                'limit'     => $limit,
                'data'      => $this->Poliklinik_model->getData($limit, $mulai, $q,$group),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/poliklinik';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $poly_id=$this->input->post('poly_id');
            
            $row=$this->Poliklinik_model->getDataByid($poly_id);
            if(empty($row)){
                $poly_status=$this->input->post('poly_status');
                if($poly_status!='Aktif') $poly_status="Non Aktif";
                $poly_induk=$this->input->post('poly_induk');
                if($poly_induk!=1) $poly_status=0;
                $create_dir = "rsud-backend/public/img/Icon/poliklinik/";
                $file_type="jpg|jpeg|gif|tiff";
                if (!file_exists($create_dir)) {
                    mkdir($create_dir, 0777, true);
                }
                $res = $this->Poliklinik_model->upload_files($create_dir, '', $_FILES['poly_image'], $file_type);
                // print_r($res); exit;
                if($res['status']==true) $images = $res["images"][0]; else $images="";
                if(!empty($images)){
                    $data=array(
                        'poly_id'=>$this->input->post('poly_id'),
                        'poly_glid'=>$this->input->post('poly_glid'),
                        'poly_kode'=>$this->input->post('poly_kode'),
                        'poly_induk'=>$poly_induk,
                        'poly_status'=>$poly_status,
                        'poly_image'=>'thumb_'.$images
                    );
                }else{
                    $data=array(
                        'poly_id'=>$this->input->post('poly_id'),
                        'poly_nama'=>$this->input->post('poly_nama'),
                        'poly_glid'=>$this->input->post('poly_glid'),
                        'poly_kode'=>$this->input->post('poly_kode'),
                        'poly_induk'=>$poly_induk,
                        'poly_status'=>$poly_status
                    );
                }
                

                $this->form_validation->set_rules('poly_nama', 'Nama Poliklinik', 'required');
                $this->form_validation->set_rules('poly_id', 'ID Poliklinik Sesuai Simrs', 'required');
                if($this->form_validation->run())
                {
                    $insert = $this->Poliklinik_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_poly_nama' => form_error('poly_nama'),
                        'err_poly_id' => form_error('poly_id'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('poly_nama', 'Cara Bayar', 'required');
                // $this->form_validation->set_rules('poly_status', 'Status poliklinik', 'required');
                $this->form_validation->set_rules('poly_id', 'ID Poliklinik Sesuai Simrs', 'required');
                if($this->form_validation->run())
                {
                    $poly_status=$this->input->post('poly_status');
                    // echo "Status ".$poly_status; exit;
                    if($poly_status!='Aktif') $poly_status="Non Aktif";

                    $poly_induk=$this->input->post('poly_induk');
                    if($poly_induk!=1) $poly_induk=0;
                    $create_dir = "rsud-backend/public/img/Icon/poliklinik/";
                    $file_type="jpg|jpeg|gif|tiff";
                    if (!file_exists($create_dir)) {
                        mkdir($create_dir, 0777, true);
                    }
                    $res = $this->Poliklinik_model->upload_files($create_dir, '', $_FILES['poly_image'], $file_type);
                    if($res['status']==true) $images = $res["images"][0]; else $images="";
                    // echo $poly_status; exit;
                    if(!empty($images)){
                        $data=array(
                            'poly_nama'=>$this->input->post('poly_nama'),
                            'poly_glid'=>$this->input->post('poly_glid'),
                            'poly_kode'=>$this->input->post('poly_kode'),
                            'poly_induk'=>$poly_induk,
                            'poly_status'=>$poly_status,
                            'poly_image'=>$images
                        );
                    }else{
                        $data=array(
                            'poly_nama'=>$this->input->post('poly_nama'),
                            'poly_glid'=>$this->input->post('poly_glid'),
                            'poly_kode'=>$this->input->post('poly_kode'),
                            'poly_induk'=>$poly_induk,
                            'poly_status'=>$poly_status
                        );
                    }
                    // print_r($data); exit;
                    $this->Poliklinik_model->updateData($data,$poly_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_poly_nama' => form_error('poly_nama'),
                        'err_poly_id' => form_error('poly_id'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status" => FALSE,'error'=>TRUE, "message"=> "Anda tidak berhak untuk mengakases halaman ini"));
        }
    }

    function hapus($idx)
    {
        $link='admin/poliklinik';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Poliklinik_model->hapusData($idx);
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
}
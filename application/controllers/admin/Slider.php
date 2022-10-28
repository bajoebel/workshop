<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Slider_model');
    }
    function index(){
        $link='admin/slider';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            // $field=array('slider_img', 'slider_caption','slider_urut','slider_status');
            // $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{slider_caption}}\\\",\\\"{{slider_urut}}\\\",\\\"{{slider_status}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            // $config = array(
            //     'url'           => 'admin/slider/getdata',
            //     'variable'      => array('idx' => 'slider_id','slider_img'=>'slider_img','slider_caption'=>'slider_caption','slider_status'=>'slider_status','slider_urut'=>'slider_urut'),
            //     'field'         => $field,
            //     'function'      => 'getData',
            //     'keyword_id'    => 'q',
            //     'param_id'      => array('group'=>'group'),
            //     'limit_id'      => 'limit',
            //     'data_id'       => 'data',
            //     'page_id'       => 'pagination',
            //     'number'        => true,
            //     'action'        => true,
            //     'load'          => true,
            //     'action_button' => $action,
            // );
            $row=array(
                'group'=>$this->Slider_model->getGroup()
            );
            $data=array(
                'libjs'=>array('js/app/slider.js'),
                'ajaxdata' => "",
                'content'=> $this->load->view('admin/slider_index',$row,true),
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
        $link='admin/slider';
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
                'row_count' => $this->Slider_model->countData($q,$group),
                'limit'     => $limit,
                'data'      => $this->Slider_model->getData($limit, $mulai, $q,$group),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/slider';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $slider_id=$this->input->post('slider_id');
            
            $row=$this->Slider_model->getDataByid($slider_id);
            if(empty($row)){
                $slider_status=$this->input->post('slider_status');
                if($slider_status!=1) $slider_status=0;
                $this->form_validation->set_rules('slider_caption', 'Caption', 'required');
                if($this->form_validation->run())
                {
                    $create_dir = "rsud-backend/public/img/slider/original/";
                    $file_type="jpg|jpeg|gif|tiff";
                    if (!file_exists($create_dir)) {
                        mkdir($create_dir, 0777, true);
                    }
                    $res = $this->Slider_model->upload_files($create_dir, '', $_FILES['slider_img'], $file_type);
                    // print_r($res); exit;
                    if($res['status']==true) $images = $res["images"][0]; else $images="";
                    if(!empty($images)){
                        $error[]=$this->Slider_model->_file_resize($create_dir."/" .$images, './rsud-backend/public/img/slider/thumb/THUMB_' .$images, 300,300);
                        $icon[]=$this->Slider_model->_file_resize($create_dir."/" .$images, '../rsud-backend/public/img/slider/icon/ICON_' .$images, 50,50);
                        $data=array(
                            'slider_urut'=>$this->input->post('slider_urut'),
                            'slider_caption'=>$this->input->post('slider_caption'),
                            'slider_status'=>$slider_status,
                            'slider_img'=>$images
                        );
                    }else{
                        $data=array(
                            'slider_urut'=>$this->input->post('slider_urut'),
                            'slider_caption'=>$this->input->post('slider_caption'),
                            'slider_status'=>$slider_status
                        );
                    }
                    $insert = $this->Slider_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_slider_img' => form_error('slider_img'),
                        'err_slider_id' => form_error('slider_id'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('slider_caption', 'Caption', 'required');
                if($this->form_validation->run())
                {
                    $slider_status=$this->input->post('slider_status');
                    // echo "Status ".$slider_status; exit;
                    if($slider_status!=1) $slider_status=0;

                    
                    $create_dir = "rsud-backend/public/img/slider/original/";
                    $file_type="jpg|jpeg|gif|tiff";
                    if (!file_exists($create_dir)) {
                        mkdir($create_dir, 0777, true);
                    }
                    $res = $this->Slider_model->upload_files($create_dir, '', $_FILES['slider_img'], $file_type);
                    if($res['status']==true) $images = $res["images"][0]; else $images=$row->slider_img;
                    // echo $slider_status; exit;
                    if(!empty($images)){
                        $data=array(
                            'slider_urut'=>$this->input->post('slider_urut'),
                            'slider_caption'=>$this->input->post('slider_caption'),
                            'slider_status'=>$slider_status,
                            'slider_img'=>$images
                        );
                    }else{
                        $data=array(
                            'slider_urut'=>$this->input->post('slider_urut'),
                            'slider_caption'=>$this->input->post('slider_caption'),
                            'slider_status'=>$slider_status,
                        );
                    }
                    // print_r($data); exit;
                    $this->Slider_model->updateData($data,$slider_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_slider_img' => form_error('slider_img'),
                        'err_slider_id' => form_error('slider_id'),
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
        $link='admin/slider';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Slider_model->hapusData($idx);
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
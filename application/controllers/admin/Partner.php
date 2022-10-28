<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Partner_model');
    }
    function index(){
        $link='admin/partner';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            // $field=array('partner_logo', 'partner_nama','partner_link','partner_status');
            // $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{partner_nama}}\\\",\\\"{{partner_link}}\\\",\\\"{{partner_status}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            // $config = array(
            //     'url'           => 'admin/partner/getdata',
            //     'variable'      => array('idx' => 'partner_id','partner_logo'=>'partner_logo','partner_nama'=>'partner_nama','partner_status'=>'partner_status','partner_link'=>'partner_link'),
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
                'group'=>$this->Partner_model->getGroup()
            );
            $data=array(
                'libjs'=>array('js/app/partner.js'),
                'ajaxdata' => "",
                'content'=> $this->load->view('admin/partner_index',$row,true),
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
        $link='admin/partner';
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
                'row_count' => $this->Partner_model->countData($q,$group),
                'limit'     => $limit,
                'data'      => $this->Partner_model->getData($limit, $mulai, $q,$group),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/partner';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $partner_id=$this->input->post('partner_id');
            
            $row=$this->Partner_model->getDataByid($partner_id);
            if(empty($row)){
                $partner_status=$this->input->post('partner_status');
                if($partner_status!=1) $partner_status=0;
                $this->form_validation->set_rules('partner_nama', 'Nama Partner', 'required');
                $this->form_validation->set_rules('partner_link', 'Website', 'required');
                if($this->form_validation->run())
                {
                    $create_dir = "rsud-backend/public/img/partner/";
                    $file_type="jpg|jpeg|gif|tiff";
                    if (!file_exists($create_dir)) {
                        mkdir($create_dir, 0777, true);
                    }
                    $res = $this->Partner_model->upload_files($create_dir, '', $_FILES['partner_logo'], $file_type);
                    // print_r($res); exit;
                    if($res['status']==true) $images = $res["images"][0]; else $images="";
                    if(!empty($images)){
                        // $error[]=$this->Partner_model->_file_resize($create_dir."/" .$images, './rsud-backend/public/img/partner/thumb/THUMB_' .$images, 300,300);
                        // $icon[]=$this->Partner_model->_file_resize($create_dir."/" .$images, '../rsud-backend/public/img/partner/icon/ICON_' .$images, 50,50);
                        $data=array(
                            'partner_link'=>$this->input->post('partner_link'),
                            'partner_nama'=>$this->input->post('partner_nama'),
                            'partner_status'=>$partner_status,
                            'partner_logo'=>$images
                        );
                    }else{
                        $data=array(
                            'partner_link'=>$this->input->post('partner_link'),
                            'partner_nama'=>$this->input->post('partner_nama'),
                            'partner_status'=>$partner_status
                        );
                    }
                    $insert = $this->Partner_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_partner_logo' => form_error('partner_logo'),
                        'err_partner_link' => form_error('partner_link'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('partner_nama', 'Caption', 'required');
                $this->form_validation->set_rules('partner_link', 'Website', 'required');
                if($this->form_validation->run())
                {
                    $partner_status=$this->input->post('partner_status');
                    // echo "Status ".$partner_status; exit;
                    if($partner_status!=1) $partner_status=0;

                    
                    $create_dir = "rsud-backend/public/img/partner/";
                    $file_type="jpg|jpeg|gif|tiff";
                    if (!file_exists($create_dir)) {
                        mkdir($create_dir, 0777, true);
                    }
                    $res = $this->Partner_model->upload_files($create_dir, '', $_FILES['partner_logo'], $file_type);
                    if($res['status']==true) $images = $res["images"][0]; else $images=$row->partner_logo;
                    // echo $partner_status; exit;
                    if(!empty($images)){
                        $data=array(
                            'partner_link'=>$this->input->post('partner_link'),
                            'partner_nama'=>$this->input->post('partner_nama'),
                            'partner_status'=>$partner_status,
                            'partner_logo'=>$images
                        );
                    }else{
                        $data=array(
                            'partner_link'=>$this->input->post('partner_link'),
                            'partner_nama'=>$this->input->post('partner_nama'),
                            'partner_status'=>$partner_status,
                        );
                    }
                    // print_r($data); exit;
                    $this->Partner_model->updateData($data,$partner_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_partner_logo' => form_error('partner_logo'),
                        'err_partner_id' => form_error('partner_id'),
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
        $link='admin/partner';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Partner_model->hapusData($idx);
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
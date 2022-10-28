<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Pekerjaan_model');
    }
    function index(){
        $link='admin/pekerjaan';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('pekerjaan_nama');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{cb}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/pekerjaan/getdata',
                'variable'      => array('idx' => 'pekerjaan_id','cb'=>'pekerjaan_nama'),
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
            $data=array(
                'libjs'=>array('js/app/pekerjaan.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/pekerjaan_index','',true),
                'aktif'=>$priv->urut_menu
            );
            $this->load->view('admin/layout',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>2
            );
            $this->load->view('admin/layout',$data);
        }
        
    }

    function getdata()
    {
        $link='admin/pekerjaan';
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
                'row_count' => $this->Pekerjaan_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Pekerjaan_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/pekerjaan';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $pekerjaan_id=$this->input->post('pekerjaan_id');
            
            $row=$this->Pekerjaan_model->getDataByid($pekerjaan_id);
            if(empty($row)){
                
                $data=array(
                    'pekerjaan_nama'=>$this->input->post('pekerjaan_nama'),
                );

                $this->form_validation->set_rules('pekerjaan_nama', 'pekerjaan Perkawinan', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Pekerjaan_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("pekerjaan" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_pekerjaan' => form_error('pekerjaan_nama'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('pekerjaan_nama', 'pekerjaan Perkawinan', 'required');
                if($this->form_validation->run())
                {
                    
                    $data=array(
                        'pekerjaan_nama'=>$this->input->post('pekerjaan_nama'),
                    );
                    $this->Pekerjaan_model->updateData($data,$pekerjaan_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("pekerjaan" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_pekerjaan' => form_error('pekerjaan_nama'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("pekerjaan" => FALSE,'error'=>TRUE, "message"=> "Anda tidak berhak untuk mengakases halaman ini"));
        }
    }

    function hapus($idx)
    {
        $link='admin/pekerjaan';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Pekerjaan_model->hapusData($idx);
            $response = array(
                'status'    => TRUE,
                'message'   => "Data berhasil dihapus",
            );
        }else{
            $response=array('pekerjaan_nama'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
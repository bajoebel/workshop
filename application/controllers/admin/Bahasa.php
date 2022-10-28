<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahasa extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('bahasa_model');
    }
    function index(){
        $link='admin/bahasa';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('bahasa_nama');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{cb}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/bahasa/getdata',
                'variable'      => array('idx' => 'bahasa_id','cb'=>'bahasa_nama'),
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
                'libjs'=>array('js/app/bahasa.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/bahasa_index','',true),
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
        $link='admin/bahasa';
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
                'row_count' => $this->bahasa_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->bahasa_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/bahasa';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $bahasa_id=$this->input->post('bahasa_id');
            
            $row=$this->bahasa_model->getDataByid($bahasa_id);
            if(empty($row)){
                
                $data=array(
                    'bahasa_nama'=>$this->input->post('bahasa_nama'),
                );

                $this->form_validation->set_rules('bahasa_nama', 'bahasa Perkawinan', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->bahasa_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("bahasa" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_bahasa' => form_error('bahasa_nama'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('bahasa_nama', 'bahasa Perkawinan', 'required');
                if($this->form_validation->run())
                {
                    
                    $data=array(
                        'bahasa_nama'=>$this->input->post('bahasa_nama'),
                    );
                    $this->bahasa_model->updateData($data,$bahasa_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("bahasa" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_bahasa' => form_error('bahasa_nama'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("bahasa" => FALSE,'error'=>TRUE, "message"=> "Anda tidak berhak untuk mengakases halaman ini"));
        }
    }

    function hapus($idx)
    {
        $link='admin/bahasa';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->bahasa_model->hapusData($idx);
            $response = array(
                'status'    => TRUE,
                'message'   => "Data berhasil dihapus",
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
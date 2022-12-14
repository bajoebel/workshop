<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wsclient extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('wsclient_model');
    }
    function index(){
        $link='admin/wsclient';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('client_id', 'client_name','client_status');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit(\\\"{{client_id}}\\\",\\\"{{client_name}}\\\",\\\"{{client_secret_key}}\\\",\\\"{{client_status}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus(\\\"{{client_id}}\\\")' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/wsclient/getdata',
                'variable'      => array('client_name' => 'client_name','client_id'=>'client_id','client_secret_key'=>'client_secret_key','client_status'=>'client_status'),
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
                'libjs'=>array('js/app/wsclient.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/wsclient_index','',true),
                'aktif'=>$priv->urut_menu
            );
            $this->load->view('admin/layout',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>5
            );
            $this->load->view('admin/layout',$data);
        }
        
    }

    function getdata()
    {
        $link='admin/wsclient';
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
                'row_count' => $this->wsclient_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->wsclient_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/wsclient';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $wsclient_id=$this->input->post('wsclient_id');
            
            $row=$this->wsclient_model->getDataByid($wsclient_id);
            if(empty($row)){
                $client_status=$this->input->post('client_status');
                if($client_status!='Aktif') $client_status="Non Aktif";
                $data=array(
                    'client_id'=>$this->input->post('client_id'),
                    'client_name'=>$this->input->post('client_name'),
                    'client_secret_key'=>md5($this->input->post('client_secret_key')),
                    'client_status'=>$client_status,
                );

                $this->form_validation->set_rules('client_id', 'Cara Bayar', 'required');
                // $this->form_validation->set_rules('client_status', 'Status wsclient', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->wsclient_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_client_id' => form_error('client_id'),
                        'err_client_name' => form_error('client_name'),
                        'err_client_secret_key' => form_error('err_client_secret_key'),
                        'err_client_status' => form_error('client_status'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('client_id', 'Cara Bayar', 'required');
                // $this->form_validation->set_rules('client_status', 'Status wsclient', 'required');
                if($this->form_validation->run())
                {
                    $client_status=$this->input->post('client_status');
                    if($client_status!='Aktif') $client_status="Non Aktif";
                    $data=array(
                        'client_name'=>$this->input->post('client_name'),
                        'client_status'=>$client_status,
                    );
                    $this->wsclient_model->updateData($data,$wsclient_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_client_id' => form_error('client_id'),
                        'err_client_name' => form_error('client_name'),
                        'err_client_secret_key' => form_error('err_client_secret_key'),
                        'err_client_status' => form_error('client_status'),
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
        $link='admin/wsclient';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->wsclient_model->hapusData($idx);
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
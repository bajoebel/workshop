<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Negara extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Negara_model');
    }
    function index(){
        $link='admin/negara';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('nama_negara');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{cb}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/negara/getdata',
                'variable'      => array('idx' => 'id_negara','cb'=>'nama_negara'),
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
                'libjs'=>array('js/app/negara.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/negara_index','',true),
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
        $link='admin/negara';
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
                'row_count' => $this->Negara_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Negara_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/negara';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $id_negara=$this->input->post('id_negara');
            
            $row=$this->Negara_model->getDataByid($id_negara);
            if(empty($row)){
                
                $data=array(
                    'nama_negara'=>$this->input->post('nama_negara'),
                );

                $this->form_validation->set_rules('nama_negara', 'Nama negara', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Negara_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_negara' => form_error('nama_negara'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('nama_negara', 'Nama negara', 'required');
                if($this->form_validation->run())
                {
                    
                    $data=array(
                        'nama_negara'=>$this->input->post('nama_negara'),
                    );
                    $this->Negara_model->updateData($data,$id_negara);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_negara' => form_error('nama_negara'),
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
        $link='admin/negara';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Negara_model->hapusData($idx);
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
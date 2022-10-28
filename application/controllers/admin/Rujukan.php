<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rujukan extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Rujukan_model');
    }
    function index(){
        $link='admin/rujukan';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('rujukan','=jenis[{{jenis}}]');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{cb}}\\\",{{jenis}})'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/rujukan/getdata',
                'variable'      => array('idx' => 'id_rujukan','cb'=>'rujukan','jenis'=>'jenis'),
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
                'libjs'=>array('js/app/rujukan.js'),
                'ajaxdata' => "var jenis = new Array(\"Non Faskes\", \"Faskes 1\", \"Faskes 2\", \"Kontrol Ulang\");".getData($config),
                'content'=> $this->load->view('admin/rujukan_index','',true),
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
        $link='admin/rujukan';
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
                'row_count' => $this->Rujukan_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Rujukan_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/rujukan';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $id_rujukan=$this->input->post('id_rujukan');
            
            $row=$this->Rujukan_model->getDataByid($id_rujukan);
            if(empty($row)){
                
                $data=array(
                    'rujukan'=>$this->input->post('rujukan'),
                    'jenis'=>$this->input->post('jenis')
                );

                $this->form_validation->set_rules('rujukan', 'rujukan', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Rujukan_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("rujukan" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_rujukan' => form_error('rujukan'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('rujukan', 'rujukan Perkawinan', 'required');
                if($this->form_validation->run())
                {
                    
                    $data=array(
                        'rujukan'=>$this->input->post('rujukan'),
                        'jenis'=>$this->input->post('jenis')
                    );
                    $this->Rujukan_model->updateData($data,$id_rujukan);
                    header('Content-Type: application/json');
                    echo json_encode(array("rujukan" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_rujukan' => form_error('rujukan'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("rujukan" => FALSE,'error'=>TRUE, "message"=> "Anda tidak berhak untuk mengakases halaman ini"));
        }
    }

    function hapus($idx)
    {
        $link='admin/rujukan';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Rujukan_model->hapusData($idx);
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
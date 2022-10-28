<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carabayar extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Carabayar_model');
    }
    function index(){
        $link='admin/carabayar';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('cara_bayar', 'KET');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{cb}}\\\",{{jkn}})'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/carabayar/getdata',
                'variable'      => array('idx' => 'id_cara_bayar','cb'=>'cara_bayar','jkn'=>'jkn'),
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
                'libjs'=>array('js/app/carabayar.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/carabayar_index','',true),
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
        $link='admin/carabayar';
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
                'row_count' => $this->Carabayar_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Carabayar_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/carabayar';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $id_cara_bayar=$this->input->post('id_cara_bayar');
            
            $row=$this->Carabayar_model->getDataByid($id_cara_bayar);
            if(empty($row)){
                $jkn=$this->input->post('jkn');
                // echo $jkn; exit;
                $ket=array('Umum','BPJS','Asuransi Lain','BPJS Ketenagakerjaan');
                $data=array(
                    'cara_bayar'=>$this->input->post('cara_bayar'),
                    'jkn'=>$this->input->post('jkn'),
                    'KET'=>$ket[intval($jkn)],
                );

                $this->form_validation->set_rules('cara_bayar', 'Cara Bayar', 'required');
                $this->form_validation->set_rules('jkn', 'Jenis Asuransi', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Carabayar_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_cara_bayar' => form_error('cara_bayar'),
                        'err_jkn' => form_error('jkn'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('cara_bayar', 'Cara Bayar', 'required');
                $this->form_validation->set_rules('jkn', 'Jenis Asuransi', 'required');
                if($this->form_validation->run())
                {
                    $jkn=$this->input->post('jkn');
                    // echo $jkn; exit;
                    $ket=array('Umum','BPJS','Asuransi Lain','BPJS Ketenagakerjaan');
                    $data=array(
                        'cara_bayar'=>$this->input->post('cara_bayar'),
                        'jkn'=>$this->input->post('jkn'),
                        'KET'=>$ket[intval($jkn)],
                    );
                    $this->Carabayar_model->updateData($data,$id_cara_bayar);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_cara_bayar' => form_error('cara_bayar'),
                        'err_jkn' => form_error('jkn'),
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
        $link='admin/carabayar';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Carabayar_model->hapusData($idx);
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
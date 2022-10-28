<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
    }
    function index(){
        $link='admin/kategori';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('kategori_nama', 'kategori_link','kategori_status');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{kategori_nama}}\\\",\\\"{{kategori_status}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/kategori/getdata',
                'variable'      => array('idx' => 'kategori_id','kategori_nama'=>'kategori_nama','kategori_status'=>'kategori_status'),
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
                'libjs'=>array('js/app/kategori.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/kategori_index','',true),
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
        $link='admin/kategori';
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
                'row_count' => $this->Kategori_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Kategori_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/kategori';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $kategori_id=$this->input->post('kategori_id');
            $kategori_link=str_replace(' ','_',strtolower($this->input->post('kategori_nama')));
            $kategori_link=str_replace('&','dan',$kategori_link);
            $kategori_link=preg_replace('~[\\\\/:*?"<>|]~', '', $kategori_link);
            $row=$this->Kategori_model->getDataByid($kategori_id);
            if(empty($row)){
                $kategori_status=$this->input->post('kategori_status');
                if($kategori_status!='Aktif') $kategori_status="Non Aktif";
                $data=array(
                    'kategori_nama'=>$this->input->post('kategori_nama'),
                    'kategori_link'=>$kategori_link,
                    'kategori_status'=>$kategori_status,
                );

                $this->form_validation->set_rules('kategori_nama', 'Cara Bayar', 'required');
                // $this->form_validation->set_rules('kategori_status', 'Status Kategori', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Kategori_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_kategori_nama' => form_error('kategori_nama'),
                        'err_kategori_status' => form_error('kategori_status'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('kategori_nama', 'Cara Bayar', 'required');
                // $this->form_validation->set_rules('kategori_status', 'Status Kategori', 'required');
                if($this->form_validation->run())
                {
                    $kategori_status=$this->input->post('kategori_status');
                    if($kategori_status!='Aktif') $kategori_status="Non Aktif";
                    $data=array(
                        'kategori_nama'=>$this->input->post('kategori_nama'),
                        'kategori_status'=>$kategori_status,
                        'kategori_link'=>$kategori_link,
                    );
                    $this->Kategori_model->updateData($data,$kategori_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_kategori_nama' => form_error('kategori_nama'),
                        'err_kategori_status' => form_error('kategori_status'),
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
        $link='admin/kategori';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Kategori_model->hapusData($idx);
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
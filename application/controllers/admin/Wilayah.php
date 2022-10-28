<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Wilayah_model');
    }
    function index(){
        $link='admin/wilayah';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('provinsi','kabkota','nama_kabkota','kecamatan','desa','kode_pos');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit(\\\"{{idx}}\\\",\\\"{{provinsi}}\\\",\\\"{{kabkota}}\\\",\\\"{{nama_kabkota}}\\\",\\\"{{kecamatan}}\\\",\\\"{{desa}}\\\",\\\"{{kode_pos}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/wilayah/getdata',
                'variable'      => array('idx' => 'wilayah_id','provinsi'=>'provinsi','kabkota'=>'kabkota','nama_kabkota'=>'nama_kabkota','kecamatan'=>'kecamatan','desa'=>'desa','kode_pos'=>'kode_pos'),
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
                'libjs'=>array('js/app/wilayah.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/wilayah_index','',true),
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
        $link='admin/wilayah';
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
                'row_count' => $this->Wilayah_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Wilayah_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/wilayah';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $wilayah_id=$this->input->post('wilayah_id');
            
            $row=$this->Wilayah_model->getDataByid($wilayah_id);
            if(empty($row)){
                
                $data=array(
                    'wilayah_id'=>$this->Wilayah_model->createId(),
                    'provinsi'=>$this->input->post('provinsi'),
                    'kabkota'=>$this->input->post('kabkota'),
                    'nama_kabkota'=>$this->input->post('nama_kabkota'),
                    'kecamatan'=>$this->input->post('kecamatan'),
                    'desa'=>$this->input->post('desa'),
                    'kode_pos'=>$this->input->post('kode_pos')
                );

                $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
                $this->form_validation->set_rules('kabkota', 'Kab Kota', 'required');
                $this->form_validation->set_rules('nama_kabkota', 'Nama Kab/Kota', 'required');
                $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
                $this->form_validation->set_rules('desa', 'Desa', 'required');
                if($this->form_validation->run())
                {
                    $insert = $this->Wilayah_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_provinsi' => form_error('provinsi'),
                        'err_kabkota' => form_error('kabkota'),
                        'err_nama_kakota' => form_error('nama_kabkota'),
                        'err_kecamatan' => form_error('kecamatan'),
                        'err_desa' => form_error('desa'),
                        'err_kode_pos' => form_error('kode_pos'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
                $this->form_validation->set_rules('kabkota', 'Kab Kota', 'required');
                $this->form_validation->set_rules('nama_kabkota', 'Nama Kab/Kota', 'required');
                $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
                $this->form_validation->set_rules('desa', 'Desa', 'required');
                if($this->form_validation->run())
                {
                    
                    $data=array(
                        'provinsi'=>$this->input->post('provinsi'),
                        'kabkota'=>$this->input->post('kabkota'),
                        'nama_kabkota'=>$this->input->post('nama_kabkota'),
                        'kecamatan'=>$this->input->post('kecamatan'),
                        'desa'=>$this->input->post('desa'),
                        'kode_pos'=>$this->input->post('kode_pos')
                    );
                    $this->Wilayah_model->updateData($data,$wilayah_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_provinsi' => form_error('provinsi'),
                        'err_kabkota' => form_error('kabkota'),
                        'err_nama_kakota' => form_error('nama_kabkota'),
                        'err_kecamatan' => form_error('kecamatan'),
                        'err_desa' => form_error('desa'),
                        'err_kode_pos' => form_error('kode_pos'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("wilayah" => FALSE,'error'=>TRUE, "message"=> "Anda tidak berhak untuk mengakases halaman ini"));
        }
    }

    function hapus($idx)
    {
        $link='admin/wilayah';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Wilayah_model->hapusData($idx);
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
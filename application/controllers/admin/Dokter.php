<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Dokter_model');
    }
    function index(){
        $link='admin/dokter';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('nrp','spesialis_nama','dokter_nama','dokter_jekel','dokter_notelp','dokter_jenis','dokter_status');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{nrp}}\\\",\\\"{{dokter_spesialis_id}}\\\",\\\"{{dokter_nama}}\\\",\\\"{{dokter_notelp}}\\\",\\\"{{dokter_jenis}}\\\",\\\"{{dokter_status}}\\\",\\\"{{dokter_jekel}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/dokter/getdata',
                'variable'      => array(
                    'idx' => 'dokter_id',
                    'nrp'=>'nrp',
                    'dokter_jekel'=>'dokter_jekel',
                    'dokter_spesialis_id'=>'dokter_spesialis_id',
                    'dokter_nama'=>'dokter_nama',
                    'dokter_notelp'=>'dokter_notelp',
                    'dokter_status'=>'dokter_status',
                    'dokter_jenis'=>'dokter_jenis',
                ),
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
            $get=array(
                'spesialis'=>$this->Dokter_model->getSpesialis()
            );
            $data=array(
                'libjs'=>array('js/app/dokter.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/dokter_index',$get,true),
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
        $link='admin/dokter';
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
                'row_count' => $this->Dokter_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Dokter_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/dokter';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $dokter_id=$this->input->post('dokter_id');
            $row=$this->Dokter_model->getDataByid($dokter_id);
            $create_dir = "rsud-backend/public/img/dokter/";
            $file_type="jpg|jpeg|gif|tiff";
            if (!file_exists($create_dir)) {
                mkdir($create_dir, 0777, true);
            }
            $res = $this->Dokter_model->upload_files($create_dir, '', $_FILES['dokter_fhoto'], $file_type);
            if($res['status']==true) $fhoto = $res["images"][0]; else $fhoto="";
            $dokter_status=$this->input->post('dokter_status');
            if($dokter_status!='Aktif') $dokter_status="Non Aktif";
            if($fhoto==""){
                $data=array(
                    'nrp'=>$this->input->post('nrp'),
                    'dokter_jekel'=>$this->input->post('dokter_jekel'),
                    'dokter_spesialis_id'=>$this->input->post('dokter_spesialis_id'),
                    'dokter_nama'=>$this->input->post('dokter_nama'),
                    'dokter_notelp'=>$this->input->post('dokter_notelp'),
                    'dokter_status'=>$dokter_status,
                    'dokter_jenis'=>$this->input->post('dokter_jenis'),
                );
            }else{
                $data=array(
                    'nrp'=>$this->input->post('nrp'),
                    'dokter_jekel'=>$this->input->post('dokter_jekel'),
                    'dokter_spesialis_id'=>$this->input->post('dokter_spesialis_id'),
                    'dokter_nama'=>$this->input->post('dokter_nama'),
                    'dokter_notelp'=>$this->input->post('dokter_notelp'),
                    'dokter_status'=>$dokter_status,
                    'dokter_jenis'=>$this->input->post('dokter_jenis'),
                    'dokter_fhoto'=>$fhoto
                );
            }

            if(empty($row)){
                $this->form_validation->set_rules('nrp', 'NRP', 'required');
                $this->form_validation->set_rules('dokter_jekel', 'Jenis Kelamin', 'required');
                $this->form_validation->set_rules('dokter_spesialis_id', 'Spesialisasi', 'required');
                $this->form_validation->set_rules('dokter_nama', 'Nama Dokter', 'required');
                $this->form_validation->set_rules('dokter_notelp', 'No telp', 'required');
                $this->form_validation->set_rules('dokter_jenis', 'Jenis dokter', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Dokter_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_nrp' => form_error('nrp'),
                        'err_dokter_jekel' => form_error('dokter_jekel'),
                        'err_dokter_spesialis_id' => form_error('dokter_spesialis_id'),
                        'err_dokter_nama' => form_error('dokter_nama'),
                        'err_dokter_notelp' => form_error('dokter_notelp'),
                        'err_dokter_jenis' => form_error('dokter_jenis'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('nrp', 'NRP', 'required');
                $this->form_validation->set_rules('dokter_jekel', 'Jenis Kelamin', 'required');
                $this->form_validation->set_rules('dokter_spesialis_id', 'Spesialisasi', 'required');
                $this->form_validation->set_rules('dokter_nama', 'Nama Dokter', 'required');
                $this->form_validation->set_rules('dokter_notelp', 'No telp', 'required');
                $this->form_validation->set_rules('dokter_jenis', 'Jenis dokter', 'required');
                if($this->form_validation->run())
                {
                    // $dokter_status=$this->input->post('dokter_status');
                    // if($dokter_status!='Aktif') $dokter_status="Non Aktif";
                    // $data=array(
                    //     'nrp'=>$this->input->post('nrp'),
                    //     'dokter_jekel'=>$this->input->post('dokter_jekel'),
                    //     'dokter_spesialis_id'=>$this->input->post('dokter_spesialis_id'),
                    //     'dokter_nama'=>$this->input->post('dokter_nama'),
                    //     'dokter_notelp'=>$this->input->post('dokter_notelp'),
                    //     'dokter_status'=>$dokter_status,
                    //     'dokter_jenis'=>$this->input->post('dokter_jenis'),
                    // );
                    $this->Dokter_model->updateData($data,$dokter_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_nrp' => form_error('nrp'),
                        'err_dokter_jekel' => form_error('dokter_jekel'),
                        'err_dokter_spesialis_id' => form_error('dokter_spesialis_id'),
                        'err_dokter_nama' => form_error('dokter_nama'),
                        'err_dokter_notelp' => form_error('dokter_notelp'),
                        'err_dokter_jenis' => form_error('dokter_jenis'),
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
        $link='admin/dokter';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Dokter_model->hapusData($idx);
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
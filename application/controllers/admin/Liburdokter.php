<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Liburdokter extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Liburdokter_model');
    }
    function index(){
        $link='admin/liburdokter';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('libur_tgl','dokter_nama','poly_nama','libur_keterangan');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{libur_tgl}}\\\",\\\"{{libur_jadwalid}}\\\",\\\"{{libur_keterangan}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/liburdokter/getdata',
                'variable'      => array('idx' => 'libur_id','libur_tgl'=>'libur_tgl','libur_jadwalid'=>'libur_jadwalid','libur_keterangan'=>'libur_keterangan'),
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
                'libjs'=>array(
                    'component/inputmask/dist/jquery.inputmask.bundle.js',
                    'component/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
                    'js/app/liburdokter.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/liburdokter_index','',true),
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
        $link='admin/liburdokter';
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
                'row_count' => $this->Liburdokter_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Liburdokter_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/liburdokter';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $libur_id=$this->input->post('libur_id');
            
            $row=$this->Liburdokter_model->getDataByid($libur_id);
            if(empty($row)){
                $data=array(
                    'libur_tgl'=>$this->input->post('libur_tgl'),
                    'libur_jadwalid'=>$this->input->post('libur_jadwalid'),
                    'libur_keterangan'=>$this->input->post('libur_keterangan')
                );

                $this->form_validation->set_rules('libur_tgl', 'Tanggal Libur', 'required');
                $this->form_validation->set_rules('libur_keterangan', 'Keterangan', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Liburdokter_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_libur_tgl' => form_error('libur_tgl'),
                        'err_libur_keterangan' => form_error('libur_keterangan'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('libur_tgl', 'Tanggal Libur', 'required');
                $this->form_validation->set_rules('libur_keterangan', 'Keterangan', 'required');
                if($this->form_validation->run())
                {
                    $data=array(
                        'libur_tgl'=>$this->input->post('libur_tgl'),
                        'libur_jadwalid'=>$this->input->post('libur_jadwalid'),
                        'libur_keterangan'=>$this->input->post('libur_keterangan')
                    );
                    $this->Liburdokter_model->updateData($data,$libur_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_libur_tgl' => form_error('libur_tgl'),
                        'err_libur_keterangan' => form_error('libur_keterangan'),
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
        $link='admin/liburdokter';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Liburdokter_model->hapusData($idx);
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
    function jadwal($tgl){
        $tanggal=date_create($tgl);
        $hari=date('D', strtotime(date_format($tanggal,'Y-m-d')));
        $list_hari=array(
            'Sun' => "Minggu",
            'Mon' => "Senin",
            'Tue' => "Selasa",
            'Wed' => "Rabu",
            'Thu' => "Kamis",
            'Fri' => "Jumat",
            'Sat' => "Sabtu"
        );
        $dokter=$this->Liburdokter_model->getJadwaldokter($list_hari[$hari]);
        header('Content-Type: application/json');
        echo json_encode($dokter);
        // print_r($date);
    }
}
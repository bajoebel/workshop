<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bed extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Bed_model');
    }
    function index(){
        $link='admin/bed';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('map_ruangid', 'ruang_perawatan','map_kelasid','kelas_nama','grNama','map_kapasitas','map_isipr','map_isilk','map_penempatan');
            // $action = "<div class='btn-group'><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Batal</button></div>";
            $action ="";
            $config = array(
                'url'           => 'admin/bed/getdata',
                'variable'      => array('idx' => 'idx'),
                'field'         => $field,
                'function'      => 'getData',
                'keyword_id'    => 'q',
                'param_id'      => array('ruang'=>'ruang','kelas'=>'kelas'),
                'limit_id'      => 'limit',
                'data_id'       => 'data',
                'page_id'       => 'pagination',
                'number'        => true,
                'action'        => false,
                'load'          => true,
                'action_button' => $action,
            );
            $res=array(
                'ruang'=>$this->Bed_model->getRuang(),
                'kelas'=>$this->Bed_model->getKelas(),
            );
            $data=array(
                'libjs'=>array(
                    'component/inputmask/dist/jquery.inputmask.bundle.js',
                    'component/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
                    'js/app/bed.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/bed_index',$res,true),
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
        $link='admin/bed';
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
                'row_count' => $this->Bed_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Bed_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function batal($idx)
    {
        $link='admin/bed';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Bed_model->batalDaftar($idx);
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
    function kembali($idx)
    {
        $link='admin/bed';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Bed_model->kembaliDaftar($idx);
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
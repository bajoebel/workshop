<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Pasien_model');
    }
    function index(){
        $link='admin/pasien';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('nomr', 'no_ktp','nama','{{tempat_lahir}}/{{tgl_lahir}}','=jekel[{{jns_kelamin}}]','alamat kel {{nama_kelurahan}} Kec {{nama_kecamatan}} {{nama_kab_kota}} Prov {{nama_provinsi}}','no_telpon','suku','bahasa','agama','pekerjaan');
            $action = "<div class='btn-group'><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Batal</button></div>";
            $config = array(
                'url'           => 'admin/pasien/getdata',
                'variable'      => array('idx' => 'idx','tempat_lahir'=>'tempat_lahir','tgl_lahir'=>'tgl_lahir','jns_kelamin'=>'jns_kelamin','nama_kelurahan'=>'nama_kelurahan','nama_kecamatan'=>'nama_kecamatan','nama_kab_kota'=>'nama_kab_kota','nama_provinsi'=>'nama_provinsi'),
                'field'         => $field,
                'function'      => 'getData',
                'keyword_id'    => 'q',
                'param_id'      => array(),
                'limit_id'      => 'limit',
                'data_id'       => 'data',
                'page_id'       => 'pagination',
                'number'        => true,
                'action'        => false,
                'load'          => true,
                'action_button' => $action,
            );
            $res=array(
                'poli'=>$this->Pasien_model->getPoly()
            );
            $data=array(
                'libjs'=>array(
                    'component/inputmask/dist/jquery.inputmask.bundle.js',
                    'component/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
                    'js/app/pasien.js'),
                'ajaxdata' =>"let jekel={0:'Perempuan',1:'Laki-Laki','L':'Laki-Laki','P':'Perempuan'}" .getData($config),
                'content'=> $this->load->view('admin/pasien_index',$res,true),
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
        $link='admin/pasien';
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
                'row_count' => $this->Pasien_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Pasien_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function batal($idx)
    {
        $link='admin/pasien';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Pasien_model->batalDaftar($idx);
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
        $link='admin/pasien';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Pasien_model->kembaliDaftar($idx);
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
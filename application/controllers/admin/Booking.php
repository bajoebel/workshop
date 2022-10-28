<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model');
    }
    function index(){
        $link='admin/booking';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            // $field=array('nomr', 'no_ktp','nama_pasien','tanggal_daftar','{{label_antrian}}.{{nomor_daftar}}','tanggal_kunjungan','jam_kunjunganAntrian','nama_ruang','rujukan','cara_bayar','namaDokterJaga','status_berobat');
            // $action = "<div class='btn-group'><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Batal</button></div>";
            // $config = array(
            //     'url'           => 'admin/booking/getdata',
            //     'variable'      => array('idx' => 'idx','tempat_lahir'=>'tempat_lahir','tgl_lahir'=>'tgl_lahir','label_antrian'=>'label_antrian','nomor_daftar'=>'nomor_daftar'),
            //     'field'         => $field,
            //     'function'      => 'getData',
            //     'keyword_id'    => 'q',
            //     'param_id'      => array('tgl'=>'tanggal','ruang'=>'poliklinik'),
            //     'limit_id'      => 'limit',
            //     'data_id'       => 'data',
            //     'page_id'       => 'pagination',
            //     'number'        => true,
            //     'action'        => true,
            //     'load'          => true,
            //     'action_button' => $action,
            // );
            $res=array(
                'poli'=>$this->Booking_model->getPoly()
            );
            $data=array(
                'libjs'=>array(
                    'component/inputmask/dist/jquery.inputmask.bundle.js',
                    'component/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
                    'js/app/booking.js'),
                'ajaxdata' => '',
                'content'=> $this->load->view('admin/booking_index',$res,true),
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
        $link='admin/booking';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $q = urldecode($this->input->get('keyword', TRUE));
            $tgl = urldecode($this->input->get('tgl', TRUE));
            $ruang = intval($this->input->get('ruang'));
            $start = intval($this->input->get('start'));
            $limit = intval($this->input->get('limit'));
            $mulai = ($start * $limit) - $limit;
            $response = array(
                'status'    => true,
                'message'   => "OK",
                'start'     => $mulai,
                'row_count' => $this->Booking_model->countData($q,$tgl,$ruang),
                'limit'     => $limit,
                'data'      => $this->Booking_model->getData($limit, $mulai, $q,$tgl,$ruang),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function batal($idx)
    {
        $link='admin/booking';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Booking_model->batalDaftar($idx);
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
        $link='admin/booking';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Booking_model->kembaliDaftar($idx);
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
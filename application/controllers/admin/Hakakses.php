<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hakakses extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Hakakses_model');
    }
    function index(){
        $link='admin/hakakses';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('level', '=aktif[{{aktif}}]');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{level}}\\\",\\\"{{aktif}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/hakakses/getdata',
                'variable'      => array('idx' => 'idx','level'=>'level','aktif'=>'aktif'),
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
            $res=array(
                'menu'=>$this->Hakakses_model->getModul()
            );
            $data=array(
                'libjs'=>array('js/app/hakakses.js'),
                'ajaxdata' => "var aktif=new Array(\"Non Aktif\",\"Aktif\")".getData($config),
                'content'=> $this->load->view('admin/hakakses_index',$res,true),
                'aktif'=>$priv->urut_menu
            );
            $this->load->view('admin/layout',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>6
            );
            $this->load->view('admin/layout',$data);
        }
        
    }

    function getdata()
    {
        $link='admin/hakakses';
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
                'row_count' => $this->Hakakses_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Hakakses_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/hakakses';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $idx=$this->input->post('idx');
            
            $row=$this->Hakakses_model->getDataByid($idx);
            if(empty($row)){
                $status=$this->input->post('aktif');
                if($status!=1) $status=0;
                $data=array(
                    'level'=>$this->input->post('level'),
                    'aktif'=>$status,
                );

                $this->form_validation->set_rules('level', 'Level', 'required');
                // $this->form_validation->set_rules('aktif', 'Status hakakses', 'required');
                if($this->form_validation->run())
                {
                    $insert = $this->Hakakses_model->simpanData($data);
                    $idx_modul=$this->input->post('idx_modul');
                    foreach ($idx_modul as $i ) {
                        $pilih=intval($this->input->post('pilih'.$i));
                        if($pilih>0){
                            $hakakses[]=array(
                                'idx_level'=>$insert,
                                'idx_modul'=>$i
                            );
                        }
                        
                    }
                    if(!empty($hakakses)){
                        $this->db->insert_batch('stx_hakakses',$hakakses);
                    }
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_level' => form_error('level'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('level', 'Level', 'required');
                // $this->form_validation->set_rules('aktif', 'Status hakakses', 'required');
                if($this->form_validation->run())
                {
                    $aktif=$this->input->post('aktif');
                    if($aktif!=1) $aktif=0;
                    $hak=$this->input->post('hak');
                    $data=array(
                        'level'=>$this->input->post('level'),
                        'aktif'=>$aktif,
                    );
                    $this->Hakakses_model->updateData($data,$idx);

                    $idx_modul=$this->input->post('idx_modul');
                    foreach ($idx_modul as $i ) {
                        $pilih=intval($this->input->post('pilih'.$i));
                        if($pilih>0){
                            $hakakses[]=array(
                                'idx_level'=>$idx,
                                'idx_modul'=>$i
                            );
                        }
                        
                    }

                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_level' => form_error('level'),
                        'err_aktif' => form_error('aktif'),
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
        $link='admin/hakakses';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Hakakses_model->hapusData($idx);
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
    function level($idx){
        $link='admin/hakakses';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $res=array(
                'menu'=>$this->Hakakses_model->getModul(),
                'hak'=>$this->Hakakses_model->getHakakses($idx)
            );
            $response = array(
                'status'    => true,
                
                'hakakses' =>$this->load->view('admin/hakakses_privilege',$res,true),
                'message'   => "Data berhasil dihapus",
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
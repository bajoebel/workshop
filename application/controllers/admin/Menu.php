<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
    }
    function index(){
        $link='admin/menu';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('kode','menu_judul', 'menu_link','menu_status');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{menu_judul}}\\\",\\\"{{menu_link}}\\\",\\\"{{menu_idxutama}}\\\",\\\"{{menu_idxanak}}\\\",\\\"{{menu_idxsub}}\\\",\\\"{{menu_baseurl}}\\\",\\\"{{menu_status}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/menu/getdata',
                'variable'      => array('idx' => 'menu_id','menu_judul'=>'menu_judul','menu_link'=>'menu_link','menu_idxutama'=>'menu_idxutama','menu_idxanak'=>'menu_idxanak','menu_idxsub'=>'menu_idxsub','menu_status'=>'menu_status'),
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
                'libjs'=>array('js/app/menu.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/menu_index','',true),
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
        $link='admin/menu';
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
                'row_count' => $this->Menu_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Menu_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/menu';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $menu_id=$this->input->post('menu_id');
            
            $row=$this->Menu_model->getDataByid($menu_id);
            if(empty($row)){
                $menu_status=$this->input->post('menu_status');
                if($menu_status!=1) $menu_status=0;
                $menu_baseurl=$this->input->post('menu_baseurl');
                if($menu_baseurl!=1) $menu_baseurl=0;
                $data=array(
                    'menu_judul'=>$this->input->post('menu_judul'),
                    'menu_link'=>$this->input->post('menu_link'),
                    'menu_idxutama'=>$this->input->post('menu_idxutama'),
                    'menu_idxanak'=>$this->input->post('menu_idxanak'),
                    'menu_idxsub'=>$this->input->post('menu_idxsub'),
                    'menu_baseurl'=>$menu_baseurl,
                    'menu_status'=>$menu_status,
                );

                $this->form_validation->set_rules('menu_judul', 'Judul', 'required');
                $this->form_validation->set_rules('menu_link', 'Link', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Menu_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_menu_judul' => form_error('menu_judul'),
                        'err_menu_link' => form_error('menu_link'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('menu_judul', 'Judul', 'required');
                $this->form_validation->set_rules('menu_link', 'Link', 'required');
                if($this->form_validation->run())
                {
                    $menu_status=$this->input->post('menu_status');
                    if($menu_status!=1) $menu_status=0;
                    $menu_baseurl=$this->input->post('menu_baseurl');
                    if($menu_baseurl!=1) $menu_baseurl=0;
                    $data=array(
                        'menu_judul'=>$this->input->post('menu_judul'),
                        'menu_link'=>$this->input->post('menu_link'),
                        'menu_idxutama'=>$this->input->post('menu_idxutama'),
                        'menu_idxanak'=>$this->input->post('menu_idxanak'),
                        'menu_idxsub'=>$this->input->post('menu_idxsub'),
                        'menu_baseurl'=>$menu_baseurl,
                        'menu_status'=>$menu_status,
                    );
                    $this->Menu_model->updateData($data,$menu_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_menu_judul' => form_error('menu_judul'),
                        'err_menu_status' => form_error('menu_status'),
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
        $link='admin/menu';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Menu_model->hapusData($idx);
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
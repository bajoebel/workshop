<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    function index(){
        $link='admin/user';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('user_nama_lengkap','user_email','level','user_status');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{user_nama_lengkap}}\\\",\\\"{{user_email}}\\\",\\\"{{user_idxlevel}}\\\",\\\"{{user_password}}\\\",\\\"{{user_status}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/user/getdata',
                'variable'      => array('idx' => 'user_id','user_nama_lengkap'=>'user_nama_lengkap','user_email'=>'user_email','user_idxlevel'=>'user_idxlevel','user_password'=>'user_password','user_status'=>'user_status'),
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
                'level'=>$this->User_model->getLevel()
            );
            $data=array(
                'libjs'=>array(
                    'component/inputmask/dist/jquery.inputmask.bundle.js',
                    'component/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
                    'js/app/user.js'),
                'ajaxdata' => getData($config),
                'content'=> $this->load->view('admin/user_index',$res,true),
                'aktif'=>$priv->urut_menu
            );
            $this->load->view('admin/layout',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>5
            );
            $this->load->view('admin/layout',$data);
        }
        
    }

    function getdata()
    {
        $link='admin/user';
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
                'row_count' => $this->User_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->User_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/user';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $user_id=$this->input->post('user_id');
            $foto="";
            $row=$this->User_model->getDataByid($user_id);
            $create_dir = "rsud-backend/public/img/user/";
            $file_type="jpg|jpeg|gif|tiff";
            if (!file_exists($create_dir)) {
                mkdir($create_dir, 0777, true);
            }
            $res = $this->User_model->upload_files($create_dir, '', $_FILES['user_photo'], $file_type);
            if($res['status']==true) $fhoto = $res["images"][0]; else $fhoto="";

            if(empty($row)){
                $user_status=$this->input->post('user_status');
                if($user_status!="Aktif") $user_status="Non Aktif"; 
                if(!empty($fhoto)){
                    $data=array(
                        'user_nama_lengkap'=>$this->input->post('user_nama_lengkap'),
                        'user_email'=>$this->input->post('user_email'),
                        'user_password'=>md5($this->input->post('user_password')),
                        'user_status'=>$user_status,
                        'user_photo'=>$fhoto,
                        'user_idxlevel'=>$this->input->post('user_idxlevel')
                    );
                }else{
                    $data=array(
                        'user_nama_lengkap'=>$this->input->post('user_nama_lengkap'),
                        'user_email'=>$this->input->post('user_email'),
                        'user_password'=>md5($this->input->post('user_password')),
                        'user_status'=>$user_status,
                        'user_idxlevel'=>$this->input->post('user_idxlevel')
                    );
                }
                

                $this->form_validation->set_rules('user_nama_lengkap', 'Nama Lengkap', 'required');
                $this->form_validation->set_rules('user_email', 'Alamat Email', 'required');
                $this->form_validation->set_rules('user_password', 'Password', 'required');
                $this->form_validation->set_rules('user_idxlevel', 'Level', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->User_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_user_nama_lengkap' => form_error('user_nama_lengkap'),
                        'err_user_email' => form_error('user_email'),
                        'err_user_idxlevel' => form_error('user_idxlevel'),
                        'err_user_password' => form_error('user_password'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                $user_status=$this->input->post('user_status');
                if($user_status!="Aktif") $user_status="Non Aktif"; 
                $this->form_validation->set_rules('user_nama_lengkap', 'Tanggal Libur', 'required');
                $this->form_validation->set_rules('user_email', 'Alamat Email', 'required');
                if($this->form_validation->run())
                {
                    if(!empty($fhoto)){
                        $data=array(
                            'user_nama_lengkap'=>$this->input->post('user_nama_lengkap'),
                            'user_email'=>$this->input->post('user_email'),
                            'user_status'=>$user_status,
                            'user_photo'=>$fhoto,
                            'user_idxlevel'=>$this->input->post('user_idxlevel')
                        );
                    }else{
                        $data=array(
                            'user_nama_lengkap'=>$this->input->post('user_nama_lengkap'),
                            'user_email'=>$this->input->post('user_email'),
                            'user_status'=>$user_status,
                            'user_idxlevel'=>$this->input->post('user_idxlevel')
                        );
                    }
                    
                    $this->User_model->updateData($data,$user_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_user_nama_lengkap' => form_error('user_nama_lengkap'),
                        'err_user_email' => form_error('user_email'),
                        'err_user_idxlevel'=>$this->input->post('user_idxlevel')
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
        $link='admin/user';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->User_model->hapusData($idx);
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
        $dokter=$this->User_model->getJadwaldokter($list_hari[$hari]);
        header('Content-Type: application/json');
        echo json_encode($dokter);
        // print_r($date);
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Media_model');
    }
    function index(){
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            
            $data=array(
                'libjs'=>array('js/app/media.js'),
                'content'=> $this->load->view('admin/media_index','',true),
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
        $link='admin/media';
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
                'row_count' => $this->Media_model->countData($q),
                'limit'     => $limit,
                'data'      => $this->Media_model->getData($limit, $mulai, $q),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $media_id=$this->input->post('media_id');
            $media_link=str_replace(' ','_',strtolower($this->input->post('media_nama')));
            $media_link=str_replace('&','dan',$media_link);
            $media_link=preg_replace('~[\\\\/:*?"<>|]~', '', $media_link);
            $row=$this->Media_model->getDataByid($media_id);
            if(empty($row)){
                $media_status=$this->input->post('media_status');
                if($media_status!='Aktif') $media_status="Non Aktif";
                $data=array(
                    'media_nama'=>$this->input->post('media_nama'),
                    'media_link'=>$media_link,
                    'media_status'=>$media_status,
                );

                $this->form_validation->set_rules('media_nama', 'Cara Bayar', 'required');
                // $this->form_validation->set_rules('media_status', 'Status media', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Media_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_media_nama' => form_error('media_nama'),
                        'err_media_status' => form_error('media_status'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('media_nama', 'Cara Bayar', 'required');
                // $this->form_validation->set_rules('media_status', 'Status media', 'required');
                if($this->form_validation->run())
                {
                    $media_status=$this->input->post('media_status');
                    if($media_status!='Aktif') $media_status="Non Aktif";
                    $data=array(
                        'media_nama'=>$this->input->post('media_nama'),
                        'media_status'=>$media_status,
                        'media_link'=>$media_link,
                    );
                    $this->Media_model->updateData($data,$media_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_media_nama' => form_error('media_nama'),
                        'err_media_status' => form_error('media_status'),
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
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Media_model->hapusData($idx);
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

    function filemanager(){
        $dir_path=$this->input->get("dir");
        $directories = scandir($dir_path);
        $urut=0;
        echo "<div class='row'>";
        foreach($directories as $entry) {
            $urut++;
            if (is_dir($dir_path . "/" . $entry) && !in_array($entry, array('.','..'))) {
                echo "<div class='col-md-1 col-xs-3' style='text-align:center;font-weight:bold'><a href='#' onmousedown='cekAction(event,\"".$entry."\")'><img src='".base_url() ."img/icon/folder.png"."' class='img img-responsive' /></a>".$entry."</div>";
                // echo "<a href=?directory=" . $dir_path . "" . $entry . "/" . "><li>" . $entry . "</li></a>";
            }
            else {
                $e=array('doc','docx','xls','xlsx','pdf','zip','rar','txt','js','css','html');
                $e1=array('jpg','jpeg','gif','tiff',);
                $ex=explode(".",$entry);
                // print_r($ex);
                $ext=end($ex);
                if(in_array($ext,$e)) $file_link=base_url() ."img/icon/$ext.png";
                // elseif(in_array($ext,$e1)) $file_link=base_url() .$dir_path.$entry;
                elseif(in_array($ext,$e1)) $file_link=str_replace('./',base_url(),$dir_path) ."/".$entry;
                else $file_link=base_url() ."img/icon/txt.png";;
                if($entry!="." && $entry!=".." && $entry!="")
                echo "<div class='col-md-1 col-xs-3' style='text-align:center;font-weight:bold' ><a href='".base_url() .$dir_path.$entry."' onclick='openDir(\"".$entry."\")'>
                <img src='$file_link' class='img img-responsive' /></a>".$entry."</div>";
            }
        }
        echo "</div>";
    }
    function createfolder(){
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $curdir=$this->input->post('curent_dir');
            $newfolder=$this->input->post('newfolder');
            $create_dir = $curdir."/".$newfolder;
            if (!file_exists($create_dir)) {
                mkdir($create_dir, 0777, true);
                $response = array(
                    'status'    => true,
                    'message'   => "OK",
                );
            }else{
                $response = array(
                    'status'    => false,
                    'message'   => "GagalMembuat Folder",
                );
            }

            
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function uploadfile(){
        $link='admin/media';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $create_dir=$this->input->post('curent_dir1');
            $file_type="jpg|jpeg|gif|tiff|pdf|doc|docx|xls|xlsx|zip|rar|odt|avi|mp4";
            $res = $this->Media_model->upload_files($create_dir, '', $_FILES['userfile'], $file_type);
            if($res['status']==true) {
                $response=array('status'=>true,'message'=>'OK');
            }else{
                $response=array('status'=>false,'message'=>$res["message"]);
            }
            
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
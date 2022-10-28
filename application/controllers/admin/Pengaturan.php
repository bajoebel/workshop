<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Pengaturan_model');
    }
    function index(){
        $link='admin/pengaturan';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $res=array(
                'set'=>$this->Pengaturan_model->getSet()
            );
            $data=array(
                'libjs'=>array('js/app/pengaturan.js'),
                'ajaxdata' => "",
                'content'=> $this->load->view('admin/pengaturan_index',$res,true),
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
    function getDataByid($set_id){
        $this->db->where('set_id',$set_id);
        return $this->db->get('stx_pengaturan')->row();
    }
    function simpan(){
        $link='admin/pengaturan';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $set_id=$this->input->post('set_id');
            
            $row=$this->Pengaturan_model->getDataByid($set_id);
            if(empty($row)){
                $set_status=$this->input->post('set_status');
                if($set_status!='Aktif') $set_status="Non Aktif";
                $set_kajian_mandiri_covid=$this->input->post('set_kajian_mandiri_covid');
                if($set_kajian_mandiri_covid!=1) $set_kajian_mandiri_covid=0;
                $data=array(
                    'set_jadwal_daftar_m'=>$this->input->post('set_jadwal_daftar_m'),
                    'set_jadwal_daftar_s'=>$this->input->post('set_jadwal_daftar_s'),
                    'set_jam_daftar_s'=>$this->input->post('set_jam_daftar_s'),
                    'set_lama_blokir'=>$this->input->post('set_lama_blokir'),
                    'set_pesan'=>$this->input->post('set_pesan'),
                    'set_kajian_mandiri_covid'=>$set_kajian_mandiri_covid,
                    'set_status'=>$set_status,
                );

                $this->form_validation->set_rules('set_jadwal_daftar_m', 'Mulai Buka', 'required');
                $this->form_validation->set_rules('set_jadwal_daftar_s', 'Selesai Buka', 'required');
                $this->form_validation->set_rules('set_jam_daftar_s', 'Jam Daftar Terakhir', 'required');
                $this->form_validation->set_rules('set_lama_blokir', 'Lama Blokir', 'required');
                $this->form_validation->set_rules('set_pesan', 'Pesan Tutup', 'required');
                // $this->form_validation->set_rules('pengaturan_status', 'Status pengaturan', 'required');
                if($this->form_validation->run())
                {
                    
                    $insert = $this->Pengaturan_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_set_jadwal_daftar_m' => form_error('set_jadwal_daftar_m'),
                        'err_set_jadwal_daftar_s' => form_error('set_jadwal_daftar_s'),
                        'err_set_jam_daftar_s' => form_error('set_jam_daftar_s'),
                        'err_set_lama_blokir' => form_error('set_lama_blokir'),
                        'err_set_pesan' => form_error('set_pesan'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('set_jadwal_daftar_m', 'Mulai Buka', 'required');
                $this->form_validation->set_rules('set_jadwal_daftar_s', 'Selesai Buka', 'required');
                $this->form_validation->set_rules('set_jam_daftar_s', 'Jam Daftar Terakhir', 'required');
                $this->form_validation->set_rules('set_lama_blokir', 'Lama Blokir', 'required');
                $this->form_validation->set_rules('set_pesan', 'Pesan Tutup', 'required');
                if($this->form_validation->run())
                {
                    $set_status=$this->input->post('set_status');
                    if($set_status!='Aktif') $set_status="Non Aktif";
                    $set_kajian_mandiri_covid=$this->input->post('set_kajian_mandiri_covid');
                    if($set_kajian_mandiri_covid!=1) $set_kajian_mandiri_covid=0;
                    
                    $data=array(
                        'set_jadwal_daftar_m'=>$this->input->post('set_jadwal_daftar_m'),
                        'set_jadwal_daftar_s'=>$this->input->post('set_jadwal_daftar_s'),
                        'set_jam_daftar_s'=>$this->input->post('set_jam_daftar_s'),
                        'set_lama_blokir'=>$this->input->post('set_lama_blokir'),
                        'set_pesan'=>$this->input->post('set_pesan'),
                        'set_kajian_mandiri_covid'=>$set_kajian_mandiri_covid,
                        'set_status'=>$set_status,
                    );
                    $this->Pengaturan_model->updateData($data,$set_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_set_jadwal_daftar_m' => form_error('set_jadwal_daftar_m'),
                        'err_set_jadwal_daftar_s' => form_error('set_jadwal_daftar_s'),
                        'err_set_jam_daftar_s' => form_error('set_jam_daftar_s'),
                        'err_set_lama_blokir' => form_error('set_lama_blokir'),
                        'err_set_pesan' => form_error('set_pesan'),
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

}
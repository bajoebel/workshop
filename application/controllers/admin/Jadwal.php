<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
    }
    function index(){
        $link='admin/jadwal';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $field=array('poly_nama','dokter_nama','jadwal_hari','=jenis[{{jadwal_pekan}}]','jadwal_status');
            $action = "<div class='btn-group'><a href='#' class='btn btn-warning btn-xs'  onclick='edit({{idx}},\\\"{{jadwal_dokter_id}}\\\",\\\"{{jadwal_poly_id}}\\\",\\\"{{jadwal_hari}}\\\",\\\"{{jadwal_pekan}}\\\",\\\"{{jadwalgroup}}\\\",\\\"{{jadwal_status}}\\\")'><span class='fa fa-pencil'></span> Edit</a><button onclick='hapus({{idx}})' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span> Hapus</button></div>";
            $config = array(
                'url'           => 'admin/jadwal/getdata',
                'variable'      => array(
                    'idx' => 'jadwal_id',
                    'jadwal_dokter_id'=>'jadwal_dokter_id',
                    'jadwal_poly_id'=>'jadwal_poly_id',
                    'jadwal_hari'=>'jadwal_hari',
                    'jadwal_pekan'=>'jadwal_pekan',
                    'jadwalgroup'=>'jadwalgroup',
                    'jadwal_status'=>'jadwal_status',
                ),
                'field'         => $field,
                'function'      => 'getData',
                'keyword_id'    => 'q',
                'param_id'      => array('poly'=>'poly','dokter'=>'dokter','hari'=>'hari','pekan'=>'pekan'),
                'limit_id'      => 'limit',
                'data_id'       => 'data',
                'page_id'       => 'pagination',
                'number'        => true,
                'action'        => true,
                'load'          => true,
                'action_button' => $action,
            );
            $get=array(
                'dokter'=>$this->Jadwal_model->getDokter(),
                'poly'=>$this->Jadwal_model->getPoly(),
                'group'=>$this->Jadwal_model->getGroupBatch()
            );
            $data=array(
                'libjs'=>array('js/app/jadwal.js'),
                'ajaxdata' => "var jenis = new Array(\"Semua Pekan\", \"Ganjil\", \"Genap\");".getData($config),
                'content'=> $this->load->view('admin/jadwal_index',$get,true),
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
        $link='admin/jadwal';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $q = urldecode($this->input->get('keyword', TRUE));
            $start = intval($this->input->get('start'));
            $limit = intval($this->input->get('limit'));
            $poly = intval($this->input->get('poly'));
            $dokter = intval($this->input->get('dokter'));
            $hari = urldecode($this->input->get('hari'));
            $pekan = intval($this->input->get('pekan'));
            $mulai = ($start * $limit) - $limit;
            $response = array(
                'status'    => true,
                'message'   => "OK",
                'start'     => $mulai,
                'row_count' => $this->Jadwal_model->countData($q,$poly,$dokter,$hari,$pekan),
                'limit'     => $limit,
                'data'      => $this->Jadwal_model->getData($limit, $mulai, $q,$poly,$dokter,$hari,$pekan),
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function simpan(){
        $link='admin/jadwal';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $jadwal_id=$this->input->post('jadwal_id');
            $row=$this->Jadwal_model->getDataByid($jadwal_id);
            $jadwal_status=$this->input->post('jadwal_status');
            if($jadwal_status!='Aktif') $jadwal_status="Non Aktif";
            if(empty($row)){
                $this->form_validation->set_rules('jadwal_dokter_id', 'Dokter ', 'required');
                $this->form_validation->set_rules('jadwal_poly_id', 'Poliklinik', 'required');
                $this->form_validation->set_rules('jadwal_hari', 'Hari', 'required');
                $this->form_validation->set_rules('jadwalgroup', 'Batch Jadwal', 'required');
                $batch=$this->input->post('jadwalgroup');
                if($batch=="baru"){
                    $this->form_validation->set_rules('group_mulai', 'Jam Mulai', 'required');
                    $this->form_validation->set_rules('group_selesai', 'Jam Selesai', 'required');
                    $this->form_validation->set_rules('group_quotaperjam', 'Quota', 'required');
                }
                if($this->form_validation->run())
                {
                    $jadwalgroup=$this->input->post('jadwalgroup');
                    if($jadwalgroup=="baru"){
                        $mulai=$this->Jadwal_model->getBatchMasterByid($this->input->post('group_mulai'));
                        $selesai=$this->Jadwal_model->getBatchMasterByid($this->input->post('group_selesai'));
                        $group_label="Jam ".$mulai->jam." - ".$selesai->jam." Dengan quota ".$this->input->post('group_quotaperjam') ." Per Batch";
                        $conf_group=array(
                            'group_label'=>$group_label,
                            'group_mulai'=>$mulai->jam,
                            'group_selesai'=>$selesai->jam,
                            'group_quotaperjam'=>$this->input->post('group_quotaperjam'),
                            'group_aktif'=>1
                        );
                        $this->db->insert('tb_config_batch_group',$conf_group);
                        $jadwalgroup=$this->db->insert_id();
                        $bid=$this->input->post('bid');
                        $label=0;
                        foreach ($bid as $b ) {
                            $pilih=$this->input->post('pilih'.$b);
                            if($pilih==1){
                                $label++;
                                $group[]=array(
                                    'groupid'=>$jadwalgroup,
                                    'label'=>$label,
                                    'name'=>$this->input->post('name'.$b),
                                    'jam'=>$this->input->post('jam'.$b),
                                    'tersedia'=>$this->input->post('group_quotaperjam')
                                );
                            }
                        }
                        if(!empty($group)) $this->db->insert_batch('tb_config_batch',$group);
                    }
                    $data=array(
                        'jadwal_dokter_id'=>$this->input->post('jadwal_dokter_id'),
                        'jadwal_poly_id'=>$this->input->post('jadwal_poly_id'),
                        'jadwal_hari'=>$this->input->post('jadwal_hari'),
                        'jadwal_pekan'=>$this->input->post('jadwal_pekan'),
                        'created_at'=>date('Y-m-d H:i:s'),
                        'jadwal_status'=>$jadwal_status,
                        'jadwalgroup'=>$jadwalgroup,
                    );
                    $insert = $this->Jadwal_model->simpanData($data);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di simpan"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'message'   => "Data Belum Lengkap",
                        'err_jadwal_dokter_id' => form_error('jadwal_dokter_id'),
                        'err_jadwal_poly_id' => form_error('jadwal_poly_id'),
                        'err_jadwal_hari' => form_error('jadwal_hari'),
                        'err_jadwal_pekan' => form_error('jadwal_pekan'),
                        'err_jadwalgroup' => form_error('jadwalgroup'),
                        'err_group_mulai' => form_error('group_mulai'),
                        'err_group_selesai' => form_error('group_selesai'),
                        'err_group_quotaperjam' => form_error('group_quotaperjam'),
                    );
                    header('Content-Type: application/json');
                    echo json_encode($array);
                }
            }else{
                
                $this->form_validation->set_rules('jadwal_dokter_id', 'Dokter ', 'required');
                $this->form_validation->set_rules('jadwal_poly_id', 'Poliklinik', 'required');
                $this->form_validation->set_rules('jadwal_hari', 'Hari', 'required');
                $this->form_validation->set_rules('jadwalgroup', 'Batch Jadwal', 'required');
                $batch=$this->input->post('jadwalgroup');
                if($batch=="baru"){
                    $this->form_validation->set_rules('group_mulai', 'Jam Mulai', 'required');
                    $this->form_validation->set_rules('group_selesai', 'Jam Selesai', 'required');
                    $this->form_validation->set_rules('group_quotaperjam', 'Quota', 'required');
                }
                if($this->form_validation->run())
                {
                    $jadwalgroup=$this->input->post('jadwalgroup');
                    if($jadwalgroup=="baru"){
                        $mulai=$this->Jadwal_model->getBatchMasterByid($this->input->post('group_mulai'));
                        $selesai=$this->Jadwal_model->getBatchMasterByid($this->input->post('group_selesai'));
                        $group_label="Jam ".$mulai->jam." - ".$selesai->jam." Dengan quota ".$this->input->post('group_quotaperjam') ." Per Batch";
                        $conf_group=array(
                            'group_label'=>$group_label,
                            'group_mulai'=>$mulai->jam,
                            'group_selesai'=>$selesai->jam,
                            'group_quotaperjam'=>$this->input->post('group_quotaperjam'),
                            'group_aktif'=>1
                        );
                        $this->db->insert('tb_config_batch_group',$conf_group);
                        $jadwalgroup=$this->db->insert_id();
                        $bid=$this->input->post('bid');
                        $label=0;
                        foreach ($bid as $b ) {
                            $pilih=$this->input->post('pilih'.$b);
                            if($pilih==1){
                                $label++;
                                $group[]=array(
                                    'groupid'=>$jadwalgroup,
                                    'label'=>$label,
                                    'name'=>$this->input->post('name'.$b),
                                    'jam'=>$this->input->post('jam'.$b),
                                    'tersedia'=>$this->input->post('group_quotaperjam')
                                );
                            }
                        }
                        if(!empty($group)) $this->db->insert_batch('tb_config_batch',$group);
                    }

                    $data=array(
                        'jadwal_dokter_id'=>$this->input->post('jadwal_dokter_id'),
                        'jadwal_poly_id'=>$this->input->post('jadwal_poly_id'),
                        'jadwal_hari'=>$this->input->post('jadwal_hari'),
                        'jadwal_pekan'=>$this->input->post('jadwal_pekan'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                        'jadwal_status'=>$jadwal_status,
                        'jadwalgroup'=>$jadwalgroup,
                    );
                    $this->Jadwal_model->updateData($data,$jadwal_id);
                    header('Content-Type: application/json');
                    echo json_encode(array("status" => TRUE,'error'=>FALSE,"message"=>"Data berhasil di update"));
                }else{
                    $array = array(
                        'status'    => TRUE,
                        'error'     => TRUE,
                        'csrf'      => $this->security->get_csrf_hash(),
                        'message'   => "Data Belum Lengkap",
                        'err_jadwal_dokter_id' => form_error('jadwal_dokter_id'),
                        'err_jadwal_poly_id' => form_error('jadwal_poly_id'),
                        'err_jadwal_hari' => form_error('jadwal_hari'),
                        'err_jadwalgroup' => form_error('jadwalgroup'),
                        'err_group_mulai' => form_error('group_mulai'),
                        'err_group_selesai' => form_error('group_selesai'),
                        'err_group_quotaperjam' => form_error('group_quotaperjam'),
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
        $link='admin/jadwal';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $this->Jadwal_model->hapusData($idx);
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
    function group($group="")
    {
        $link='admin/jadwal';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $data=array(
                'groupid'=>$group,
                'batch'=>$this->Jadwal_model->getBatch($group)
            );
            $this->load->view('admin/jadwal_batch',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>4
            );
            $this->load->view('404',$data);
        }
    }
    function groupbaru($dari=0,$sampai=0,$quota=0)
    {
        $link='admin/jadwal';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $data=array(
                'quota'=>$quota,
                'batch'=>$this->Jadwal_model->getRangeBatchMaster($dari,$sampai)
            );
            $this->load->view('admin/jadwal_batch_baru',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>4
            );
            $this->load->view('404',$data);
        }
    }
    function sampai($min=0){
        $link='admin/jadwal';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $response=array(
                'status'=>true,
                'message'=>'OK',
                'data'=>$this->Jadwal_model->getBatchMaster($min)
            );
        }else{
            $response=array('status'=>false,'message'=>'Maaf anda tidak bisa menampilkan data karena session sudah expire');
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Mandiri_model');
		$this->load->model('Welcome_model');
    }

	function index(){
		$data=array(
			'slider'=>$this->Welcome_model->getSlider(),
			'dokter'=>array(),
			'berita'=>$this->Welcome_model->getBlog(4),
			'partner'=>$this->Welcome_model->getPartner()
		);

		$data=array(
			'libjs'=>array('component/inputmask/dist/jquery.inputmask.bundle.js',
            'component/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
            'plugins/wow/wowslider.js','plugins/wow/script.js',
            'js/app/home.js'),
			'content'=> $this->load->view('public/index',$data,true)
		);
		$this->load->view('public/view_layout',$data);
	}

	function detail($tglpost,$link){
        $this->Welcome_model->hitPost($tglpost,$link);
        $data=array(
            'halaman'  => $this->Welcome_model->get_post($tglpost,$link)
        );
        $data["isi"]    = $this->load->view('public/blog/post_detail',$data,true);
        $view=array(
            'content'   => $this->load->view('public/blog/kontent',$data,true),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);
    }
    
	function page($link){
        $this->Welcome_model->hitPage($link);
        $data=array(
            'halaman'  => $this->Welcome_model->get_halaman($link)
        );
        $data["isi"]    = $this->load->view('public/blog/post_detail',$data,true);
        $view=array(
            'content'   => $this->load->view('public/blog/kontent',$data,true),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);
    }
	public function ppid($dir=""){
        // $this->load->model("Welcome_model");
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        if(empty($dir)) $dir = intval($this->input->get('dir'));
        $limit = 10;
        //echo $dir; exit;
        $data=array(
            'dir'   => $dir,
            'media'  => $this->Welcome_model->getPpid($limit,$start,$q,$dir),
        );
        //$data["isi"]=$this->load->view('admin/media/view_tabel', $data, true);
        $data["isi"]=$this->load->view('public/blog/ppid', $data, true);
        $view=array(
            'content'   => $this->load->view('public/blog/kontent',$data,true),
			'libjs'=>array('js/app/ppid.js'),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);
    }
	public function data_ppid(){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $dir = intval($this->input->get('dir'));
        $limit = 20;
        $row_count=$this->Welcome_model->countPpid($q,$dir);
        $tabel= $this->Welcome_model->getPpid($limit,$start,$q,$dir);
        $list=array(
            'start'     => $start,
            'row_count' => $row_count,
            'limit'     => $limit,
            'data'     => $tabel,
        );
        echo json_encode($list);
    }
	public function jadwal_dokter(){
        
        $data=array(
            'jadwal'  => $this->Welcome_model->getJadwal()
        );
        $data["isi"]    = $this->load->view('public/blog/post_jadwal',$data,true);
        $view=array(
            'content'   => $this->load->view('public/blog/kontent1',$data,true),
			'resource_url'=>RESOURCE_URL,
        );
        $this->load->view('public/view_layout', $view);

        //echo "Jadwal DOkter";
    }
	function bed_monitoring(){
        $limit=20;
        $start=0;
        $jmlData=$this->Welcome_model->jmlData();
        
        $data=array(
            'jmlData'       => $jmlData,
            'limit'         => $limit,
            'setting'       => $this->Welcome_model->getSetting()
        );
        $data["isi"]    = $this->load->view('public/blog/view_bedmonitoring',$data,true);
        $content       = $this->load->view('public/blog/kontent1',$data,true);
        $view=array(
            'content'   => $content,
			'libjs'=>array('js/app/bedmonitoring.js'),
        );
        //header('Content-Type: application/json');
        //echo json_encode($view);exit;
        $this->load->view('public/view_layout',$view);
    }
	
	function login(){
		$data=array();
		$data=array(
			'libjs'=>array('js/app/home.js','js/app/login.js'),
			'content'=> $this->load->view('public/login',$data,true)
		);
		$this->load->view('public/view_layout',$data);
	}
    function logout(){
        
    }
	function cekuser(){
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$cek=$this->Welcome_model->cekUser($username,$password);
		if($cek){
			if($cek->user_status=='Aktif'){
				$sess_data=array(
					'id'=>$cek->user_id,
					'nama_lengkap'=>$cek->user_nama_lengkap,
					'level'=>$cek->user_idxlevel,
					'photo'=>$cek->user_photo
				);
				$this->session->set_userdata($sess_data);
				$response=array('status'=>true,'message'=>'Anda Berhasil Login');
			}else $response=array('status'=>true,'message'=>'Username Atau Password Anda Salah');
		}else{
			$response=array('status'=>false,'message'=>'Username Atau Password Anda Salah');
		}
		header('Content-Type: application/json');
        echo json_encode($response);
	}
	public function registrasi()
	{
		$data=array(
            'peserta'=>$this->Welcome_model->getKategoriPeserta(),
            'kegiatan'=> $this->Welcome_model->getKategoriKegiatan(),
        );
		$data=array(
			'libjs'=>array('js/app/home.js'),
			'content'=> $this->load->view('public/pendaftaran',$data,true)
		);
		$this->load->view('public/view_layout',$data);
	}
    function jadwal(){

    }
    function konfirmasi(){

    }
	public function pasien_baru()
	{
		$data=array(
			'rujukan'=>$arr->data,
			'status_kawin'=> $this->Welcome_model->statusKawin(),
			'pekerjaan'=>$this->Welcome_model->getPekerjaan(),
			'agama'=>$this->Welcome_model->getAgama(),
			'suku'=>$this->Welcome_model->getSuku(),
			'bahasa'=>$this->Welcome_model->getBahasa(),
			'provinsi'=>$this->Welcome_model->getProvinsi(),
			'config'=>$this->Online_model->getConfig(),
			'pertanyaan'=>$this->Online_model->getPertanyaan(),
		);
		$data=array(
			'libjs'=>array(
				'component/inputmask/dist/jquery.inputmask.bundle.js',
				'component/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
				'js/app/home.js',
				'js/app/online.js'),
			'content'=> $this->load->view('public/pasien_baru',$data,true)
		);
		$this->load->view('public/layout',$data);
	}
	public function reservasi($idx){
		$x_token=$this->session->userdata('token');
        if(empty($token)){
            $param=array(
                'client'=>SMART_ID,
                'key'=> SMART_KEY
            );
            $response = $this->Online_model->http_request($param,SMART_CALL_BACK ."sim/auth/gettoken");
            $token=json_decode($response);
            $x_token = $token->response->token;
            $this->session->set_userdata(array('token'=>$x_token));
        }
		$param=array(
			'param'=>array(
				'idx'=>$idx
			)
		);
		$response = $this->Online_model->http_request($param,SMART_CALL_BACK ."sim/pendaftaran/getdetail",$x_token);
        // echo $response; exit;
		$res_arr=json_decode($response);
		$data=$res_arr->pendaftaran;
		// echo $data->nomr; exit;
		// print_r($data);exit;
		// $data=$this->Online_model->getRegistrasiById($idx);
		// print_r($data);
		if($data){
			$this->load->view('public/print_reservasi',$data);
		}
	}
	function qr($id){
		// $data=$this->input->get('qrdata');
		// $data=array(
		// 	'nama'=>'Wanhar Azri',
		// 	'umur'=>35,
		// 	'pekerjaan'=>"THL"
		// );
		// $data=$this->input->get('qrdata');
		$data=QRLINK."online/pendaftaran/".$id;
		// echo $data;exit;
		QRcode::png($id,false,QR_ECLEVEL_H,5,2);
	}
	function kabkota(){
		$prov=$this->input->get('provinsi');
		$response=array(
			'status'=>true,
			'data'=>$this->Welcome_model->getKabupaten($prov)
		);
		header('Content-Type: application/json');
        echo json_encode($response);
	}
	function kecamatan(){
		$kab=$this->input->get('nama_kabkota');
		$response=array(
			'status'=>true,
			'data'=>$this->Welcome_model->getKecamatan($kab)
		);
		header('Content-Type: application/json');
        echo json_encode($response);
	}
	function kelurahan(){
		$kec=$this->input->get('kecamatan');
		$response=array(
			'status'=>true,
			'data'=>$this->Welcome_model->getKelurahan($kec)
		);
		header('Content-Type: application/json');
        echo json_encode($response);
	}
	function mode(){
        $mode=$this->Welcome_model->getSetting();
        header('Content-Type: application/json');
        echo json_encode($mode);
    }
	function ruangan(){
        $data=$this->Welcome_model->getMonitoring();
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    function datakelas(){
        $kelas=$this->Welcome_model->ketersediaan_kamar('');
        header('Content-Type: application/json');
        echo json_encode($kelas);
    }
    function datakamar($start=0){
        $limit=20;
        $kamar=$this->Welcome_model->getKetersediaan($limit, $start);
        header('Content-Type: application/json');
        echo json_encode($kamar);
    }
	function kajian_mandiri_covid19(){
        $data = array('kajian'=>$this->Welcome_model->getKajian(),'jquery3'=>true);
        $view=array(
            'content'   => $this->load->view('public/blog/kajian_mandiri_covid19',$data,true),
			'libjs'=>array('js/app/blog.js'),
        );
        $this->load->view('public/view_layout', $view);
    }
	function pegawai(){
        $param=$this->input->post('param1');
        $data=$this->Welcome_model->getPegawai($param);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
	function form_kajian($idx){
        $this->db->where('ref_id',$idx);
        $this->db->where('tgl_berkunjung',date('Y-m-d'));
        $cek = $this->db->get('trx_kajian_covid')->row();
        if(empty($cek)){
            $data=array(
                'pegawai'=>$this->Welcome_model->getPegawaiByid($idx),
                'kajian'=>$this->Welcome_model->getKajian()
            );
            $this->load->view('public/blog/form_kajian_mandiri_covid',$data);
        }else{
            echo '<div class="alert alert-danger">
            <p>Anda sudah mengisi kajian mandiri covid-19 untuk hari ini, silahkan isi lagi besok</p>
          </div>';
        }
        
    }
	function simpankajian(){
        $this->db->where('ref_id',$this->input->post('ref_id'));
        $this->db->where('tgl_berkunjung',date('Y-m-d'));
        $cek = $this->db->get('trx_kajian_covid')->row();
        if(empty($cek)){
            // $this->load->model('Welcome_model');
            $kajian=array(
                'object_kajian'=>'Pegawai',
                'nik'   => $this->input->post('nik'),
                'nama_lengkap'   => $this->input->post('nama_lengkap'),
                'keperluan'   => $this->input->post('keperluan'),
                'tgl_berkunjung'   => $this->input->post('tanggal_kunjungan'),
                'tgl_pengisian'=>date('Y-m-d H:i:s'),
                'ref_id'    => $this->input->post('ref_id'),
            );
            //Update Nik Pegawai
            $nik=array('nik'=>$this->input->post('nik'));
            $this->db->where('idx',$this->input->post('ref_id'));
            $this->db->update('stx_pegawai',$nik);

            $idx_kajian = $this->Welcome_model->insertKajian($kajian);
            $idx=$this->input->post('idx');
            $tot_point =0;
            foreach ($idx as $idx_pertanyaan ) {
                $kajian_detail[] = array(
                    'idx_kajian'=>$idx_kajian,
                    'idx_pertanyaan'=>$idx_pertanyaan,
                    'pertanyaan'=> $this->input->post('pertanyaan'.$idx_pertanyaan),
                    'point' => $this->input->post('point'.$idx_pertanyaan)
                );
                $tot_point+=intval($this->input->post('point'.$idx_pertanyaan));
            }
            if(!empty($kajian_detail)){
                $this->db->insert_batch('trx_kajian_covid_detail',$kajian_detail);

                //Update Point Kunjungan 
                if($tot_point==0) $tot_point='Nol';
                $point=array('point_kajian_covid'=>$tot_point);
                $this->db->where('idx',$idx_kajian);
                $this->db->update('trx_kajian_covid',$point);

                $this->session->set_flashdata('message', $tot_point );
            }else{
                $this->session->set_flashdata('message', '-');
            }
        }else{
            $this->session->set_flashdata('message', 'Data kajian mandiri covid-19 anda sudah diinput untuk hari ini, silahkan isi lagi besok' );
        }
        
        header('location:'.base_url()."kajian_mandiri_covid19");
    }
	function blog(){
        $link='';
        $data=array(
            'halaman'  => $this->Welcome_model->get_halaman($link)
        );
        $view=array(
            'content'   => $this->load->view('public/blog/utama',$data,true),
        );
        $this->load->view('public/view_layout', $view);
    }
    public function download($dir=""){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        if(empty($dir)) $dir = intval($this->input->get('dir'));
        $limit = 10;    
        //echo $dir; exit;
        $data=array(
            'dir'   => $dir,
            'media'  => $this->Welcome_model->getDownload($limit,$start,$q,$dir),
        );
        //$data["isi"]=$this->load->view('admin/media/view_tabel', $data, true);
        $data["isi"]=$this->load->view('public/blog/download', $data, true);
        $view=array(
            'content'   => $this->load->view('public/blog/kontent',$data,true),
            'libjs'=>array('js/app/download.js'),
        );
        $this->load->view('public/view_layout', $view);
    }
    public function data_download(){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $dir = intval($this->input->get('dir'));
        $limit = 20;
        $row_count=$this->Welcome_model->countDownload($q,$dir);
        $tabel= $this->Welcome_model->getDownload($limit,$start,$q,$dir);
        $list=array(
            'start'     => $start,
            'row_count' => $row_count,
            'limit'     => $limit,
            'data'     => $tabel,
        );
        echo json_encode($list);
    }
    function pengaduan(){
        $view=array(
            'content'   => $this->load->view('public/blog/pengaduan','',true)
        );
        $this->load->view('public/view_layout', $view);
    }

    function kritik(){
        $view=array(
            'content'   => $this->load->view('public/blog/kritik','',true)
        );
        $this->load->view('public/view_layout', $view);
    }
    function simpankritik(){
        $data=array(
            'kritik_desc'=>$this->security->xss_clean($this->input->post('kritik_desc')),
            'kritik_penilaian'=>$this->security->xss_clean($this->input->post('kritik_penilaian')),
            'kritik_tanggal'=>date('Y-m-d')
        );
        $this->db->insert('trx_kritik',$data);
        $id=$this->db->insert_id();
        if($id){
            echo json_encode(array('status'=>true,'message'=>'Terima kasih atas saran dan kritiknya, kritik dan saran anda akan kami pertimbangkan demi peningkatan palayanan kami'));
        }else{
            echo json_encode(array('status'=>false,'message'=>'Maaf terjadi kesalahan '));
        }
    }
    function pasien(){
        $nomr=urlencode($this->input->get('nomr'));
        $pasien=$this->Welcome_model->getPasien($nomr);
        header('Content-Type: application/json');
        echo json_encode($pasien);
    }
    function kirimpengaduan(){
        $data=array(
            'pengaduan_nomr'=>$this->security->xss_clean($this->input->post('pengaduan_nomr')),
            'pengaduan_namapasien'=>$this->security->xss_clean($this->input->post('pengaduan_namapasien')),
            'pengaduan_tanggal' => date('Y-m-d'),
            'pengaduan_alamatpasien'=>$this->security->xss_clean($this->input->post('pengaduan_alamatpasien')),
            'pengaduan_tgllahir'=>$this->security->xss_clean($this->input->post('pengaduan_tgllahir')),
            'pengaduan_tempatrawat'=>$this->security->xss_clean($this->input->post('pengaduan_tempatrawat')),
            'pengaduan_jenislayanan'=>$this->security->xss_clean($this->input->post('pengaduan_jenislayanan')),
            'pengaduan_namapelapor'=>$this->security->xss_clean($this->input->post('pengaduan_namapelapor')),
            'pengaduan_notelp'=>$this->security->xss_clean($this->input->post('pengaduan_notelp')),
            'pengaduan_email'=>$this->security->xss_clean($this->input->post('pengaduan_email')),
            'pengaduan_hubungan'=>$this->security->xss_clean($this->input->post('pengaduan_hubungan')),
            'pengaduan_kronologis'=>$this->security->xss_clean($this->input->post('pengaduan_kronologis'))
        );
        $this->db->insert('trx_pengaduan',$data);
        $id=$this->db->insert_id();
        if($id){
            echo json_encode(array('status'=>true,'message'=>'Terima kasih atas pengaduannya, Pengaduan anda sudah kami terima dan akan segera kami proses '));
        }else{
            echo json_encode(array('status'=>false,'message'=>'Maaf terjadi kesalahan '));
        }
    }
}

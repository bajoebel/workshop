<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mandiri_model');
        $this->load->model('Online_model');
    }
	public function cari()
	{
        $nomr=$this->input->post('nomr');
        $thnlahir=$this->input->post('thnlahir');
        // echo $nomr; exit;
        if(strlen($nomr)==6){
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
            $request=array(
                'param'=>array(
                    'nomr'=>$nomr,
                    'tahun_lahir'=> $thnlahir
                )
            );
            $res=$this->Online_model->http_request($request,SMART_CALL_BACK."sim/pasien/cekpasien",$x_token);
            // header('Content-Type: application/json');
            // echo $res; exit;
            $arr=json_decode($res);
            // print_r($arr);exit;
            if($arr){
                if($arr->code==200){
                    $pj=$arr->pj;
                    if(!empty($pj)){
                        $pjnama=$pj->nama_penanggung_jawab;
                        $pjpekerjaan=$pj->pekerjaan;
                        $pjalamat=$pj->alamat;
                        $pjnotelp=$pj->no_telp;
                        $pjhubungan=$pj->hub_keluarga;
                    }else{
                        if(!empty($cek)){
                            $pjnama=$cek->penanggung_jawab;
                            $pjnotelp=$cek->no_penanggung_jawab;
                        }else{
                            $pjnama='';
                            $pjnotelp='';
                        }
                        
                        $pjpekerjaan="-";
                        $pjalamat="-";
                        $pjhubungan="-";
                    }
                    $response=array(
                        'status'=>true,
                        'message'=>'OK',
                        'data'  =>$arr->data,
                        'pjnama'=>$pjnama,
                        'pjpekerjaan'=>$pjpekerjaan,
                        'pjalamat'=>$pjalamat,
                        'pjnotelp'=>$pjnotelp,
                        'pjhubungan'=>$pjhubungan
                    );
                }else{
                    $response=array(
                        'status'=>false,
                        'message'=>$arr->message,
                        'data'  =>''
                    );
                }
            }else{
                $response=array(
                    'status'=>false,
                    'message'=>'Tidak bisa koneksi ke server pendaftaran online',
                    'data'  =>''
                );
            }
            
        }else{
            $response=array(
                'status'=>false,
                'message'=>'Nomr '.$nomr .' Tidak Valid',
                'data'  =>''
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
	}
    function dokter($id_ruang){
        $param=json_encode(array());
        
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
                'poly'=>$id_ruang
            ),
        );
        $tglbuka = $this->Online_model->http_request($param,SMART_CALL_BACK ."sim/pendaftaran/tanggalbuka",$x_token);
        // echo $tglbuka;exit;
        $data=json_decode($tglbuka);
        if($data->code==200){
            // echo "OK";
            $data=array(
                'tglbuka'=>$data->tgl,
                'idruang'=>$id_ruang,
                'token'=>$x_token
            );
            $this->load->view('online/dokter',$data);
        }else{
            echo $data->message;
        }
        
        // header('Content-Type: application/json');
        // echo json_encode($response);
    }
    function dokterbaru($id_ruang){
        $param=json_encode(array());
        
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
                'poly'=>$id_ruang
            ),
        );
        $tglbuka = $this->Online_model->http_request($param,SMART_CALL_BACK ."sim/pendaftaran/tanggalbuka",$x_token);
        // echo $tglbuka;exit;
        $data=json_decode($tglbuka);
        if($data->code==200){
            // echo "OK";
            $data=array(
                'tglbuka'=>$data->tgl,
                'idruang'=>$id_ruang,
                'token'=>$x_token
            );
            $this->load->view('online/dokterbaru',$data);
        }else{
            echo $data->message;
        }
        
        // header('Content-Type: application/json');
        // echo json_encode($response);
    }
    function carabayar($asuransi){
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
        $kondisi=array('asuransi'=>$asuransi);
        $param=array('param'=>$kondisi);
        $response = $this->Online_model->http_request($param,SMART_CALL_BACK ."sim/pendaftaran/carabayar",$x_token);
        $res_arr=json_decode($response);
        $d=$res_arr->data;
        $data=array('jml'=>$d->jml,'carabayar'=>$d->carabayar);
        // print_r($data);exit;
        // $data=$this->Mandiri_model->getCaraBayar($asuransi);
        $this->load->view('online/carabayar',$data);
    }

    function poliklinik(){
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
        $q=$this->input->get('q');
        $kondisi=array('keyword'=>$q);
        $param=array('param'=>$kondisi);
        $response = $this->Online_model->http_request($param,SMART_CALL_BACK ."sim/pendaftaran/poly",$x_token,'GET');
        $res_arr=json_decode($response);
        // print_r($res_arr); exit;
        $data=array(
            'ruang'=>$res_arr->data
        );
        $this->load->view('online/poliklinik',$data);
    }
    function poliklinikbaru(){
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
        $q=$this->input->get('q');
        $kondisi=array('keyword'=>$q);
        $param=array('param'=>$kondisi);
        $response = $this->Online_model->http_request($param,SMART_CALL_BACK ."sim/pendaftaran/poly",$x_token,'GET');
        $res_arr=json_decode($response);
        // print_r($res_arr); exit;
        $data=array(
            'ruang'=>$res_arr->data
        );
        $this->load->view('online/poliklinikbaru',$data);
    }
    function simpan_pendaftaran(){
        $data=array(
            'idpasien'=>$this->input->post('id_pasien'),
            'nomr'=>$this->input->post('nomr'),
            'no_ktp'=>$this->input->post('no_ktp'),
            'nama_pasien'=>$this->input->post('nama_pasien'),
            'tempat_lahir'=>$this->input->post('tempat_lahir'),
            'tgl_lahir'=>$this->input->post('tgl_lahir'),
            'jns_kelamin'=>$this->input->post('jns_kelamin'),
            'nama_provinsi'=>$this->input->post('nama_provinsi'), //X
            'nama_kab_kota'=>$this->input->post('nama_kab_kota'), //X
            'nama_kecamatan'=>$this->input->post('nama_kecamatan'),//X
            'nama_kelurahan'=>$this->input->post('nama_kelurahan'),//X
            'tgl_daftar'=>$this->input->post('tgl_daftar'),//X
            'tanggal_kunjungan'=> $this->input->post('tgl_masuk'),
            'jam_kunjungan'=>$this->input->post('jam_antrian'),
            'id_ruang'=>$this->input->post('id_ruang'),
            'nama_ruang'=>$this->input->post('nama_ruang'),
            'id_rujuk'=>$this->input->post('id_rujuk'),
            'rujukan'=>$this->input->post('rujukan'),
            'no_rujuk'=>$this->input->post('no_rujuk'),
            'id_cara_bayar'=>$this->input->post('id_cara_bayar'),
            'cara_bayar'=>$this->input->post('cara_bayar'),
            'id_jenis_peserta'=>$this->input->post('id_cara_bayar').".".$this->input->post('id_jenis_peserta'), //X
            'jenis_peserta'=>$this->input->post('jenis_peserta'),
            'jam_kunjunganLabel' => $this->input->post('name_antrian'),
            'label_antrian'=>$this->input->post('label_antrian'),
            'no_bpjs'=>$this->input->post('no_bpjs'),
            'pjPasienNama'=>$this->input->post('pjPasienNama'),
            'pjPasienPekerjaan'=>$this->input->post('pjPasienPekerjaan'),
            'pjPasienAlamat'=>$this->input->post('pjPasienAlamat'),
            'pjPasienTelp'=>$this->input->post('pjPasienTelp'),
            'pjPasienHubKel'=>$this->input->post('pjPasienHubKel'),
            'pjPasienDikirimOleh'=>$this->input->post('pjPasienDikirimOleh'),
            'pjPasienAlmtPengirim'=>$this->input->post('pjPasienAlmtPengirim'),
            'dokterJaga'=>$this->input->post('id_dokter'),
            'namaDokterJaga'=>$this->input->post('namaDokterJaga'),
            'quota_antrian'=>$this->input->post('quota_antrian')
        );
        
        if($data['nomr']=="")           $err['err_nomr']="Nomr Pasien Masih Kosong";
        if($data['no_ktp']=="")         $err['err_noktp']="NIK Masih Kosong";
        if($data['nama_pasien']=="")    $err['err_namapasien']="Nama Pasien Masih Kosong";
        if($data['tempat_lahir']=="")   $err['err_tempatlahir']="Nomr Pasien Masih Kosong";
        if($data['tgl_lahir']=="")      $err['err_tgllahir']="Tempat lahir Pasien Masih Kosong";
        if($data['jns_kelamin']=="")    $err['err_jnskelamin']="Jenis Kelamin Pasien Masih Kosong";
        if($data['nama_provinsi']=="")  $err['err_namaprovinsi']="Provinsi Pasien Masih Kosong";
        if($data['nama_kab_kota']=="")  $err['err_namakabkota']="Kabupaten / Kota Pasien Masih Kosong";
        if($data['nama_kecamatan']=="") $err['err_namakecamatan']="Kecamatan Pasien Masih Kosong";
        if($data['nama_kelurahan']=="") $err['err_namakelurahan']="Kelurahan Pasien Masih Kosong";
        if(empty($data['nomr'])||
            empty($data['no_ktp'])||
            empty($data['tempat_lahir'])||
            empty($data['tgl_lahir'])||
            $data['jns_kelamin']==""||
            empty($data['nama_provinsi'])||
            empty($data['nama_kecamatan'])||
            empty($data['nama_kecamatan'])||
            empty($data['nama_kelurahan'])){
                $message[]="Data Pasien Belum Lengkap";
            }
        if($data['id_ruang']=="")       $err['err_ruang']="Ruangan Pasien Masih Kosong";
        if($data['nama_ruang']=="")     $err['err_ruang']="Ruangan Pasien Masih Kosong";
        if(empty($data['id_ruang'])||empty($data['nama_ruang'])) $message[]="Ruangan Pasien Masih Kosong";
        if($data['id_rujuk']=="")       $err['err_rujukan']="Asal Rujukan Pasien Masih Kosong";
        if($data['rujukan']=="")        $err['err_rujukan']="Asal Rujukan Pasien Masih Kosong";
        if(empty($data['id_rujuk'])||empty($data['rujukan'])) $message[]="Asal Rujukan Pasien Masih Kosong";
        if($data['id_cara_bayar']=="")  $err['err_carabayar']="cara Bayar Pasien Masih Kosong";
        if($data['cara_bayar']=="")     $err['err_carabayar']="Cara Bayar Pasien Masih Kosong";
        if(empty($data['id_cara_bayar'])||empty($data['cara_bayar'])) $message[]="Cara Bayar Pasien Masih Kosong";
        if($data['id_jenis_peserta']=="")   $err['err_jenispeserta']="Jenis Peserta Masih Kosong";
        if($data['jenis_peserta']=="")  $err['err_jenispeserta']="Jenis Peserta Pasien Masih Kosong";
        if(empty($data['id_jenis_peserta'])||empty($data['jenis_peserta'])) $message[]="Jenis Peserta Masih Kosong";
        if($data['dokterJaga']=="")  $err['err_dokter']="Dokter Belum dipilih";
        if($data['namaDokterJaga']=="")  $err['err_dokter']="Dokter Belum dipilih";
        if(empty($data['dokterJaga'])||empty($data['namaDokterJaga'])) $message[]="DOkter elum Dipilih";

        //Divalidasi khusus Pasien BPJS
        $jkn=$this->input->post('jkn');
        if($jkn===1){
            if($data['no_rujuk']==""){
                $err['err_norujuk']="No Rujuk Pasien Masih Kosong";
                $message[]=$err['err_norujuk'];
            }
            if($data['no_bpjs']==""){
                $err['err_nobpjs']="No BPJS Pasien Masih Kosong";
                $message[]=$err['err_nobpjs'];
            }
        }
        
        if(!empty($err)) {
            if(!empty($message)) $pesan=implode(",", $message);else $pesan="Unknow Error";
            $response=array('code'=>202,'message'=>$pesan,'error'=>$err);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else {
            // $id = $this->Mandiri_model->insertPendaftaran($data);
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
            $status_kajian=$this->input->post('kajian_mandiri_covid19');
            if($status_kajian){
                $idx=$this->input->post('idx');
                $point=0;
                foreach ($idx as $i ) {
                    $jawaban=$this->input->post('jawaban'.$i);
                    if(!$jawaban) $jawaban=0;
                    $point+=$jawaban;
                    $detail[]=array(
                        'idx_kajian'=>'',
                        'idx_pertanyaan'=>$i,
                        'pertanyaan'=>$this->input->post('pertanyaan'.$i),
                        'point'=>$jawaban
                    );
                }
                $kajian=array(
                    'object_kajian'=>'Pasien',
                    'nik'=>$this->input->post('no_ktp'),
                    'nama_lengkap'=>$this->input->post('nama_pasien'),
                    'keperluan'=>'Berobat',
                    'tgl_berkunjung'=>$this->input->post('tgl_masuk'),
                    'tgl_pengisian'=>date('Y-m-d H:i:s'),
                    'point_kajian_covid'=>$point,
                );
            }else{
                $kajian=array();
                $detail=array();
            }
            
            $param=array('data'=>$data,'kajian_mandiri'=>$status_kajian,'kajian'=>$kajian,'detail'=>$detail);
            $response = $this->Online_model->http_request($param,SMART_CALL_BACK ."sim/pendaftaran/simpan",$x_token);
            header('Content-Type: application/json');
            // echo "Error <br>";
            echo $response;
        }
    }
    function daftarpasienbaru(){
        $pasien=array(
            'no_ktp'=>$this->input->post('no_ktp'),
            'nama'=>$this->input->post('nama'),
            'tempat_lahir'=>$this->input->post('tempat_lahir'),
            'tgl_lahir'=>dateEng($this->input->post('tgl_lahir')),
            'jns_kelamin'=>$this->input->post('jns_kelamin'),
            'status_kawin'=>$this->input->post('status_kawin'),
            'pekerjaan'=>$this->input->post('pekerjaan'),
            'agama'=>$this->input->post('agama'),
            'no_telpon'=>$this->input->post('no_telpon'),
            'kewarganegaraan'=>'WNI',
            'nama_negara'=>'Indonesia',
            'nama_provinsi'=>$this->input->post('nama_provinsi'),
            'nama_kab_kota'=>$this->input->post('kabkota')." ".$this->input->post('nama_kab_kota'),
            'nama_kecamatan'=>$this->input->post('nama_kecamatan'),
            'nama_kelurahan'=>$this->input->post('nama_kelurahan'),
            'dalam_kota'=>$this->input->post('dalam_kota'),//Belum Ada
            'suku'=>$this->input->post('suku'), // Belum Ada
            'bahasa'=>$this->input->post('bahasa'), // Belum ada
            'alamat'=>$this->input->post('alamat'), 
            'penanggung_jawab'=>$this->input->post('pjPasienNama'),
            'no_penanggung_jawab'=>$this->input->post('pjPasienTelp'),
            'no_bpjs'=>$this->input->post('no_bpjs'),
            'tgl_daftar'=>$this->input->post('tgl_masuk'),
        );
        // print_r($pasien);exit;
        $data=array(
            'idpasien'=>$this->input->post('id_pasien'),
            'nomr'=>$this->input->post('nomr'),
            'no_ktp'=>$this->input->post('no_ktp'),
            'nama_pasien'=>$this->input->post('nama'),
            'tempat_lahir'=>$this->input->post('tempat_lahir'),
            'tgl_lahir'=>dateEng($this->input->post('tgl_lahir')),
            'jns_kelamin'=>$this->input->post('jns_kelamin'),
            'nama_provinsi'=>$this->input->post('nama_provinsi'), //X
            'nama_kab_kota'=>$this->input->post('kabkota')." ".$this->input->post('nama_kab_kota'), //X
            'nama_kecamatan'=>$this->input->post('nama_kecamatan'),//X
            'nama_kelurahan'=>$this->input->post('nama_kelurahan'),//X
            'tgl_daftar'=>$this->input->post('tgl_masuk'),//X
            'tanggal_kunjungan'=> $this->input->post('tgl_masuk'),
            'jam_kunjungan'=>$this->input->post('jam_antrian'),
            'id_ruang'=>$this->input->post('id_ruang'),
            'nama_ruang'=>$this->input->post('nama_ruang'),
            'id_rujuk'=>$this->input->post('id_rujuk'),
            'rujukan'=>$this->input->post('rujukan'),
            'no_rujuk'=>$this->input->post('no_rujuk'),
            'id_cara_bayar'=>$this->input->post('id_cara_bayar'),
            'cara_bayar'=>$this->input->post('cara_bayar'),
            'id_jenis_peserta'=>$this->input->post('id_cara_bayar').".".$this->input->post('id_jenis_peserta'), //X
            'jenis_peserta'=>$this->input->post('jenis_peserta'),
            'jam_kunjunganLabel' => $this->input->post('name_antrian'),
            'label_antrian'=>$this->input->post('label_antrian'),
            'no_bpjs'=>$this->input->post('no_bpjs'),
            'pjPasienNama'=>$this->input->post('pjPasienNama'),
            'pjPasienPekerjaan'=>$this->input->post('pjPasienPekerjaan'),
            'pjPasienAlamat'=>$this->input->post('pjPasienAlamat'),
            'pjPasienTelp'=>$this->input->post('pjPasienTelp'),
            'pjPasienHubKel'=>$this->input->post('pjPasienHubKel'),
            'pjPasienDikirimOleh'=>$this->input->post('pjPasienDikirimOleh'),
            'pjPasienAlmtPengirim'=>$this->input->post('pjPasienAlmtPengirim'),
            'dokterJaga'=>$this->input->post('id_dokter'),
            'namaDokterJaga'=>$this->input->post('namaDokterJaga'),
            'quota_antrian'=>$this->input->post('quota_antrian')
        );
        
        // if($data['nomr']=="")           $err['err_nomr']="Nomr Pasien Masih Kosong";
        if($data['no_ktp']=="")         $err['err_noktp']="NIK Masih Kosong";
        if($data['nama_pasien']=="")    $err['err_namapasien']="Nama Pasien Masih Kosong";
        if($data['tempat_lahir']=="")   $err['err_tempatlahir']="Nomr Pasien Masih Kosong";
        if($data['tgl_lahir']=="")      $err['err_tgllahir']="Tempat lahir Pasien Masih Kosong";
        if($data['jns_kelamin']=="")    $err['err_jnskelamin']="Jenis Kelamin Pasien Masih Kosong";
        if($data['nama_provinsi']=="")  $err['err_namaprovinsi']="Provinsi Pasien Masih Kosong";
        if($data['nama_kab_kota']=="")  $err['err_namakabkota']="Kabupaten / Kota Pasien Masih Kosong";
        if($data['nama_kecamatan']=="") $err['err_namakecamatan']="Kecamatan Pasien Masih Kosong";
        if($data['nama_kelurahan']=="") $err['err_namakelurahan']="Kelurahan Pasien Masih Kosong";
        if(empty($data['nomr'])||
            empty($data['no_ktp'])||
            empty($data['tempat_lahir'])||
            empty($data['tgl_lahir'])||
            $data['jns_kelamin']==""||
            empty($data['nama_provinsi'])||
            empty($data['nama_kecamatan'])||
            empty($data['nama_kecamatan'])||
            empty($data['nama_kelurahan'])){
                $message[]="Data Pasien Belum Lengkap";
            }
        if($data['id_ruang']=="")       $err['err_ruang']="Ruangan Pasien Masih Kosong";
        if($data['nama_ruang']=="")     $err['err_ruang']="Ruangan Pasien Masih Kosong";
        if(empty($data['id_ruang'])||empty($data['nama_ruang'])) $message[]="Ruangan Pasien Masih Kosong";
        if($data['id_rujuk']=="")       $err['err_rujukan']="Asal Rujukan Pasien Masih Kosong";
        if($data['rujukan']=="")        $err['err_rujukan']="Asal Rujukan Pasien Masih Kosong";
        if(empty($data['id_rujuk'])||empty($data['rujukan'])) $message[]="Asal Rujukan Pasien Masih Kosong";
        if($data['id_cara_bayar']=="")  $err['err_carabayar']="cara Bayar Pasien Masih Kosong";
        if($data['cara_bayar']=="")     $err['err_carabayar']="Cara Bayar Pasien Masih Kosong";
        if(empty($data['id_cara_bayar'])||empty($data['cara_bayar'])) $message[]="Cara Bayar Pasien Masih Kosong";
        if($data['id_jenis_peserta']=="")   $err['err_jenispeserta']="Jenis Peserta Masih Kosong";
        if($data['jenis_peserta']=="")  $err['err_jenispeserta']="Jenis Peserta Pasien Masih Kosong";
        if(empty($data['id_jenis_peserta'])||empty($data['jenis_peserta'])) $message[]="Jenis Peserta Masih Kosong";
        if($data['dokterJaga']=="")  $err['err_dokter']="Dokter Belum dipilih";
        if($data['namaDokterJaga']=="")  $err['err_dokter']="Dokter Belum dipilih";
        if(empty($data['dokterJaga'])||empty($data['namaDokterJaga'])) $message[]="DOkter elum Dipilih";

        //Divalidasi khusus Pasien BPJS
        $jkn=$this->input->post('jkn');
        if($jkn===1){
            if($data['no_rujuk']==""){
                $err['err_norujuk']="No Rujuk Pasien Masih Kosong";
                $message[]=$err['err_norujuk'];
            }
            if($data['no_bpjs']==""){
                $err['err_nobpjs']="No BPJS Pasien Masih Kosong";
                $message[]=$err['err_nobpjs'];
            }
        }
        
        if(!empty($err)) {
            if(!empty($message)) $pesan=implode(",", $message);else $pesan="Unknow Error";
            $response=array('code'=>202,'message'=>$pesan,'error'=>$err);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else {
            // $id = $this->Mandiri_model->insertPendaftaran($data);
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
            $status_kajian=$this->input->post('kajian_mandiri_covid19');
            if($status_kajian){
                $idx=$this->input->post('idx');
                $point=0;
                foreach ($idx as $i ) {
                    $jawaban=$this->input->post('jawaban'.$i);
                    if(!$jawaban) $jawaban=0;
                    $point+=$jawaban;
                    $detail[]=array(
                        'idx_kajian'=>'',
                        'idx_pertanyaan'=>$i,
                        'pertanyaan'=>$this->input->post('pertanyaan'.$i),
                        'point'=>$jawaban
                    );
                }
                $kajian=array(
                    'object_kajian'=>'Pasien',
                    'nik'=>$this->input->post('no_ktp'),
                    'nama_lengkap'=>$this->input->post('nama_pasien'),
                    'keperluan'=>'Berobat',
                    'tgl_berkunjung'=>$this->input->post('tgl_masuk'),
                    'tgl_pengisian'=>date('Y-m-d H:i:s'),
                    'point_kajian_covid'=>$point,
                );
            }else{
                $kajian=array();
                $detail=array();
            }

            $param=array('data'=>$data,'pasien'=>$pasien,'kajian_mandiri'=>$status_kajian,'kajian'=>$kajian,'detail'=>$detail);
            $response = $this->Online_model->http_request($param,SMART_CALL_BACK ."sim/pendaftaran/daftar_pasien_baru",$x_token);
            header('Content-Type: application/json');
            echo $response;
            
        }
    }
    function cekstatus($nobpjs){
        $response=$this->Mandiri_model->getPesertaByKartuBPJS($nobpjs,date('Y-m-d'));
        echo $response;
    }
    function listrujukan($nobpjs,$faskes){
        if($faskes==1) $response=$this->Mandiri_model->listrujukanfaskes1($nobpjs);
        elseif ($faskes==2) $response=$this->Mandiri_model->listrujukanfaskes2($nobpjs);
        echo $response;
    }
    function polibpjs($kode,$tglrujukan,$idpengirim){
        date_default_timezone_set("Asia/Jakarta");
        $tgl_rencana_kunjungan=date_create(date('Y-m-d'));
        $awalkunjungan =date_create($tglrujukan);
        $diff=date_diff($awalkunjungan,$tgl_rencana_kunjungan);
        if($diff->invert==0){
            $selisih = $diff->days;
            if ($selisih<=90) {
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
                $p1=array('poly_kode'=>$kode);
                $param=array('param'=>$p1);
                $poly = $this->Online_model->http_request($param,SMART_CALL_BACK ."sim/pendaftaran/polibpjs",$x_token);
                $arr_poly=json_decode($poly);
                // print_r($arr_poly);
                // echo $arr_poly->code;
                // echo SMART_CALL_BACK;
                // echo $poly;
                // exit;
                if($arr_poly->code==true) $res=$arr_poly->data;else $res=array();
                
                // $res=$this->Mandiri_model->getPoliByKodeBpjs($kode);
                // $perujuk=$this->Mandiri_model->getPerujuk($idpengirim);
                $p2=array('kodeppk'=>$idpengirim);
                $param2=array('param'=>$p2);
                $asal = $this->Online_model->http_request($param2,SMART_CALL_BACK ."sim/pendaftaran/perujuk",$x_token);
                // echo $res; exit;
                $arr_asal=json_decode($asal);
                // print_r($arr_asal); exit;
                if($arr_asal->code==true) $perujuk=$arr_asal->data; else $perujuk=array();
                // print_r($arr_asal); exit;
                if(empty($perujuk)) $perujuk=null;
                if(!empty($res)){
                    $data=array(
                        'status'    => true,
                        'message'   => 'OK',
                        'data'      => $res,
                        'perujuk'   => $perujuk,
                    );
                }else{
                    $data=array(
                        'status'    => true,
                        'message'   => 'OK',
                        'data'      => null,
                        'perujuk'   => $perujuk
                    );
                }
            }
            else{
                $data=array(
                    'status'    => false,
                    'message'   => 'Rujukan Anda Sudah tidak berlaku karena suda lebih dari 90 hari, Silahkan minta kembali rujukan baru dari puskesmas',
                    
                );
            }
        }else{
            $data=array(
                'status'    => false,
                'message'   => 'Data Tidak Benar',
            );            
        }
        echo json_encode($data);
    }
}

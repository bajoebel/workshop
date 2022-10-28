<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mandiri_model');
    }
	public function cari()
	{
        $nomr=$this->input->post('nomr');
        // echo $nomr; exit;
        if(strlen($nomr)==6){
            $cek=$this->Mandiri_model->cekPasien($nomr);
            $pj=$this->Mandiri_model->cekPj($nomr);
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
            if($cek){
                $response=array(
                    'status'=>true,
                    'message'=>'OK',
                    'data'  => $cek,
                    'pjnama'=>$pjnama,
                    'pjpekerjaan'=>$pjpekerjaan,
                    'pjalamat'=>$pjalamat,
                    'pjnotelp'=>$pjnotelp,
                    'pjhubungan'=>$pjhubungan
                );
            }else{
                $response=array(
                    'status'=>false,
                    'message'=>'Pasien Dengan NOMR '.$nomr .' Tidak Ditemukan',
                    'data'  => ''
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
        $data=array(
            'dokter'=>$this->Mandiri_model->getDokter($id_ruang)
        );
        $this->load->view('mandiri/dokter',$data);
        // header('Content-Type: application/json');
        // echo json_encode($response);
    }

    function carabayar($asuransi){
        $data=$this->Mandiri_model->getCaraBayar($asuransi);
        $this->load->view('mandiri/carabayar',$data);
    }
    function simpan_pendaftaran(){
        $data=array(
            'nomr'=>$this->input->post('nomr'),
            'no_ktp'=>$this->input->post('no_ktp'),
            'nama_pasien'=>$this->input->post('nama_pasien'),
            'tempat_lahir'=>$this->input->post('tempat_lahir'),
            'tgl_lahir'=>$this->input->post('tgl_lahir'),
            'jns_kelamin'=>$this->input->post('jns_kelamin'),
            'nama_provinsi'=>$this->input->post('nama_provinsi'),
            'nama_kab_kota'=>$this->input->post('nama_kab_kota'),
            'nama_kecamatan'=>$this->input->post('nama_kecamatan'),
            'nama_kelurahan'=>$this->input->post('nama_kelurahan'),
            'jns_layanan'=>'RJ',
            'tgl_masuk'=>date('Y-m-d :H:i:s'),
            'tgl_daftar'=>$this->input->post('tgl_daftar'),
            'id_ruang'=>$this->input->post('id_ruang'),
            'nama_ruang'=>$this->input->post('nama_ruang'),
            'id_rujuk'=>$this->input->post('id_rujuk'),
            'rujukan'=>$this->input->post('rujukan'),
            'no_rujuk'=>$this->input->post('no_rujuk'),
            'id_cara_bayar'=>$this->input->post('id_cara_bayar'),
            'cara_bayar'=>$this->input->post('cara_bayar'),
            'id_jenis_peserta'=>$this->input->post('id_cara_bayar').".".$this->input->post('id_jenis_peserta'),
            'jenis_peserta'=>$this->input->post('jenis_peserta'),
            'no_bpjs'=>$this->input->post('no_bpjs'),
            'no_jaminan'=>$this->input->post('no_jaminan'),
            'tgl_jaminan'=>$this->input->post('sekarang'),
            'pjPasienNama'=>$this->input->post('pjPasienNama'),
            'pjPasienPekerjaan'=>$this->input->post('pjPasienPekerjaan'),
            'pjPasienAlamat'=>$this->input->post('pjPasienAlamat'),
            'pjPasienTelp'=>$this->input->post('pjPasienTelp'),
            'pjPasienHubKel'=>$this->input->post('pjPasienHubKel'),
            'pjPasienDikirimOleh'=>$this->input->post('pjPasienDikirimOleh'),
            'pjPasienAlmtPengirim'=>$this->input->post('pjPasienAlmtPengirim'),
            'dokterJaga'=>$this->input->post('id_dokter'),
            'namaDokterJaga'=>$this->input->post('namaDokterJaga'),
        );
        //$message="OK";
        // Validasi Data
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
        if($data['pjPasienNama']=="")   $err['err_namapasien']="Nama Penanggung Jawab Pasien Masih Kosong";
        if($data['pjPasienTelp']=="")   $err['err_telppasien']="TelpPenanggung Jawab Pasien Masih Kosong";
        if($data['pjPasienNama']==""||$data['pjPasienTelp']==""){
            $message[]="Data Penanggung Jawab Belum Lengkap";
        }
        // Cek pendaftaran ke ruangan yang sama
        $cekKunjungan=$this->Mandiri_model->cekKunjungan($data['nomr'],date('Y-m-d'),$data['id_ruang'],$jkn);
        if($cekKunjungan>0 && $jkn==1){
            //Jika Pasien bpjs dan sudah mendaftar selanjutnya
            $err['err_kunjungan'] = "Pasien BPJS Hanya bisa mendaftar 1 kali dalam sehari";
            $message[]="Pasien BPJS Hanya bisa mendaftar 1 kali dalam sehari";
        }else if($cekKunjungan>0 && $jkn!=1){
            $err['err_kunjungan'] = "Pasien sudah terdaftar di poli yang sama di hari sama";
            $message[]="Pasien sudah terdaftar di poli yang sama di hari sama";
        }
        $cekPendaftaran=$this->Mandiri_model->cekPendaftaran($data['nomr'],date('Y-m-d'),$data['id_ruang'],$jkn);
        if($cekPendaftaran>0 && $jkn==1){
            //Jika Pasien bpjs dan sudah mendaftar selanjutnya
            $err['err_kunjungan'] = "Pasien BPJS Hanya bisa mendaftar 1 kali dalam sehari";
            $message[]="Pasien BPJS Hanya bisa mendaftar 1 kali dalam sehari";
        }else if($cekPendaftaran>0 && $jkn!=1){
            $err['err_kunjungan'] = "Pasien sudah terdaftar di poli yang sama di hari sama";
            $message[] = "Pasien sudah terdaftar di poli yang sama di hari sama";
        }
        if(!empty($err)) {
            if(!empty($message)) $pesan=implode(",", $message);else $pesan="Unknow Error";
            $response=array('status'=>false,'message'=>$pesan,'error'=>$err);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else {
            $label_antrian=$this->input->post('label_antrian');
            $jam_antrian=$this->input->post('jam_antrian');
            $quota_antrian=$this->input->post('quota_antrian');
            $name_antrian=$this->input->post('name_antrian');
            $no_antrian = $this->Mandiri_model->createAntrian(date('Y-m-d'),$label_antrian,$data['id_ruang'],$data['dokterJaga'],$quota_antrian);
            if($no_antrian!=false){
                $id = $this->Mandiri_model->insertPendaftaran($data);
                $antrian=array(
                    'id_pendaftaranonline'=>$id,
                    'tgl_kunjungan'=>date('Y-m-d'),
                    'jam_kunjunganLabel'=>$name_antrian,
                    'jam_kunjunganAntrian'=>$jam_antrian,
                    'label_antrian'=>$label_antrian,
                    'ruangid'=>$data['id_ruang'],
                    'nrpdokter'=>$data['dokterJaga'],
                    'nomor_antrian'=>$no_antrian,
                    'source'=>'Atm'
                );
                $this->db->insert('tbl02_antrianv2',$antrian);
                header('Content-Type: application/json');
                echo json_encode(array('status'=>true,'message'=>'Simpan Pendaftaran ','idx'=>$id));
            }else{
                header('Content-Type: application/json');
                echo json_encode(array('status'=>false,'message'=>'Quota Untuk Jam kunjungan '.$jam_antrian .' Penuh'));
            }
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
                // $data=array(
                //     'code'      => 200,
                //     'status'    => 'Berlaku',
                //     'icon'      => 'fa-check',
                //     'noKunjungan'=>$response->noKunjungan,
                //     'poly_kode' => $response->kodepoliRujukan
                // );
                // Jika Rujukan masih berlaku
                $res=$this->Mandiri_model->getPoliByKodeBpjs($kode);
                $perujuk=$this->Mandiri_model->getPerujuk($idpengirim);
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
            }else{
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

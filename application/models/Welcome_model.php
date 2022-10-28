<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Welcome_model extends CI_Model
{
    function cekuser($username,$password){
        $this->db->where('user_email',$username);
        $this->db->where('user_password',md5($password));
        $this->db->where('user_status','Aktif');
        return $this->db->get('stx_user')->row();
    }
    function getMenuinduk(){
		$this->db->order_by('menu_idxutama');
		$this->db->order_by('menu_idxanak');
		$this->db->order_by('menu_idxsub');
		$this->db->where('menu_idxanak',0);
		$this->db->where('menu_status',1);
		return $this->db->get('stx_menu')->result();
	}

	function getMenuanak($idxutama){
		//$this->db->order_by('menu_idxutama');
		$this->db->order_by('menu_idxanak');
		$this->db->order_by('menu_idxsub');
		//$this->db->group_by('menu_idxanak');
		$this->db->where('menu_status',1);
		$this->db->where('menu_idxanak >',0);
		$this->db->where('menu_idxutama', $idxutama);
		return $this->db->get('stx_menu')->result();
	}
	function getSubmenu($idxutama,$idxanak){
		$this->db->order_by('menu_idxutama');
		$this->db->order_by('menu_idxanak');
		$this->db->order_by('menu_idxsub');
		$this->db->where('menu_status',1);
		$this->db->where('menu_idxutama', $idxutama);
		$this->db->where('menu_idxanak',$idxanak);
		$this->db->where('menu_idxsub >',0);
		return $this->db->get('stx_menu')->result();
	}
    function getSlider(){
        $this->db->where('slider_status',1);
        return $this->db->get('stx_slider')->result();
    }
    
    function getBlog($limit){
        $this->db->where('post_status','Publish');
        $this->db->where('post_jenis','Halaman Dinamis');
        $this->db->where('post_tglpublish < ',date('Y-m-d'));
        $this->db->join('stx_kategori b','a.post_kategori_id=b.kategori_id');
        $this->db->order_by('post_tanggal','DESC');
        $this->db->limit($limit);
        return $this->db->get('trx_post a')->result();
    }
    function getPartner(){
        return $this->db->get("stx_partner")->result();
    }


    function hitPost($tgl,$link){
		$this->db->query("UPDATE trx_post SET post_statistik=post_statistik+1 WHERE DATE_FORMAT(post_tanggal,'%Y-%m-%d')='$tgl' AND post_link='$link'");
	}
    function hitPage($link){
		$this->db->query("UPDATE trx_post SET post_statistik=post_statistik+1 WHERE post_link='$link'");
	}
    function addHits(){
		$ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'IP tidak dikenali';
	    $sekarang=date('Y-m-d');
	    $this->db->where('hit_ip',$ipaddress);
	    $this->db->where('hit_tgl',$sekarang);
	    $row=$this->db->get('trx_hits')->num_rows();
	    if($row>0){
	    	//update jumlah hittrx_hits
	    	$this->db->query("UPDATE trx_hits SET hit_jml=hit_jml+1 WHERE hit_ip='$ipaddress' AND hit_tgl='$sekarang'");
	    }else{
	    	$data=array(
	    		'hit_ip'	=> $ipaddress,
	    		'hit_tgl'	=> $sekarang,
	    		'hit_jml'	=> 1
	    	);
	    	$this->db->insert('trx_hits',$data);
	    	//Insert jml Hits
	    }
	}
    function get_post($post_tgl, $link){
        $sekarang=date('Y-m-d');
        $this->db->where("DATE_FORMAT(post_tanggal, '%Y-%m-%d')='$post_tgl'");
        $this->db->where('post_link',$link);
        $this->db->where('post_status','Publish');
        $this->db->where('post_jenis','Halaman Dinamis');
        $this->db->where('post_tglpublish <=',$sekarang);
        return $this->db->get('trx_post')->row();
    }
    function get_halaman($link){
        $this->db->where("post_link",$link);
        $this->db->where('post_status','Publish');
        $this->db->where('post_jenis','Halaman Statis');
        return $this->db->get('trx_post')->row();
    }
    function getBanner(){
		$this->db->where('banner_status',1);
		$this->db->order_by('banner_urut');
		return $this->db->get('stx_banner')->result();
	}
    function getGalery(){
		$this->db->select('media_namafile');
		$this->db->join('stx_direktori','media_dirid=dir_id');
		$this->db->where('dir_status',1);
		$this->db->where('dir_galery',1);
		$this->db->order_by('media_id','desc');
		return $this->db->get('stx_media')->result();
	}
    function getKomentar($post_id){
    	$this->db->where('komentar_status',1);
    	$this->db->where('komentar_postid', $post_id);
    	return $this->db->get('trx_komentar')->result();
    }
    
    function jmlData()
    {
        $this->db->group_by('id_ruang,idkelas_display');
        return $this->db->get('tbl01_kamar')->num_rows();
    }
    
    function getKategoriPeserta(){
        return $this->db->where('kategoristatus',1)->get('stx_kategoripeserta')->result();
    }
    function getKategoriKegiatan(){
        return $this->db->where('kategoriregistrasistatus',1)->get('stx_kategoriregistrasi')->result();
    }
}
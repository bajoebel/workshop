<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasboard extends CI_Controller {
	function __construct()
    {
        parent::__construct();
    }
    function index(){
        $link='admin/dasboard';
        $priv=getAkses($link,$this->session->userdata('level'));
        if(!empty($priv)){
            $data=array();
            $data=array(
                'libjs'=>array('js/app/home.js','js/app/online.js'),
                'content'=> $this->load->view('admin/home_index',$data,true),
                'aktif'=>$priv->urut_menu
            );
            $this->load->view('admin/layout',$data);
        }else{
            $data=array(
                'content'=> $this->load->view('403','',true),
                'aktif'=>1
            );
            $this->load->view('admin/layout',$data);
        }
    }
}
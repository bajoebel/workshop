<?php 
function tglindo($tgl){
    $hari = date('D', strtotime($tgl));
    $list_hari = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'sabtu'
    );
    $arr1=explode(' ',$tgl);
    $arr=explode('-',$arr1[0]);
    $bulan=array('','Januari', 'Februari', 'Maret', 'April', 
    'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
    'November', 'Desember');
    $hasil = $arr[2] ." " .$bulan[intval($arr[1])]." " . $arr[0] ;
    return $list_hari[$hari] ." / " .$hasil;
}
function longDate($strdate){
    $tgl=date('Y-m-d');
    $timestamp = strtotime($strdate);
    $day = date('D', $timestamp);
    $hari=array(
        'Sun'=>'Minggu',
        'Mon'=>'Senin',
        'Tue'=>'Selasa',
        'Wed'=>'Rabu',
        'Thu'=>'Kamis',
        'Fri'=>'Jumat',
        'Sat'=>'Sabtu'
    );
    $arr1=explode(' ', $strdate);
    // print_r($arr1);
    $jmldata = count($arr1);
    if(count($arr1)>1){
        $arr=explode('-',$arr1[0]);
        $t=$arr1[1];
    }else{
        $arr=explode('-',$strdate);
        $t='';
    }
    
    $bulan = array(
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    //print_r($arr);exit;
    return array('hari'=>$hari[$day],'label'=>$hari[$day].", ". $arr[2] ." " .$bulan[intval($arr[1])] ." " .$arr[0],'waktu'=>$t);
}
function dateEng($tgl){
    $t=explode('/',$tgl);
    if(count($t)==3){
        $nt=$t[2]."-".$t[1]."-".$t[0];
        return $nt;
    }else return false;
}
?>
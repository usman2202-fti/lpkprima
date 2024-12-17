<?php
function tgl_indo($tanggal){$bulan = array (1 =>   'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agust','Sep','Okt','Nov','Des' ); $pecahkan = explode('-', $tanggal); return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0]; }
$db['host'] = "localhost"; $db['user'] = "root"; $db['pass'] = ""; $db['name'] = "aplikasi_lpkprima"; 
$config = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);
$cek = mysqli_fetch_array(mysqli_query($config, "SELECT * from promo where kodepromo='$_GET[kodepromo]' and untuk='$_GET[untuk]' and stp ='in'"));
if ($_GET['kodepromo'] == '') {	$tglp = ''; $tglhar = date('Y-m-d'); 	$biaya = '0';	$cpro = '';	$kdpro = ''; $tglakhir=''; } else { $tglp = $cek['tglakhir']; $tglhar = date('Y-m-d'); 	$biaya = $cek['biaya'];	$cpro = $cek['promo']; $tglakhir=$cek['tglakhir'];
	$kdpro = $cek['promo'];}

if($cpro == ''){ $promo = "0";}else{ $promo = $cpro;};
$persen=($promo /100)*$biaya;
$pbayar= $biaya - $persen;
$tglbatas = date('Y-m-d', strtotime('+1 days', strtotime($tglp)));
if ($tglhar > $tglbatas || $tglhar == $tglbatas) { if($kdpro == ''){ $tam = "Anda tidak mendapatkan diskon karena tidak menggunakan kode promo";$pr=''; $hid="block"; $stp='F';}else{ $tam='Mohon Maaf!! Promo telah berakhir'; $pr="Rp " . number_format($biaya,0,',','.'); $hid="none"; $stp='T';}} else{ $tam='Promo Diskon '.$promo.'% Berlaku Sampai Tanggal '.tgl_indo($tglp); $pr="Rp " . number_format($pbayar,0,',','.'); $hid="none"; $stp='T';};
$data_cek = array(  'tglakhir'   => $tglakhir,
              		'ket' 		=> 	$tam,
              		'bayar'		=> 	$pr,
              		'hid'		=> 	$hid,
	              	'stp'		=> 	$stp,);
 echo json_encode($data_cek);

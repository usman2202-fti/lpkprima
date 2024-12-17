<?php
include "../kon.php";
$emas = mysqli_fetch_array(mysqli_query($kon, "SELECT * FROM pegawai WHERE nip='$_GET[kode]'"));
$data_emas = array('nama'   	=>  $emas['nama'],
              		'jk'  	=>  $emas['jk'],
              		'gol'    		=>  $emas['gol'],
              		'jabatan'    		=>  $emas['jabatan']);
 echo json_encode($data_emas);

<?php
include "../kon.php";
$pengguna = mysqli_fetch_array(mysqli_query($kon, "SELECT * from pengguna where idkar='$_GET[id]'"));
$karyawan = mysqli_fetch_array(mysqli_query($kon, "SELECT * from karyawan where idkar='$_GET[id]'"));
$data_karyawan = array('user'   	=>  $pengguna['user'],
              		'nama'  	=>  $karyawan['nama'],
              		'nohp'    		=>  $karyawan['nohp'],
              		'alamat'    		=>  $karyawan['alamat'],);
 echo json_encode($data_karyawan);

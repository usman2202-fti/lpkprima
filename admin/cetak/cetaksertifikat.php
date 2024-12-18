<?php
require_once ("../../vendors/dompdf/autoload.inc.php");
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

error_reporting(0); 
$daritanggal=$_GET['dt'];
$sampaitanggal=$_GET['st'];
$bulan=$_GET['bulan'];
$tahun=$_GET['tahun'];
$laporan=$_GET['laporan'];
$tanggalhariini=date('Y-m-d');

function tgl_indo($tanggal){$bulan = array (1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' ); $pecahkan = explode('-', $tanggal); return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0]; }
$ketjudul='<h2>SERTIFIKAT</h2>';
include '../../kon.php';
$idkursus=$_GET['id']; 
$datapeserta=mysqli_query($kon, "SELECT * FROM peserta where idkursus='$idkursus'"); $tamdatpe=mysqli_fetch_array($datapeserta);
$datapromo=mysqli_query($kon, "SELECT * FROM promo where idkursus='$idkursus'"); $cekpromo=mysqli_fetch_array($datapromo); $promo=$cekpromo['promo']; $tglp = $cekpromo['tglakhir']; $tglhar = date('Y-m-d'); $biaya=$cekpromo['biaya']; $persen=($promo /100)*$biaya; $pbayar= $biaya - $persen; $tglbatas = date('Y-m-d', strtotime('+1 days', strtotime($tglp)));
if ($cekpromo['untuk']== '6'){ $stpeng ='kurmob';} elseif ($cekpromo['untuk']== '8'){ $stpeng ='kurmob';} elseif ($cekpromo['untuk']== '10'){ $stpeng ='kurmob';} elseif ($cekpromo['untuk']== '12'){ $stpeng ='kurmob';} else{$stpeng='kurkom';}
$datanilaipeserta=mysqli_query($kon, "SELECT * FROM nilaipeserta where idkursus='$idkursus'"); $ceknilai=mysqli_fetch_array($datanilaipeserta);
$imagePath = '../foto/' . $tamdatpe['foto'];
$imageData = base64_encode(file_get_contents($imagePath));

if($stpeng == 'kurkom'){$ketnilai1='Microsoft Office Word';$ketnilai2='Microsoft Office Excel';$ketnilai3='Microsoft Office Power Point';} else{$ketnilai1='Pengenalan Rambu-Rambu';$ketnilai2='Teknik Mengemudi';$ketnilai3='Teknik Parkir';}
$html= '
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center"><center><d style="font-size: 40px; font-style: bold;" >LKP PRIMA</d><br>Jl. Tambun Bungai RT. 02 Dekat Simpang 5 Kuala Kapuas Kalimantan Tengah</center></td>
  </tr>
  <tr>
    <td colspan="2"><hr style="border-color: #000000"></td>
  </tr>
</table> 

<center><h3>'.$ketjudul.'</h3></center><br>';

$html.='<table width="100%">
                            <tr>
                              <td width="50%" valign="top">
                                    <span style="font-size: 20px;">
                                        <table border="0" style="width: 100%;">
                                            <tr>
                                                <td><label class="col-5">Nama Lengkap</label></td>
                                                <td>: '.$tamdatpe['nama'].'</td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-5">Tempat, Tanggal Lahir</label></td>
                                                <td>: '.$tamdatpe['tplahir'].', '.tgl_indo($tamdatpe['tglahir']).'</td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-5">Agama</label></td>
                                                <td>: '.$tamdatpe['agama'].'</td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-5">Jenis Kelamin</label></td>
                                                <td>: '.$tamdatpe['jk'].'</td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-5">Pendidikan Terakhir</label></td>
                                                <td>: '.$tamdatpe['pendter'].'</td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-5">Pekerjaan</label></td>
                                                <td>: '.$tamdatpe['pekerjaan'].'</td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-5">Alamat</label></td>
                                                <td>: '.$tamdatpe['alamat'].'</td>
                                            </tr>
                                            <tr>
                                                <td><label class="col-5">Nomor Handphone</label></td>
                                                <td>: '.$tamdatpe['nama'].'</td>
                                            </tr>
                                        </table>
                      
                                    </span>
                                </td>

                              <td width="20%"><img src="data:image/jpeg;base64,' . $imageData . '" alt="Foto Kegiatan" width="200" height="300"></td>
                                <td width="1%"></td>
                              <td valign="top">
                                    <span style="font-size: 16px;">
                                        <table width="100%" border="1">
                                            <tr>
                                                <td width="70%" align="center"><strong>Keterangan</strong></td>
                                                <td align="center"><strong>Nilai</strong></td>
                                            </tr>
                                            <tr>
                                                <td width="70%">'.$ketnilai1.'</td>
                                                <td align="center">'.$nilai1=$ceknilai['nilai1'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">'.$ketnilai2.'</td>
                                                <td align="center">'.$nilai2=$ceknilai['nilai2'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">'.$ketnilai3.'</td>
                                                <td align="center">'.$nilai3=$ceknilai['nilai3'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">Jumlah</td>
                                                <td align="center">'.$totnilai=$nilai1+$nilai2+$nilai3.'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">Rata-Rata</td>
                                                <td align="center">'.round(($totnilai/3),2).'</td>
                                            </tr>
                                            </table><br>
                                    </span>
                              </td>
                            </tr>
                          </table>';

$html.='</table>';
$html.='<br>
<table width="100%">
    <tr>
        <td width="50%"></td>
        <td width="50%"><center>Kuala Kapuas, '.tgl_indo(date("Y-m-d")).'<br>Direktur,<p><br><p><br><u>AGUS PRIYANTO</u></center></td>
    </tr>
</table>';

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($namjudul.'.pdf',array('Attachment'=>0));
?>


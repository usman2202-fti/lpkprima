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

if ($laporan == 'harian'){ $ketjudul='Laporan Harian Data Pembayaran<br>Dari Tanggal '. $daritanggal.'&nbsp; Sampai Tanggal '.$sampaitanggal;} else if ($laporan == 'bulanan'){ $ketjudul='Laporan Bulanan Data Pembayaran<br>Bulan '.$bulan.'&nbsp; Tahun '.$tahun; ;} 
else {$ketjudul='Laporan Tahunan Data Pembayaran<br>&nbsp; Tahun '.$tahun;;}

if ($laporan == 'harian'){ $namjudul='Laporan Harian Data Pembayaran Dari Tanggal '. $daritanggal.' Sampai Tanggal '.$sampaitanggal;} else if ($laporan == 'bulanan'){ $namjudul='Laporan Bulanan Data Pembayaran Bulan '.$bulan.' Tahun '.$tahun; } else {$namjudul='Laporan Tahunan Data Pembayaran  Tahun '.$tahun;}

include "../../kon.php"; 
if ($laporan == 'harian'){$hasil="SELECT * FROM pembayaran WHERE tgl BETWEEN '$daritanggal' AND '$sampaitanggal' order by tgl asc";} else if ($laporan == 'bulanan'){$hasil="SELECT * FROM pembayaran WHERE month(tgl)='$bulan' AND  year(tgl)='$tahun' order by tgl asc";}else {$hasil="SELECT * FROM pembayaran WHERE  year(tgl)='$tahun' order by tgl asc";}
$data=mysqli_query($kon,$hasil ); 
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

$html.='<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr style="background-color: #08A128;">
    <th>No</th>
    <th>Id Kursus</th>
    <th>Biaya</th>
    <th>Untuk Kursus</th>
    <th>Keterangan</th>
    <th>Tanggal Pembayaran</th>
</tr>';
$no=1; 
while ($tampil=mysqli_fetch_array($data)) { $tnip=$tampil['idkursus']; $tuntuk= $tampil['untuk'];
  $datapeserta=mysqli_query($kon,"SELECT * FROM peserta WHERE idkursus='$tnip'" ); $tampildata=mysqli_fetch_array($datapeserta);
  $biaya =number_format($tampil['biaya'],0,',','.'); 

 if($tuntuk == 'komreg'){ $untuk="Komputer Reguler";} 
 if($tuntuk == 'kompri'){ $untuk="Komputer Privat";} 
 if($tuntuk == 'tek'){ $untuk="Teknisi Komputer";} 
 if($tuntuk == 'komdg'){ $untuk="Desain Grafis";} 
 if($tuntuk == '6'){ $untuk="Mengemudi Mobil 6 Jam";}
 if($tuntuk == '8'){ $untuk="Mengemudi Mobil 8 Jam";}
 if($tuntuk == '10'){ $untuk="Mengemudi Mobil 10 Jam";}
 if($tuntuk == '12'){ $untuk="Mengemudi Mobil 12 Jam";}
$html.='<tr>
      <td align="center" valign="top">'. $no.'</td>
      <td>Id Kursus : <b>'.$tnip.'</b><br>
      Nama : '.$tampildata['nama'].'<br>Tempat, Tanggal Lahir : '.tgl_indo($tampildata['tplahir']). ', '. tgl_indo($tampildata['tglahir']).'<br>Jenis Kelamin : '.$tampildata['jk'].'<br>Agama : '.$tampildata['agama'].'<br>Nomor handphone : '.$tampildata['nohp'].'<br>Pendidikan Terakhir : '.$tampildata['pendter'].'<br>Pekerjaan : '.$tampildata['pekerjaan'].'<br>Alamat : '.$tampildata['alamat'].'</td>
      <td valign="top">Rp '.$biaya.'</td>
      <td valign="top">'.$untuk.'</td>
      <td valign="top">'.$tampil['ket'].'</td>
      <td align="center" valign="top">'.tgl_indo($tampil['tgl']).'</td>
  </tr>'; $no++;
}
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


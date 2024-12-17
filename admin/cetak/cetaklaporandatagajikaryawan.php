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

if ($laporan == 'harian'){ $ketjudul='Laporan Harian Data Gaji Karyawan<br>Dari Tanggal '. $daritanggal.'&nbsp; Sampai Tanggal '.$sampaitanggal;} else if ($laporan == 'bulanan'){ $ketjudul='Laporan Bulanan Data Gaji Karyawan<br>Bulan '.$bulan.'&nbsp; Tahun '.$tahun; ;} 
else {$ketjudul='Laporan Tahunan Data Gaji Karyawan<br>&nbsp; Tahun '.$tahun;;}

if ($laporan == 'harian'){ $namjudul='Laporan Harian Data Gaji Karyawan Dari Tanggal '. $daritanggal.' Sampai Tanggal '.$sampaitanggal;} else if ($laporan == 'bulanan'){ $namjudul='Laporan Bulanan Data Gaji Karyawan Bulan '.$bulan.' Tahun '.$tahun; } else {$namjudul='Laporan Tahunan Data Gaji Karyawan  Tahun '.$tahun;}

include "../../kon.php"; 
if ($laporan == 'harian'){$hasil="SELECT * FROM datagaji WHERE  tgl BETWEEN '$daritanggal' AND '$sampaitanggal' order by tgl asc";} else if ($laporan == 'bulanan'){$hasil="SELECT * FROM datagaji WHERE  month(tgl)='$bulan' AND  year(tgl)='$tahun' order by tgl asc";}else {$hasil="SELECT * FROM datagaji WHERE   year(tgl)='$tahun' order by tgl asc";}
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
    <th>Data Karyawan</th>
    <th>Gaji Pokok</th>
    <th>Bonus</th>
    <th>Tanggal Gajian</th>
</tr>';
$no=1; 
while ($tampil=mysqli_fetch_array($data)) { $tidkar=$tampil['idkar'];
    $edit1=mysqli_query($kon, "SELECT * FROM karyawan WHERE idkar='$tidkar'"); $tedit1=mysqli_fetch_array($edit1); 
    $edit2=mysqli_query($kon, "SELECT * FROM pengguna WHERE idkar='$tidkar'"); $tedit2=mysqli_fetch_array($edit2);
    $gapok =number_format($tampil['gapok'],0,',','.'); 
    $bonus =number_format($tampil['bonus'],0,',','.'); 
    if($tedit2['level'] == 'kurkom'){ $jabatan="Instruktur Komputer";}else{ $jabatan= "Instruktur Mobil";}

$html.='<tr>
      <td align="center" valign="top">'. $no.'</td>
      <td>Id Karyawan : '.$tedit2['user'].'<br> Nama Karyawan : '.$tedit1['nama'].'<br> Nomor handphone : '.$tedit1['nohp'].'<br> Alamat : '.$tedit1['alamat'].'<br> Jabatan : '.$jabatan.'</td>
      <td valign="top"> Rp '.$gapok.'</td>
      <td valign="top"> Rp '.$bonus.'</td>
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


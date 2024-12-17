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

if ($laporan == 'harian'){ $ketjudul='Laporan Harian Data KAS <br>Dari Tanggal '. $daritanggal.'&nbsp; Sampai Tanggal '.$sampaitanggal;} else if ($laporan == 'bulanan'){ $ketjudul='Laporan Bulanan Data KAS <br>Bulan '.$bulan.'&nbsp; Tahun '.$tahun; ;} 
else {$ketjudul='Laporan Tahunan Data KAS <br>&nbsp; Tahun '.$tahun;;}

if ($laporan == 'harian'){ $namjudul='Laporan Harian Data KAS  Dari Tanggal '. $daritanggal.' Sampai Tanggal '.$sampaitanggal;} else if ($laporan == 'bulanan'){ $namjudul='Laporan Bulanan Data KAS  Bulan '.$bulan.' Tahun '.$tahun; } else {$namjudul='Laporan Tahunan Data KAS   Tahun '.$tahun;}

include "../../kon.php"; 

if ($_GET['laporan'] == 'bulanan'){
    $hasil1="SELECT * FROM pembayaran WHERE month(tgl)='$bulan' AND  year(tgl)='$tahun' order by tgl asc";
    $hasil2="SELECT * FROM datagaji WHERE month(tgl)='$bulan' AND  year(tgl)='$tahun' order by tgl asc";
    $hasil3="SELECT * FROM sarpra WHERE month(tgl)='$bulan' AND  year(tgl)='$tahun' order by tgl asc";}
if ($_GET['laporan'] == 'tahunan'){
    $hasil1="SELECT * FROM pembayaran WHERE  year(tgl)='$tahun' order by tgl asc";
    $hasil2="SELECT * FROM datagaji WHERE  year(tgl)='$tahun' order by tgl asc";
    $hasil3="SELECT * FROM sarpra WHERE  year(tgl)='$tahun' order by tgl asc";}
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
    <th>Keterangan</th>
    <th>Pemasukan</th>
    <th>Pengeluaran</th>
</tr>';
$html.='<tr><td colspan="4"><b>Pemasukan Pembayaran Kursus</b></td></tr>';
$no=1; 
$data=mysqli_query($kon,$hasil1 ); while ($tampil=mysqli_fetch_array($data)) { 
$tampem=number_format($tampil['biaya'],0,',','.'); $totalpemasukan+=$tampil['biaya'];

$html.='<tr>
      <td align="center" valign="top">'. $no++.'</td>
      <td valign="top">'.tgl_indo($tampil['tgl']).'</td>
      <td valign="top"> Rp '.$tampem.'</td>
      <td></td>
  </tr>'; 
}
$data2=mysqli_query($kon,$hasil2 ); while ($tampil2=mysqli_fetch_array($data2)) { 
    $tot1=($tampil2['gapok']+$tampil2['bonus']);
$tamba1=number_format($tot1,0,',','.'); $totalpengeluaran1+=$tot1;

$html.='<tr><td colspan="4"><b>Pengeluaran Pembayaran Gaji Karyawan</b></td></tr>';
$html.='<tr>
        <td align="center" valign="top">'. $no++.'</td>
        <td valign="top">'.tgl_indo($tampil2['tgl']).'</td>
        <td></td>
        <td valign="top"> Rp '.$tamba1.'</td>
    </tr>'; 
}
$data3=mysqli_query($kon,$hasil3 ); while ($tampil3=mysqli_fetch_array($data3)) { 
$tamba2=number_format($tampil3['biaya'],0,',','.'); $totalpengeluaran2+=$tampil3['biaya'];

$html.='<tr><td colspan="4"><b>Pengeluaran Pembayaran Perbaikan Sarana & Prasarana</b></td></tr>';
$html.='<tr>
        <td align="center" valign="top">'. $no++.'</td>
        <td valign="top">'.tgl_indo($tampil3['tgl']).'</td>
        <td></td>
        <td valign="top"> Rp '.$tamba2.'</td>
    </tr>'; 
}$totalpengeluaran=$totalpengeluaran1+$totalpengeluaran2; $totalkas=$totalpemasukan-$totalpengeluaran;
$rptp=number_format($totalpemasukan,0,',','.');
$rptk=number_format($totalpengeluaran,0,',','.');
$rpkas=number_format($totalkas,0,',','.');
$html.='
<tr>
    <td colspan="2"><b>Total Pemasukan</b></td>
    <td></td> 
    <td valign="top"><b> Rp '.$rptp.'</b></td>
</tr>';
$html.='
<tr>
    <td colspan="2"><b>Total Pengeluaran</b></td>
    <td></td> 
    <td valign="top"><b> Rp '.$rptk.'</b></td>
</tr>';
$html.='
<tr>
    <td colspan="2"><b>Total KAS (Pemasukan-Pengeluaran)</b></td>
    <td></td> 
    <td valign="top"><b> Rp '.$rpkas.'</b></td>
</tr>';
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
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($namjudul.'.pdf',array('Attachment'=>0));
?>


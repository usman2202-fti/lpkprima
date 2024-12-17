<!DOCTYPE html>
<html lang="en">
<?php include '../vendors/atas.php';?>
  <body class="nav-md">
    <div class="container body" style="background-color: #008f37">
      <div class="main_container">
        <?php include 'nav.php';?>

        <!-- page content -->
        <div class="right_col min-vh-100" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>

            <div class="">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <b style="color: #000000; font-size: 30px;">Data Peserta Selesai</b>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="width:100%">
                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Data Peserta</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; $stpeng=$_SESSION['level']; if($stpeng == 'kurkom') { $tabeldatapeserta=mysqli_query($kon, "SELECT * FROM datapeserta where untuk in ('komreg','kompri','tek','komdg') and stp='end' order by no DESC");} else {$tabeldatapeserta=mysqli_query($kon, "SELECT * FROM datapeserta where untuk in ('6','8','10','12') and stp='end' order by no DESC");}  while ($tampil=mysqli_fetch_array($tabeldatapeserta)) { $idkursus=$tampil['idkursus']; ?>
                            <tr>
                                <td><?= $no++; $tno=$tampil['no']?></td>
                                <?php $datapeserta=mysqli_query($kon, "SELECT * FROM peserta where idkursus='$idkursus'"); $tamdatpe=mysqli_fetch_array($datapeserta); $datanilaipeserta=mysqli_query($kon, "SELECT * FROM nilaipeserta where idkursus='$idkursus'"); $ceknilai=mysqli_fetch_array($datanilaipeserta);?>
                                <td>
                                  <label class="col-5">ID Kursus</label>: <?= $idkursus=$tampil['idkursus']?><br>
                                  <label class="col-5">Nama Lengkap</label>: <?= $tamdatpe['nama'] ?><br>
                                  <label class="col-5">Tempat, Tanggal Lahir</label>: <?= $tamdatpe['tplahir'] ?>, <?= tgl_indo($tamdatpe['tglahir']) ?><br>
                                  <label class="col-5">Agama</label>: <?= $tamdatpe['agama'] ?><br>
                                  <label class="col-5">Jenis Kelamin</label>: <?= $tamdatpe['jk'] ?><br>
                                  <label class="col-5">Pendidikan Terakhir</label>: <?= $tamdatpe['pendter'] ?><br>
                                  <label class="col-5">Pekerjaan</label>: <?= $tamdatpe['pekerjaan'] ?><br>
                                  <label class="col-5">Alamat</label>: <?= $tamdatpe['alamat'] ?><br>
                                  <label class="col-5">Nomor Handphone</label>: <?= $tamdatpe['nama'] ?><br> 
                                  <label class="col-5">Status Kursus</label>: <b><?php if($tampil['stp']=='ok'){ echo "Peserta belum aktif kursus";} else if($tampil['stp']=='af'){ echo "Peserta telah aktif kursus";} else { echo "Peserta telah menyelesaikan kursus<br> <label class='col-5'></label>&nbsp; pada tanggal "; echo tgl_indo($ceknilai['tgl']); echo "<br><br>";}?></b>
                                <label class="col-5">Jenis Kursus</label>: Kursus <?php if($tampil['untuk'] == 'komreg'){ echo "Komputer Reguler";} if($tampil['untuk'] == 'kompri'){ echo "Komputer Privat";} if($tampil['untuk'] == 'tek'){ echo "Teknisi Komputer";} if($tampil['untuk'] == 'komdg'){ echo "Desain Grafis";} if($tampil['untuk'] == '6'){ echo "Mengemudi Mobil 6 Jam";}if($tampil['untuk'] == '8'){ echo "Mengemudi Mobil 8 Jam";}if($tampil['untuk'] == '10'){ echo "Mengemudi Mobil 10 Jam";}if($tampil['untuk'] == '12'){ echo "Mengemudi Mobil 12 Jam";}?> 
                                </td>
                                <td>
                                  <?php if($stpeng == 'kurkom'){$ketnilai1='Microsoft Office Word';$ketnilai2='Microsoft Office Excel';$ketnilai3='Microsoft Office Power Point';}else{$ketnilai1='Pengenalan Rambu-Rambu';$ketnilai2='Teknik Mengemudi';$ketnilai3='Teknik Parkir';}?>
                                  <table width="100%" border="2">
                                  <tr>
                                     <td width="70%" align="center"><strong>Keterangan</strong></td>
                                    <td align="center"><strong>Nilai</strong></td>
                                  </tr>
                                  <tr>
                                    <td width="70%"><?= $ketnilai1 ?></td>
                                    <td align="center"><?= $nilai1=$ceknilai['nilai1']?></td>
                                  </tr>
                                  <tr>
                                    <td width="70%"><?= $ketnilai2 ?></td>
                                    <td align="center"><?= $nilai2=$ceknilai['nilai2']?></td>
                                  </tr>
                                  <tr>
                                    <td width="70%"><?= $ketnilai3 ?></td>
                                    <td align="center"><?= $nilai3=$ceknilai['nilai3']?></td>
                                  </tr>
                                  <tr>
                                    <td width="70%">Jumlah</td>
                                    <td align="center"><?= $totnilai=$nilai1+$nilai2+$nilai3?></td>
                                  </tr>
                                  <tr>
                                    <td width="70%">Rata-Rata</td>
                                    <td align="center"><?= round(($totnilai/3),2) ?></td>
                                  </tr>
                                </table>
                                </td>
                            </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>

          <div class="clearfix"></div>
        </div>
        <div style="text-align: right; padding-right: 2%; padding-bottom: 2%; padding-top: 1%;"></div>
      </div>
    </div>

<?php include '../vendors/bawah.php';?>
  </body>
</html>

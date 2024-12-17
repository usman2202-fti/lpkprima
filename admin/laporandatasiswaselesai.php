
<!DOCTYPE html>
<html lang="en">
<?php include '../vendors/atas.php';?>


  <body class="nav-md" style="background-color: #F7F7F7">
    <div class="container body" style="background-color: #008f37">
      <div class="main_container">
        <?php include 'nav.php';?>

        <!-- page content -->
        <div class="right_col vh-auto-max pb-4" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>

            <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h3 class="float-left"><b>Laporan Data Siswa Selesai</b></h3>
                  <?php include 'ceklaporan.php';?>
              </div>
              <div class="card-body">
                  <div class="row" <?php if('harian' == $_GET['laporan']){ echo "";}else{echo "hidden";}?>>
                    <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <center><h2>Laporan Harian <br>Dari Tanggal <?php echo $_GET['daritanggal']?>&nbsp; Sampai Tanggal <?php echo $_GET['sampaitanggal']?></h2><br><a href="cetak/cetaklaporandatasiswaselesai.php?laporan=harian&dt=<?php echo $_GET['daritanggal']?>&st=<?php echo $_GET['sampaitanggal']?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</a></center>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" <?php if('bulanan' == $_GET['laporan']){ echo "";}else{echo "hidden";}?>>
                    <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <center><h2>Laporan Bulanan <br>Bulan <?php echo $_GET['bulan']?>&nbsp; Tahun <?php echo $_GET['tahun']?></h2><br><a href="cetak/cetaklaporandatasiswaselesai.php?laporan=bulanan&bulan=<?php echo $_GET['bulan']?>&tahun=<?php echo $_GET['tahun']?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</a></center>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" <?php if('tahunan' == $_GET['laporan']){ echo "";}else{echo "hidden";}?>>
                    <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <center><h2>Laporan Tahun <br>Tahun <?php echo $_GET['tahun']?></h2><a href="cetak/cetaklaporandatasiswaselesai.php?laporan=tahunan&tahun=<?php echo $_GET['tahun']?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</a></center>
                        </div>
                      </div>
                    </div>
                  </div><br>

                  <?php if('harian' == $_GET['laporan'] || 'bulanan' == $_GET['laporan'] || 'tahunan' == $_GET['laporan']){ ?>
                  <div class="row" >
                    <table class="table table-bordered"  width="100%" cellspacing="0">
                        <thead style="background-image: linear-gradient(#08A128,#008f37); color: #FFFFFF;">
                            <tr>
                                <th>No</th>
                                <th>Data Peserta</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php include "../kon.php"; $no=1; 
                        if ($_GET['laporan'] == 'harian'){$hasil="SELECT * FROM datapeserta WHERE stp='end' and tgl BETWEEN '$daritanggal' AND '$sampaitanggal' order by tgl asc";}
                        if ($_GET['laporan'] == 'bulanan'){$hasil="SELECT * FROM datapeserta WHERE stp='end' and month(tgl)='$bulan' AND  year(tgl)='$tahun' order by tgl asc";}
                        if ($_GET['laporan'] == 'tahunan'){$hasil="SELECT * FROM datapeserta WHERE stp='end' and  year(tgl)='$tahun' order by tgl asc";}
                        $data=mysqli_query($kon,$hasil ); while ($tampil=mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?= $no++; $tno=$tampil['no']?></td>
                                <?php $idkursus=$tampil['idkursus']; $datapeserta=mysqli_query($kon, "SELECT * FROM peserta where idkursus='$idkursus'"); $tamdatpe=mysqli_fetch_array($datapeserta); $datanilaipeserta=mysqli_query($kon, "SELECT * FROM nilaipeserta where idkursus='$idkursus'"); $ceknilai=mysqli_fetch_array($datanilaipeserta);
                                  if ($tampil['untuk']== '6'){ $stpeng ='kurmob';} elseif ($tampil['untuk']== '8'){ $stpeng ='kurmob';} elseif ($tampil['untuk']== '10'){ $stpeng ='kurmob';} elseif ($tampil['untuk']== '12'){ $stpeng ='kurmob';} else{$stpeng='kurkom';} ?>
                                <td>
                                  <label class="col-5">ID Kursus</label>: <?= $idkursus=$tampil['idkursus']?><br>
                                  <label class="col-5">Nama Lengkap</label>: <?= $tamdatpe['nama'] ?><br>
                                  <label class="col-5">Tempat, Tanggal Lahir</label>: <?= $tamdatpe['tplahir'] ?>, <?= tgl_indo($tamdatpe['tglahir']) ?><br>
                                  <label class="col-5">Agama</label>: <?= $tamdatpe['agama'] ?><br>
                                  <label class="col-5">Jenis Kelamin</label>: <?= $tamdatpe['jk'] ?><br>
                                  <label class="col-5">Pendidikan Terakhir</label>: <?= $tamdatpe['pendter'] ?><br>
                                  <label class="col-5">Pekerjaan</label>: <?= $tamdatpe['pekerjaan'] ?><br>
                                  <label class="col-5">Alamat</label>: <?= $tamdatpe['alamat'] ?><br>
                                  <label class="col-5">Nomor Handphone</label>: <?= $tamdatpe['nohp'] ?><br> 
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
                           <?php }?>
                        </tbody>
                    </table>
                  </div>
                  <?php }?>

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

<script>
  $(window).load(function(){
  $("#dataa").change(function() {
        console.log($("#dataa option:selected").val());
        if ($("#dataa option:selected").val() == 'harian') {
          $('#tampil').prop('hidden', false);
        } else {
          $('#tampil').prop('hidden', true);
        }
        if ($("#dataa option:selected").val() == 'bulanan') {
          $('#tampil2').prop('hidden', false);
        } else {
          $('#tampil2').prop('hidden', true);
        }
        if ($("#dataa option:selected").val() == 'tahunan') {
          $('#tampil3').prop('hidden', false);
        } else {
          $('#tampil3').prop('hidden', true);
        }
      });
  });
</script>

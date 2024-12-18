<?php function tgl_indo($tanggal){$bulan = array (1 =>   'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agust','Sep','Okt','Nov','Des' ); $pecahkan = explode('-', $tanggal); return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0]; } ?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

      <title>LPK PRIMA</title>
  
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="../vendors/sweetalert/sweetalert.min.js"></script>

<body id="page-top" style="background-image: linear-gradient(#08A128,#008f37 )">

  <!-- Page Wrapper -->
  <div id="wrapper bg-light">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" >

      <!-- Main Content -->
      <div id="content">

        <div class="container-fluid mt-4">

          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h3 class="float-left">Data Peserta</h3><a style="color: #FFFFFF; font-weight: bold;" target="_blank" href="cetak/cetaksertifikat.php?id=<?= $_GET['id']?>" class="btn btn-success float-right ml-2">Cetak</a> <a style="color: #FFFFFF; font-weight: bold;" href="datapeserta.php" class="btn btn-warning float-right">Kembali</a>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                    <div class="float-left col-12">
                      <?php include '../kon.php'; $idkursus=$_GET['id']; $datapeserta=mysqli_query($kon, "SELECT * FROM peserta where idkursus='$idkursus'"); $tamdatpe=mysqli_fetch_array($datapeserta);
                      $datapromo=mysqli_query($kon, "SELECT * FROM promo where idkursus='$idkursus'"); $cekpromo=mysqli_fetch_array($datapromo); $promo=$cekpromo['promo']; $tglp = $cekpromo['tglakhir']; $tglhar = date('Y-m-d'); $biaya=$cekpromo['biaya']; $persen=($promo /100)*$biaya; $pbayar= $biaya - $persen; $tglbatas = date('Y-m-d', strtotime('+1 days', strtotime($tglp)));
                      if ($cekpromo['untuk']== '6'){ $stpeng ='kurmob';} elseif ($cekpromo['untuk']== '8'){ $stpeng ='kurmob';} elseif ($cekpromo['untuk']== '10'){ $stpeng ='kurmob';} elseif ($cekpromo['untuk']== '12'){ $stpeng ='kurmob';} else{$stpeng='kurkom';}
                      $datanilaipeserta=mysqli_query($kon, "SELECT * FROM nilaipeserta where idkursus='$idkursus'"); $ceknilai=mysqli_fetch_array($datanilaipeserta);?>
                      <div class="card-body">
                        <div>
                          <table width="100%">
                            <tr>
                              <td width="50%">
                                <b>- Biodata Peserta</b><br>
                                <label class="col-5">Nama Lengkap</label>: <?= $tamdatpe['nama'] ?><br>
                                <label class="col-5">Tempat, Tanggal Lahir</label>: <?= $tamdatpe['tplahir'] ?>, <?= tgl_indo($tamdatpe['tglahir']) ?><br>
                                <label class="col-5">Agama</label>: <?= $tamdatpe['agama'] ?><br>
                                <label class="col-5">Jenis Kelamin</label>: <?= $tamdatpe['jk'] ?><br>
                                <label class="col-5">Pendidikan Terakhir</label>: <?= $tamdatpe['pendter'] ?><br>
                                <label class="col-5">Pekerjaan</label>: <?= $tamdatpe['pekerjaan'] ?><br>
                                <label class="col-5">Alamat</label>: <?= $tamdatpe['alamat'] ?><br>
                                <label class="col-5">Nomor Handphone</label>: <?= $tamdatpe['nama'] ?><br>                         
                              </td>
                              <td width="20%"><?php if($tamdatpe['foto'] == null) { ?>
                                <form method="post" action="" enctype="multipart/form-data">
                                  <input type="hidden" class="form-control" name="no" value="<?= $idkursus=$_GET['id']?>">
                                  <input class="form-control" type="file" name="file" required><br>
                                  <button class="btn btn-sm " type="submit" name="simpanfoto" style="background-image: linear-gradient(#08A128,#008f37); color: #FFFFFF; font-size: 15px;"> Upload Foto</button>
                                </form>
                                <?php }else { ?>
                                  <img src="foto/<?= $tamdatpe['foto'] ?>" alt="Foto Kegiatan" width="200" height="300"><br>
                                  <a href='#' class='btn btn-sm btn-danger mt-1' data-toggle='modal' data-target='#hapus<?=$_GET['id'];?>'>Hapus</a>
                                  <div class="modal fade" id="hapus<?=$_GET['id'];?>" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                          <div class="modal-body">
                                            <h3>Apakah anda yakin akan menghapus ?</h3>
                                          </div>
                                          <div class="modal-footer">
                                            <form method="get" action=""><input type="hidden" name="no" value="<?= $_GET['id'];?>"><button class="btn btn-sm btn-danger" type="submit" name="hapusfoto">Ya, yakin hapus data</button> <button type="button" class="btn btn-sm btn-info" data-dismiss="modal" aria-label="Close">Tidak, batal hapus data</button></form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php } ?></td>
                                <td width="1%"></td>
                              <td valign="top">
                                <b>- Data Nilai Peserta</b><p>
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
                                </table><br>
                                <label class="col-4">Status Kursus</label>: <b><?php if($cekpromo['stp']=='ok'){ echo "Peserta belum aktif kursus";} else if($cekpromo['stp']=='af'){ echo "Peserta telah aktif kursus";} else { echo "Peserta telah menyelesaikan kursus<br> <label class='col-4'></label>&nbsp; pada tanggal "; echo tgl_indo($ceknilai['tgl']);}?></b><br>
                                <label class="col-4">Jenis Kursus</label>: Kursus <?php if($cekpromo['untuk'] == 'komreg'){ echo "Komputer Reguler";} if($cekpromo['untuk'] == 'kompri'){ echo "Komputer Privat";} if($cekpromo['untuk'] == 'tek'){ echo "Teknisi Komputer";} if($cekpromo['untuk'] == 'komdg'){ echo "Desain Grafis";} if($cekpromo['untuk'] == '6'){ echo "Mengemudi Mobil 6 Jam";}if($cekpromo['untuk'] == '8'){ echo "Mengemudi Mobil 8 Jam";}if($cekpromo['untuk'] == '10'){ echo "Mengemudi Mobil 10 Jam";}if($cekpromo['untuk'] == '12'){ echo "Mengemudi Mobil 12 Jam";}?>
                              </td>
                            </tr>
                          </table>
                                               
                          <hr>
                          <b>- Rincian Pemabayaran</b><br>
                          <label class="col-3">ID KURSUS</label>: <b><?= $idkursus ?></b><br>
                          
                          <label class="col-3">Keterangan</label>: <?php if ($promo == ''){ echo "Anda tidak mendapatkan diskon karena tidak menggunakan kode promo";} else{ if($tglhar > $tglbatas || $tglhar == $tglbatas){ echo "Mohon Maaf!! Promo telah berakhir'";}else{ echo 'Promo Diskon '.$promo.'% Berlaku Sampai Tanggal '.tgl_indo($tglp);}} ?><br>
                          <label class="col-3">Total Pembayaran</label>: <b><?php if($promo == '') { echo "Rp " . number_format($biaya,0,',','.');} else { echo "Rp " . number_format($pbayar,0,',','.');} ?></b><br>
                        </div>
                      </div>                      
                    </div>
                  </div>
              </div>
              <div class="card-footer">     
              </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- Bootstrap core JavaScript-->

</body>

</html>

<script src="../vendors/jquery/dist/jquery.min.js"></script>
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<?php 
if(isset($_POST['simpanfoto'])){
  $no =$_POST['no'];
  $nama = time() . '_' . basename($_FILES['file']['name']);  // Ambil nama file
  $ukuran = $_FILES['file']['size'];  // Ukuran file
  $file_tmp = $_FILES['file']['tmp_name'];  // Lokasi sementara file yang diupload

  // Cek apakah ukuran file valid (misalnya, kurang dari 1MB)
  if ($ukuran < 10044070) {
      // Cek error pada file upload
      if ($_FILES['file']['error'] == 0) {
          // Tentukan folder tujuan untuk menyimpan file
          $target_dir = "foto/";
          $target_file = $target_dir . $nama;
          
          // Cek apakah file sudah ada di server
          if (!file_exists($target_file)) {
              // Pindahkan file ke folder yang diinginkan
              if (move_uploaded_file($file_tmp, $target_file)) {
                  // Menyimpan data ke database
                  $query = mysqli_query($kon,"UPDATE peserta SET foto='$nama' WHERE idkursus='$no'");
                  if ($query) {
                      echo "<script>swal({title: 'File Berhasil Di Upload', text: 'Silakan tunggu...', icon: 'success', buttons: [false, false]});</script>";
                      echo "<meta http-equiv='refresh' content='3; url=tdatapeserta.php?id=$no'>";
                  } else {
                      echo "<script>swal({title: 'Gagal Menyimpan Data ke Database', icon: 'warning', buttons: [false, 'OK']});</script>";
                  }
              } else {
                  echo "<script>swal({title: 'Gagal Memindahkan File', icon: 'warning', buttons: [false, 'OK']});</script>";
              }
          } else {
              echo "<script>swal({title: 'File Sudah Ada', icon: 'warning', buttons: [false, 'OK']});</script>";
          }
      } else {
          echo "<script>swal({title: 'Error dalam Proses Upload', icon: 'warning', buttons: [false, 'OK']});</script>";
      }
  } else {
      echo "<script>swal({title: 'File Gagal Di Upload, Ukuran Terlalu Besar', icon: 'warning', buttons: [false, 'OK']});</script>";
  }
} 
if(isset($_GET['hapusfoto'])){
  $no =$_GET['no'];

    $data=mysqli_query($kon,"UPDATE peserta SET foto='' WHERE idkursus='$no'");
    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Dihapus', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=tdatapeserta.php?id=$no'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 
} 
?>

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
                  <h3 class="float-left">Pembayaran Calon Peserta</h3><a style="color: #FFFFFF; font-weight: bold;" href="calonpeserta.php" class="btn btn-warning float-right">Kembali</a>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                    <div class="float-left col-12">
                      <?php include '../kon.php'; $idkursus=$_GET['id']; $datapeserta=mysqli_query($kon, "SELECT * FROM peserta where idkursus='$idkursus'"); $tamdatpe=mysqli_fetch_array($datapeserta);?>
                      <div class="card-body">
                        <div>
                          <b>- Biodata Peserta</b><br>
                          <label class="col-3">Nama Lengkap</label>: <?= $tamdatpe['nama'] ?><br>
                          <label class="col-3">Tempat, Tanggal Lahir</label>: <?= $tamdatpe['tplahir'] ?>, <?= tgl_indo($tamdatpe['tglahir']) ?><br>
                          <label class="col-3">Agama</label>: <?= $tamdatpe['agama'] ?><br>
                          <label class="col-3">Jenis Kelamin</label>: <?= $tamdatpe['jk'] ?><br>
                          <label class="col-3">Pendidikan Terakhir</label>: <?= $tamdatpe['pendter'] ?><br>
                          <label class="col-3">Pekerjaan</label>: <?= $tamdatpe['pekerjaan'] ?><br>
                          <label class="col-3">Alamat</label>: <?= $tamdatpe['alamat'] ?><br>
                          <label class="col-3">Nomor Handphone</label>: <?= $tamdatpe['nohp'] ?><br>                     
                          <hr>
                          <b>- Rincian Pemabayaran</b><br>
                          <label class="col-3">ID KURSUS</label>: <b><?= $idkursus ?></b><br>
                          <?php $datapromo=mysqli_query($kon, "SELECT * FROM promo where idkursus='$idkursus'"); $cekpromo=mysqli_fetch_array($datapromo); $promo=$cekpromo['promo']; $tglp = $cekpromo['tglakhir']; $tglhar = date('Y-m-d'); $biaya=$cekpromo['biaya']; $persen=($promo /100)*$biaya; $pbayar= $biaya - $persen; $tglbatas = date('Y-m-d', strtotime('+1 days', strtotime($tglp)));?>
                          <label class="col-3">Keterangan</label>: <?php if ($promo == ''){ echo "Anda tidak mendapatkan diskon karena tidak menggunakan kode promo";} else{ if($tglhar > $tglbatas || $tglhar == $tglbatas){ echo "Mohon Maaf!! Promo telah berakhir'";}else{ echo 'Promo Diskon '.$promo.'% Berlaku Sampai Tanggal '.tgl_indo($tglp);}} ?><br>
                          <label class="col-3">Total Pembayaran</label>: <b><?php if($promo == '') { echo "Rp " . number_format($biaya,0,',','.');} else { if($tglhar > $tglbatas || $tglhar == $tglbatas){echo "Rp " . number_format($biaya,0,',','.');}else{echo "Rp " . number_format($pbayar,0,',','.');}} ?></b><br>
                        </div>
                      </div>                      
                    </div>
                  </div>
              </div>
              <div class="card-footer">
              <form method="post" action=""><input type="hidden" name="idkursus" value="<?= $idkursus ?>"><input type="hidden" name="untuk" value="<?= $cekpromo['untuk']?>"><input type="hidden" name="no" value="<?= $cekpromo['no']?>"><input type="hidden" name="biaya" value="<?php if($promo == '') { echo $biaya;} else if($tglhar > $tglbatas || $tglhar == $tglbatas){ echo $biaya;}else{ echo $pbayar;} ?>"><input type="hidden" name="ket" value="<?php if ($promo == ''){ echo "Anda tidak mendapatkan diskon karena tidak menggunakan kode promo";} else{ if($tglhar > $tglbatas || $tglhar == $tglbatas){ echo "Mohon Maaf!! Promo telah berakhir'";}else{ echo 'Promo Diskon '.$promo.'% Berlaku Sampai Tanggal '.tgl_indo($tglp);}} ?>"><button type="submit" name="bayar" class="btn btn-info col-1 float-right">Bayar</button></form>          
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
<script type="text/javascript">
$(document).ready(function(){
      $('#beranda').addClass("active");
});
</script>

<?php 
   if(isset($_POST['bayar'])){
    $no =$_POST['no'];
    $idkursus =$_POST['idkursus'];
    $biaya =$_POST['biaya'];
    $untuk =$_POST['untuk'];
    $ket =$_POST['ket'];
    $tgl=date('Y-m-d');

    $data=mysqli_query($kon,"INSERT INTO pembayaran (idkursus, biaya, untuk, ket, tgl) VALUES ('$idkursus','$biaya','$untuk','$ket','$tgl')");
    mysqli_query($kon,"UPDATE promo SET stp='ok' WHERE no='$no'");

    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Disimpan', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=datapeserta.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 

    }
?>

<?php session_start(); 
error_reporting(0); ?><!DOCTYPE html>
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

<body id="page-top" style="background-color: #51FA6D">

  <!-- Page Wrapper -->
  <div id="wrapper bg-light">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" >

      <!-- Main Content -->
      <div id="content">

        <div class="container-fluid mt-4">

          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h1 class="m-0 font-weight-bold text-center">LKP PRIMA</h1><center>Jl. Tambun Bungai RT. 02 Dekat Simpang 5 Kuala Kapuas Kalimantan Tengah</center>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                    <div class="float-left col-12">
                      
                      <div class="card-body">
                        <?php include 'nav.php'; ?>
                        <div <?php if($_GET['/'] == ''){ echo "";} else { echo "hidden";}?>><br>
                          <label><b>Ketentuan Umum</b></label><br>
                          1. Tidak boleh bawa senjata tajam<br>
                          2. Tidak boleh membawa membawa obat terlarang <br>
                          3. TIdak boleh mabuk-mabukan saat mengikuti kursus<br>
                          4. Apabila tidak dapat hadir harap melapor ke instruktur<br>
                          5. Harap jangan main HP dan bercanda saat mengikuti kursus<br>
                          <center><b>--- Pilih Paket Kursus Komputer ---</b><br>
                          <label><b>Kursus Komputer</b></label><br>
                          <a href="daftarkursus.php?/=komreg" class="btn btn-info mb-1 mr-2">Daftar Reguler <br> (Rp. 500.00)</a>&nbsp;
                          <a href="daftarkursus.php?/=kompri" class="btn btn-info mb-1">Daftar Privat <br> (Rp. 750.00)</a><br>
                          <label><b>Kursus Teknisi Komputer</b></label><br>
                          <a href="daftarkursus.php?/=tek" class="btn btn-info mb-1">Daftar <br> (Rp. 1.200.000)</a><br>
                          <label><b>Kursus Desain Grafis</b></label><br>
                          <a href="daftarkursus.php?/=komdg" class="btn btn-info mb-1">Daftar  <br> (Rp. 950.00)</a><br>
                          </center>
                          <center><b>--- Pilih Paket Kursus Mobil ---</b><br><br>
                          <a href="daftarkursus.php?/=6" class="btn btn-info mb-1 mr-2">Daftar 6 Jam <br> (Rp. 525.00)</a>&nbsp;
                          <a href="daftarkursus.php?/=8" class="btn btn-info mb-1">Daftar 8 Jam <br> (Rp. 680.00)</a>&nbsp;
                          <a href="daftarkursus.php?/=10" class="btn btn-info mb-1">Daftar 10 Jam <br> (Rp. 825.00)</a>&nbsp;
                          <a href="daftarkursus.php?/=12" class="btn btn-info mb-1">Daftar 12 Jam <br> (Rp. 940.00)</a>
                          </center>
                        </div>                        
                          <?php include 'kursus.php';?>
                      </div>
                      
                    </div>
                  </div>
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
    <script src="../vendors/sweetalert/js/index.js"></script>
<script type="text/javascript">
$(document).ready(function(){
      $('#daftarkursus').addClass("active");
});
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
</script>
<script type="text/javascript">
    function cek(){
        var kodepromo = $("#kodepromo").val();
        var untuk = "<?php echo $_GET['/'];?>";
        $.ajax({
            url: 'ajax.php',
            data:"kodepromo="+kodepromo+"&untuk="+untuk,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#stp').val(obj.stp);          
            document.getElementById("hilang").style.display = obj.hid;
            document.getElementById("ket").innerHTML = obj.ket;
            document.getElementById("bayar").innerHTML = obj.bayar;
            document.getElementById("tglakhir").innerHTML = obj.tglakhir;
        });
    }
</script>
<?php include '../kon.php';
   if(isset($_POST['daftar'])){
    $idkursus =$_POST['idkursus'];
    $nama =$_POST['nama'];
    $tplahir =$_POST['tptlhr'];
    $tglahir =$_POST['tgllhr'];
    $agama =$_POST['agama'];
    $jk =$_POST['jk'];
    $pendter =$_POST['pendter'];
    $pekerjaan =$_POST['pekerjaan'];
    $alamat =$_POST['alamat'];
    $nohp =$_POST['nohp'];
    $promo =$_POST['kodepromo'];
    $biaya =$_POST['biaya'];
    $untuk =$_POST['untuk'];
    $stp =$_POST['stp'];
    $tgl=date('Y-m-d');

    if ($stp == 'F'){$data=mysqli_query($kon,"INSERT INTO peserta (idkursus, nama, tplahir, tglahir, agama, jk, pendter, pekerjaan, alamat, nohp,tgl) VALUES ('$idkursus', '$nama', '$tplahir', '$tglahir', '$agama', '$jk', '$pendter', '$pekerjaan', '$alamat', '$nohp', '$tgl')"); mysqli_query($kon,"INSERT INTO promo (idkursus, biaya, untuk, stp, tgl) VALUES ('$idkursus','$biaya','$untuk','out','$tgl')");}
    else{ $data=mysqli_query($kon,"INSERT INTO peserta (idkursus, nama, tplahir, tglahir, agama, jk, pendter, pekerjaan, alamat, nohp,tgl) VALUES ('$idkursus', '$nama', '$tplahir', '$tglahir', '$agama', '$jk', '$pendter', '$pekerjaan', '$alamat', '$nohp', '$tgl')"); mysqli_query($kon,"UPDATE promo SET idkursus='$idkursus', stp='out' WHERE kodepromo='$promo'");}

    if ($data) {
    echo "<script>swal({title: 'Pendaftaran $idkursus berhasil !! silahkan lakukan pembanyaran secepatnya agar promo tidak hilang', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='5; url=daftarkursus.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 

    }
?>

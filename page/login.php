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
  
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <?php include 'nav.php'; ?><center>
                        <div class="col-4">
                          <div class="card card-login shadow mt-5">
                            <!--<div class="card-header"> <center><img src="img/logo2.png" width="70%" height="70%"></center> </div>-->
                            <div class="card-body mt-4 mb-5">
                              <form method="post" action="">
                                <div class="form-group">
                                  <div class="form-label-group">
                                    <input type="text" id="inputEmail" class="form-control" placeholder="Nama Pengguna" name="user" required="required" >
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="form-label-group">
                                    <input type="password" id="inputPassword" class="form-control" placeholder="Kata Sandi" name="pass" required="required">
                                  </div>
                                </div>
                                <button class="btn btn-primary btn-block" type="submit" name="masuk">Masuk</button>
                              </form>
                            </div>
                          </div>
                        </div></center>
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
<script type="text/javascript">
$(document).ready(function(){
      $('#login').addClass("active");
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
  $('#dataTable').DataTable();
});
</script>
<?php include '../kon.php';

if(isset($_POST['masuk'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];

// menyeleksi data admin dengan user dan pass yang sesuai
$data = mysqli_query($kon,"SELECT * FROM pengguna WHERE user='$user' AND pass='$pass'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
    
    $lihat=mysqli_fetch_array($data);


    if($lihat['level']=='admin'){
        $_SESSION['user'] =$user;
        $_SESSION['idkar'] = $lihat['idkar'];
        $_SESSION['level'] = $lihat['level'];

        echo "<script>swal({title: 'Nama Pengguna & Kata Sandi Dikenali', text:'Silahkan tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
        echo "<meta http-equiv='refresh' content='4; url=../admin/index.php'>";

    } else if($lihat['level']=='kurkom' || $lihat['level']=='kurmob'){
      $_SESSION['user'] =$user;
      $_SESSION['idkar'] = $lihat['idkar'];
      $_SESSION['level'] = $lihat['level'];

      echo "<script>swal({title: 'Nama Pengguna & Kata Sandi Dikenali', text:'Silahkan tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
      echo "<meta http-equiv='refresh' content='4; url=../instruktur/index.php'>";

  } else {
        echo "<script>swal({title: 'Maaf !! Nama Pengguna & Kata Sandi Tidak Dikenali', icon: 'warning'});</script>";}

}else{
    echo "<script>swal({title: 'Maaf !! Nama Pengguna & Kata Sandi Tidak Dikenali', icon: 'warning'});</script>";
}}

?>

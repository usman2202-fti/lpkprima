<!DOCTYPE html>
<html lang="en">
<?php include '../vendors/atas.php';?>
  <body class="nav-md" style="background-color: #F7F7F7">
    <div class="container body" style="background-color: #008f37">
      <div class="main_container">
        <?php include 'nav.php';?>

        <!-- page content -->
        <div class="right_col vh-100" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>

            <div class="">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <b style="color: #000000; font-size: 30px;">Data Profil</b>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="width:100%; font-size: 20px;">
                    <?php $tidkar=$_SESSION['idkar']; $edit1=mysqli_query($kon, "SELECT * FROM karyawan WHERE idkar='$tidkar'"); $tamdatpe=mysqli_fetch_array($edit1); ?>
                    <div <?php if($_GET['/']=='edit'){echo "hidden";}else{ echo "";}?>>  
                      <label class="col-3">Nama Lengkap</label>: <?= $tamdatpe['nama'] ?><br>
                      <label class="col-3">Tempat, Tanggal Lahir</label>: <?= $tamdatpe['tplahir'] ?>, <?= tgl_indo($tamdatpe['tglahir']) ?><br>
                      <label class="col-3">Agama</label>: <?= $tamdatpe['agama'] ?><br>
                      <label class="col-3">Jenis Kelamin</label>: <?= $tamdatpe['jk'] ?><br>
                      <label class="col-3">Pendidikan Terakhir</label>: <?= $tamdatpe['pendter'] ?><br>
                      <label class="col-3">Alamat</label>: <?= $tamdatpe['alamat'] ?><br>
                      <label class="col-3">Nomor Handphone</label>: <?= $tamdatpe['nohp'] ?><br style="height: 20px;"><hr>
                      <label class="col-3"></label>&nbsp;&nbsp;<a href="profil.php?/=edit" class="btn btn-success col-2">Edit Profil</a>&nbsp;<a href='#' class="btn btn-info" data-toggle='modal' data-target='#katasandi'>Ubah Kata Sandi</a>
                    </div>

                    <div class="modal fade" id="katasandi" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                    <div class="modal-dialog modal-md" role="document">
                      <div class="modal-content">
                      <div class="modal-header" id="alert">
                        <label id="ketpw1" style="display: none;">Kata sandi tidak sama</label>
                        <label id="ketpw2" style="display: none;">Kata sandi sama</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="" method="POST">
                      <div class="modal-body">
                      <input type="hidden" name="laporan" value="harian">
                        <div class="form-group row">
                          <label class="col-md-5" style="font-size: 20px;">&nbsp;Kata Sandi &nbsp;</label>
                          <input type="password" class="form-control col-7" id="pw1" name="pass">
                          <input type="hidden" name="kodekaryawan" value="<?= $tidkar; ?>">
                        </div> 
                        <div class="form-group row">
                          <label class="col-md-5" style="font-size: 20px;">&nbsp;Ulang Kata Sandi &nbsp;</label>
                          <input type="password" class="form-control col-7" id="pw2" onkeyup="pw()">
                        </div>                                    
                      </div>          
                        <div class="modal-footer">
                           <button class="btn btn-info col-12" id="idsimpan" style="display: none;" type="submit" name="gantipw">Simpan</button>
                        </div>
                        </form> 
                      </div>
                    </div>
                    </div> 

                    <div <?php if($_GET['/']=='edit'){echo "";}else{ echo "hidden";}?>>
                      <form action="" method="POST"><input type="hidden" name="kodekaryawan" value="<?= $tidkar; ?>">
                      <div class="row">
                        <label class="col-3">Nama Lengkap</label>:&nbsp;<input class="form-control col-8" type="text" name="nama" value="<?= $tamdatpe['nama'] ?>"><br>
                      </div>
                      <div class="row mt-2">
                        <label class="col-3">Tempat, Tanggal Lahir</label>:&nbsp;<input class="form-control col-5" type="text" name="tplahir" value="<?= $tamdatpe['tplahir'] ?>"><input class="form-control col-3" type="date" name="tglahir" value="<?= $tamdatpe['tglahir'] ?>"><br>
                      </div>
                      <div class="row mt-2">
                        <label class="col-3">Agama</label>:&nbsp;
                          <select name="agama" class="form-control col-8" >
                             <option> -- Pilih Agama -- </option>
                             <option <?php if ($tampil['agama'] == 'Islam') {echo "SELECTED";} ?> value="Islam">Islam</option>
                             <option <?php if ($tampil['agama'] == 'Kristen') {echo "SELECTED";} ?> value="Kristen">Kristen</option>
                             <option <?php if ($tampil['agama'] == 'Protestan') {echo "SELECTED";} ?> value="Protestan">Protestan</option>
                             <option <?php if ($tampil['agama'] == 'Katolik') {echo "SELECTED";} ?> value="Katolik">Katolik</option>
                             <option <?php if ($tampil['agama'] == 'Hindu') {echo "SELECTED";} ?> value="Hindu">Hindu</option>
                             <option <?php if ($tampil['agama'] == 'Buddha') {echo "SELECTED";} ?> value="Buddha">Buddha</option>
                             <option <?php if ($tampil['agama'] == 'Khonghucu') {echo "SELECTED";} ?> value="Khonghucu">Khonghucu</option>
                         </select><br>
                      </div>
                      <div class="row mt-2">
                        <label class="col-3">Jenis Kelamin</label>:&nbsp;
                        <select name="jk" class="form-control col-8" >
                         <option> -- Pilih Jenis Kelamin -- </option>
                         <option  <?php if ($tampil['jk'] == 'Laki-laki') {echo "SELECTED";} ?> value="Laki-laki">Laki-laki</option>
                         <option  <?php if ($tampil['jk'] == 'Perempuan') {echo "SELECTED";} ?> value="Perempuan">Perempuan</option>
                       </select><br>
                      </div>
                      <div class="row mt-2">
                        <label class="col-3">Pendidikan Terakhir</label>:&nbsp;<input class="form-control col-8" type="text" name="pendter" value="<?= $tamdatpe['nama'] ?>"><br>
                      </div>
                      <div class="row mt-2">
                        <label class="col-3">Alamat</label>:&nbsp;
                        <textarea class="form-control col-8" name="alamat"><?= $tamdatpe['alamat'] ?></textarea><br>
                      </div>
                      <div class="row mt-2">
                        <label class="col-3">Nomor Handphone</label>:&nbsp;<input class="form-control col-8" type="text" name="nohp" value="<?= $tamdatpe['nohp'] ?>">
                      </div>
                      <div class="row mt-2">
                        <label class="col-3"></label>&nbsp;&nbsp;<button class="btn btn-warning col-2" style="color:#FFFFFF;" name="simpanedit" type="submit">Simpan Profil</button></form>&nbsp;<a href="profil.php" class="btn btn-info col-2">Batal</a>
                      </div>
                  </div>
                </div>
              </div>

          <div class="clearfix"></div>
        </div>
        <div style="text-align: right; padding-right: 2%; padding-bottom: 2%; padding-top: 1%;"></div>
      </div>
    </div>

<?php include '../vendors/bawah.php';?>
<script type="text/javascript">
    function pw(){
        var pw1 = document.getElementById("pw1").value;
        var pw2 = document.getElementById("pw2").value;
        if(pw1 == pw2) { document.getElementById("ketpw2").style.display = 'block'; document.getElementById("idsimpan").style.display = 'block'; document.getElementById("ketpw1").style.display = 'none';  document.getElementById("alert").classList.remove('alert-danger'); document.getElementById("alert").classList.add('alert-success');}  else { document.getElementById("ketpw1").style.display = 'block'; document.getElementById("idsimpan").style.display = 'none'; document.getElementById("ketpw2").style.display = 'none';  document.getElementById("alert").classList.remove('alert-success'); document.getElementById("alert").classList.add('alert-danger'); }      
    }
</script>
  </body>
</html>
<?php 
   if(isset($_POST['simpanedit'])){
    $kodekaryawan =$_POST['kodekaryawan'];
    $nama =$_POST['nama'];
    $tplahir =$_POST['tplahir'];
    $tglahir =$_POST['tglahir'];
    $agama =$_POST['agama'];
    $jk =$_POST['jk'];
    $pendter =$_POST['pendter'];
    $alamat =$_POST['alamat'];
    $nohp =$_POST['nohp'];

    $data=mysqli_query($kon,"UPDATE karyawan SET nama='$nama', tplahir='$tplahir', tglahir='$tglahir', agama='$agama', jk='$jk', pendter='$pendter', alamat='$alamat', nohp='$nohp'  WHERE idkar='$kodekaryawan'");
    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Diperbaharui', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=profil.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 
  }
   if(isset($_POST['gantipw'])){
    $kodekaryawan =$_POST['kodekaryawan'];
    $pass =$_POST['pass'];

    $data=mysqli_query($kon,"UPDATE pengguna SET pass='$pass' WHERE idkar='$kodekaryawan'");
    if ($data) {
    echo "<script>swal({title: 'Password Berhasil Diperbaharui', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=profil.php'>";
    } else {
    echo "<script>swal({title: 'Password Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 
  }
?>

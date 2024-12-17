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
                    <b style="color: #000000; font-size: 30px;">Data Galeri Kegiatan</b><a href='#' style="background-image: linear-gradient(#08A128,#008f37 ); color: #FFFFFF;" class='btn btn-md float-right' data-toggle='modal' data-target='#kegiatan'><i class='fa fa-folder-open'></i> Tambah</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="width:100%">
                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Foto</th>
                                <th>Tanggal</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; $tabelpromo=mysqli_query($kon, "SELECT * FROM kegiatan order by no DESC"); while ($tampil2=mysqli_fetch_array($tabelpromo)) { ?>
                            <tr>
                                <td><?= $no++; $tno2=$tampil2['no']?></td>
                                <td><?= $tampil2['namakegiatan']?></td>
                                <td> <img src="file/<?= $tampil2['foto'] ?>" alt="Foto Kegiatan" width="100" height="100"> </td>
                                <td><?= tgl_indo($tampil2['tgl'])?></td>
                                <td>
                                  <a href='#' class='btn btn-sm btn-success' data-toggle='modal' data-target='#edit<?=$tno2;?>'>Edit</a>
                                  <div class="modal fade" id="edit<?=$tno2;?>" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                                    <div class="modal-dialog modal-lg" role="document">
                                      <?php $edit13=mysqli_query($kon, "SELECT * FROM kegiatan WHERE no = '$tno2'"); $tedit12=mysqli_fetch_array($edit13); ?>
                                      <form method="get" action="">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                          <div class="modal-body"><input type="hidden" name="no" value="<?= $tno2 ?>"> 
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle">Nama Kegiatan</label>
                                              <input class="form-control col-6" type="text"  value="<?= $tedit12['namakegiatan']?>" name="namakegiatan" placeholder="Masukan Nama Kegiatan">
                                            </div>                                                                                    
                                          </div>
                                              
                                          <div class="modal-footer">
                                            <button class="btn btn-sm btn-success float-right col-2" type="submit" name="editkegiatan">Edit Data</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div> <!-- batas -->
                                  <a href='#' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus<?=$tno2;?>'>Hapus</a>
                                  <div class="modal fade" id="hapus<?=$tno2;?>" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                                    <div class="modal-dialog modal-lg" role="document">
                                      <?php $edit32=mysqli_query($kon, "SELECT * FROM kegiatan WHERE no='$tno2'"); $tedit322=mysqli_fetch_array($edit32);?>
                                      <div class="modal-content">
                                          <div class="modal-body">
                                            <h3>Apakah anda yakin akan menghapus ?</h3>
                                          </div>
                                          <div class="modal-footer">
                                            <form method="get" action=""><input type="hidden" name="no" value="<?= $tedit322['no'] ?>"><button class="btn btn-sm btn-danger" type="submit" name="hapuskegiatan">Ya, yakin hapus data</button><button type="button" class="btn btn-sm btn-info" data-dismiss="modal" aria-label="Close">Tidak, batal hapus data</button></form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                            </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <b style="color: #000000; font-size: 30px;">Data Promo</b><a href='#' style="background-image: linear-gradient(#08A128,#008f37 ); color: #FFFFFF;" class='btn btn-md float-right' data-toggle='modal' data-target='#promo'><i class='fa fa-folder-open'></i> Tambah</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="width:100%">
                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Promo</th>
                                <th>Keterangan Jumlah Promo</th>
                                <th>Tanggal Berakhir Promo</th>
                                <th>Untuk Kursus</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; $tabelpromo=mysqli_query($kon, "SELECT * FROM promo where stp='in' order by no DESC"); while ($tampil=mysqli_fetch_array($tabelpromo)) { ?>
                            <tr>
                                <td><?= $no++; $tno=$tampil['no']?></td>
                                <td><?= $tampil['kodepromo']?></td>
                                <td>Diskon <?= $tampil['promo']?>%</td>
                                <td><?= tgl_indo($tampil['tglakhir'])?></td>
                                <td><?php if($tampil['untuk'] == 'komreg'){ echo "Komputer Reguler";} if($tampil['untuk'] == 'kompri'){ echo "Komputer Privat";} if($tampil['untuk'] == 'tek'){ echo "Teknisi Komputer";} if($tampil['untuk'] == 'komdg'){ echo "Desain Grafis";} if($tampil['untuk'] == '6'){ echo "Mengemudi Mobil 6 Jam";}if($tampil['untuk'] == '8'){ echo "Mengemudi Mobil 8 Jam";}if($tampil['untuk'] == '10'){ echo "Mengemudi Mobil 10 Jam";}if($tampil['untuk'] == '12'){ echo "Mengemudi Mobil 12 Jam";}?></td>
                                <td>
                                  <a href='#' class='btn btn-sm btn-success' data-toggle='modal' data-target='#edit<?=$tno;?>'>Edit</a>
                                  <div class="modal fade" id="edit<?=$tno;?>" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                                    <div class="modal-dialog modal-lg" role="document">
                                      <?php $edit1=mysqli_query($kon, "SELECT * FROM promo WHERE no = '$tno'"); $tedit1=mysqli_fetch_array($edit1); ?>
                                      <form method="get" action="">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                          <div class="modal-body"><input type="hidden" name="no" value="<?= $tno ?>"> 
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle">Jumlah Promo</label>
                                              <input class="form-control col-6" type="number"  value="<?= $tedit1['promo']?>" name="promo" placeholder="Masukan Jumlah Promo">
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle">Tanggal Berakhir Promo</label>
                                              <input class="form-control col-6" type="text"  value="<?= $tedit1['tglakhir']?>" name="tglakhir" onfocus="(this.type='date')" placeholder="Masukan Tanggal Berakhir Promo">
                                            </div>                                                                                    
                                          </div>
                                              
                                          <div class="modal-footer">
                                            <button class="btn btn-sm btn-success float-right col-2" type="submit" name="edit">Edit Data</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div> <!-- batas -->
                                  <a href='#' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus<?=$tno;?>'>Hapus</a>
                                  <div class="modal fade" id="hapus<?=$tno;?>" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                                    <div class="modal-dialog modal-lg" role="document">
                                      <?php $edit3=mysqli_query($kon, "SELECT * FROM promo WHERE no='$tno'"); $tedit3=mysqli_fetch_array($edit3);?>
                                      <div class="modal-content">
                                          <div class="modal-body">
                                            <h3>Apakah anda yakin akan menghapus ?</h3>
                                          </div>
                                          <div class="modal-footer">
                                            <form method="get" action=""><input type="hidden" name="no" value="<?= $tedit3['no'] ?>"><button class="btn btn-sm btn-danger" type="submit" name="hapus">Ya, yakin hapus data</button><button type="button" class="btn btn-sm btn-info" data-dismiss="modal" aria-label="Close">Tidak, batal hapus data</button></form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
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
<div class="modal fade" id="promo" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" style="width: 0px:" >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php function acak($panjang) {$karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789'; $string = ''; for ($i = 0; $i < $panjang; $i++) 
        { $pos = rand(0, strlen($karakter)-1); $string .= $karakter[$pos];}
        return $string;} $kodepromo=acak(7);?>
        <form method="post" action="">
          <div class="modal-body">
              <div class="form-group row">
                <label class="col-5 h6 align-middle">Kode Promo</label>
                <input class="form-control col-6" type="text" readonly name="kodepromo" value="<?= $kodepromo ?>">
              </div>
              <div class="form-group row">
                <label class="col-5 h6 align-middle">Jumlah Promo</label>
                <input class="form-control col-6" type="number" name="promo" placeholder="Masukan Jumlah Promo">
              </div>
              <div class="form-group row">
                <label class="col-5 h6 align-middle">Tanggal Berakhir Promo</label>
                <input class="form-control col-6" type="text" name="tglakhir" onfocus="(this.type='date')" placeholder="Masukan Tanggal Berakhir Promo">
              </div>
              <div class="form-group row">
                <label class="col-5 h6 align-middle">Untuk</label>
                <select class="form-control col-6" name="untuk">
                  <option>-- Pilih Kursus ---</option>
                  <option value="komreg">Kursus Komputer Reguler</option>
                  <option value="kompri">Kursus Komputer Privat</option>
                  <option value="tek">Kursus Teknisi Komputer</option>
                  <option value="komdg">Kursus Desain Grafis</option>
                  <option value="6">Kursus Mengemudi Mobil 6</option>
                  <option value="8">Kursus Mengemudi Mobil 8</option>
                  <option value="10">Kursus Mengemudi Mobil 10</option>
                  <option value="12">Kursus Mengemudi Mobil 12</option>
                </select>
              </div>
              <div class="form-group row">
                <label class="col-5 h6 align-middle">Tanggal</label>                    
                <input class="form-control col-6" type="text" value="<?php echo tgl_indo(date('Y-m-d'));?>" readonly>
              </div>
          </div>
              
          <div class="modal-footer">
            <button class="btn btn-sm float-right col-2" type="submit" name="simpan" style="background-image: linear-gradient(#08A128,#008f37); color: #FFFFFF; font-size: 15px;">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="kegiatan" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" style="width: 0px:" >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="" enctype="multipart/form-data">
        <div class="modal-body">
            <!-- Nama Kegiatan -->
            <div class="form-group row">
                <label class="col-5 h6 align-middle">Nama Kegiatan</label>
                <input class="form-control col-6" type="text" name="namakegiatan" placeholder="Masukan Nama Kegiatan" required>
            </div>
            
            <!-- Upload Foto Kegiatan -->
            <div class="form-group row">
                <label class="col-5 h6 align-middle">Foto Kegiatan</label>
                <input class="form-control col-6" type="file" name="file" required>
            </div>
            
            <!-- Tanggal Kegiatan -->
            <div class="form-group row">
                <label class="col-5 h6 align-middle">Tanggal</label>                    
                <input class="form-control col-6" type="text" value="<?php echo tgl_indo(date('Y-m-d')); ?>" readonly>
            </div>
        </div>
                  
        <!-- Tombol Simpan -->
        <div class="modal-footer">
            <button class="btn btn-sm float-right col-2" type="submit" name="simpankegiatan" style="background-image: linear-gradient(#08A128,#008f37); color: #FFFFFF; font-size: 15px;">
                Simpan
            </button>
        </div>
    </form>

      </div>
    </div>
  </div>
<?php 
   if(isset($_POST['simpan'])){
    $kodepromo =$_POST['kodepromo'];
    $promo =$_POST['promo'];
    $tglakhir =$_POST['tglakhir'];
    $untuk =$_POST['untuk'];
    if($untuk == 'komreg'){ $biaya= "500000";} if($untuk == 'kompri'){ $biaya= "750000";} if($untuk == 'tek'){ $biaya= "1200000";} if($untuk == 'komdg'){ $biaya= "950000";} if($untuk == '6'){ $biaya= "525000";}if($untuk == '8'){ $biaya= "680000";}if($untuk == '10'){ $biaya= "825000";}if($untuk == '12'){ $biaya= "940000";};
    $tgl=date('Y-m-d');

    $data=mysqli_query($kon,"INSERT INTO promo (kodepromo, promo, biaya, tglakhir, untuk, stp, tgl) VALUES ('$kodepromo','$promo','$biaya','$tglakhir','$untuk', 'in','$tgl')");

    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Disimpan', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=promo.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 

    }
    if(isset($_GET['edit'])){
      $no =$_GET['no'];
      $promo =$_GET['promo'];
      $tglakhir =$_GET['tglakhir'];
  
      $data=mysqli_query($kon,"UPDATE promo SET promo='$promo', tglakhir='$tglakhir' WHERE no='$no'");
      if ($data) {
      echo "<script>swal({title: 'Data Berhasil Diperbaharui', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
      echo "<meta http-equiv='refresh' content='3; url=promo.php'>";
      } else {
      echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 
    }
  
    if(isset($_GET['hapus'])){
       $no =$_GET['no'];
  
      $data=mysqli_query($kon,"DELETE FROM promo WHERE no='$no'");
      if ($data) {
      echo "<script>swal({title: 'Data Berhasil Dihapus', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
      echo "<meta http-equiv='refresh' content='3; url=promo.php'>";
      } else {
      echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } }

    if (isset($_POST['simpankegiatan'])) {
      // Ambil data dari form
      $namakegiatan = $_POST['namakegiatan'];
      $tgl = date('Y-m-d');  // Menyimpan tanggal saat ini
      $nama = time() . '_' . basename($_FILES['file']['name']);  // Ambil nama file
      $ukuran = $_FILES['file']['size'];  // Ukuran file
      $file_tmp = $_FILES['file']['tmp_name'];  // Lokasi sementara file yang diupload
  
      // Cek apakah ukuran file valid (misalnya, kurang dari 1MB)
      if ($ukuran < 1044070) {
          // Cek error pada file upload
          if ($_FILES['file']['error'] == 0) {
              // Tentukan folder tujuan untuk menyimpan file
              $target_dir = "file/";
              $target_file = $target_dir . $nama;
              
              // Cek apakah file sudah ada di server
              if (!file_exists($target_file)) {
                  // Pindahkan file ke folder yang diinginkan
                  if (move_uploaded_file($file_tmp, $target_file)) {
                      // Menyimpan data ke database
                      $query = mysqli_query($kon, "INSERT INTO kegiatan (namakegiatan, foto, tgl) VALUES ('$namakegiatan', '$nama', '$tgl')");
                      if ($query) {
                          echo "<script>swal({title: 'File Berhasil Di Upload', text: 'Silakan tunggu...', icon: 'success', buttons: [false, false]});</script>";
                          echo "<meta http-equiv='refresh' content='3; url=promo.php'>";
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
  

  if(isset($_GET['editkegiatan'])){
    $no =$_GET['no'];
    $namakegiatan = $_GET['namakegiatan'];

    $data=mysqli_query($kon,"UPDATE kegiatan SET namakegiatan='$namakegiatan' WHERE no='$no'");
    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Diperbaharui', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=promo.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 
  }

  if(isset($_GET['hapuskegiatan'])){
     $no =$_GET['no'];

    $data=mysqli_query($kon,"DELETE FROM kegiatan WHERE no='$no'");
    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Dihapus', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=promo.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } }
?>

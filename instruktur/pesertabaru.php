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
                    <b style="color: #000000; font-size: 30px;">Data Peserta Baru</b>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="width:100%">
                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Kursus</th>
                                <th>Nama</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Keterangan</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; $stpeng=$_SESSION['level']; if($stpeng == 'kurkom') { $tabeldatapeserta=mysqli_query($kon, "SELECT * FROM datapeserta where untuk in ('komreg','kompri','tek','komdg') and stp='ok' order by no DESC limit 10");} else {$tabeldatapeserta=mysqli_query($kon, "SELECT * FROM datapeserta where untuk in ('6','8','10','12') and stp='ok' order by no DESC limit 10");}  while ($tampil=mysqli_fetch_array($tabeldatapeserta)) { ?>
                            <tr>
                                <td><?= $no++; $tno=$tampil['no']?></td>
                                <td><?= $idkursus=$tampil['idkursus']?></td>
                                <?php $datapeserta=mysqli_query($kon, "SELECT * FROM peserta where idkursus='$idkursus'"); $tamdatpe=mysqli_fetch_array($datapeserta);?>
                                <td><?= $tamdatpe['nama']?></td>
                                <td><?= $tamdatpe['tplahir']?>, <?= tgl_indo($tamdatpe['tglahir'])?></td>
                                <td><?= $tamdatpe['alamat']?></td>
                                <td>Peserta belum aktif kursus</td>                                
                                <td><a href='#' class='btn btn-sm btn-success' data-toggle='modal' data-target='#datapeserta<?=$tno;?>'>Aktifkan Kursus</a></td>
                                 <div class="modal fade" id="datapeserta<?=$tno;?>" tabindex="1" role="dialog" aria-labelledby="datapeserta" aria-hidden="true" >
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div><form action="" method="get">
                                          <div class="modal-body"><input type="hidden" name="no" value="<?= $tno ?>"> 
                                            <div class="form-group "><center>
                                              <label class="col-5 h6 align-middle">Tanggal aktif kursus</label>
                                              <input class="form-control col-3" name="tgl" type="date">
                                              <button class="btn btn-sm btn-success col-2 mt-2" type="submit" name="simpan">Aktif Kursus</button></center>
                                            </div></form>                                                                               
                                          </div>                                              
                                          <div class="modal-footer">
                                          </div>
                                        
                                      </div>
                                    </div>
                                  </div>
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
<?php 
  if(isset($_GET['simpan'])){
    $no =$_GET['no'];
    $tgl=date('Y-m-d');

    $data=mysqli_query($kon,"UPDATE datapeserta SET stp='af', tgl='$tgl' WHERE no='$no'");
    if ($data) {
    echo "<script>swal({title: 'Peserta telah aktif kursus', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=datapeserta.php'>";
    } else {
    echo "<script>swal({title: 'Peserta Gagal aktif kursus', icon: 'warning',buttons: [false,'OK']});</script>"; } 
  }
?>

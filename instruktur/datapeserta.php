<!DOCTYPE html>
<html lang="en">
<?php include '../vendors/atas.php';?>
  <body class="nav-md">
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
                    <b style="color: #000000; font-size: 30px;">Data Peserta</b>
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
                            <?php $no=1; $stpeng=$_SESSION['level']; if($stpeng == 'kurkom') { $tabeldatapeserta=mysqli_query($kon, "SELECT * FROM datapeserta where untuk in ('komreg','kompri','tek','komdg') and stp='af' order by no DESC limit 10"); $nilai1='Nilai Microsoft Office Word'; $nilai2='Nilai Microsoft Office Excel'; $nilai3='Nilai Microsoft Office Power Point';} else {$tabeldatapeserta=mysqli_query($kon, "SELECT * FROM datapeserta where untuk in ('6','8','10','12') and stp='af' order by no DESC limit 10"); $nilai1='Nilai Pengenalan Rambu-Rambu'; $nilai2='Nilai Teknik Mengemudi Mobil'; $nilai3='Nilai Teknik Parkir Mobil';}  while ($tampil=mysqli_fetch_array($tabeldatapeserta)) { ?>
                            <tr>
                                <td><?= $no++; $tno=$tampil['no']?></td>
                                <td><?= $idkursus=$tampil['idkursus']?></td>
                                <?php $datapeserta=mysqli_query($kon, "SELECT * FROM peserta where idkursus='$idkursus'"); $tamdatpe=mysqli_fetch_array($datapeserta);?>
                                <td><?= $tamdatpe['nama']?></td>
                                <td><?= $tamdatpe['tplahir']?>, <?= tgl_indo($tamdatpe['tglahir'])?></td>
                                <td><?= $tamdatpe['alamat']?></td>
                                <td>Peserta telah aktif kursus dari tanggal <?=tgl_indo($tampil['tgl'])?></td>           
                                <td><a href='#' class='btn btn-sm btn-success' data-toggle='modal' data-target='#datapeserta<?=$tno;?>'>Masukan Nilai</a></td>
                                 <div class="modal fade" id="datapeserta<?=$tno;?>" tabindex="1" role="dialog" aria-labelledby="datapeserta" aria-hidden="true" >
                                  <?php $edit1=mysqli_query($kon, "SELECT * FROM datapeserta WHERE no = '$tno'"); $tedit1=mysqli_fetch_array($edit1); ?>
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div><form action="" method="post">
                                          <div class="modal-body"><input type="hidden" name="no" value="<?= $tno ?>"> 
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle">ID Peserta Kursus</label>
                                              <input class="form-control col-6" type="text" name="idkursus" value="<?= $tedit1['idkursus']?>" readonly>
                                            </div>  
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle"><?= $nilai1?></label>
                                              <input class="form-control col-6" type="number" min="0" name="nilai1" placeholder="Masukan <?= $nilai1?>">
                                            </div> 
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle"><?= $nilai2?></label>
                                              <input class="form-control col-6" type="number" min="0" name="nilai2" placeholder="Masukan <?= $nilai2?>">
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle"><?= $nilai3?></label>
                                              <input class="form-control col-6" type="number" min="0" name="nilai3" placeholder="Masukan <?= $nilai3?>">
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle">Tanggal Input Nilai</label>
                                              <input class="form-control col-6" type="text" value="<?= tgl_indo(date('Y-m-d'))?>" readonly>
                                            </div>
                                             <div class="form-group row">
                                              <label class="col-12 h6 align-middle">Catatan :<br> Jika nilai telah diinput maka peserta dinyatakan telah selesai kursus</label>
                                            </div>                                                                               
                                          </div>                                              
                                          <div class="modal-footer">
                                            <button class="btn btn-success float-right col-2" type="submit" name="simpan">Selesai</button>
                                          </div>
                                        </form>
                                        
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
  if(isset($_POST['simpan'])){
    $idkursus =$_POST['idkursus'];
    $nilai1 =$_POST['nilai1'];
    $nilai2 =$_POST['nilai2'];
    $nilai3 =$_POST['nilai3'];
    $tgl=date('Y-m-d');

    $data=mysqli_query($kon,"INSERT INTO nilaipeserta (idkursus, nilai1, nilai2, nilai3, tgl) VALUES ('$idkursus','$nilai1','$nilai2','$nilai3','$tgl')");
    mysqli_query($kon,"UPDATE datapeserta SET stp='end' WHERE idkursus='$idkursus'");
    mysqli_query($kon,"UPDATE promo SET stp='end' WHERE idkursus='$idkursus'");
    if ($data) {
    echo "<script>swal({title: 'Peserta telah diberi nilai', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=pesertaselesai.php'>";
    } else {
    echo "<script>swal({title: 'Peserta Gagal diberi nilai', icon: 'warning',buttons: [false,'OK']});</script>"; } 
  }
?>

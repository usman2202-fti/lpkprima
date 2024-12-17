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
                    <b style="color: #000000; font-size: 30px;">Data Perbaikan Sarana Dan Prasarana</b><a href='#' style="background-image: linear-gradient(#08A128,#008f37 ); color: #FFFFFF;" class='btn btn-md float-right' data-toggle='modal' data-target='#sarpra'><i class='fa fa-folder-open'></i> Tambah</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="width:100%">
                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sarana & Prasarana Yang Diperbaiki</th>
                                <th>Jumlah Biaya</th>
                                <th>Tanggal Perbaikan</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; $tabelsarpra=mysqli_query($kon, "SELECT * FROM sarpra order by no DESC"); while ($tampil=mysqli_fetch_array($tabelsarpra)) {  ?>
                            <tr>
                                <td><?= $no++; $tno=$tampil['no']?></td>
                                <td><?= $tampil['ket']?></td>
                                <td><?= 'Rp '.number_format($tampil['biaya'],0,',','.');?></td>
                                <td><?= tgl_indo($tampil['tgl'])?></td>
                                <td>
                                  <a href='#' class='btn btn-sm btn-success' data-toggle='modal' data-target='#edit<?=$tno;?>'>Edit</a>
                                  <div class="modal fade" id="edit<?=$tno;?>" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                                    <div class="modal-dialog modal-lg" role="document">
                                      <?php $edit1=mysqli_query($kon, "SELECT * FROM sarpra WHERE no = '$tno'"); $tedit1=mysqli_fetch_array($edit1); ?>
                                      <form method="get" action="">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                          <div class="modal-body"><input type="hidden" name="no" value="<?= $tno ?>"> 
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle">Keterangan Perbaikan Sarana & Prasarana</label>
                                              <textarea rows="6" class="form-control col-6" name="ket" placeholder="Masukan Keterangan Perbaikan Nama Sarana & Prasarana"><?= $tedit1['ket']?></textarea>
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle">Total Biaya</label>
                                              <input class="form-control col-6" type="number" name="biaya" value="<?= $tedit1['biaya']?>" placeholder="Masukan Total Biaya">
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
                                      <?php $edit3=mysqli_query($kon, "SELECT * FROM sarpra WHERE no='$tno'"); $tedit3=mysqli_fetch_array($edit3);?>
                                      <div class="modal-content">
                                          <div class="modal-body">
                                            <h3>Apakah anda yakin akan menghapus ?</h3>
                                          </div>
                                          <div class="modal-footer">
                                            <form method="get" action=""><input type="hidden" name="no" value="<?= $tedit3['no'] ?>"><button class="btn btn-sm btn-danger" type="submit" name="hapus">Ya, yakin hapus data</button><button type="button" class="btn btn-sm btn-info" data-dismiss="modal" aria-label="Close">Tidak, batal hapus data</button></form>
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
<div class="modal fade" id="sarpra" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" style="width: 0px:" >
    <div class="modal-dialog modal-lg" role="document">
    <form method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="">
          <div class="modal-body">
              <div class="form-group row">
                <label class="col-5 h6 align-middle">Keterangan Perbaikan Sarana & Prasarana</label>
                <textarea rows="6" class="form-control col-6" name="ket" placeholder="Masukan Keterangan Perbaikan Nama Sarana & Prasarana"></textarea>
              </div>
              <div class="form-group row">
                <label class="col-5 h6 align-middle">Total Biaya</label>
                <input class="form-control col-6" type="number" name="biaya" placeholder="Masukan Total Biaya">
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
    </div></form>
  </div>
<?php 
   if(isset($_POST['simpan'])){
    $ket =$_POST['ket'];
    $biaya =$_POST['biaya'];
    $tgl=date('Y-m-d');

    $data=mysqli_query($kon,"INSERT INTO sarpra (ket, biaya, tgl) VALUES ('$ket','$biaya','$tgl')");

    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Disimpan', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=sarpra.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 

    }

  if(isset($_GET['edit'])){
    $no =$_GET['no'];
    $ket =$_GET['ket'];
    $biaya =$_GET['biaya'];

    $data=mysqli_query($kon,"UPDATE sarpra SET ket='$ket', biaya='$biaya' WHERE no='$no'");
    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Diperbaharui', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=sarpra.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 
  }

  if(isset($_GET['hapus'])){
     $no =$_GET['no'];

    $data=mysqli_query($kon,"DELETE FROM sarpra WHERE no='$no'");
    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Dihapus', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=sarpra.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } }
?>

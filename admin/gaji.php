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
                    <b style="color: #000000; font-size: 30px;">Data Gaji</b><a href='#' style="background-image: linear-gradient(#08A128,#008f37 ); color: #FFFFFF;" class='btn btn-md float-right' data-toggle='modal' data-target='#gaji'><i class='fa fa-folder-open'></i> Tambah</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="width:100%">
                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Data Karyawan</th>
                                <th>Gaji Pokok</th>
                                <th>Bonus</th>
                                <th>Tanggal Gajian</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; $tabelgaji=mysqli_query($kon, "SELECT * FROM datagaji order by no DESC"); while ($tampil=mysqli_fetch_array($tabelgaji)) { ?>
                            <tr>
                                <td><?= $no++; $tno=$tampil['no']?></td>
                                <td><?php $tidkar=$tampil['idkar']; $edit1=mysqli_query($kon, "SELECT * FROM karyawan WHERE idkar='$tidkar'"); $tedit1=mysqli_fetch_array($edit1); $edit2=mysqli_query($kon, "SELECT * FROM pengguna WHERE idkar='$tidkar'"); $tedit2=mysqli_fetch_array($edit2); echo "Id Karyawan : "; echo $tedit2['user']; echo "<br>"; echo "Nama Karyawan : "; echo $tedit1['nama']; echo "<br>"; echo "Nomor handphone : "; echo $tedit1['nohp']; echo "<br>";  echo "Alamat : "; echo $tedit1['alamat']; echo "<br>"; echo "Jabatan : "; if($tedit2['level'] == 'kurkom'){ echo "Instruktur Komputer";}else{ echo "Instruktur Mobil";} ?></td>
                                <td><?= "Rp " . number_format($tampil['gapok'],0,',','.')?></td>
                                <td><?php if($tampil['bonus'] == ''){ echo "-";}else{ echo "Rp " . number_format($tampil['bonus'],0,',','.');}?></td>
                                <td><?= tgl_indo($tampil['tgl'])?></td>
                                <td>
                                  <a href='#' class='btn btn-sm btn-success' data-toggle='modal' data-target='#edit<?=$tno;?>'>Edit</a>
                                  <div class="modal fade" id="edit<?=$tno;?>" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                                    <div class="modal-dialog modal-lg" role="document">
                                      <?php $edit1=mysqli_query($kon, "SELECT * FROM datagaji WHERE no = '$tno'"); $tedit1=mysqli_fetch_array($edit1); ?>
                                      <form method="get" action="">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                          <div class="modal-body"><input type="hidden" name="no" value="<?= $tno ?>"> 
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle">Jumlah gaji</label>
                                              <input class="form-control col-6" type="number"  value="<?= $tedit1['gapok']?>" name="gaji" placeholder="Masukan Jumlah gaji">
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-5 h6 align-middle">Jumlah Bonus</label>
                                              <input class="form-control col-6" type="number"  value="<?= $tedit1['bonus']?>" name="bonus" placeholder="Masukan Jumlah Bonus">
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
                                      <?php $edit3=mysqli_query($kon, "SELECT * FROM datagaji WHERE no='$tno'"); $tedit3=mysqli_fetch_array($edit3);?>
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
<script type="text/javascript">
    function cek(){
        var id = $("#id").val();
        $.ajax({
            url: 'ajaxvid.php',
            data:"id="+id ,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#nama').val(obj.nama);
            $('#nohp').val(obj.nohp);
            $('#alamat').val(obj.alamat);
        });
    }
</script>
  </body>
</html>
<div class="modal fade" id="gaji" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" style="width: 0px:" >
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
                <label class="col-3 h6 align-middle">ID Karyawan</label>
                <select class="form-control col-9" onchange="cek()" id="id" name="idkar">
                  <option>-- Pilih Id Karyawan --</option>
                  <?php $tabpeng=mysqli_query($kon, "SELECT * FROM pengguna where user!='admin'"); while ($ttabpeng=mysqli_fetch_array($tabpeng)) { ?>
                  <option value="<?=$ttabpeng['idkar'];?>"><?=$ttabpeng['user'];?></option>
                  <?php ;}?>
                </select>
              </div>
              <div class="form-group row">
                <label class="col-3 h6 align-middle">Biodata</label>
                <input class="form-control col-9" placeholder="Nama Karyawan" id="nama" readonly>
              </div>
              <div class="form-group row">
                <label class="col-3 h6 align-middle"></label>
                <input class="form-control col-9" placeholder="Nomor Handphone (WA)" id="nohp" readonly>
              </div>
              <div class="form-group row">
                <label class="col-3 h6 align-middle"></label>
                <textarea  class="form-control col-9" placeholder="Alamat" id="alamat" readonly></textarea>
              </div>
              <div class="form-group row">
                <label class="col-3 h6 align-middle">Gaji Pokok</label>
                <input class="form-control col-9" type="text" name="gapok" placeholder="Masukan gaji pokok">
              </div>
              <div class="form-group row">
                <label class="col-3 h6 align-middle">Bonus</label>
                <input class="form-control col-9" type="text" name="bonus" placeholder="Masukan bonus">
              </div>
              <div class="form-group row">
                <label class="col-3 h6 align-middle">Tanggal</label>                    
                <input class="form-control col-9" type="text" value="<?php echo tgl_indo(date('Y-m-d'));?>" readonly>
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
    $idkar =$_POST['idkar'];
    $gapok =$_POST['gapok'];
    $bonus =$_POST['bonus'];
    $untuk =$_POST['untuk'];
    $tgl=date('Y-m-d');

    $data=mysqli_query($kon,"INSERT INTO datagaji (idkar, gapok, bonus,  tgl) VALUES ('$idkar','$gapok','$bonus','$tgl')");

    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Disimpan', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=gaji.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 

    }

  if(isset($_GET['edit'])){
    $no =$_GET['no'];
    $gaji =$_GET['gaji'];
    $bonus =$_GET['bonus'];

    $data=mysqli_query($kon,"UPDATE datagaji SET gapok='$gaji', bonus='$bonus' WHERE no='$no'");
    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Diperbaharui', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=gaji.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 
  }

  if(isset($_GET['hapus'])){
     $no =$_GET['no'];

    $data=mysqli_query($kon,"DELETE FROM datagaji WHERE no='$no'");
    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Dihapus', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=gaji.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } }
?>

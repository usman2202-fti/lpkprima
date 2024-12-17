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
                    <b style="color: #000000; font-size: 30px;">Data Karyawan</b><a href='#' style="background-image: linear-gradient(#08A128,#008f37 ); color: #FFFFFF;" class='btn btn-md float-right' data-toggle='modal' data-target='#karyawan'><i class='fa fa-folder-open'></i> Tambah</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="width:100%">
                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID karyawan</th>
                                <th>Kode Karyawan</th>
                                <th>Nama Lengkap</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>No HP (WA)</th>
                                <th>Pend. Terakhir</th>
                                <th>Jabatan</th>
                                <th>Tanggal Input</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include '../kon.php'; $no=1; $tabelkaryawan=mysqli_query($kon, "SELECT * FROM karyawan WHERE idkar!='admin' order by no DESC"); while ($tampil=mysqli_fetch_array($tabelkaryawan)) { ?>
                            <tr>
                                <td><?= $no++; $tno=$tampil['no']; $tidkar=$tampil['idkar']?></td>
                                <td><?php $edit1=mysqli_query($kon, "SELECT * FROM pengguna WHERE idkar='$tidkar'"); $tedit1=mysqli_fetch_array($edit1); echo $tedit1['user']; ?></td>
                                <td><?= $tidkar?></td>
                                <td><?= $tampil['nama']?></td>
                                <td><?= $tampil['tplahir']?>, <?= tgl_indo($tampil['tglahir'])?></td>
                                <td><?= $tampil['alamat']?></td>
                                <td><?= $tampil['nohp']?></td>
                                <td><?= $tampil['pendter']?></td>
                                <td><?php if($tedit1['level'] == 'kurkom'){ echo "Instruktur Komputer";}else{ echo "Instruktur Mobil";}?></td>
                                <td><?= tgl_indo($tampil['tgl'])?></td>
                                <td><a href='#' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#hapus<?=$tno;?>'>Hapus</a>
                                  <div class="modal fade" id="hapus<?=$tno;?>" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                                    <div class="modal-dialog modal-lg" role="document">
                                      <?php $edit3=mysqli_query($kon, "SELECT * FROM karyawan WHERE no='$tno'"); $tedit3=mysqli_fetch_array($edit3);?>
                                      <div class="modal-content">
                                          <div class="modal-body">
                                            <h3>Apakah anda yakin akan menghapus ?</h3>
                                          </div>
                                          <div class="modal-footer">
                                            <form method="get" action=""><input type="hidden" name="no" value="<?= $tedit3['no'] ?>"><button class="btn btn-sm btn-danger" type="submit" name="hapus">Ya, yakin hapus data</button><button type="button" class="btn btn-sm btn-info" data-dismiss="modal" aria-label="Close">Tidak, batal hapus data</button></form>
                                        </div>
                                      </div>
                                    </div>
                                  </div></td>
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
<div class="modal fade" id="karyawan" tabindex="1" role="dialog" aria-labelledby="edit" aria-hidden="true" style="width: 0px:" >
    <div class="modal-dialog modal-lg" role="document">
    <form method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php function acak($panjang) {$karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789'; $string = ''; for ($i = 0; $i < $panjang; $i++) 
        { $pos = rand(0, strlen($karakter)-1); $string .= $karakter[$pos];}
        return $string;} $kodekaryawan=acak(7); $dk=mysqli_query($kon, "SELECT * FROM karyawan ");?>
        <form method="post" action="">
          <div class="modal-body">
              <div class="form-group row">
                <label class="col-4 h6 align-middle">Kode karyawan</label>
                <input class="form-control col-8" type="text" readonly name="kodekaryawan" value="<?= $kodekaryawan ?>">
              </div>
              <div class="form-group row">
                <label class="col-4 h6 align-middle">Id karyawan</label>
                <input class="form-control col-8" type="text" readonly name="user" value="<?php echo "ID-"; echo sprintf("%03s",$s=mysqli_num_rows($dk)+1);?>">
              </div>
              <div class="form-group row">
                <label class="col-4 h6 align-middle">Nama</label>
                <input class="form-control col-8" type="text" name="nama" placeholder="Masukan Nama Lengkap">
              </div>
              <div class="form-group row">
                <label class="col-4 h6 align-middle">Tempat, Tanggal Lahir</label>
                <input class="form-control col-5" type="text" name="tplahir" placeholder="Masukan Tempat Lahir">
                <input class="form-control col-3" type="text" name="tglahir" onfocus="(this.type='date')" placeholder="Tanggal Lahir">
              </div>
              <div class="form-group row">
                <label class="col-4 h6 align-middle">Agama</label>
                <select name="agama" class="form-control col-8" >
                   <option> -- Pilih Agama -- </option>
                   <option value="Islam">Islam</option>
                   <option value="Kristen">Kristen</option>
                   <option value="Protestan">Protestan</option>
                   <option value="Katolik">Katolik</option>
                   <option value="Hindu">Hindu</option>
                   <option value="Buddha">Buddha</option>
                   <option value="Khonghucu">Khonghucu</option>
               </select>
              </div>

              <div class="form-group row">
                <label class="col-4 h6 align-middle">Jenis Kelamin</label>
                <select name="jk" class="form-control col-8" >
                 <option> -- Pilih Jenis Kelamin -- </option>
                 <option value="Laki-laki">Laki-laki</option>
                 <option value="Perempuan">Perempuan</option>
               </select>
              </div>

              <div class="form-group row">
                <label class="col-4 h6 align-middle">Pendidikan Terakhir</label>
                <input class="form-control col-8" type="text" name="pendter" placeholder="Masukan Pendidikan Terakhir">
              </div>

              <div class="form-group row">
                <label class="col-4 h6 align-middle">Alamat</label>
                <textarea class="form-control col-8" name="alamat" placeholder="Masukan Alamat"></textarea>
              </div>
              <div class="form-group row">
                <label class="col-4 h6 align-middle">Nomor Handpone (WA)</label>
                <input class="form-control col-8" type="text" name="nohp" placeholder="Masukan Nomor Handpone (WA)">
              </div>
              <div class="form-group row">
                <label class="col-4 h6 align-middle">Jabatan</label>                
                <select name="jabatan" class="form-control col-8" >
                   <option> -- Pilih Jabatan -- </option>
                   <option value="kurkom">Instruktur Komputer</option>
                   <option value="kurmob">Instruktur Mobil</option>
               </select>
              </div>
              <div class="form-group row">
                <label class="col-4 h6 align-middle">Tanggal</label>                    
                <input class="form-control col-8" type="text" value="<?php echo tgl_indo(date('Y-m-d'));?>" readonly>
              </div>
          </div>
              
          <div class="modal-footer">
            <button class="btn btn-md float-right col-2" type="submit" name="simpan" style="background-image: linear-gradient(#08A128,#008f37); color: #FFFFFF; font-size: 15px;">Simpan</button>
          </div>
        </form>
      </div>
    </div></form>
  </div>
<?php 
   if(isset($_POST['simpan'])){
    $kodekaryawan =$_POST['kodekaryawan'];
    $nama =$_POST['nama'];
    $tplahir =$_POST['tplahir'];
    $tglahir =$_POST['tglahir'];
    $agama =$_POST['agama'];
    $jk =$_POST['jk'];
    $pendter =$_POST['pendter'];
    $alamat =$_POST['alamat'];
    $nohp =$_POST['nohp'];
    $jabatan =$_POST['jabatan'];
    $user =$_POST['user'];
    $tgl=date('Y-m-d');

    $data=mysqli_query($kon,"INSERT INTO karyawan (idkar, nama, tplahir, tglahir, agama, jk, pendter, alamat, nohp, tgl) VALUES ('$kodekaryawan','$nama','$tplahir','$tglahir','$agama','$jk','$pendter','$alamat','$nohp','$tgl')");
    if($jabatan == 'kurkom' || $jabatan == 'kurmob' ){
      mysqli_query($kon,"INSERT INTO pengguna (idkar, user, pass, level) VALUES ('$kodekaryawan','$user','$kodekaryawan','$jabatan')");} else { echo "";}

    if ($data) {
    echo "<script>swal({title: 'Data Berhasil Disimpan', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
    echo "<meta http-equiv='refresh' content='3; url=karyawan.php'>";
    } else {
    echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } 

    }
    if(isset($_GET['hapus'])){
      $no =$_GET['no'];
 
     $data=mysqli_query($kon,"DELETE FROM karyawan WHERE no='$no'");
     if ($data) {
     echo "<script>swal({title: 'Data Berhasil Dihapus', text:'Silahkn tunggu.........!', icon: 'success',buttons: [false,false]});</script>";
     echo "<meta http-equiv='refresh' content='3; url=karyawan.php'>";
     } else {
     echo "<script>swal({title: 'Data Gagal Disimpan', icon: 'warning',buttons: [false,'OK']});</script>"; } }
?>

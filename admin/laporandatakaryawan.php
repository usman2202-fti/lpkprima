
<!DOCTYPE html>
<html lang="en">
<?php include '../vendors/atas.php';?>


  <body class="nav-md" style="background-color: #F7F7F7">
    <div class="container body" style="background-color: #008f37">
      <div class="main_container">
        <?php include 'nav.php';?>

        <!-- page content -->
        <div class="right_col vh-auto-max pb-4" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>

            <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h3 class="float-left"><b>Laporan Data Karyawan</b></h3>
                  <?php include 'ceklaporan2.php';?>
              </div>
              <div class="card-body">
                  <div class="row" <?php if('harian' == $_GET['laporan']){ echo "";}else{echo "hidden";}?>>
                    <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <center><h2>Laporan Harian <br>Dari Tanggal <?php echo $_GET['daritanggal']?>&nbsp; Sampai Tanggal <?php echo $_GET['sampaitanggal']?></h2><br><a href="cetak/cetaklaporandatakaryawan.php?laporan=harian&dt=<?php echo $_GET['daritanggal']?>&st=<?php echo $_GET['sampaitanggal']?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</a></center>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" <?php if('bulanan' == $_GET['laporan']){ echo "";}else{echo "hidden";}?>>
                    <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <center><h2>Laporan Bulanan <br>Bulan <?php echo $_GET['bulan']?>&nbsp; Tahun <?php echo $_GET['tahun']?></h2><br><a href="cetak/cetaklaporandatakaryawan.php?laporan=bulanan&bulan=<?php echo $_GET['bulan']?>&tahun=<?php echo $_GET['tahun']?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</a></center>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" <?php if('tahunan' == $_GET['laporan']){ echo "";}else{echo "hidden";}?>>
                    <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <center><h2>Laporan Tahun <br>Tahun <?php echo $_GET['tahun']?></h2><a href="cetak/cetaklaporandatakaryawan.php?laporan=tahunan&tahun=<?php echo $_GET['tahun']?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</a></center>
                        </div>
                      </div>
                    </div>
                  </div><br>

                  <?php if('harian' == $_GET['laporan'] || 'bulanan' == $_GET['laporan'] || 'tahunan' == $_GET['laporan']){?>
                  <div class="row">
                    <table class="table table-bordered"  width="100%" cellspacing="0">
                        <thead style="background-image: linear-gradient(#08A128,#008f37); color: #FFFFFF;">
                            <tr>
                                <th>No</th>
                                <th>ID karyawan</th>
                                <th>Nama Lengkap</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>No HP (WA)</th>
                                <th>Pend. Terakhir</th>
                                <th>Jabatan</th>
                                <th>Tanggal Input</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php include "../kon.php"; $no=1; 
                        if ($_GET['laporan'] == 'harian'){$hasil="SELECT * FROM karyawan WHERE idkar!='admin' and tgl BETWEEN '$daritanggal' AND '$sampaitanggal' order by tgl asc";}
                        if ($_GET['laporan'] == 'bulanan'){$hasil="SELECT * FROM karyawan WHERE idkar!='admin' and month(tgl)='$bulan' AND  year(tgl)='$tahun' order by tgl asc";}
                        if ($_GET['laporan'] == 'tahunan'){$hasil="SELECT * FROM karyawan WHERE idkar!='admin' and  year(tgl)='$tahun' order by tgl asc";}
                        $data=mysqli_query($kon,$hasil ); while ($tampil=mysqli_fetch_array($data)) { ?>
                            <tr>
                            <td><?= $no++; $tidkar=$tampil['idkar']?></td>
                                <td><?php $edit1=mysqli_query($kon, "SELECT * FROM pengguna WHERE idkar='$tidkar'"); $tedit1=mysqli_fetch_array($edit1); echo $tedit1['user']; ?></td>
                                <td><?= $tampil['nama']?></td>
                                <td><?= $tampil['tplahir']?>, <?= tgl_indo($tampil['tglahir'])?></td>
                                <td><?= $tampil['alamat']?></td>
                                <td><?= $tampil['nohp']?></td>
                                <td><?= $tampil['pendter']?></td>
                                <td><?php if($tedit1['level'] == 'kurkom'){ echo "Instruktur Komputer";}else{ echo "Instruktur Mobil";}?></td>
                                <td><?= tgl_indo($tampil['tgl'])?></td>
                              </tr>
                           <?php }?>
                        </tbody>
                    </table>
                  </div>
                  <?php } ?>

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

<script>
  $(window).load(function(){
  $("#dataa").change(function() {
        console.log($("#dataa option:selected").val());
        if ($("#dataa option:selected").val() == 'harian') {
          $('#tampil').prop('hidden', false);
        } else {
          $('#tampil').prop('hidden', true);
        }
        if ($("#dataa option:selected").val() == 'bulanan') {
          $('#tampil2').prop('hidden', false);
        } else {
          $('#tampil2').prop('hidden', true);
        }
        if ($("#dataa option:selected").val() == 'tahunan') {
          $('#tampil3').prop('hidden', false);
        } else {
          $('#tampil3').prop('hidden', true);
        }
      });
  });
</script>

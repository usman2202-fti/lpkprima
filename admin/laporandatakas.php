
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
                  <h3 class="float-left"><b>Laporan Data KAS</b></h3>
                  <?php include 'ceklaporan2.php';?>
              </div>
              <div class="card-body">
                  <div class="row" <?php if('harian' == $_GET['laporan']){ echo "";}else{echo "hidden";}?>>
                    <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <center><h2>Laporan Harian <br>Dari Tanggal <?php echo $_GET['daritanggal']?>&nbsp; Sampai Tanggal <?php echo $_GET['sampaitanggal']?></h2><br><a href="cetak/cetaklaporandatakas.php?laporan=harian&dt=<?php echo $_GET['daritanggal']?>&st=<?php echo $_GET['sampaitanggal']?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</a></center>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" <?php if('bulanan' == $_GET['laporan']){ echo "";}else{echo "hidden";}?>>
                    <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <center><h2>Laporan Bulanan <br>Bulan <?php echo $_GET['bulan']?>&nbsp; Tahun <?php echo $_GET['tahun']?></h2><br><a href="cetak/cetaklaporandatakas.php?laporan=bulanan&bulan=<?php echo $_GET['bulan']?>&tahun=<?php echo $_GET['tahun']?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</a></center>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" <?php if('tahunan' == $_GET['laporan']){ echo "";}else{echo "hidden";}?>>
                    <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <center><h2>Laporan Tahun <br>Tahun <?php echo $_GET['tahun']?></h2><a href="cetak/cetaklaporandatakas.php?laporan=tahunan&tahun=<?php echo $_GET['tahun']?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan</a></center>
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
                                <th>Keterangan</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php include "../kon.php"; $no=1; 
                        if ($_GET['laporan'] == 'bulanan'){
                            $hasil1="SELECT * FROM pembayaran WHERE month(tgl)='$bulan' AND  year(tgl)='$tahun' order by tgl asc";
                            $hasil2="SELECT * FROM datagaji WHERE month(tgl)='$bulan' AND  year(tgl)='$tahun' order by tgl asc";
                            $hasil3="SELECT * FROM sarpra WHERE month(tgl)='$bulan' AND  year(tgl)='$tahun' order by tgl asc";}
                        if ($_GET['laporan'] == 'tahunan'){
                            $hasil1="SELECT * FROM pembayaran WHERE  year(tgl)='$tahun' order by tgl asc";
                            $hasil2="SELECT * FROM datagaji WHERE  year(tgl)='$tahun' order by tgl asc";
                            $hasil3="SELECT * FROM sarpra WHERE  year(tgl)='$tahun' order by tgl asc";}
                            echo '<tr><td colspan="4"><b>Pemasukan Pembayaran Kursus</b></td></tr>';
                            $data=mysqli_query($kon,$hasil1 ); while ($tampil=mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td><?= $no++?></td>
                                <td><?= tgl_indo($tampil['tgl'])?></td>
                                <td><?= 'Rp '.number_format($tampil['biaya'],0,',','.'); $totalpemasukan+=$tampil['biaya'];?></td>
                                <td></td>
                              </tr>                              
                            <?php }                            
                            echo '<tr><td colspan="4"><b>Pengeluaran Pembayaran Gaji Karyawan</b></td></tr>';
                            $data2=mysqli_query($kon,$hasil2 ); while ($tampil2=mysqli_fetch_array($data2)) { ?>
                            <tr>
                                <td><?= $no++?></td>
                                <td><?= tgl_indo($tampil2['tgl']); $tot1=($tampil2['gapok']+$tampil2['bonus'])?></td>
                                <td></td>
                                <td><?= "Rp " . number_format($tot1,0,',','.'); $totalpengeluaran1+=$tot1;?></td>
                              </tr>                              
                            <?php }
                            echo '<tr><td colspan="4"><b>Pengeluaran Pembayaran Perbaikan Sarana & Prasarana</b></td></tr>';
                             $data3=mysqli_query($kon,$hasil3 ); while ($tampil3=mysqli_fetch_array($data3)) { ?>
                                <tr>
                                    <td><?= $no++?></td>
                                    <td><?= tgl_indo($tampil3['tgl'])?></td>
                                    <td></td>
                                    <td><?= 'Rp '.number_format($tampil3['biaya'],0,',','.'); $totalpengeluaran2+=$tampil3['biaya'];?></td>
                                </tr>                              
                            <?php } $totalpengeluaran=$totalpengeluaran1+$totalpengeluaran2; $totalkas=$totalpemasukan-$totalpengeluaran;?>
                            <tr>
                                <td colspan="2"><b>Total Pemasukan</b></td>
                                <td><b><?= 'Rp '.number_format($totalpemasukan,0,',','.');?></b></td>
                                <td></td>                                
                            </tr>                            
                            <tr>
                                <td colspan="2"><b>Total Pengeluaran</b></td>
                                <td></td> 
                                <td><b><?= 'Rp '.number_format($totalpengeluaran,0,',','.');?></b></td>                               
                            </tr>                                                    
                            <tr>
                                <td colspan="3"><b>Total KAS (Pemasukan-Pengeluaran)</b></td>
                                <td><b><?= 'Rp '.number_format($totalkas,0,',','.');?></b></td>                               
                            </tr>
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

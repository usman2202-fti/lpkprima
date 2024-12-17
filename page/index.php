<?php session_start(); 
error_reporting(0); function tgl_indo($tanggal){$bulan = array (1 =>   'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agust','Sep','Okt','Nov','Des' ); $pecahkan = explode('-', $tanggal); return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0]; }?><!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

      <title>LPK PRIMA</title>
  
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../vendors/datatables/dataTables.bootstrap5.min.css" rel="stylesheet">

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
                        <?php include 'nav.php'; ?>
                        <div>
                          <br><h3 class="text-center">BROSUR LKP PRIMA</h3>
                          <img src="../img/browsur.jpg" width="100%">
                          <hr><center><h2>Kode Promo</center></h2>
                          <table id="example" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Promo</th>
                                    <th>Keterangan Jumlah Promo</th>
                                    <th>Tanggal Berakhir Promo</th>
                                    <th>Untuk Kursus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include '../kon.php'; $no=1; $tabelpromo=mysqli_query($kon, "SELECT * FROM promo where stp='in' order by no DESC"); while ($tampil=mysqli_fetch_array($tabelpromo)) { ?>
                                <tr>
                                    <td><?= $no++; $tno=$tampil['no']?></td>
                                    <td><?= $tampil['kodepromo']?></td>
                                    <td>Diskon <?= $tampil['promo']?>%</td>
                                    <td><?= tgl_indo($tampil['tglakhir'])?></td>
                                    <td><?php if($tampil['untuk'] == 'komreg'){ echo "Komputer Reguler";} if($tampil['untuk'] == 'kompri'){ echo "Komputer Privat";} if($tampil['untuk'] == 'tek'){ echo "Teknisi Komputer";} if($tampil['untuk'] == 'komdg'){ echo "Desain Grafis";} if($tampil['untuk'] == '6'){ echo "Mengemudi Mobil 6 Jam";}if($tampil['untuk'] == '8'){ echo "Mengemudi Mobil 8 Jam";}if($tampil['untuk'] == '10'){ echo "Mengemudi Mobil 10 Jam";}if($tampil['untuk'] == '12'){ echo "Mengemudi Mobil 12 Jam";}?></td>
                                </tr>
                                <?php } ?> 
                            </tbody>
                        </table>
                        
                        <hr><center><h2>Foto Kegiatan</center></h2>
                        <div class="row">
                            <?php $no=1; $tabelpromo=mysqli_query($kon, "SELECT * FROM kegiatan order by no DESC"); while ($tampil2=mysqli_fetch_array($tabelpromo)) { ?>
                              <div class="col-3">
                                <img src="../admin/file/<?= $tampil2['foto'] ?>" alt="Foto Kegiatan" width="340" height="340"><br><?= $tampil2['namakegiatan']?>
                              </div>
                            <?php } ?> 
                          </div>
                        
                        </div>
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
      $('#beranda').addClass("active");
});
</script>


<script src="../vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables/dataTables.bootstrap5.min.js"></script>
     <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable( {
          "language": {
          "sProcessing":   "Sedang memproses...",
          "sLengthMenu":   "",
          "sZeroRecords":  "Tidak ditemukan data yang sesuai",
          "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
          "sInfoPostFix":  "",
          "sSearch":       "Pencarian Data : ",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Pertama",
            "sPrevious": "Sebelumnya",
            "sNext":     "Selanjutnya",
            "sLast":     "Terakhir"
          }
                }
            } );
        } );
  </script>
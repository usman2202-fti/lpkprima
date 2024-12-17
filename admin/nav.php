<?php 
 if($_SESSION['level']=="" || $_SESSION['level'] !=="admin"){
      echo "<script>swal({title: 'ANDA HARUS LOGIN DULU !!!', text:'kembali Kehalaman utama', icon: 'warning',buttons: [false,false], backdrop: 'yellow'});</script>";
      echo "<meta http-equiv='refresh' content='0; url=../'>";}  ?>
      
        <div class="col-md-3 left_col" >
          <div class="left_col scroll-view" style="background-image: linear-gradient(#08A128,#08A128,#08A128,#008f37 );">
            <div class="navbar nav_title" style="background-color: #08A128">
              <b class="site_title" style="font-size: 25px;">&nbsp; LPK PRIMA</b>
            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" >
              <div class="menu_section">
                <ul class="nav side-menu">                  
                  <li><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                  <li><a href="promo.php"><i class="fa fa-stack-overflow"></i> Data Galeri & Promo</a></li>
                  <li><a href="calonpeserta.php"><i class="fa fa-group"></i> Data Calon Peserta</a></li>
                  <li><a href="pembayaran.php"><i class="fa fa-money"></i> Data Pembayaran</a></li>
                  <li><a href="datapeserta.php"><i class="fa fa-database"></i> Data Peserta</a></li>
                  <li><a href="karyawan.php"><i class="fa fa-edit"></i>Data Karyawan</a></li>
                  <li><a href="gaji.php"><i class="fa fa-bar-chart"></i> Data Gaji Karyawan</a></li>
                  <li><a href="sarpra.php"><i class="fa fa-book"></i> Data Saran & Prasarana</a></li>
                  <li><a><i class="fa fa-list-ul"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="laporandatapendaftaran.php">Laporan Data Pendaftaran</a></li>
                      <li><a href="laporandatapembayaran.php">Laporan Data Pembayaran</a></li>
                      <li><a href="laporandatasiswaaktif.php">Laporan Data Siswa Aktif</a></li>
                      <li><a href="laporandatasiswaselesai.php">Laporan Siswa Selesai</a></li>
                      <li><a href="laporandatakaryawan.php">Laporan Data Karyawan</a></li>
                      <li><a href="laporandatagajikaryawan.php">Laporan Data Gaji Karyawan</a></li>
                      <li><a href="laporandataperbaikansarpra.php">Laporan Data Perbaikan Sarpra</a></li>
                      <li><a href="laporandatakas.php">Laporan Data KAS</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <center style="float: left;"><h3><b>SELAMAT DATANG</b></h3></center>
                <nav class="nav navbar-nav">
                  <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><img src="../img/dasar.jpg" alt="..." width="5%" height="5%" style="border-radius: 50%">&nbsp; Admin</a>
                    <div class="dropdown-menu dropdown-usermenu pull-right mt-4" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="profil.php"><i class="fa fa-user pull-right"></i> Profil</a>
                      <a class="dropdown-item"  href="../keluar.php"><i class="fa fa-sign-out pull-right"></i> Keluar</a>
                    </div>
                    </li>
                  </ul>
              </nav>
            </div>
          </div>

  <?php
  include "../kon.php";
  $tabelpegawai=mysqli_query($kon, "SELECT * FROM pegawai order by no DESC");
  ?>
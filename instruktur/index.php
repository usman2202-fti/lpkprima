<!DOCTYPE html>
<html lang="en">
<?php include '../vendors/atas.php';?>
<?php include '../vendors/plus/tambahan.php';?>
  <body class="nav-md">
    <div class="container body" style="background-color: #008f37">
      <div class="main_container">
        <?php include 'nav.php';?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="pb-4">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>
            <div class="">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title"><center><br>
                    <b style="color: #000000; font-size: 30px;">Kalender <?= $datetahun=date('Y'); $datebulan=date('m')?></b><br><b style="color: #000000; font-size: 20px;">Bulan <?= ubahbulan($datebulan);?></b></center><br>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content mb-5"><br>
                    <?php echo draw_calendar($datebulan, $datetahun); ?><br>
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
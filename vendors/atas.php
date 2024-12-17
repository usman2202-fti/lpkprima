
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LPK PRIMA</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../vendors/build/css/custom.min.css" rel="stylesheet">
    <script src="../vendors/sweetalert/sweetalert.min.js"></script>
    <link href="../vendors/datatables/dataTables.bootstrap5.min.css" rel="stylesheet">
  </head>
  <?php session_start(); error_reporting(0);  function ubahbulan($bln){switch ($bln){ case 1: return "Januari"; break;case 2: return "Februari";break;case 3: return "Maret";break;case 4: return "April";break;case 5: return "Mei";break;case 6: return "Juni";break;case 7: return "Juli";break;case 8: return "Agustus";break;case 9: return "September";break;case 10: return "Oktober";break;case 11: return "November";break;case 12: return "Desember";break;case 13: return "Satu Tahun";break; }}
    function tgl_indo($tanggal){$bulan = array (1 =>   'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agust','Sep','Okt','Nov','Des' ); $pecahkan = explode('-', $tanggal); return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0]; }?>
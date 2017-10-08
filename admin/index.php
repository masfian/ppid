<?php
session_start();

if(!isset($_SESSION['USER_SESSION']))
{
 header("Location: login.html");
}

include_once 'engine/configdb.php';

$stmt = $db_con->prepare("SELECT * FROM user WHERE USERID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['USER_SESSION']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

$usr= $row['USERNAME'];
$fn= $row['FULLNAME'];
$level= $row['LEVEL'];
$loc= $row['IDSKPD'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.html">

    <title>Admin PPID</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap-switch.css">

    <link href="plugin/datatables/dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link href="plugin/toastr/toastr.css" rel="stylesheet" type="text/css"/>


    <!-- Select2 css -->
    <link href="plugin/select2/select2.min.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" type="text/css" href="js/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

    <link rel="stylesheet" type="text/css" href="js/bootstrap-fileupload/bootstrap-fileupload.css" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->



    <!-- <script src="js/jquery.js"></script> -->
    <script src="plugin/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="plugin/knockoutjs/knockout-3.4.2.js" type="text/javascript"></script>
    <script type="text/javascript">
      var page = {
        pageDestination:ko.observable("")
      };
    </script>
</head>

  <body class="full-width">

  <section id="container" class="hr-menu">
      <!--header start-->
      <header class="header fixed-top">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle hr-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="fa fa-bars"></span>
              </button>

              <!--logo start-->
              <!--logo start-->
              <div class="brand ">
                  <a href="#" class="logo" style="display: -webkit-inline-box;">
                      <img src="images/logo-jember.png" alt="" style="width: 30px;">
                      <h4 style="margin-top: 7px; color: #fff;font-weight: bold; padding-left: 10px;">ADMIN PPID</h4>
                  </a>
              </div>
              <!--logo end-->
              <!--logo end-->
              <div class="horizontal-menu navbar-collapse collapse ">
                  <ul class="nav navbar-nav">
                      <li class="beranda"><a href="index.php?page=beranda">Beranda</a></li>
                      <li class="dropdown">
                          <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">Input Data <b class=" fa fa-angle-down"></b></a>
                          <ul class="dropdown-menu">
                              <li class="dataartikel"><a href="index.php?page=dataartikel">Data Artikel</a></li>
                              <li class="datadokumen"><a href="index.php?page=datadokumen">Data Dokumen</a></li>
                              
                          </ul>
                      </li>
                      <li class="dropdown">
                          <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">Master Data <b class=" fa fa-angle-down"></b></a>
                          <ul class="dropdown-menu">
                              <li class="mdatakategoriskpd"><a href="index.php?page=masterkategoriskpd">Master Data Kategori SKPD</a></li>
                              <li class="mdataskpd"><a href="index.php?page=masterskpd">Master Data SKPD</a></li>
                              <li class="mdatauser"><a href="index.php?page=masteruser">Master Data User</a></li>
                          </ul>
                      </li>
                      <li class="datarequest"><a href="index.php?page=datarequest">Data Request</a></li>
                  </ul>

              </div>
              <div class="top-nav hr-top-nav">
                  <ul class="nav pull-right top-menu">
                      <!-- <li>
                          <input type="text" class="form-control search" placeholder=" Search">
                      </li> -->
                      <!-- user login dropdown start-->
                      <li class="dropdown">
                          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                              <img alt="" src="images/avatar1_small.jpg">
                              <span class="username"><?php echo $fn; ?></span>
                              <b class="caret"></b>
                          </a>
                          <ul class="dropdown-menu extended logout">
                              <!-- <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                              <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                              <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li> -->
                              <li><a href="index.php?page=keluar"><i class="fa fa-key"></i> Log Out</a></li>
                          </ul>
                      </li>
                      <!-- user login dropdown end -->
                  </ul>
              </div>

          </div>

      </header>
      <!--header end-->
      <!--sidebar start-->

      <!--sidebar end-->
      <!--main content start-->
      <?php
          $page = (isset($_GET['page']))? $_GET['page'] : "main";
          switch ($page) {
              case 'dataartikel': include "input_dataartikel.php"; break;
              case 'datadokumen': include "input_datadokumen.php"; break;
              case 'masterkategoriskpd': include "master_kategoriskpd.php"; break;
              case 'masterskpd': include "master_skpd.php"; break;
              case 'masteruser': include "master_user.php"; break;
              case 'datarequest': include "datarequest.php"; break;
              case 'keluar': include "controller/logout.php"; break;
              default : include 'beranda.php'; 
          }
      ?>
      
      <!--main content end-->
      <!--footer start-->
      <footer class="footer-section">
          <div class="text-center">
              2017 &copy; Admin PPID Jember
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
  <style type="text/css">
    .select2-dropdown{
      border: 1px solid #2691e4;
    }
    .select2-container--default .select2-selection--multiple{
      border: 1px solid #e2e2e4;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border: 1px solid #2691e4 !important;
    }

  </style>
  <!-- Placed js at the end of the document so the pages load faster -->

  <!--Core js-->
  
  <script src="bs3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/hover-dropdown.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>

  <script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
  <script src="js/jquery.nicescroll.js"></script>
  <script src="js/bootstrap-switch.js"></script>
  <!-- Moment js -->
  <script src="plugin/moment.min.js" type="text/javascript"></script>

  <!-- Knockout js -->
  
  <!-- Sweet alert js -->
  <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
  <script src="plugin/toastr/toastr.min.js" type="text/javascript"></script>
  <!-- Underscore js -->
  <script src="plugin/underscore/underscore.js" type="text/javascript"></script>

  <!--dynamic table-->
  <script type="text/javascript" language="javascript" src="plugin/datatables/dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="plugin/datetime.js"></script>

  <!-- select2 js -->
  <script type="text/javascript" language="javascript" src="plugin/select2/select2.min.js"></script>

  <!-- WYSIWYG -->
  <script type="text/javascript" src="js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>


  <!-- FILEUPLOAD -->
  <script type="text/javascript" src="js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  
  <!--common script init for all pages-->
  <script src="js/scripts.js"></script>
  <script src="js/toggle-init.js"></script>
  
  <script type="text/javascript">
    $.fn.capitalize = function () {
      $.each(this, function () {
          var split = this.value.split(' ');
          for (var i = 0, len = split.length; i < len; i++) {
              split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);
          }
          this.value = split.join(' ');
      });
      return this;
    };
    function callStyleMenu(){
      var pgMenu = page.pageDestination();
      // console.log(pgMenu)
      
      if (pgMenu=="Beranda"){
        $(".beranda").addClass("active");
        $(".dataartikel").removeClass("active");
        $(".datadokumen").removeClass("active");
        $(".mdatakategoriskpd").removeClass("active");
        $(".mdataskpd").removeClass("active");
        $(".mdatauser").removeClass("active");
        $(".datarequest").removeClass("active");
      }else if(pgMenu=="MasterUser"){
        $(".beranda").removeClass("active");
        $(".dataartikel").removeClass("active");
        $(".datadokumen").removeClass("active");
        $(".mdatakategoriskpd").removeClass("active");
        $(".mdataskpd").removeClass("active");
        $(".mdatauser").addClass("active");
        $(".datarequest").removeClass("active");
      }else if(pgMenu=="MasterDataSKPD"){
        $(".beranda").removeClass("active");
        $(".dataartikel").removeClass("active");
        $(".datadokumen").removeClass("active");
        $(".mdatakategoriskpd").removeClass("active");
        $(".mdataskpd").addClass("active");
        $(".mdatauser").removeClass("active");
        $(".datarequest").removeClass("active");
      }else if(pgMenu=="MasterDataKategoriSKPD"){
        $(".beranda").removeClass("active");
        $(".dataartikel").removeClass("active");
        $(".datadokumen").removeClass("active");
        $(".mdatakategoriskpd").addClass("active");
        $(".mdataskpd").removeClass("active");
        $(".mdatauser").removeClass("active");
        $(".datarequest").removeClass("active");
      }else if(pgMenu=="DataDokumen"){
        $(".beranda").removeClass("active");
        $(".dataartikel").removeClass("active");
        $(".datadokumen").addClass("active");
        $(".mdatakategoriskpd").removeClass("active");
        $(".mdataskpd").removeClass("active");
        $(".mdatauser").removeClass("active");
        $(".datarequest").removeClass("active");
      }else if(pgMenu=="DataArtikel"){
        $(".beranda").removeClass("active");
        $(".dataartikel").addClass("active");
        $(".datadokumen").removeClass("active");
        $(".mdatakategoriskpd").removeClass("active");
        $(".mdataskpd").removeClass("active");
        $(".mdatauser").removeClass("active");
        $(".datarequest").removeClass("active");
      }else if(pgMenu=="DataRequest"){
        $(".beranda").removeClass("active");
        $(".dataartikel").removeClass("active");
        $(".datadokumen").removeClass("active");
        $(".mdatakategoriskpd").removeClass("active");
        $(".mdataskpd").removeClass("active");
        $(".mdatauser").removeClass("active");
        $(".datarequest").addClass("active");
      }
    }
    // function prepareDtTbls(){
    //   (function( factory ) {
    //       "use strict";
       
    //       if ( typeof define === 'function' && define.amd ) {
    //           // AMD
    //           define( ['jquery'], function ( $ ) {
    //               return factory( $, window, document );
    //           } );
    //       }
    //       else if ( typeof exports === 'object' ) {
    //           // CommonJS
    //           module.exports = function (root, $) {
    //               if ( ! root ) {
    //                   root = window;
    //               }
       
    //               if ( ! $ ) {
    //                   $ = typeof window !== 'undefined' ?
    //                       require('jquery') :
    //                       require('jquery')( root );
    //               }
       
    //               return factory( $, root, root.document );
    //           };
    //       }
    //       else {
    //           // Browser
    //           factory( jQuery, window, document );
    //       }
    //   }
    //   (function( $, window, document ) {
    //     $.fn.dataTable.render.moment = function ( from, to, locale ) {
    //         // Argument shifting
    //         if ( arguments.length === 1 ) {
    //             locale = 'en';
    //             to = from;
    //             from = 'YYYY-MM-DD';
    //         }
    //         else if ( arguments.length === 2 ) {
    //             locale = 'en';
    //         }
         
    //         return function ( d, type, row ) {
    //             var m = window.moment( d, from, locale, true );
         
    //             // Order and type get a number value from Moment, everything else
    //             // sees the rendered value
    //             return m.format( type === 'sort' || type === 'type' ? 'x' : to );
    //         };
    //     };
    //   }));
    // }

    $(document).ready(function () {
      "use strict"; // Start of use strict
      callStyleMenu();



      ko.applyBindings(page);
    });
  </script>
  </body>
</html>
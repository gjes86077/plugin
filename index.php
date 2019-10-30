<?
  require_once  "system/config.php";
  if(!checkAdmin())
    HEADER('Location:login.php');
?>
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=WEB_TITLE?>  | 森德網站設計有限公司 </title>
    <!-- Bootstrap -->
    <link href="plug/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="plug/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="plug/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="plug/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="plug/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="plug/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="plug/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="plug/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="plug/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="system/css/custom.css" rel="stylesheet">
    <?require_once  "block/side.php";?>
    <style>
    #panel{width: 100%;padding: 0 5%}
    #panel div{text-align: center}
    #panel i{display: block;font-size: 2em;padding-bottom: 3px;padding-top: 15px}
    #panel h2{font-size: 2em;color: #333;padding-bottom: 30px}
    .content{padding: 30px}
    </style>
  </head>
  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col ">
          <?side(MessageCount($link));?>
        </div>
        <!-- top navigation -->
        <?top_nav($link);?>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" style="background: url(img/b1.jpg);background-size: cover ">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12" id="panel">
              <div >
                  <h2 style="color: #fff;text-shadow: 2px 2px 5px rgba(20,20,20,0.6);padding-top: 10%;font-size: 60px">WELCOME</h2>
                  <h1 style="color: #fff;text-shadow: 2px 2px 5px rgba(20,20,20,0.6);padding-top: 5%;font-size: 40px">森德網站後台管理系統</h1>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?footer();?>
        <!-- /footer content -->
      </div>
    </div>
    <!-- jQuery -->
    <script src="plug/CKEdit/ckeditor/ckeditor.js"></script>
    <!-- jQuery -->
    <script src="plug/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plug/bootstrap/dist/js/bootstrap.js"></script>
    <!-- FastClick -->
    <script src="plug/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="plug/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="plug/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="plug/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="plug/moment/min/moment.min.js"></script>
    <script src="plug/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="plug/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="plug/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="plug/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="plug/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="plug/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="plug/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="plug/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="plug/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="plug/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="plug/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="system/js/custom.min.js"></script>
    <script>
    </script>
  </body>
</html>

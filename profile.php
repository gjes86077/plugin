<? 
  require_once  "system/config.php"; 
    if(!checkAdmin())
    HEADER('Location:login.php');
  $title="網站設定";
  $result=SelectNCondition($link,'inf');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=WEB_TITLE?>  | 森德網站設計 </title>
    <!-- Bootstrap -->
    <link href="plug/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="plug/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="plug/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="plug/nprogress/nprogress.css" rel="stylesheet">    
    <!-- Custom Theme Style -->
    <link href="system/css/custom.css" rel="stylesheet">
    <?require_once  "block/side.php";?>
  </head>
  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col  menu_fixed">
          <?side(MessageCount($link));?>
        </div>
        <!-- top navigation -->
        <?top_nav($link);?>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?=$title?>編修</h3>
              </div>             
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>網站設定</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" action="control/profile.php" method="post"> 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">網站名稱 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="title" class="form-control col-md-7 col-xs-12 "  name="title" placeholder="網站名稱" required="required" type="text" value="<?=$result[0]['title']?>">
                          <input id="update_profile" name="update_profile" type="hidden" value="update_profile">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="youtube_channel">Youtube頻道連結 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="youtube_channel" class="form-control col-md-7 col-xs-12 "  name="youtube_channel" placeholder="Youtube頻道連結" required="required" type="text" value="<?=$result[0]['youtube_channel']?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paramount_tel">統領電話 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="paramount_tel" class="form-control col-md-7 col-xs-12 "  name="paramount_tel" placeholder="統領電話" required="required" type="text" value="<?=$result[0]['paramount_tel']?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paramount_mail">統領信箱 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="paramount_mail" class="form-control col-md-7 col-xs-12 "  name="paramount_mail" placeholder="統領信箱" required="required" type="text" value="<?=$result[0]['paramount_mail']?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pacific_tel">統利電話 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pacific_tel" class="form-control col-md-7 col-xs-12 "  name="pacific_tel" placeholder="統利電話" required="required" type="text" value="<?=$result[0]['pacific_tel']?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pacific_mail">統利信箱 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pacific_mail" class="form-control col-md-7 col-xs-12 "  name="pacific_mail" placeholder="統利信箱" required="required" type="text" value="<?=$result[0]['pacific_mail']?>">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">聯絡地址 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="address" class="form-control col-md-7 col-xs-12 "  name="address" placeholder="聯絡地址" required="required" type="text" value="<?=$result[0]['address']?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">地理座標 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="location" class="form-control col-md-7 col-xs-12 "  name="location" placeholder="地理座標" required="required" type="text" value="<?=$result[0]['lat'].','.$result[0]['lng']?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="service">服務時間 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="service" class="form-control col-md-7 col-xs-12 "  name="service" placeholder="服務時間" required="required" type="text" value="<?=$result[0]['service']?>">
                        </div>
                      </div>
                      <!-- SEO設定 -->
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword">網站關鍵字</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="keyword" name="keyword" class="form-control col-md-7 col-xs-12"><?=$result[0]['keyword']?></textarea>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">網站描述</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="desc"  name="desc" class="form-control col-md-7 col-xs-12"><?=$result[0]['desc']?></textarea>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ga">GA指令碼</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="ga"  name="ga" class="form-control col-md-7 col-xs-12"><?=$result[0]['ga']?></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">確認修改</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                    </div>
    </div>
        </div>
    </div>
        <!-- /page content -->
        <!-- footer content -->
        <?footer()?>
        <!-- /footer content -->
      </div>
    </div>
    
    <!-- CKEdit -->
    <script src="plug/CKEdit/ckeditor/ckeditor.js"></script>
    <!-- jQuery -->
    <script src="plug/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plug/bootstrap/dist/js/bootstrap.js"></script>


    <!-- validator -->
    <script src="plug/validator/validator.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="plug/moment/min/moment.min.js"></script>
    <script src="plug/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="system/js/custom.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6R-j6QUGy31AmQSwOMonQo-y7leSviBg"></script>

    <script>
    $(function(){
      $("#address").on("input",function(){
      var geocoder = new google.maps.Geocoder();  //定義一個Geocoder物件   
        geocoder.geocode(   
        { address: $(this).val() },    //設定地址的字串   
        function(results, status) {    //callback function   
          if (status == google.maps.GeocoderStatus.OK) {//判斷狀態 
            var pos = [results[0].geometry.location.lat(), results[0].geometry.location.lng()];
              $('#location').val(pos) ;             //取得座標                                   
            } else {   
              console.error("無法正確取得座標！");
          }   
        })   
      })
    })
    </script>
	
  </body>
</html>
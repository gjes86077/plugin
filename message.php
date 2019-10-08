<?
  require_once  "system/config.php";
  require_once  "block/side.php";
    if(!checkAdmin())
    HEADER('Location:login.php');
  $table='contact';
  $result= SelectNConditionOrder($cn,$table,array("crt_date"=>"desc"));
  $title='官網訊息';
  $amount=10; //一頁幾筆
  $totalData  = count($result);       //資料總數
  $totalPage  = ceil($totalData/$amount);   //總頁數
  $control_file='message.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=WEB_TITLE?>  | 森德網站設計有限公司</title>
    <!-- Bootstrap -->
    <link href="plug/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="plug/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="plug/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="plug/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="plug/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <style>.msg_list img{width: 100%}.time{float: right;}</style>
    <!-- Custom Theme Style -->
    <link href="system/css/custom.css" rel="stylesheet">
  </head>
  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col ">
        <?side(MessageCount($cn))?>
        </div>
        <!-- top navigation -->
        <?top_nav($cn)?>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>官網留言訊息</h3>
              </div>
            </div>
            <!-- End to do list -->
            <div class="col-xs-12">
              <!-- 信件編輯區塊 -->
              <div class="x_panel " id="edit">
                  <div class="x_title">
                    <h2>回覆訊息
                      <small></small>
                    </h2>
                    <?panel_menu()?>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="form_id" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">文章置於首頁</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="checkbox">
                            <label class="form-control" id="send"></label>
                              <input type="hidden" id="send_to" name="send_to" value="">
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">信件內容<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="content" id="content" cols="30" rows="10" class="ckeditor"></textarea>
                        </div>
                      </div>

                  <div class="clearfix"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-danger" type="button" onclick="list()" >取消</button>
                          <button class="btn btn-primary" type="reset">重填</button>
                          <button type="submit" class="btn btn-success" id="form_btn">發佈</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <!-- 信件編輯區塊 -->
              <div class="x_panel" id="list">
                <div class="x_title">
                  <h2>訊息瀏覽 </h2>

                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                    <?php foreach ($result as $mes):
    $label = $mes['read'] == 0 ? '<span class="label label-danger">未讀</span>' : '';
    ?>

			                    <li>
			                        <div class="col-md-1 col-xs-12"><img src="system/images/user.png" alt="img" />

			                        </div>
			                        <div class="col-md-2 col-xs-12">
			                          <div class="row">
			                            <div class="col-xs-12">姓　　名：<?=$mes['name']?></div>
			                            <div class="col-xs-12">聯絡電話：<?=$mes['phone']?></div>
			                            <div class="col-xs-12">電子信箱：<?=$mes['email']?></div>
			                            <div class="col-xs-12">
			                              <button class="btn btn-danger" onclick="del(<?=$mes['id']?>)">刪除</button>
			                              <button class="btn btn-warning" onclick="update(<?=$mes['id']?>)">回覆</button>
			                            </div>
			                          </div>
			                        </div>
			                        <div class="col-md-9 col-xs-12">
			                          <span class="time"><?=$label?><?=CheckTime($mes['crt_date'])?></span>
			                          <p class="message">
			                             <?=($mes['title'])?>
			                          </p>
			                          <p class="message">
			                             <?=nl2br($mes['content'])?>
			                          </p>
			                        </div>
			                    </li>
			                    <?php endforeach?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
                  <form action="control/<?php echo $control_file; ?>?action=delete" method="post" class="form-horizontal" id="del_from" >
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="type" id="type" value="">
          </form>
          <div class="clearfix"></div>
        </div>
        <!-- /page content -->
        <?footer()?>
      </div>
    </div>
    <div id="custom_notifications" class="custom-notifications dsp_none">
      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
      </ul>
      <div class="clearfix"></div>
      <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    <!-- 文件編輯器 -->
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
    <!-- Custom Theme Scripts -->
    <script src="system/js/custom.min.js"></script>
    <script>
      $('#edit').hide();
      function list() {
        $('#list').removeClass("fadeOutLeft").show().addClass('fadeInLeft');
        $("#edit").removeClass("fadeInRight").addClass('fadeOutRight ').hide();
       }
        function update(id) {
        var SRC_URL = "upload/";
        // $('#edit').fadeIn();
        // $('#list').fadeOut();
        $('#edit').removeClass("fadeOutRight ").addClass('fadeInRight').show();
        $("#list").removeClass("fadeInLeft ").addClass('fadeOutLeft').hide();
        $("#edit small").html("");
        $("#form_btn").html("送出");
        $.ajax({
          url:"control/<?=$control_file;?>?action=getId",
          dataType : "json",
          type:"GET",
          data:{
            id : id
          },
          beforeSend : function() {}
        }).done(
          function(result) {
            if (result) {
              $("#id").val(id);
              $("#send").html(result[0].email);
              $("#send_to").val(result[0].email);
              $("#content").val('<div>親愛的 '+result[0].name+' 先生／小姐，你好：</div><div></div><div></div><div></div><div>如果其他需要幫忙的地方，歡迎在至官網使用留言功能，或是將訊息直接透過信件與我們聯繫，並事事順心、愉快。</div><div style="text-align:center;color:#f00;font-weight:bold">※此訊息為系統發信，請勿直接回信※</div>');
              CKEDITOR.instances['content'].setData();
            }
            else
            {
              alert('沒有值');
            }
          }
        ).fail(
          function (error) {          //錯誤處理
            alert(error.responseText);  //列印錯誤 內容
          }
        );
        //        CKEDITOR.instances.n_content.setData(n_content); //編輯器設定值confirm("確認刪除？")
        $("#form_id").attr("action","control/<?php echo $control_file; ?>?action=send");
        $("#form_btn").attr("onsubmit","confirm('確認變更？')");
      }
      function del(id){
        $("#del_from #id").val(id);
        $("#del_from #type").val('article');
        if (!confirm("確認刪除？")) { return; }
        $("#del_from").submit();
      }
    </script>

  </body>
</html>
<? UpdateRead($cn);?>
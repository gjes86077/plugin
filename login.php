<?php
require_once "system/config.php";
//已登入跳至首頁
if (checkAdmin()) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>森德網站設計 | <?=WEB_TITLE?></title>
    <!-- Bootstrap -->
    <link href="plug/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="plug/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- NProgress -->
    <link href="plug/nprogress/nprogress.css" rel="stylesheet" />
    <!-- Animate.css -->
    <link href="plug/animate.css/animate.min.css" rel="stylesheet" />
    <!-- Pnotify Theme Style -->
    <link href="plug/pnotify/pnotify.custom.min.css" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="system/css/custom.css" rel="stylesheet" />
    <link href="plug/QapTcha/QapTcha.css" rel="stylesheet" />
    <style>
      .col-sm-9 {
        padding-left: 0;
      }
      .col-sm-3 {
        padding-right: 0;
      }

    </style>
  </head>
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" id="status">
              <h1 style="line-height: 80px"><?=WEB_TITLE?></h1>
              <a href="http://forestwebs.com.tw/" target="_blank"
                ><img
                  src="img/forest-logo-dark.png"
                  style="width:calc( 100%  - 150px);margin-top: -60px"
              /></a>
              <div></div>
              <div>
                <input
                  type="text"
                  class="form-control"
                  placeholder="帳號 | Account"
                  required=""
                  name="ac"
                  id="ac"
                />
              </div>
              <div>
                <input
                  type="password"
                  class="form-control"
                  placeholder="密碼 | Password"
                  required=""
                  name="pw"
                  id="pw"
                />
              </div>
              <div classs="row">
                <div class="col-sm-9">
                  <div class="QapTcha"></div>
                </div>
                <div class="col-sm-3">
                  <a class="btn btn-success submit btn-block" href="javascript:login()">登入</a>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <p>
                    ©2017
                    <a href="http://forestwebs.com.tw/" target="_blank">森德網站設計</a> Design All
                    Rights Reserved.
                  </p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <!-- <style>.pnotify-center {right: calc(50% - 150px) !important;}</style> -->
    <script src="plug/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="plug/pnotify/pnotify.custom.min.js"></script>
    <script src="plug/QapTcha/QapTcha.js"></script>
    <script type="text/javascript">
      $(function() {
        $('.QapTcha').QapTcha({
          txtLock: '不是機器人就往右滑',
          txtUnlock: '驗證成功!',
          disabledSubmit: false,
          autoRevert: true,
          autoSubmit: false,
          PHPfile: 'control/qaptcha.php',
        })
        $('#pw').keypress(function(e) {
          if (e.keyCode == 13) {
            login()
          }
        })
      })
      function login() {
        var data_array = {
          ac: $('#ac').val(),
          pw: $('#pw').val(),
        }
        data_array[$('.QapTcha input[type=hidden]').attr('name')] = 'qaptcha'
        console.log($('.QapTcha input[type=hidden]').attr('name'))
        $.ajax({
          url: 'control/login.php',
          dataType: 'json',
          type: 'post',
          data: data_array,
          beforeSend: function() {
            //showWait('資料傳送中');
          },
        })
          .done(function(result) {
            //hideWait();
            //關閉過場訊息
            var opts = {
              title: '錯誤！！',
              text: '',
              type: 'error',
              opacity: 0.5,
              animate: {
                animate: true,
                in_class: 'bounceIn',
                out_class: 'bounceOut',
              },
            }
            result = parseInt(result)
            switch (result) {
              case 10:
              case 12:
                opts.text = '帳號或密碼不正確，請重新確認！'
                break
              case 11:
                opts.text = '帳號已鎖定，請聯絡管理員！'
                break
              case 99:
                opts.text = '請將機器人向右拖拉！'
                break
              case 0:
                location.reload()
                return false
                break
              default:
                opts.text = '未知錯誤，請洽森德網站設計公司。'
                break
            }
            new PNotify(opts)
          })
          .fail(function(error) {
            //錯誤處理
            //hideWait();           //關閉過場訊息
            alert(error.responseText) //列印錯誤 內容
          })
      }
    </script>
  </body>
</html>

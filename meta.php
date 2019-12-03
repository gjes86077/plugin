<?php
require_once 'system/config.php';
if (!checkAdmin()) {
    header('Location:login.php');
}
$table        = 'meta';
$result       = SelectCondition($cn, $table, ['page' => $type]);
$result       = $result[0];
$control_file = 'meta.php';
?>
<!DOCTYPE html>
<html >
  <head>
    <?require_once  "block/head.php";?>
    <?require_once  "block/side.php";?>
  </head>
  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col  ">
          <?side(MessageCount($cn));?>
        </div>
        <!-- top navigation -->
        <?top_nav($cn);?>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?=$title;?>-頁面Meta資訊編修</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?=$title;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" action="control/meta.php?action=update" method="post" enctype="multipart/form-data"  data-type='formdata'  >
                      <input type="hidden" name="page" value='<?=$page?>'>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">頁面標題 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control" id="title" name='title' value='<?=$result['title'];?>'>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">頁面簡述 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="description" id="description" cols="30" rows="3"  class="form-control"><?=$result['description'];?></textarea>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keywords">頁面關鍵字 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="keywords" id="keywords" cols="30" rows="3"  class="form-control"><?=$result['keywords'];?></textarea>
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

    <?require_once 'block/js.php'?>
    <script>
    function func_afterEditing(res) {
      if (res.status) {
        Swal.fire({
          position: 'top',
          showConfirmButton: false,
          timer: 1000,
          title:'已儲存',
          type:'success'
        })
        update(res.id)
        dla.ajax.reload()
      }else{
        Swal.fire({
          position: 'top',
          showConfirmButton: false,
          timer: 1000,
          title:res.msg,
          type:'error'
        })
      }
    }
    </script>
  </body>
</html>
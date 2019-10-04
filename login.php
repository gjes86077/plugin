<?php
require_once 'system/config.php';
if (!checkAdmin()) {
    header('Location:login.php');
}
$control_file = 'Article.php';
$config       = ['insert' => true, 'show_check' => $show, 'category' => false];

?>
<!DOCTYPE html>
<html lang="ZH-TW">
  <head>
    <?require_once  "block/head.php";?>
    <?require_once  "block/side.php";?>
    <style>
    </style>
  </head>
 <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
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
                <h3></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel hidden" id="edit">
                  <div class="x_title">
                    <h2><?=$title;?><small></small></h2>
                    <?panel_menu()?>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="form_id" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" data-type='formdata'>
                      <input type="hidden" id="id" name="id" >    <!--ID 在這-->
                      <input type="hidden" id="type" name="type" value='<?=$type?>'>    <!--ID 在這-->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">標題<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="title" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>

                      <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='first-name'>圖片<span class='required'>*</span></label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                            <div class='alert alert-success'>請上傳的「jpg,png,gif」格式圖片。</div>
                          <a href='javascript:' class='btn btn-warning' style='position:relative'>
                            <i class='fa fa-upload'></i> 選擇檔案
                            <input type='file' class='upl' name='banner'>
                          </a>
                          <div>
                            <input type='hidden'  name='img' id='img' >
                            <img class='preview' style='max-width: 100%;margin-top: 10px'  data-event="cropper" data-width="600" data-height="400">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">內容<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name='content' id="content" cols="30" rows="10" class="ckeditor"></textarea>
                        </div>
                      </div>


                      <div class="ln_solid"></div>

                  <div class="clearfix"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button" onclick="list()" >返回</button>
                          <button class="btn btn-danger" type="reset">清除重填</button>
                          <button type="submit" class="btn btn-success" id="form_btn">儲存</button>

                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="x_panel" id="list">
              <!-- 新增按鈕在這邊 -->
                  <div class="x_title">
                  <div class="row">
                  <h2 class="col-sm-6"><?=$title;?>清單 </h2>
                  <div class="col-sm-6">
                  <?=$config['insert'] ? '<a href="javascript:insert();" class="btn-primary insert-btn pull-right"></a>' : '';?>
                  </div >
                  </div>

                    <!-- <?panel_menu()?> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action  dt-responsive nowrap dataAjax"  style="font-size: 16px;line-height: 18px; width:100%" id="">
                        <thead>
                          <tr class="headings">
                            <th class="column-title col-xs-1 center"> </th>
                            <th class="column-title col-xs-9 center">標題</th>
                            <th class="column-title col-xs-1  center">排序級別
                            <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="top"
                                data-original-title="數字越大越前面，同級別以更新時間為參考依據"></span>
                            </th>
                            <?if($config['show_check']){?>
                            <th class="column-title col-xs-1  center">顯示於首頁</th>
                            <?}?>
                          </tr>
                        </thead>
                        <tbody id="data_list">

                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
                <form action="?action=delete" method="post" class="form-horizontal" id="del_from" >
                  <input type="hidden" name="id" id="id" value="">
                  <input type="hidden" name="type" id="type" value="">
                </form>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <a href="https://www.forestwebs.com.tw/">森德網站設計有限公司</a> 製作
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <?php require_once 'block/js.php';?>

    <script>
    controlUrl = 'control/<?php echo $control_file; ?>'
    $('.dataAjax').on('change', '.SortNum', function() {
      id = $(this).data('id')
      $.post(controlUrl + '?action=sortNum', { id: id, sort: $(this).val() }, function(res) {
        obj = {
          position: 'top',
          showConfirmButton: false,
          timer: 1000,
        }
        if (parseInt(res)) {
          obj.title = '已變更'
          obj.type = 'success'
        } else {
          obj.title = '變更失敗'
          obj.type = 'error'
          obj.animation = false
          obj.customClass.popup = 'animated fadeInDown'
        }
        Swal.fire(obj)
        dla.ajax.reload()
      })
    })
    function func_afterEditing(res) {
      update(res.id)
      Swal.fire({
          position: 'top',
          showConfirmButton: false,
          timer: 1000,
          title:'已儲存',
          type:'success'
      })

    }

    $('.dataAjax').on('change', '.showHome', function() {
      id = $(this).data('id')
      show = $(this).is(':checked') ? 1 : 0
      $.post(controlUrl + '?action=showHome', { id: id, show: show }, function(res) {
        obj = {
          position: 'top',
          showConfirmButton: false,
          timer: 1000,
        }
        if (parseInt(res)) {
          obj.title = '已變更'
          obj.type = 'success'
        } else {
          obj.title = '變更失敗'
          obj.type = 'error'
          obj.animation = false
          obj.customClass.popup = 'animated tada'
        }
        Swal.fire(obj)
        dla.ajax.reload()
      })
    })

    function reset() {
      $('textarea').val('')
      $('input[type=text]').val('')
      $('img[class^="preview"]').removeAttr('src')
      $('img[class^="preview"]').cropper('destroy')
    }
    function insert() {
      type = '<?=$_GET["type"];?>'
      reset()
      $('#edit').removeClass('hidden')
      $('#edit small').html('新增')
      $('#form_id').attr('action', controlUrl + '?action=insert')
      $('#list').addClass('hidden')
    }
    //刪除
    function del(id) {
      $('#del_from #id').val(id)
      Swal.fire({
        title: '確認刪除？',
        text: '資料一經刪除，將無法還原！',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '確認刪除',
        cancelButtonText: '取消',
      }).then(result => {
        if (result.value) {
          $.post(controlUrl + '?action=delete', { id: id }, function() {
            Swal.fire('已刪除', '完成刪除！', 'success')
            dla.ajax.reload()
          })
        }
      })
      // $("#del_from").submit();
    }
    function delfile(id) {
      $('#del_from #id').val(id)
      $('#del_from #type').val('file')
      if (!confirm('確認刪除檔案？')) {
        return
      }
      $('#del_from').submit()
    }
    function list() {
      $('#list').removeClass('hidden')
      $('#edit').addClass('hidden')
    }
    function check() {
      if ($('#top').val() == 1) $('#top').val(0)
      else $('#top').val(1)
    }
    function update(id) {
      var SRC_URL = '../upload/'
      reset()
      $('#edit').removeClass('hidden')
      $('#edit small').html('變更')
      $('#list').addClass('hidden')
      $.ajax({
        url: 'control/<?=$control_file;?>?action=getId',
        dataType: 'json',
        type: 'GET',
        data: {
          id: id,
        },
        beforeSend: function() {},
      })
        .done(function(result) {
          if (result) {
            $('#id').val(id)
            $('#title').val(result.title)
            $('#content').val(result.content)
            if ($('#content').hasClass('ckeditor')) {
              CKEDITOR.instances['content'].setData()
            }
            $('.preview').attr('src', SRC_URL + 'article-' + result.id + '.png')
          } else {
            alert('沒有值')
          }
        })
        .fail(function(error) {
          //錯誤處理
          alert(error.responseText) //列印錯誤 內容
        })
      //        CKEDITOR.instances.n_content.setData(n_content); //編輯器設定值confirm("確認刪除？")
      $('#form_id').attr('action', 'control/<?=$control_file;?>?action=update')
      $('#form_btn').attr('onsubmit', "confirm('確認變更？')")
    }


    </script>
  </body>

</html>

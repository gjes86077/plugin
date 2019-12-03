<?php
  $control_file='lang_list.php';   
  $table='lang_data';
  $result=SelectCustom($link,"Select * from $table where lang='zh-tw' and `key` like '$where%' order by `key` ");  
  $amount=10; //一頁幾筆
  $totalData  = count($result);       //資料總數
  $totalPage  = ceil($totalData/$amount);   //總頁數
?>
<!DOCTYPE html>
<html lang="ZH-TW">
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
.table>tbody>tr>td{
  line-height: 40px !important;
}
    </style>
  </head>

 <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col  ">
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

            

            <div class="x_panel" id="list">
                  <div class="x_title">
                    <h2><i class="fa fa-language"></i>、<?=$title?>清單</h2>
                    <?panel_menu()?>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <form method="post" action="control/<?=$control_file?>" >
                      <table class="table table-striped jambo_table bulk_action" style="font-size: 18px;line-height: 40px;">
                        <thead>
                          <tr class="headings">
                            <!-- <th class="column-title col-xs-1"> </th> -->
                            <th class="column-title col-xs-2">鍵值</th>
                            <th class="column-title col-xs-5">中文名稱</th>
                            <th class="column-title col-xs-5">語系內容</th>
                            </tr>

                        </thead>
                        <tbody>
                          <? foreach ($result as $key=>$data) {?>
                          <tr class="even pointer">
                            <!-- <td class="control ">
                              <button class="btn btn-danger" onclick="del(<?=$active_cate['id']?>)"  data-toggle="tooltip" data-placement="top" data-original-title="刪除<?=$active_cate['title']?>"><i class="fa fa-remove"></i></button>
                              <button class="btn btn-primary" onclick="update(<?=$active_cate['id']?>)" data-toggle="tooltip" data-placement="top" data-original-title="編輯<?=$active_cate['title']?>"><i class="fa fa-edit"></i></button>
                              </td> -->
                              <td class=" ">
                              <?=$data['key']?>
                            </td>
                            <td class=" ">
                              <?=$data['title']?>
                            </td>
                            <td class=" ">
                              <?$res=SelectCustom($link,"Select * from lang_data  where lang='".$_SESSION['admin_lang']."' and `key` = '".$data['key']."'")?>
                              <input type="text" name="title[]" value="<?=$res[0]['title']?>" class="form-control">
                              <input type="hidden" name="key[]" value="<?=$data['key']?>" >
                            </td>
                         
                          </tr>  
                          <?}?>                        
                        </tbody>
                        <tbody>
                          <tr>
                            <td  colspan="3"><button class="btn btn-success">確認修改</button></td>
                          </tr>
                        </tbody>
                      </table>
                      </form>
                    </div>
                  </div>
                </div>
            
<form action="control/<?php echo $control_file; ?>?action=delete" method="post" class="form-horizontal" id="del_from" >
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
      function insert() {
        type = '<?=$_GET['type']?>';
        $("#id").val(id);
        $("#title").val('');
        $("#content").val('');
        $("#order").val('');
        $("#top").val('');
        $("#img").val('');
        $("#edit").removeClass("hidden");
        $("#edit small").html("發佈");
        $("#form_btn").html("發佈");
        $("#form_id").attr("action","control/<?php echo $control_file; ?>?action=insert");
        $("#list").addClass("hidden");
      }
      //刪除
      function del(id){
        $("#del_from #id").val(id);
        if (!confirm("確認刪除？")) { return; }
        $("#del_from").submit();
      }
      function delfile(id){
        $("#del_from #id").val(id);        
        $("#del_from #type").val('file');
        if (!confirm("確認刪除檔案？")) { return; }
        $("#del_from").submit();
      }
       function list() {
        $("#list").removeClass("hidden");
        $("#edit").addClass("hidden");
       }
       function check(){
        if($("#top").val()==1)
          $("#top").val(0)   ;     
        else
          $("#top").val(1)   ;        
       }
       function update(id) {
        var SRC_URL = "upload/";
        $("#edit").removeClass("hidden");
        $("#edit small").html("");
        $("#form_btn").html("變更");
        $("#list").addClass("hidden");
        $('#type option').attr('selected',null);   
        $.ajax({
          url:"control/<?=$control_file; ?>?action=getId",
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
              $("#title").val(result[0].title);
              $("#order").val(result[0].order);
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
        $("#form_id").attr("action","control/<?php echo $control_file; ?>?action=update");
        $("#form_btn").attr("onsubmit","confirm('確認變更？')");
      }

    </script> 
  </body>

</html>

<? 
  require_once  "system/config.php"; 
    if(!checkAdmin())
    HEADER('Location:login.php');
  
  $table='user';
  $result= SelectCustom($link,'Select * from user where account !="forest"');
  $control_file='user.php';
  
  $title='成員管理';
  $amount=10; //一頁幾筆
  $totalData  = count($result);       //資料總數
  $totalPage  = ceil($totalData/$amount);   //總頁數
?>
<!DOCTYPE html>
<html lang="ZH-TW">
  <head>
    <?require_once  "block/head.php";?>
    <?require_once  "block/side.php";?>
    <style>
input[type=file]{
  display: hidden;
}
    </style>
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
                <h3></h3>
              </div>
              
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel hidden" id="edit">
                  <div class="x_title">
                    <h2><?=$title?><small></small></h2>
                    <?panel_menu()?>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="form_id" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">姓名<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">帳號<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="account" name="account" class="form-control col-md-7 col-xs-12" required="required">
                          <input type="hidden" id="account2" name="account2" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">密碼<span class="required">*</span>
                        </label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12"  AutoComplete="Off" >
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">層級<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <select name="rank" id="rank" class="form-control">
                           <option value="1">系統管理者</option>
                           <option value="2">一般管理者</option>
                         </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">狀態<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="is_open" id="is_open" class="form-control">
                           <option value="0">正常</option>
                           <option value="1">停權</option>
                         </select>
                        </div>
                      </div>                              
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-danger" type="button" onclick="list()" >取消</button>
                          <button class="btn btn-primary" type="reset" >重填</button>
						              <button class="btn btn-info hidden" type="button" id="resetpw">重設密碼</button>
                          <button type="submit" class="btn btn-success" id="form_btn">發佈</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="x_panel" id="list">
                  <div class="x_title">
                    <h2><?=$title?>清單 <a href="javascript:insert();" class="btn btn-primary">建立會員</a></h2>
                    <?panel_menu()?>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action" style="font-size: 18px;line-height: 40px;">
                        <thead>
                          <tr class="headings">
                            <th class="column-title col-xs-1 control "></th>
                            <th class="column-title col-xs-3">帳號 </th>
                            <th class="column-title col-xs-3">姓名</th>
                            <th class="column-title col-xs-3">權限</th>
                            <th class="column-title col-xs-3">狀態</th>
                          </tr>
                        </thead>
                        <tbody>
                          <? foreach ($result as $member) {?>
                          <tr class="even pointer">
                            <td class="control ">
                              <button class="btn btn-danger" onclick="del(<?=$member['id']?>)"  data-toggle="tooltip" data-placement="top" data-original-title="刪除<?=$member['title']?>"><i class="fa fa-remove"></i></button>
                              <button class="btn btn-primary" onclick="update(<?=$member['id']?>)" data-toggle="tooltip" data-placement="top" data-original-title="編輯<?=$member['title']?>"><i class="fa fa-edit"></i></button>
                              </td>
                            <td class=" "><?=$member['account']?></td>
                            <td class=" "><?=$member['name']?></td>                            
                            <td class=" "><?=$member['rank']==1?'系統管理者':'一般管理者'?></td>
                            <td class=" "><?=$member['is_open']==1?'停權':'正常'?></td>
                          </tr>  
                          <?}?>                        
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            
    <form action="control/<?php echo $control_file; ?>?action=delete" method="post" class="form-horizontal" id="del_from" >
      <input type="hidden" name="id" id="id" value="">
    </form>
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
      function insert() {
        type = '<?=$_GET['type']?>';
        $("#id").val(id);
        $("#name").val('');
        $("#password").val('');
        $("#account").val('');
        $("#account").removeAttr('disabled');
        $("#edit").removeClass("hidden");
        $("#edit small").html("建立");
        $("#form_btn").html("建立");
        $("#form_id").attr("action","control/<?php echo $control_file; ?>?action=insert");
        $("#list").addClass("hidden");        
        $("#password").attr("placeholder","");
      }
      //刪除
      function del(id){
        $("#del_from #id").val(id);
        $("#del_from").attr("action","control/<?php echo $control_file; ?>?action=delete");
        if (!confirm("確認刪除？")) { return; }
        $("#del_from").submit();
      }
      function resetPW(id){
        $("#del_from #id").val(id);
        $("#del_from").attr("action","control/<?php echo $control_file; ?>?action=resetPW");
        if (!confirm("是否重設帳號 "+id+" 的密碼呢？")) { return; }
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
       function update(ac) {
        $("#edit").removeClass("hidden");
        $("#edit small").html("");
        $("#form_btn").html("變更");
        $("#list").addClass("hidden");
        $("#password").attr("placeholder","不變更請留白");
       
        $.ajax({
          url:"control/<?=$control_file; ?>?action=getId",
          dataType : "json",
          type:"GET",
          data:{"id" : ac},
          beforeSend : function() {}
        }).done(
          function(result) {
            if (result) {       
              $("#id").val(id);
              $("#name").val(result[0].name);
              $("#email").val(result[0].email);
              $("#phone").val(result[0].phone);
              $("#account2").val(result[0].account);
              $("#account").val(result[0].account);
              $("#account").attr("disabled","disabled");
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
<? 
function side($val){
  $filename = "block/links.json";
  $json_string = file_get_contents($filename); 
  $list=json_decode($json_string,true); 
  if($val>0){$label='<span class="label label-dange animated flash" style="position: absolute; top: 5px;">'.$val.'</span>';}
  $admin=$_SESSION['u_rank']>2?'<div class="menu_section"><h3>系統管理員</h3><ul class="nav side-menu"><li><a href="e_commerce.html"><i class="fa fa-bug"></i> 多國語系新增鍵值</a></li></ul>
    </div>':'';
  echo '<div class="col-md-3 left_col ">
  <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"></a>
          </div>
          <div class="clearfix"></div>
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="img/icon-people.png" alt="'.$_SESSION['u_name'].'" class="img-circle profile_img">
            </div>
          <div class="profile_info">
            <span>Welcome,</span>
            <h2>'.$_SESSION['u_name'].'</h2>
          </div>
        </div>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h3>'.WEB_TITLE.'</h3>
            <ul class="nav side-menu">';
  foreach ($list as $list_1) {
    $exist=array_key_exists("list",$list_1);
    echo "<!-- {$list_1['title']} -->\r\n";
    $href=!$exist?"href='{$list_1['php_file']}'":'';
    $icon=$exist?"<span class='fa fa-chevron-down'></span>":'';
    echo "<li ><a {$href}><i class='fa fa-{$list_1['fa']}'></i> {$list_1['title']}{$icon}</a>\r\n";
    if ($exist) {
      echo "<ul class='nav child_menu'>\r\n";
      foreach ($list_1["list"] as $list_2) {
        $exist=array_key_exists("list",$list_2);
        $href=!$exist?"href='{$list_2['php_file']}'":'';
        $icon=$exist?"<span class='fa fa-chevron-down'></span>":'';
        echo "<li ><a {$href}>{$list_2['title']}</a>\r\n";
        if ($exist) {
            echo "<ul class='nav child_menu'>\r\n";
            foreach ($list_2["list"] as $list_3) {
              echo "<li ><a href='{$list_3['php_file']}'>{$list_3['title']}</a>\r\n";
        }
            echo "</ul>\r\n";
      }
        echo "</li>\r\n";
      }
      echo "</ul>\r\n";
    } 
    echo "</li>\r\n";
  }
  echo       '

         </ul>
       </div>
       '.$admin.'
     </div>
     <!-- /sidebar menu -->

     <!-- /menu footer buttons -->
     <div class="sidebar-footer hidden-small">
       <a data-toggle="tooltip" data-placement="top" title="成員管理" href="user.php">
         <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
       </a>
       <a data-toggle="tooltip" data-placement="top" title="官網訊息查看" href="message.php">
         <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>'.$label.'
       </a>
       <a data-toggle="tooltip" data-placement="top" title="Lock">
         <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
       </a>
       <a data-toggle="tooltip" data-placement="top" title="登出" href="control/logout.php">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>';
      }
function panel_menu(){
  echo '<ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>';
    }
    function footer(){
      
      echo '
 <!-- footer content -->
  <footer>
   
      <div class="pull-right">
'.WEB_TITLE.'
            <a href="https://www.forestwebs.com.tw/">森德網站設計有限公司 製作</a> 
        
          </div>
          
          <div class="clearfix"></div>
        </footer>
      <!-- /footer content -->';
   }
   function top_nav($link){
            session_start();
            $_SESSION[admin_lang_chinese]=$_SESSION[admin_lang]=='zh-tw'?'繁體中文':'英文';
            $result=SelectUnread($link);
            echo '<div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="img/icon-people.png" alt="">'.$_SESSION['u_name'].'
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                 
                    <li><a href="user.php"><i class="glyphicon glyphicon-user pull-right"></i>成員管理</a></li>
                    <li><a href="../index.php" target="_blank"><i class="glyphicon glyphicon-eye-open pull-right"></i>瀏覽網頁</a></li>                    
                    <li><a href="control/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
               <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  '.$_SESSION[admin_lang_chinese].'
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li ><a href="?admin_lang=zh-tw"> 繁中設定</a></li>
                  <li ><a href="?admin_lang=en-us"> 英文設定</a></li>
                  
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>';
                    if (MessageCount($link)>0)
                      echo '<span class="badge bg-green">'.MessageCount($link).'</span>';
                   echo '</a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">';
                  foreach ($result as $unread) {
                    echo '<li>
                      <a>
                        <span class="image"><img src="system/images/user.png" alt="Profile Image" /></span>
                        <span>
                          <span>'.$unread['name'].'</span>
                          <span class="time">'.CheckTime($unread['crt_date']).'</span>
                        </span>
                        <span class="message">
                         '.$unread['content'].'
                        </span>
                      </a>
                    </li>';
                  }
                    echo '<li>
                      <div class="text-center">
                        <a href="message.php">
                          <strong>See All Messages</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>';
}

?>
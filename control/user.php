<?php

require_once '../system/config.php';
$UPD = UpdateById($cn, 'inf', array('upd' => date('Y-m-d H:m:s')), 0);

function getList($cn, $type = '')
{
    header('Content-type:application/json');
    //設定檢查傳入KEY值
    $keyArray = array('id');
    //接收POST值
    $get = $_GET;
    //檢查

    //取出資料
    $id = $get['id'];
    //移除sql注入
    $id = checkSqlInjection($id);
    //移除HTML標籤
    $id     = checkHtmlPhpTag($id);
    $result = SelectCustom($cn, 'Select * from user where account !="forest"');

    $column = ['account', 'name', 'rank', "is_open"];
    $return['data'];

    foreach ($result as $index => $lib) {
        $id     = $lib['id'];
        $list[] = "<button class=\"btn btn-danger btn-xs\"
                onclick=\"del({$id})\"
                data-toggle=\"tooltip\"
                data-placement=\"top\"
                data-original-title=\"刪除\">
                    <i class=\"fa fa-remove\"></i>
                </button>
                <button class=\"btn btn-primary btn-xs\"
                onclick=\"update({$id})\"
                data-toggle=\"tooltip\"
                data-placement=\"top\"
                data-original-title=\"編輯\">
                    <i class=\"fa fa-edit\"></i>
                </button>";
        foreach ($column as $value) {

            if ($value == 'show') {
                $checked = (int) $lib[$value] ? 'checked' : '';
                $str     = "<input type='checkbox' data-id='{$id}' class='form-control showHome' value=1 {$checked}>";
                $value   = $str;
            } elseif ($value == 'sort') {
                $str   = "<input value='{$lib[$value]}' type='number' data-id='{$id}' class='form-control SortNum' >";
                $value = $str;
            } elseif ($value == 'rank') {
                $value = $lib[$value] == 1 ? '系統管理者' : '一般管理者';
            } elseif ($value == 'is_open') {
                $value = $lib[$value] == 1 ? '停權' : '正常';
            } else {
                $value = $lib[$value];
            }
            $list[] = $value;
        }
        $return['data'][] = $list;
        unset($list);
    }

    echo json_encode($return);
}
function getId($cn, $type = '')
{
    //設定檢查傳入KEY值
    $keyArray = array('id');
    //接收POST值
    $post = $_GET;
    //檢查
    if (!checkConvey($post, $keyArray)) {
        echo 'error = 10';
        exit();
    }
    //取出資料
    $id = $post['id'];
    //移除sql注入
    $id = checkSqlInjection($id);
    //移除HTML標籤
    $id = checkHtmlPhpTag($id);

    $tableName = 'user';
    $result    = Select1Condition($cn, $tableName, 'id', $id);
    echo json_encode($result);
}
function delete($cn)
{
    //設定檢查傳入KEY值
    $keyArray = array('id');
    //接收POST值
    $post = $_POST;
    //檢查
    if (!checkConvey($post, $keyArray)) {
        echo 'ERROR:無法找到索引值';
        exit();
    }
    //取出資料
    $id = $post['id'];
    //移除sql注入
    $id = checkSqlInjection($id);
    //移除HTML標籤
    $id     = checkHtmlPhpTag($id);
    $result = DeleteById($cn, 'user', 'id', $id);

    if ($result) {
        echo json_encode($result);
        exit();
    } else {
        echo 'error = 11';
    }
}
function update($cn)
{
    //設定檢查傳入KEY值是否存在
    $keyArray = array('name', 'account2', 'is_open', 'rank', 'password');
    //接收POST值
    $post = $_POST;
    //檢查
    if (!checkConvey($post, $keyArray)) {
        echo 'ERROR:無法找到索引值';
        exit();
    }
    //移除無定義的key值
    $post = checkKey($post, $keyArray);
    //移除sql注入
    $post = checkSqlInjection($post);
    //移除HTML標籤
    $post = checkHtmlPhpTag($post);
    if ($post['password'] == '') {
        $result = UpdateByCustom($cn, 'user', array(
            'name'    => $post['name'],
            'is_open' => $post['is_open'],
            'rank'    => $post['rank'],
        ), 'account', $post['account2']);
    } else {
        $result = UpdateByCustom($cn, 'user', array(
            'name'     => $post['name'],
            'password' => password_salt($post['account2'], $post['password']),
            'is_open'  => $post['is_open'],
            'rank'     => $post['rank'],
        ), 'account', $post['account2']);
    }
    if ($result) {
        echo json_encode($result);
        exit();
    } else {
        echo 'ERROR:資料未更新';
        exit();
    }
}
function insert($cn)
{
    //設定檢查傳入KEY值是否存在
    $keyArray = array('name', 'account', 'password', 'rank', 'is_open');
    //接收POST值
    $post = $_POST;
    //檢查
    if (!checkConvey($post, $keyArray)) {
        echo 'ERROR:無法找到索引值';
        exit();
    }
    //移除無定義的key值
    $post = checkKey($post, $keyArray);
    //移除sql注入
    $post = checkSqlInjection($post);
    //移除HTML標籤
    $result = insertOne($cn, 'user', array(
        'name'     => $post['name'],
        'account'  => $post['account'],
        'password' => password_salt($post['account'], $post['password']),
        'rank'     => $post['rank'],
        'is_open'  => $post['is_open'],
    ));
    if ($result) {
        echo json_encode($result);
        exit();
    } else {
        echo 'error = 12';
        exit();
    }
}
if (isset($_GET['action']) && function_exists($_GET['action'])) {
    $action = $_GET['action'];
    $type   = $_POST['type'];
    $action($cn, $type);
} else {
    echo 'NO!NO!NO!';
    exit();
}

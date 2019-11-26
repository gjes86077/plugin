<?php
require_once realpath(dirname(__FILE__) . '/../') . '/system/config.php';
if (isset($_GET["action"]) && function_exists($_GET["action"])) {
    $action = $_GET["action"];
    define("TABLE_NAME", "meta");
    $action($cn, $db);
} else {
    echo "NO!NO!NO!";
    exit();
}
function keyarray()
{
    $key = array("type", 'description', "keywords", 'title');
    return $key;
}
function post_array($i = '')
{
    $post = $_POST;
    $key  = keyarray();
    //檢查
    if (!checkConvey($post, $key)) {
        var_dump($post, $key);
        echo "ERROR:無法找到索引值";
        exit();
    }
    //移除無定義的key值
    $post = CheckAll($post, $key);
    //接收POST值
    $array = [
        'title'       => $post['title'],
        'keywords'    => $post['keywords'],
        'description' => $post['description'],
        'page'        => $post['type'],
        // 'lang'=>$_SESSION[admin_lang],
        // "img" => fileimg("banner",TABLE_NAME),
    ];
    return $array;
}
function update($cn)
{
    $p = CheckAll($_POST, keyarray());

    $result = count(SelectCondition($cn, TABLE_NAME, ['page' => $p['type']])) ?
    UpdateByCustom($cn, TABLE_NAME, post_array(), ['page' => $p['type']]) :
    InsertOne($cn, TABLE_NAME, post_array());
    if ($result) {
        backPrevPage();
        exit();
    } else {
        echo "ERROR:資料未更新";
        exit();
    }
}

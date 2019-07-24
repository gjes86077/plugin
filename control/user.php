<?php

require_once '../system/config.php';
$UPD = UpdateById($link, 'inf', array('upd' => date('Y-m-d H:m:s')), 0);

  function getId($link, $type = '')
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
      $result = Select1Condition($link, $tableName, 'id', $id);
      echo json_encode($result);
  }
  function delete($link)
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
      $id = checkHtmlPhpTag($id);
      $result = DeletById($link, 'user', 'id', $id);

      if ($result) {
          echo json_encode($result);
          exit();
      } else {
          echo 'error = 11';
      }
  }
  function update($link)
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
          $result = UpdateByCustom($link, 'user', array(
      'name' => $post['name'],
      'is_open' => $post['is_open'],
      'rank' => $post['rank'],
    ), 'account', $post['account2']);
      } else {
          $result = UpdateByCustom($link, 'user', array(
      'name' => $post['name'],
      'password' => password_salt($post['account2'], $post['password']),
      'is_open' => $post['is_open'],
      'rank' => $post['rank'],
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
  function insert($link)
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
      $result = insertOne($link, 'user', array(
      'name' => $post['name'],
      'account' => $post['account'],
      'password' => password_salt($post['account'], $post['password']),
      'rank' => $post['rank'],
      'is_open' => $post['is_open'],
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
      $type = $_POST['type'];
      $action($link, $type);
  } else {
      echo 'NO!NO!NO!';
      exit();
  }

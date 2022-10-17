<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vulnweb</title>
    <!-- Bootstrap core CSS -->
    <link href="/boostrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/users/profile.php">プロフィール</a>
          <a class="navbar-brand" href="/users/filemanage.php">ファイル管理</a>
          <a class="navbar-brand" href="/users/profileStats.php">ユーザー情報検索</a>
          <a class="navbar-brand" href="/users/xml.php">XML</a>
          <a class="navbar-brand" href="/users/searchId.php">ID紐付け検索</a>
          <a class="navbar-brand" href="/logout.php">ログアウト</a>
          <a class="navbar-brand" href="/index.php">メインメニューへ戻る</a>
        </div>
      </div>
    </div>


<?php 

/* 意図的オープンリダイレクト */
if (!empty($_GET['url'])){
  header("Location: " . $_GET['url']);
  exit();
}

/* 意図的page=include(LFI脆弱性) */
if (!empty($_GET['page'])){
  include ($_GET['page']);
}

?>

<?php
  session_start();
  require_once('conn.php');
  if (empty($_POST['username']) || empty($_POST['nickname']) || empty($_POST['password'])) {
    header("Location: signup.php?errMsg=1");
    die("請填寫完整");
  }
  $username = $_POST['username'];
  $nickname = $_POST['nickname'];
  $comment = $_POST['password'];
  $sql = sprintf(
    "INSERT INTO janet_w9_users(username, nickname, password) VALUES ('%s', '%s', '%s')",
    $username,
    $nickname,
    $password
  ); 
  $result = $conn->query($sql);
  if(!$result){
    if($conn->errno === 1062){
      header("Location:signup.php?errMsg=2");
    }
    die($conn->error);
  } 
  $_SESSION['username'] = $username;
  header("Location:index.php");
?>
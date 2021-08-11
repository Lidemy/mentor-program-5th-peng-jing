<?php
  session_start();
  require_once('conn.php');
  if (
    empty($_POST['username']) || 
    empty($_POST['nickname']) || 
    empty($_POST['password'])
  ) {
    header("Location: register.php?errMsg=1");
    die("資料填寫不完整");
  }
  $username = $_POST['username'];
  $nickname = $_POST['nickname'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $sql = 'INSERT INTO janet_wk11_hw1_user(nickname, username, password) VALUES (?, ?, ?)';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $nickname, $username, $password);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  $result = $stmt->get_result();
  $_SESSION['username'] = $username;
  header("Location: index.php");
  exit();
?>
<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  if(empty($_SESSION['username']) || empty($_POST['content'])){
    header("Location: index.php?errCode=1");
    die("資料填寫不完整");
  }
  $username = $_SESSION['username'];
  $content = $_POST['content'];
  $sql = "INSERT INTO janet_wk11_hw1_comment(username, content) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $content); //把參數放進去
  $result = $stmt->execute();
  if(!$result){
    die($conn->error);
  }
  header("Location: index.php");
?>
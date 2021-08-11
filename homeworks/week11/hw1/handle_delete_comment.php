<?php
  session_start();
  require_once('conn.php');
  if(empty($_GET['id'])){
    header("Location: index.php");
    die("資料填寫不完整");
  }
  $id = $_GET['id'];
  $username = $_SESSION['username'];
  $sql = "UPDATE janet_wk11_hw1_comment SET is_delete = 1 WHERE id = ? AND username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('is', $id, $username); //把參數放進去
  $result = $stmt->execute();
  if(!$result){
    die($conn->error);
  }
  header("Location: index.php");
?>
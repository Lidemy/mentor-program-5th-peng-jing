<?php
  require_once('conn.php');
  require_once('utils.php');
  if (empty($_POST['nickname']) || empty($_POST['comment'])) {
    // header("Location: index.php?errMag=1");
  }
  $nickname = getNickname($_SESSION['username']);
  $comment = $_POST['comment'];
  $sql = sprintf(
    "INSERT INTO janet_w9_comments(nickname, comment) VALUES ('%s', '%s')",
    $nickname,
    $comment
  ); 
  $result = $conn->query($sql);
  if(!$result){
    die($conn->error);
  }
  header("Location:index.php");
?>
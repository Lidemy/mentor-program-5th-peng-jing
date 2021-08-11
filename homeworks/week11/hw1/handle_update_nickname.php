<?php
  session_start();
  require_once('conn.php');
  if (empty($_POST['nickname']) ) {
    header("Location: index.php?errMsg=1");
    die("資料填寫不完整");
  }
  $username = $_SESSION['username'];
  $nickname = $_POST['nickname'];
  $sql = 'UPDATE janet_wk11_hw1_user SET nickname = ? WHERE username = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $nickname, $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  header("Location: index.php");
?>
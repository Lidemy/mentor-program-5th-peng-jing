<?php
  session_start();
  require_once('conn.php');
  if (empty($_POST['content']) ) {
    header("Location: index.php?errMsg=1");
    die("資料填寫不完整");
  }
  $username = $_SESSION['username'];
  $id = $_POST['id'];
  $content = $_POST['content'];
  $sql = 'UPDATE janet_wk11_hw1_comment SET content = ? WHERE id = ? AND username = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sis', $content, $id, $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  header("Location: index.php");
?>
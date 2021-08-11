<?php
  session_start();
  require_once('conn.php');
  if (empty($_POST['nickname'])) { 
    header("Location: user_edit.php?errMsg=1&id=" . $_POST['id']);
    die("資料填寫不完整");
  }
  $username = $_POST['username'];
  $nickname = $_POST['nickname'];
  $role = $_POST['role'];
  $sql = 'UPDATE janet_wk11_hw1_user SET nickname = ?, role = ? WHERE username = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sis', $nickname, $role, $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  header("Location:user_list.php");
?>
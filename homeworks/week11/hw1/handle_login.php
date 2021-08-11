<?php
  session_start();
  require_once('conn.php');
  if (
    empty($_POST['username']) || 
    empty($_POST['password'])
  ) {
    header("Location: login.php?errMsg=1");
    die("資料填寫不完整");
  }
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = 'SELECT * FROM janet_wk11_hw1_user WHERE username = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->errno);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if($result->num_rows < 1 ) {
    header("Location: login.php?errMsg=2");
    die("查無帳號");
  }
  if (password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    header("Location: index.php");
    exit();
  } else {
    header("Location: login.php?errMsg=3");
    die("密碼不正確");
  }
?>
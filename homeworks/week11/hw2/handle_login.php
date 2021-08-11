<?php
  session_start();
  require_once('conn.php');
  if (
    empty($_POST['username']) || 
    empty($_POST['password'])
  ){
    header("Location: login.php?errMsg=1");
    die("資料填寫不完全");
  }
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM janet_wk11_hw2_blog_user WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();
  if (!result) {
    die($conn->error);
  }
  $result = $stmt->get_result();
  if ($result->num_rows) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['username'] = $username;
      header("Location: post_list.php");
      exit();
    } else {
      header("Location: login.php?errMsg=2");
      exit();
    }
  } else {
    header("Location: login.php?errMsg=2");
  }
?>
<?php
  require_once('conn.php');
  global $conn;
  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }
  function user_role($username) {
    global $conn;
    $sql = "SELECT role FROM janet_wk11_hw1_user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $role = $row['role'];
    return $role;
  }
?>
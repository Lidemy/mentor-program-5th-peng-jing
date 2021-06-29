<?php
  session_start();
  require_once('conn.php');
  function getNickname($username) {
    global $conn;
    $sql = sprintf(
      "SELECT nickname FROM janet_w9_users WHERE username = '%s'",
      $username
    );
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $nickname = $row['nickname'];
    return $nickname;
  }
?>
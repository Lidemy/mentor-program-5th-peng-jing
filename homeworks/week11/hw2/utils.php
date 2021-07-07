<?php
  require_once('conn.php');
  global $conn;
  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }
?>
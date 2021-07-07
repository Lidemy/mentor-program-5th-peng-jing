<?php
  session_start();
  require_once('conn.php');
  if (empty($_GET['post_id']) || empty($_SESSION['username'])){
    header("Location: add_post.php?errMsg=2");
    die("文章已被刪除");
  }
  $post_id = $_GET['post_id'];
  $sql = "UPDATE janet_wk11_hw2_blog_post SET post_is_delete = 1 WHERE post_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $post_id);
  $result = $stmt->execute();
  if (!result) {
    die($conn->error);
  }
  header("Location: post_list_edit.php");
?>
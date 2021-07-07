<?php
  require_once('conn.php');
  if (
    empty($_POST['post_title']) || 
    empty($_POST['post_content'])
  ){
    header("Location: add_post.php?errMsg=1");
    die("資料填寫不完全");
  }
  $post_title = $_POST['post_title'];
  $post_content = $_POST['post_content'];
  $sql = "INSERT INTO janet_wk11_hw2_blog_post(post_title, post_content) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $post_title, $post_content);
  $result = $stmt->execute();
  if (!result) {
    die($conn->error);
  }
  header("Location: post_list_edit.php");
?>
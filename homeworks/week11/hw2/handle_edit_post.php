<?php
  require_once('conn.php');
  if (
    empty($_POST['post_title']) || 
    empty($_POST['post_content'])
  ){
    header("Location: add_post.php?errMsg=1");
    die("資料填寫不完全");
  }
  $post_id = $_POST['post_id'];
  $post_title = $_POST['post_title'];
  $post_content = $_POST['post_content'];
  $sql = "UPDATE janet_wk11_hw2_blog_post SET post_title = ?, post_content = ? WHERE post_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ssi', $post_title, $post_content, $post_id);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  header("Location: post_list_edit.php?post_id=" . $_POST['post_id']);
?>
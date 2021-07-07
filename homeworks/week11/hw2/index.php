<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
  $result = $conn->query("SELECT * FROM janet_wk11_hw2_blog_post WHERE post_is_delete IS NULL ORDER BY post_id DESC limit 5");
  if (!$result) {
    die($conn->error);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>部落格</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
  <nav class="nav">
    <div class="nav__content">
      <div class="nav-left">
        <h1><a href="index.php">Blog</a></h1>
        <ul class="nav__list">
          <?php if (!empty($username)) { ?>
            <li><a href="post_list_edit.php">文章管理</a></li>
          <?php } else { ?>
            <li><a href="post_list.php">文章列表</a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="nav-right">
        <?php if (!empty($username)) { ?>
          <div class="nav__admin"><a href="add_post.php">新增文章</a></div>
          <div class="nav__admin"><a href="handle_logout.php">登出</a></div>
        <?php } else { ?>
          <div class="nav__admin"><a href="login.php">登入</a></div> 
        <?php } ?>
      </div>
      
    </div>
  </nav>
  <main>
    <div class="banner">
      <div class="banner__content">
        <div class="banner__title">存放技術之地</div>
        Welcome to my blog
      </div>
    </div>
    <div class="posts">
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="post">
          <div class="post__title"><?php echo escape($row['post_title']);?></div>
          <div class="post__date"><?php echo escape($row['post_create_at']);?></div>
          <div class="post__content"><?php echo substr(escape($row['post_content']), 0, 250) . "......";?></div>
          <div><a class="post__btn" href="post.php?post_id=<?php echo $row['post_id'];?>">繼續閱讀</a></div>
          <?php if (!empty($username)) { ?>
            <div>
              <a class="post__edit" href="edit_post.php?post_id=<?php echo $row['post_id']; ?>">
                <i class="fa fa-pencil-square-o edit_btn" aria-hidden="true"></i>
              </a>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
      
  </main>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>

<?php
  session_start();
  require_once('conn.php');
  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  } else {
    header("Location:index.php");
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
      <div class="post">
        <h2>發表文章</h2>
        <?php
          if (!empty($_GET['errMsg'])) {
            $errmsg = "Error";
            if ($_GET['errMsg'] === '1') {
              $errmsg = "請輸入文章標題及內文";
            } else if ($_GET['errMsg'] === '2') {
              $errmsg = "文章不存在或已被刪除，請重新撰寫。";
            }
            echo "<h3 class='err'>" . $errmsg . "</h3>";
          } 
        ?>
        <form method="POST" action="handle_add_post.php">
          <input type="text" placeholder="請輸入文章標題" name="post_title">
          <textarea name="post_content" rows="20"></textarea>
          <input class="card__submit" type="submit" value="送出">
        </form>
      </div>
    </div>
  </main>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>

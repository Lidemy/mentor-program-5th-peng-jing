<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  } else {
    header("Location:index.php");
  }
  $post_id = $_GET['post_id'];
  $sql = "SELECT * FROM janet_wk11_hw2_blog_post WHERE post_id = ? AND post_is_delete IS NULL";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $post_id);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if ($result->num_rows < 1 ) { 
    header("Location: add_post.php?errMsg=2");
    die("新增文章");
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
      <div class="post">
        <h2>編輯文章</h2>
        <?php
          if (!empty($_GET['errMsg'])) {
            $errmsg = "Error";
            if ($_GET['errMsg'] === '1') {
              $errmsg = "請輸入文章標題及內文";
            } 
            echo "<h3 class='err'>" . $errmsg . "</h3>";
          } 
        ?>
        <form method="POST" action="handle_edit_post.php">
          <input type="text" value="<?php echo escape($row['post_title']); ?>" name="post_title">
          <textarea name="post_content" rows="20" ><?php echo escape($row['post_content']); ?></textarea>
          <input class="hide" type="text" name="post_id" value="<?php echo escape($row['post_id']); ?>">
          <input class="card__submit" type="submit" value="送出">
        </form>
        <div>
          <a class="post__edit" href="handle_delete_post.php?post_id=<?php echo escape($row['post_id']); ?>">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  </main>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>

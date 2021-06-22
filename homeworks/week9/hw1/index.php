<?php
  session_start();
  require_once('conn.php');
  $result = $conn->query("SELECT * FROM janet_w9_comments ORDER BY id DESC");
  if (!$result) {
    die($conn->error);
  }
  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div class="header">
    <strong>
      注意!本站為練習用網站，因教學用途刻意忽略資安實作，註冊時請勿使用任何真實的帳號或密碼。
    </strong>
  </div>

  <div class="board">
    <div>
      <?php if(empty($username)) { ?>
        <a class="board__btn" href="signup.php">註冊</a>
        <a class="board__btn" href="login.php">登入</a>
      <?php } else { ?>
        <a class="board__btn" href="handle_logout.php">登出</a>
        <div><?php echo "Hi " . $username ?></div>
      <?php } ?>
    </div>
    <h1>Comments</h1>
    <form method="POST" action="handle_add_comment.php">
      <textarea name="comment" rows="5"></textarea>
      <div>
        <?php if(empty($username)){?>
          <h3>留言前請先登錄</h3>
        <?php } else { ?>
          <input type="submit" class="board__submit-btn">
        <?php } ?>
      </div>
    </form>
    <div class="comments">
      <?php while ($row=$result->fetch_assoc()) { ?>
        <div class="comment">
          <div class="comment__avatar"></div>
          <div class="comment__body">
            <div class="comment__user">
              <span class="comment__nickname"><?php echo $row['nickname']; ?></span>
              <span class="comment__date"><?php echo $row['create_at']; ?></span>
            </div>
            <div class="comment__message"><?php echo $row['comment'];?></div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</body>
</html>
<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");
  $page = 1;
  if (!empty($_GET['page'])) {
    $page = $_GET['page'];
  }
  $per_page_items = 5;
  $offset = ($page - 1) * $per_page_items;
  $sql = "SELECT C.id AS id, C.username AS username, C.create_at AS create_at, C.content AS content, U.nickname AS nickname FROM janet_wk11_hw1_comment AS C LEFT JOIN janet_wk11_hw1_user AS U ON C.username = U.username WHERE is_delete IS NULL ORDER BY C.id DESC LIMIT ? OFFSET ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $per_page_items, $offset);
  $result = $stmt->execute();
  if(!$result){
    die($conn->error);
  }
  $result = $stmt->get_result();
  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>留言板</title>
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <header class="warning">
    <strong>
      注意!本站為練習用網站，因教學用途刻意忽略資安實作，註冊時請勿使用任何真實的帳號或密碼。
    </strong>
  </header>
  <main class="board">
    <div class="board__btns">
      <?php if (empty($username)) { ?>
       <a class="board__btn" href="register.php">註冊</a>
       <a class="board__btn" href="login.php">登入</a>
      <?php } else { ?>
        <a class="board__btn" href="handle_logout.php">登出</a>
        <span class="board__btn update-username_btn">編輯暱稱</span>
        <?php if (user_role($username) === 2) { ?>
          <a class="board__btn admin_btn" href="user_list.php">會員管理</a>
        <?php } ?>
      <?php } ?>
    </div>
    <form method="POST" action="handle_update_nickname.php" class="hide update_username">
      <div>
        修改暱稱<input type="text" name="nickname" class="board__input">
      </div>
      <input type="submit" class="board__submit-btn">
    </form>
    <h1 class="board__title">Comments</h1>
    <?php
      if (!empty($_GET['errMsg'])) { 
        $errmsg = "Error";
        if ($_GET['errMsg'] === '1') {
          $errmsg = "請填寫留言再按提交";
        }
        echo "<h2 class='err'>" . $errmsg . "</h2>";
      }
    ?>
    <form class="board__new-comment-form" method="POST" action="handle_add_comment.php">
      <?php if ($username) { ?>
        <div>Hi 
        <?php echo $username; ?>
        </div>
        <?php if (user_role($username) !== 0) { ?>
          <textarea name="content" rows="5"></textarea>
          <input class="board__submit-btn" type="submit">
        <?php } else { ?>
          <h3>您沒有權限留言</h3>
        <?php } ?>
      <?php } else { ?>     
        <h3>發布留言請先登入</h3>
      <?php } ?>
    </form>
    <section class="cards">
     <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="card">
        <div class="card__avatar"></div>
        <div class="card__body">
          <div class="card__info">
            <span class="card__author">
              <?php echo escape($row['nickname']) . " (@" . escape($row['username']) . ")"; ?>
            </span>
            <span class="card__time">
              <?php echo escape($row['create_at']);?>
            </span>
            <?php if ($username === $row['username'] || user_role($username) === 2) { ?>
              <!-- 留言的名稱與登入名稱相同時，或是權限為管理者( role = 2 ) -->
              <a href="update_comment.php?id=<?php echo $row['id'];?>">編輯</a>
              <a href="handle_delete_comment.php?id=<?php echo $row['id'];?>">刪除</a>
            <?php } ?>
          </div>
          <div class="card__content"><?php echo escape($row['content']); ?></div>
        </div>
      </div>
    <?php } ?>
    </section>
    <?php
      $result = $conn->query("SELECT COUNT(id) AS num FROM janet_wk11_hw1_comment WHERE is_delete IS NULL");
      $row = $result->fetch_assoc();
      $final_page = ceil($row['num'] / $per_page_items);
    ?>
    <div class="pagination">
      <?php if ($page != 1) { ?>
        <a href="index.php?page=1">首頁</a>
        <a href="index.php?page=<?php echo $page - 1; ?>">上一頁</a>
      <?php } ?>  
      <?php if ($page != $final_page) { ?>
        <a href="index.php?page=<?php echo $page + 1; ?>">下一頁</a>
        <a href="index.php?page=<?php echo $final_page; ?>">最終頁</a>
      <?php } ?>
    </div>
  </main>
  <script>
    document.querySelector('.update-username_btn').addEventListener('click', 
      function() {
        document.querySelector('.update_username').classList.toggle('hide');
    })
  </script>
</body>
</html>

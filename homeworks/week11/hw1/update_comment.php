<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
  $id = $_GET['id'];
  $sql = 'SELECT * FROM janet_wk11_hw1_comment WHERE id = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if (user_role($username) !== 2) {
    if ($row['username'] != $username) {
      header("Location:index.php");
      exit();
    }
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
    <div>
      <a class="board__btn" href="index.php">回首頁</a>
    </div>
    <h1 class="board__title">編輯留言</h1>
    <?php
      if (!empty($_GET['errMsg'])) { 
        $errmsg = "Error";
        if ($_GET['errMsg'] === '1') {
          $errmsg = "請填寫留言再按送出";
        }
        echo "<h2 class='err'>" . $errmsg . "</h2>";
      }
    ?>
    <form class="board__new-comment-form" method="POST" action="handle_update_comment.php">
      <textarea name="content" rows="5"><?php echo $row['content'];?></textarea>
      <input type="text" class="hide" name="id" value="<?php echo $_GET['id'];?>">
      <input class="board__submit-btn" type="submit">
    </form>
  </main>
</body>
</html>

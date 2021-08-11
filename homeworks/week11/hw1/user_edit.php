<?php
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
  if (user_role($username) !== 2) {
    header("Location:index.php");
    exit();
  }
  $id = $_GET['id'];
  $sql = "SELECT * FROM janet_wk11_hw1_user WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>留言板</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
  <header class="warning">
    <strong>
      注意!本站為練習用網站，因教學用途刻意忽略資安實作，註冊時請勿使用任何真實的帳號或密碼。
    </strong>
  </header>
  <main class="board user__info">
    <div>
       <a class="board__btn" href="index.php">回首頁</a>
       <a class="board__btn" href="user_list.php">回會員管理</a>
    </div>
    <h1 class="board__title">編輯會員資料</h1>
    <?php
      if (!empty($_GET['errMsg'])) { 
        $errmsg = "Error";
        if ($_GET['errMsg'] === '1') {
          $errmsg = "請填寫完整";
        }
        echo "<h2 class='err'>" . $errmsg . "</h2>";
      }
    ?>
    <section>
      <div>
        <span>ID: <?php echo escape($row['id']); ?></span>
        <span>/ 帳號:  <?php echo escape($row['username']); ?></span>
      </div>
      <form method="POST" action="handle_user_edit.php">
        <input class="hide" type="text" name="id" value="<?php echo escape($row['id']); ?>">
        <input class="hide" type="text" name="username" value="<?php echo escape($row['username']); ?>">
        <div class="user__title">暱稱</div>
        <input class="user__input" type="text" name="nickname" value="<?php echo escape($row['nickname']); ?>">
        <?php 
          switch ($row['role']) {
            case 0: $role = "黑名單"; 
            break; 
            case 1: $role = "一般會員"; 
            break;
            case 2: $role = "管理者"; 
            break;
          }
        ?>
        <div class="user__title">會員狀態</div>
        <select id="role__sel" name="role">
          <option value="1" <?php if ($row['role']===1) {echo "selected";} ?>>一般會員</option >
          <option value="2" <?php if ($row['role']===2) {echo "selected";} ?> >管理者</option >
          <option value="0" <?php if ($row['role']===0) {echo "selected";} ?>>黑名單</option >
        </select >
        <input type="submit" class="board__submit-btn" value="儲存">
      </form>
    </section>
  </main>
</body>
</html>

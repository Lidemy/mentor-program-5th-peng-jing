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
  $result = $conn->query("SELECT * FROM janet_wk11_hw1_user");
  if (!$result) {
    die($conn->error);
  }
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
  <main class="board">
    <div>
       <a class="board__btn" href="index.php">回首頁</a>
    </div>
    <h1 class="board__title">會員名單</h1>
    <section>
      <table class="users">
        <thead>
            <tr>
                <th>ID</th>
                <th>帳號</th>
                <th>暱稱</th>
                <th>會員狀態</th>
                <th>編輯</th>
            </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?php echo escape($row['id']); ?></td>
              <td class="td_username"><?php echo escape($row['username']); ?></td>
              <td class="td_username"><?php echo escape($row['nickname']); ?></td>
              <td>
                <?php 
                  switch ($row['role']) {
                    case 0: $role = "黑名單"; 
                    break; 
                    case 1: $role = "一般會員"; 
                    break;
                    case 2: $role = "管理者"; 
                    break;
                  }
                  echo $role; 
                ?>
              </td>
              <td><a href="user_edit.php?id=<?php echo escape($row['id']);?>"><i class="fa fa-pencil-square-o edit_btn" aria-hidden="true"></i></a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>

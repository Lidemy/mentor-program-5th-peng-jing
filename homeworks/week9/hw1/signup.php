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
      <a class="board__btn" href="index.php">回留言板</a>
      <a class="board__btn" href="login.php">登入</a>
    </div>
    <h1>註冊</h1>
    <?php
      if(!empty($_GET['errMsg'])){
        $code = $_GET['errMsg'];
        $msg = 'Error';
        if($code === '1'){
          $msg = '請填寫完整';
        } else if($code === '2'){
          $msg = '帳號已被註冊';
        }
        echo "<h2 class='errMsg'>" . $msg . "</h2>";
      }
    ?>
    <form method="POST" action="handle_signup.php">
      <div>
        帳號: <input class="board__input" type="text" name="username">
      </div>
      <div>
        暱稱: <input class="board__input" type="text" name="nickname">
      </div>
      <div>
        密碼: <input class="board__input" type="password" name="password">
      </div>
      <div>
        <input type="submit" class="board__submit-btn">
      </div>
    </form>
  </div>
</body>
</html>
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
       <a class="board__btn" href="login.php">登入</a>
    </div>
    <h1 class="board__title">註冊會員</h1>
    <?php 
      if (!empty($_GET['errMsg'])) {
        $errmsg = "Error";
          if ($_GET['errMsg'] === '1'){
            $errmsg = "資料請填寫完整";
          }
        echo "<h2 class='err'>" . $errmsg . "</h2>";
      }
    ?>
    <form class="board__new-comment-form" method="POST" action="handle_register.php">
        <div>
          帳號: <input class="board__input" name="username" type="text">
        </div>
        <div>
          暱稱: <input class="board__input" name="nickname" type="text">
        </div>
        <div>
          密碼: <input class="board__input" name="password" type="password">
        </div>
        <input class="board__submit-btn" type="submit">
    </form>
  </main>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>部落格</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body class="login">
  <nav class="nav">
    <div class="nav__content">
      <div class="nav-left">
        <h1><a href="index.php">Blog</a></h1>
        <ul class="nav__list">
          <li><a href="post_list.php">文章列表</a></li>
          <!-- <li><a href="">分類專區</a></li>
          <li><a href="">關於我</a></li> -->
        </ul>
      </div>
    </div>
  </nav>
  <main>
    <div class="card">
      <div class="card__title">Login</div>
      <?php 
        if (!empty($_GET['errMsg'])) { 
          $msg = "Error";
          if ($_GET['errMsg'] === '1') {
            $msg = "請填寫帳號及密碼";
          } else if ($_GET['errMsg'] === '2') {
            $msg = "帳號或密碼不正確";
          } 
          echo "<h2 class='err'>" . $msg . "</h2>";
        }
      ?>
      <form method="POST" action="handle_login.php">
        <div class="card__input-title">USERNAME</div>
        <input type="text" name="username">
        <div class="card__input-title">PASSWORD</div>
        <input type="password" name="password">
        <input class="card__submit" type="submit" value="登入">
      </form>
    </div>
  </main>
</body>
</html>

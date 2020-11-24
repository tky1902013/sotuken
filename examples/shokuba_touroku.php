<?php

session_start();
/*if( isset($_SESSION['user']) != "") {
  // ログイン済みの場合はリダイレクト
  header("Location: home.php");
}*/

// DBとの接続
include_once 'dbconnect.php';

// ユーザーIDからユーザー名を取り出す
$query = "SELECT * FROM users WHERE user_id=".$_SESSION['user']."";
$result = $mysqli->query($query);

if (!$result) {
  print('クエリーが失敗しました。' . $mysqli->error);
  $mysqli->close();
  exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $username = $row['username'];
  $email = $row['email'];
}

// sendがPOSTされたときに下記を実行
if(isset($_POST['send'])) {

  $workname = $mysqli->real_escape_string($_POST['workname']);

  // POSTされた情報をDBに格納する
  $query = "INSERT INTO works(user_id,workname) VALUES('$user_id','$workname')";

  if($mysqli->query($query)) {  ?>
    <div class="alert alert-success" role="alert">登録しました</div>
    <?php } else { ?>
    <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
    <?php
  }
}

// データベースの切断
$result->close();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8' />
  <title>シフト入力画面</title>
  <link href='../packages/core/main.css' rel='stylesheet' />
  <link href='../packages/daygrid/main.css' rel='stylesheet' />
  <link href='../packages/timegrid/main.css' rel='stylesheet' />
  <link href='../packages/list/main.css' rel='stylesheet' />
  <link href='css/style.css' rel='stylesheet'/>
  <script src='../packages/core/main.js'></script>
  <script src='../packages/interaction/main.js'></script>
  <script src='../packages/daygrid/main.js'></script>
  <script src='../packages/timegrid/main.js'></script>
  <script src='../packages/list/main.js'></script>
  <script src="../packages/core/locales-all.js"></script>
</head>

<body>
  <header>
  <ul>
  <li>名前：<?php echo $username; ?></li>
  <li>メールアドレス：<?php echo $email; ?></li>
</ul>
    <a href="logout.php?logout" class="header_button">ログアウト</a>
  </header>

  <main>
  <form method="POST" action="home.php">

    <h1>職場名</h1>
    <p><input type="text" name="workname"></p>

    <p><input type="submit" name="send"></p>
    </form>
  </main>

  <fotter>
</fotter>

</body>
</html>
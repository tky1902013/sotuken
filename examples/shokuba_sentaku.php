<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user'])) {
  header("Location: index.php");
}

// ユーザーIDからユーザー名を取り出す
$query = "SELECT * FROM users WHERE user_id=".$_SESSION['user']."";
$result = $mysqli->query($query);

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
    <h1>登録済みの職場がありません</h1>
    <a href="shokuba_touroku.php" class="shokuba_touroku">管理者として職場を登録する</a>
    <a href="" class="shokuba_shoutai">スタッフとして職場に招待を受ける</a>
  </main>

  <footer>
  </footer>

</body>
</html>
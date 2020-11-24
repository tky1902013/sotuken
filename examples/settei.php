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
    <h1>ユニクロ新宿東口店</h1>
    <ul>
      <li>シフト管理者：<?php echo $username; ?></li>
    </ul>
    <a href="logout.php?logout" class="header_button">ログアウト</a>
    <a href="settei.php" class="current_button">設定</a>
    <a href="home.php" class="header_button">ホーム</a>
  </header>

  <main>
    <a href="gyoumu_settei.php" class="shokuba_shoutai">業務設定</a> 
    <a href="" class="shokuba_shoutai">スタッフ登録</a>
    <a href="" class="shokuba_shoutai">スタッフ削除</a>
    <a href="" class="shokuba_shoutai">給与確認</a>
    <a href="" class="shokuba_shoutai">職場登録</a>
    <a href="" class="shokuba_shoutai">職場削除</a>
    <a href="" class="shokuba_shoutai">職場切替</a>
    <a href="pass1.php" class="shokuba_shoutai">会員名・メールアドレスの変更</a>
    <a href="pass2.php" class="shokuba_shoutai">パスワードの変更</a>
    <a href="" class="shokuba_shoutai">お問い合わせ</a>
    <a href="" class="shokuba_shoutai">当システムの使い方</a>
    <a href="" class="shokuba_shoutai">運営からのお知らせ</a>
    <br>
  </main>

  <footer>
  </footer>
</body>
</html>
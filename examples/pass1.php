<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user'])) {
  header("Location: index.php");
}

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

// 職場IDから職場名を取り出す
$query = "SELECT * FROM works WHERE work_id=".$_SESSION['user']."";
$result = $mysqli->query($query);

if (!$result) {
  print('クエリーが失敗しました。' . $mysqli->error);
  $mysqli->close();
  exit();
}

// 職場名の取り出し
while ($row = $result->fetch_assoc()) {
  $workname = $row['workname'];
}

// データベースの切断
$result->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8' />
  <title>ホーム画面</title>
<!--フォルダ内にあるファイル群、これらを呼出すことでFullCalendarを実装している-->
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
    <h1>ユニクロ新宿東口店</h1><!--職場表と会員表を結合して、職場表の職場名をこの<h1>に入れたい-->
    <ul>
      <li>シフト管理者：<?php echo $username; ?></li>
    </ul>
    <a href="logout.php?logout" class="header_button">ログアウト</a>
    <a href="settei.php" class="header_button">設定</a>
    <a href="" class="current_button">ホーム</a>
  </header>

  <main>
  <form method="POST" action="henkou1.php">

    <h1>パスワード</h1>
    <p><input type="password" name="password"></p>

    <p><input type="submit" name="send" value="入力"></p>
    </form>

  </main>

  <footer>
  </footer>

</body>
</html>
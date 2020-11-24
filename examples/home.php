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
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
        header: {
          left: 'header,prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        locale: 'ja',
        defaultDate: '2020-11-01',
        navLinks: true, // can click day/week names to navigate views
        businessHours: false, // display business hours
        editable: true,
        buttonIcons: true, // show the prev/next text

        eventRender: function(info) {
      info.el.onclick = function () {
        alert("スタッフ名：" + info.event.title + "\n開始時刻：" + info.event.start + "\n終了時刻：" + info.event.end + "\n状態：" + info.event.extendedProps.status);
      };
    },

        events: [//title,startなど定義済みの項目に対して、ここでは手入力で代入している。ユーザ入力の際に変数で受け取ってDBに送ればよい
          {
            //id: '<262399c4-3d9c-4d4f-b090-c8d8e8b50358>',
            title: '山川',
            start: '2020-11-03T13:00:00',
            end: '2020-11-03T15:00:00',
            status: '確定'
            //constraint: 'businessHours'
          },
          {
            title: '室賀',
            start: '2020-11-03T13:00:00',
            end: '2020-11-03T16:00:00',
            status: '確定'
            //constraint: 'businessHours'
          },
          {
            title: '濱口',
            start: '2020-11-03T13:00:00',
            end: '2020-11-03T16:00:00',
            status: '確定'
            //constraint: 'businessHours'
          },
          {
            title: '三浦',
            start: '2020-11-03T13:00:00',
            end: '2020-11-03T16:00:00',
            status: '確定'
            //constraint: 'businessHours'
          },
          {
            title: '堀江',
            start: '2020-11-03T13:00:00',
            end: '2020-11-03T16:00:00',
            status: '確定'
            //constraint: 'businessHours'
          },
          {
            title: '堀江',
            start: '2020-11-13T11:00:00',
            status: '未確定',
            color: '#257e4a'
          },
          {
            title: '脇坂',
            start: '2020-11-18T11:00:00',
            end: '2020-11-18T15:00:00',
            status: '確定'
          },
          {
            title: '山本',
            start: '2020-11-29T20:00:00'
          },

          // areas where "Meeting" must be dropped
          {
            groupId: '大川',
            start: '2020-11-11T10:00:00',
            end: '2020-08-11T16:00:00',
            rendering: 'background'
          },
          {
            groupId: 'availableForMeeting',
            start: '2020-11-13T10:00:00',
            end: '2019-08-13T16:00:00',
            rendering: 'background'
          },

          // red areas where no events can be dropped
          {
            start: '2020-11-24',
            end: '2020-11-28',
            overlap: false,
            rendering: 'background',
            color: '#ff9f89'
          },
          {
            start: '2020-11-06',
            end: '2020-11-08',
            overlap: false,
            rendering: 'background',
            color: '#ff9f89'
          }
        ]
      });

      calendar.render();
    });

  </script>

  <script>//確認フォーム群、このテンプレを上手く使いまわせば、だいたいいけそう
    function check1() {
      if (window.confirm('自動作成しますがよろしいですか？')) { // 確認ダイアログを表示
        return true; // 「OK」時は送信を実行
      } else { // 「キャンセル」時の処理
        window.alert('キャンセルされました'); // 警告ダイアログを表示
        return false; // 送信を中止
      }
    }
  </script>

  <script>
    function btnClick(obj) {
      alert(obj.value);
    }
  </script>

  <script>
    function check2() {
      if (window.confirm('送信しますがよろしいですか？')) {
        return true;
      } else {
        window.alert('キャンセルされました');
        return false;
      }
    }
  </script>
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
    <form method="POST" action="" onSubmit="return check2()">
      <input type="submit" name="" value="送信" class="header_button2">
    </form>

    <form action="">
      <input type="button" name="btn" value="一括選択" onclick="btnClick(this)" class="header_button2">
    </form>

    <form method="POST" action="" onSubmit="return check1()">
      <input type="submit" name="" value="自動作成" class="header_button2">
    </form>

    <div id='calendar'></div>

  <div class="tabbox">
   <input type="radio" name="tabset" id="tabcheck1" checked><label for="tabcheck1" class="tab">新規追加</label>
   <input type="radio" name="tabset" id="tabcheck2"        ><label for="tabcheck2" class="tab">枠組み追加</label>
   <input type="radio" name="tabset" id="tabcheck3"        ><label for="tabcheck3" class="tab">メンバー</label>
   <div class="tabcontent" id="tabcontent1">
   <form method="POST" action="home.php">
    <h1>新規追加</h1>
    <p>メンバー選択</p>
    <p><select name="member"></p>
    <option value="">メンバーを選択</option>
    <option value="">山川</option>
    <option value="">脇坂</option>
    <option value="">山本</option>
    <option value="">濱口</option>
    <option value="">大川</option>
    <option value="">堀江</option>
    </select>

    <p>日付</p>
    <p><input type="date" name="start"></p>

    <p>開始時刻</p>
    <p><input type="time" name="start"></p>

    <p>終了時刻</p>
    <p><input type="time" name="end"></p>

    <p><input type="submit" name="send" value="入力"></p>
    </form>
   </div>
   <div class="tabcontent" id="tabcontent2"><form method="POST" action="home.php">
    <h1>枠組み追加</h1>
    <p>業務選択</p>
    <p><select name="member"></p>
    <option value="">担当業務を選択</option>
    <option value="">売場</option>
    <option value="">レジ</option>
    <option value="">レジアテンド</option>
    <option value="">試着室</option>
    <option value="">倉庫</option>
    </select>

    <p>日付</p>
    <p><input type="date" name="start"></p>

    <p>開始時刻</p>
    <p><input type="time" name="start"></p>

    <p>終了時刻</p>
    <p><input type="time" name="end"></p>

    <p><input type="submit" name="send" value="入力"></p>
    </form>
  </div>

   <div class="tabcontent" id="tabcontent3">
     <h1>メンバー</h1>
    <ul>
    <li>管理者<br><a href="" >山川 </a></li>
    <li>スタッフ<br><a href="" >脇坂</a></li>
    <li>スタッフ<br><a href="" >山本</a></li>
    <li>スタッフ<br><a href="" >濱口</a></li>
    <li>スタッフ<br><a href="" >大川</a></li>
    <li>スタッフ<br><a href="" >堀江</a></li>
    </ul>
  </div>
</div>
  </main>

  <footer>
  </footer>

</body>
</html>
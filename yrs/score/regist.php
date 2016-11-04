<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>?A?h???X?o?^</title>
</head>
<body>
<?php

include 'initial.php';

$con = mysql_connect( $host, $user, $pass);

if (!$con) {
  echo "$host $user $pass";
  exit('データベースに接続できませんでした。');
}

$result = mysql_select_db( $mydb, $con);
if (!$result) {
   exit('データベースを選択できませんでした。');
}

$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
  exit('文字コードを指定できませんでした。');
}

$date   = addslashes($_REQUEST['date']);
$name = addslashes($_REQUEST['name']);
$ground  = addslashes($_REQUEST['ground']);
$year  = addslashes($_REQUEST['year']);
$team  = addslashes($_REQUEST['team']);
$enemy  = addslashes($_REQUEST['enemy']);
$score  = addslashes($_REQUEST['score']);
$escore  = addslashes($_REQUEST['escore']);
$info  = addslashes($_REQUEST['info']);
$notes  = addslashes($_REQUEST['notes']);

$result = mysql_query("INSERT INTO $tbl1(date,name,ground,year,team,enemy,score,escore,info,notes) VALUES('$date','$name','$ground','$year','$team','$enemy','$score','$escore','$info','$notes')", $con);
if (!$result) {
  exit('データを登録できませんでした。');
}

$con = mysql_close($con);
if (!$con) {
 exit('データベースとの接続を閉じられませんでした。');
}

?>
<p>登録が完了しました。<br /><a href="index.html">戻る</a></p>
</body>
</html>

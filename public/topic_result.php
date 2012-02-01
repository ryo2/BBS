<!DOCTYPE html>
<html lang=”ja”>
	<head>
		<meta charset=utf-8>
		<title>write_result|BBS</title>
	</head>
	<body>
<?php 
	require_once("../config/config.php");
	require_once(PROGRAM_PATH."connectDB.php");

$sqlInsert = "INSERT INTO bbs_topics (title,comment,name,mail,delete_flag,created,updated) VALUES ('" . $_POST['title'] . "','" . nl2br($_POST['comment']) ."','". $_POST['name'] ."','". $_POST['mail'] ."',0,NULL,NULL)";

$query = mysql_query($sqlInsert,$link);

echo ("新規のトピックを作成しました！<br>");
echo ("<a href='index.php'>戻る</a>");
?>
	</body>
</html>


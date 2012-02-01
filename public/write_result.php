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

$sqlInsert = "INSERT INTO bbs_comments (topic_id,comment,name,mail,delete_flag,created) VALUES ('" . $_POST['topic_id'] . "','" . nl2br($_POST['comment']) ."','". $_POST['name'] ."','". $_POST['mail'] ."',0,NULL)" ;
$sqlUpdate = "UPDATE bbs_topics SET updated = NOW() WHERE id =" .$_POST['topic_id'] ;
$query1 = mysql_query($sqlInsert,$link) or die(mysql_error());
$query2 = mysql_query($sqlUpdate,$link) or die(mysql_error());

echo ("書き込みが完了しました！<br>");
echo ("<a href='index.php'>戻る</a>");
?>
	</body>
</html>
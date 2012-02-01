<!DOCTYPE html>
<html lang=”ja”>
	<head>
		<meta charset=utf-8>
		<title>TOPIC confirm | BBS</title>
	</head>
	<body>
	本当にこのトピックを作成しますか？<br />
	トピック名：<?php echo($_POST['title']); ?><br />
	名前：<?php echo(($_POST['name'] == NULL )? "なまえなしこさん" : $_POST['name'] ); ?><br />
	メール：<?php echo($_POST['mail']); ?><br />
	内容：<?php echo(nl2br($_POST['comment'])); ?><br />
	<form method="post" action="topic_result.php">
		<input type="hidden" name="title" value="<?php echo($_POST['title']); ?>">
		<input type="hidden" name="name" value="<?php echo(($_POST['name'] == NULL )? "なまえなしこさん" : $_POST['name'] ); ?>">
		<input type="hidden" name="mail" value="<?php echo($_POST['mail']); ?>">
		<input type="hidden" name="comment" value="<?php echo($_POST['comment']); ?>">
		<input type="submit" value="作成する">
		<input type="button" value="戻る" onClick="location.href='index.php'">
	</form>
	</body>
</html>
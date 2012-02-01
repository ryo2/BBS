<!DOCTYPE html>
<html lang=”ja”>
	<head>
		<meta charset=utf-8>
		<title>write confirm | BBS</title>
	</head>
	<body>
	本当にこの書き込みでよろしいですか？<br />
	トピック：<?php echo($_POST['topic_title']); ?><br />
	名前：<?php echo(($_POST['name'] == NULL )? "なまえなしこさん" : $_POST['name'] ); ?><br />
	メール：<?php echo($_POST['mail']); ?><br />
	内容：<?php echo(nl2br($_POST['comment'])); ?><br />
	<form method="post" action="write_result.php">
	   <input name="topic_id" type="hidden" value="<?php echo($_POST['topic_id']); ?>">
      <input name="topic_title" type="hidden" value="<?php echo($_POST['topic_title']); ?>">
		<input type="hidden" name="name" value="<?php echo(($_POST['name'] == NULL )? "なまえなしこさん" : $_POST['name'] ); ?>">
		<input type="hidden" name="mail" value="<?php echo($_POST['mail']); ?>">
		<input type="hidden" name="comment" value="<?php echo($_POST['comment']); ?>">
		<input type="submit" value="書き込む">
		<input type="button" value="戻る" onClick="location.href='index.php'">
	</form>
	</body>
</html>
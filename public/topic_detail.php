<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>bbs</title>
    <script src="../webroot/js/formcheck.js"></script>
  </head>
  <body alink="#FF9900" bgcolor="#F8CFCF" link="#29338D" text="#1A1A1A">
    <a name="top"></a>
<! topic_list >
<?php
	require_once("../config/config.php");
	require_once(PROGRAM_PATH."connectDB.php");

	$sqlTopic = "
					SELECT id,title,name,comment,mail,created
					FROM bbs_topics
					WHERE delete_flag=0 
					AND id=". $_GET['topic_id'];

	$query1 = mysql_query($sqlTopic,$link) or die(mysql_error());
	$row_topic = mysql_fetch_array($query1);
?>
    <table align="center" bgcolor="#efefef" border="1" cellpadding="2" cellspacing="11" width="99%">
      <tr>
        <td height="0">
          ■
          <a name="1"></a>
          <b>
            <font color="red" size="+1"><?php echo($row_topic['title']); ?></font>
          </b>
          <br>
          <dl>
            <dt>
              1：
              <font color="forestgreen">
                <b><?php echo($row_topic['name']); ?>&nbsp;&nbsp;</b>
              </font> 
              <?php echo( $row_topic['created']); ?>
              <tt>
                <font color="#eebbee">ID:ib4SINoPzkL4</font>
              </tt>
            </dt>
            <dd>
              <?php echo($row_topic['comment']); ?>
              <br>　
            </dd>
<! comment >            
<?php
		$sqlComment = "
						SELECT @i:=@i+1 AS rownum ,name,created,comment,mail 
						FROM (
							SELECT @i:=1
						) AS dummy,(
							SELECT * 
							FROM bbs_comments 
							WHERE topic_id=". $_GET['topic_id']." 
							ORDER BY created
						) mt";

		$query3 = mysql_query($sqlComment,$link) or die(mysql_error());
		while ($row_comm = mysql_fetch_array($query3)){
?>
               <dt>
              <?php echo($row_comm['rownum']); ?>：
					<font color="forestgreen">
                <b>
                  <font color="#335544"><?php echo($row_comm['name']); ?></font>
                </b>
              </font>　
              <?php echo($row_comm['created']); ?>　
              <tt>
                <font color="#eebbee">ID:8wRsMb17Wp8W</font>
              </tt>
            </dt>
            <dd>
              <tt>
                <?php echo($row_comm['comment']); ?>
              </tt>
              <br>
              <br>
              <br>
            </dd>
<?php
	}
?>
          </dl>
          <br>
<! write_form >
          <dl>
            <dt>
            <dd>
              <form name="makeComment" action="write_confirm.php" method="post"　onsubmit="return chkHissu(this)">
                名前:
                <input name="name" size="20" type="text" value="">
                メール:
                <input name="mail" size="20" type="text" value="">　
                <input name="submit" type="submit" value="書き込む">
                <br>
                <textarea cols="80" name="comment" rows="5" wrap="soft"></textarea>
                <input name="topic_id" type="hidden" value="<?php echo($row_topic['id']); ?>">
                <input name="topic_title" type="hidden" value="<?php echo($row_topic['title']); ?>">
              </form>
              <br>
<! topic_footer >
              <a href="/cgi/15bbs/economy/1590/">レスを全部見る</a>
              　
              <a href="topic_detail.php?topic_id=<?php echo($_GET['topic_id']); ?>" target="_self">リロード</a>
              　
              <a href="#top" target="_self">トピックトップに戻る</a>
              　
              <a href="index.php">トピック一覧に戻る</a>
            </dd>
          </dl>
        </td>
      </tr>
    </table>
    <br>
	</bode>
</html>

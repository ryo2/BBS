<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>bbs</title>
    <script src="../webroot/js/formcheck.js"></script>
  </head>
  <body alink="#FF9900" bgcolor="#F8CFCF" link="#29338D" text="#1A1A1A">
    <a name="top"></a>
    <table align="center" bgcolor="#dfffe8" border="1" cellpadding="2" cellspacing="11" width="99%">
      <tbody>
        <tr>
          <td>
            <table border="0" cellpadding="1" width="100%">
              <tr>
                <td valign="top">
                  <strong>RM掲示板</strong>
                  <br>
                  <br>
                  <dl>
                    <dd>
                      <font size="2">
                        ******************************
                        <br>
                        ・
                        <b>
                          スレを立てる前に類似スレが無いか<font color="#ff0000">確認</font>してください．
                        </b>
                        <br>
                        ・<b>
                          単発の質問スレ立ては<font color="#ff0000">禁止</font>です．
                        </b>各種質問スレを利用してください．
                        <br>
                        ・
                        <strong>荒らし煽りは徹底無視！放置できないあなたも厨房です．</strong>
                        <br>
                        以上の趣旨に明らかに反する書き込みに対してはこまめに削除依頼を行いましょう．
                        <br>
                      </font>
                    </dd>
                  </dl>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <p>
    </p>
<! topic_list >
	<! mysql connect>
<?php
	require_once("../config/config.php");
	require_once(PROGRAM_PATH."connectDB.php");

	$sqlTopic = "
				SELECT @i:=@i+1 AS rownum,id,title,name,comment,mail,created,num 
				FROM (
					SELECT @i:=0
				) AS dummy,(
					SELECT id,title,name,comment,mail,created,num 
					FROM bbs_topics t LEFT JOIN (
						SELECT topic_id,COUNT(*)+1 num 
						FROM bbs_comments 
						GROUP BY topic_id
					) c ON t.id=c.topic_id 
					WHERE delete_flag=0 
					ORDER BY updated DESC 
					LIMIT 30
				) mt";

	$query1 = mysql_query($sqlTopic,$link) or die(mysql_error());
?>
    <table align="center" bgcolor="#dfffe8" border="1" cellpadding="2" cellspacing="11" width="99%">
      <tbody>
        <tr>
          <td>
            <font color="#666666" size="-1">
              <font size="2">
                <font size="3">
<?php
	while ($row_topic = mysql_fetch_array($query1)){
?>
                  <a href="topic_detail.php"><b>
                  <?php echo($row_topic['rownum']); ?></b>:
                  </a>
                  <a href="#1" target="_self"><?php echo($row_topic['title']); ?></a>(<?php echo(($row_topic['num'] == NULL) ? "1" : $row_topic['num'] ); ?>)　

<?php
}
?>
                </font>
              </font>
              <br>
              <br>
              <a href="topic_list.php" target="_self">
                <b>スレッド一覧</b>
              </a>　
              <a href="./index.php" target="_self">
                <b>リロード</b>
              </a>
            </font>
            <p></p>
          </td>
        </tr>
      </tbody>
    </table>
    <p>
<! topic_detail  >
    </p>
    <p></p>
<?php
	$query2 = mysql_query($sqlTopic,$link) or die(mysql_error());
	while ($row_topic = mysql_fetch_array($query2)){
		if( $row_topic['rownum'] > "10" ){
		break;
		}
?>
    <table align="center" bgcolor="#efefef" border="1" cellpadding="2" cellspacing="11" width="99%">
      <tr>
        <td height="0">
          ■
          <a name="1"></a>
          <b>
            <?php echo($row_topic['rownum']); ?>
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
					SELECT * FROM (
						SELECT @i:=@i+1 AS rownum ,name,created,comment,mail 
						FROM (
							SELECT @i:=1
						) AS dummy,(
							SELECT * 
							FROM bbs_comments 
							WHERE topic_id=".$row_topic['id']." 
							ORDER BY created
						) mt 
						ORDER BY rownum DESC 
						LIMIT 10
					)  mt2 
					ORDER BY rownum";

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
              <a href="topic_detail.php?topic_id=<?php echo($row_topic['id']); ?>">レスを全部見る</a>
              　
              <a href="index.php" target="_self">リロード</a>
              　
              <a href="#top" target="_self">トップに戻る</a>
            </dd>
          </dl>
        </td>
      </tr>
    </table>
    <br>
<?php

}
?>
    <br>
<! make_new_topic >
    <table align="center" bgcolor="#dfffe8" border="1" cellpadding="2" cellspacing="11"  width="99%">
    <tbody>
      <tr>
        <td>
          <table border="0" cellpadding="0" cellspacing="0">
				<tbody>
				<b>RM掲示板</b>の新しいスレッドを作成<br>　
          <form action="topic_confirm.php" method="post" onsubmit="return chkHissu(this)">
        </td>
      </tr>
      <tr>
        <td nowrap="">　題名:</td>
        <td>
          <input class="jp" name="title" size="50" type="text" value="">
        </td>
      </tr>
      <tr>
        <td nowrap="">　名前:</td>
        <td><input name="name" size="20" type="text" value="">
        メール:<input name="mail" size="20" type="text" value="">　
        <input name="submit" type="submit" value="スレッドを作成">
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <textarea class="jp" cols="70" name="comment" rows="7" wrap="soft"></textarea>
         </form>
        </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </body>
</html>
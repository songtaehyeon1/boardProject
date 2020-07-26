<?php
include "connect.php";
$query = "select * from z201707057 where uid = $number";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

$my_name = $row[name];
$my_subject = $row[subject];
$my_comment = $row[comment];
$my_uid = $row[uid];
$my_real_fname=$row[fname];
?>
<html>
<body>
	<form method = "post" action = "change.php?page=<? echo("$page")?>&subject=<? echo("$my_subject")?>&comment=<? echo("$my_comment")?>&uid=<? echo("$my_uid")?>" enctype=multipart/form-data>
		이름 : <? echo ("$my_name") ?><br>
		제목 : <input type = "text" name = "subject" value = '<? echo ("$my_subject") ?>'><br>
		<textarea name = "comment" cols = "60" rows = "10">
			<? echo ("$my_comment") ?>
		</textarea><p>
		업로드할 파일 : (최대크기 2M)<br>
		<input type="file" name="userfile" size="20"><br>
		<input type = "submit" value = "변경하기">
		<input type = "reset" value = "취소">
	</form>
</body>
</html>
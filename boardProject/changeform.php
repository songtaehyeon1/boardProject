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
		�̸� : <? echo ("$my_name") ?><br>
		���� : <input type = "text" name = "subject" value = '<? echo ("$my_subject") ?>'><br>
		<textarea name = "comment" cols = "60" rows = "10">
			<? echo ("$my_comment") ?>
		</textarea><p>
		���ε��� ���� : (�ִ�ũ�� 2M)<br>
		<input type="file" name="userfile" size="20"><br>
		<input type = "submit" value = "�����ϱ�">
		<input type = "reset" value = "���">
	</form>
</body>
</html>
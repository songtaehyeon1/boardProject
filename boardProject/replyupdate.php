<?php
include "connect.php";

$query = "select * from z201707057a where replyuid = $replyuid";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

$getPassword = $row[password];

	if($getPassword == $updatepw)
	{
		$query = "update z201707057a set comment='$comment' where replyuid=$replyuid";
		$result = mysql_query($query);
		echo("����� �����Ǿ����ϴ�.");
		echo("<meta http-equiv='Refresh' content='1;URL=view.php?number=$number&password=$password'>");
	}
	else
	{	
		echo("��й�ȣ�� Ʋ�Ƚ��ϴ�.");
		echo("<meta http-equiv='Refresh' content='1;URL=replyupdateform.php?number=$number&replyuid=$replyuid&password=$password'>");
	}
?>

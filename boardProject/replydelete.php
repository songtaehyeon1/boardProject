<?php
include "connect.php";

$query = "select * from z201707057a where replyuid = $replyuid";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$getpw = $row[password];

	if($getpw == $password)
	{
		$query = "delete from z201707057a where replyuid = $replyuid";
		$result = mysql_query($query);
		if(! $result)
		{
			echo mysql_errno().": ".mysql_error();
			exit;
		}
		$result2=mysql_query("select * from z201707057 where uid = $row[postuid]");
		$row2=mysql_fetch_array($result2);
		if($row2[pwd]!=""){//글이 비번글이라면
			echo("<meta http-equiv='Refresh' content='0;URL=checkPwd.php?number=$number'>");
		}else{//글이 일반글이라면
			echo("<meta http-equiv='Refresh' content='0;URL=view.php?number=$number'>");
		}
	}
	else
	{
		echo("비밀번호가 틀렸습니다.");
		echo("<meta http-equiv='Refresh' content='1;URL=replydeleteform.php?number=$number&replyuid=$replyuid'>");
	}
?>
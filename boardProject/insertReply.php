<?php

include "connect.php";
$signdate=time();
$query = "insert into z201707057a(postuid, name, comment, signdate, password) values($number, '$name', '$comment', $signdate, '$pw')";
$result=mysql_query($query);

if(! $result)
{
	echo("$number<br>");
	echo("$name<br>");
	echo("$comment<br>");
	echo("$signdate<br>");
	echo("댓글 등록에 실패하였습니다.");
}else{
	echo("댓글이 정상적으로 등록되었습니다.");
}
$query = "select * from z201707057 where uid=$number";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if($row[pwd]==""){ //비번글이 아니라면
	echo("<meta http-equiv='Refresh' content='1;URL=view.php?number=$number'>"); 
}else{ //비번글이라면
	echo("<meta http-equiv='Refresh' content='1;URL=checkPwd.php?page=$page&number=$number'>");
}
?>
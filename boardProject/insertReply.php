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
	echo("��� ��Ͽ� �����Ͽ����ϴ�.");
}else{
	echo("����� ���������� ��ϵǾ����ϴ�.");
}
$query = "select * from z201707057 where uid=$number";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if($row[pwd]==""){ //������� �ƴ϶��
	echo("<meta http-equiv='Refresh' content='1;URL=view.php?number=$number'>"); 
}else{ //������̶��
	echo("<meta http-equiv='Refresh' content='1;URL=checkPwd.php?page=$page&number=$number'>");
}
?>
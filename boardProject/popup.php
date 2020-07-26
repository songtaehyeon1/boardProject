<?php
 include "connect.php";
 $query="select * from z201707057 where name='$writer'";
 $result=mysql_query($query);

echo("
<table border=1>
	<tr>
		<td>작성자</td><td>제목</td><td>작성날짜</td>
	</tr>
");

 while($row=mysql_fetch_array($result)){
 $my_name=$row[name];
 $my_subject=$row[subject];
 $my_date=date("Y년 m월 d일", $row[signdate]);
 $my_ref=$row[ref]; 
 $my_uid=$row[uid];
 $my_secret=$row[secret];
	echo("<tr>");
		echo("<td>$my_name</td>");
		if($my_secret != "x"){
			echo("<td><a href=\"checkPwd.php?page=$page&number=$my_uid\">비밀글입니다.</a></td>");
		}else{
			echo("<td><a href=\"view.php?page=$page&number=$my_uid\">$my_subject</a></td>");
		}
		echo("<td>$my_date</td>");
	echo("</tr>");
 }
 echo("</table>");
?>
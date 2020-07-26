<?php
include "connect.php";

$query="select * from z201707057 where uid=$number";

$result=mysql_query($query);
if(! $result){
	echo mysql_errno().": ".mysql_error();
	exit;
}
$row=mysql_fetch_array($result);
	$my_ref=$row[ref];
	$my_name=$row[name];
	$my_pwd=$row[pwd];
	$my_subject=$row[subject];
	$my_signdate = date("Y년 m월 d일 H시 i분", $row[signdate]);
	$my_comment=$row[comment];
	$fid=$row[fid];
	$thread=$row[thread];
	$my_real_fname=$row[fname];
	$my_secret = $row[secret];	

if($my_pwd==$password){
	$result=mysql_query("update z201707057 set ref=$my_ref + 1 where uid = $number");
?>
	<table border=1 width=600>
		<tr><td align=center><? echo("$my_subject")?></td></tr>
		<tr><td>글쓴이: <? echo("$my_name")?></td></tr>
		<tr><td>올린 시간: <? echo("$my_signdate")?></td></tr>
		<tr><td><? echo("$my_comment")?></td></tr>
<?php
		if($my_real_fname!=""){
			$dirhandle=opendir("./data");
			while($filename=readdir($dirhandle)){
				if(!is_dir($filename)){
					if($filename==$my_real_fname){
						$a="./data/".$filename;
						echo("<tr><td>파일명: <a href=\"$a\">$my_real_fname</a></td></tr>");
						echo("<tr><td><img src='$a'/></td></tr>");
					}
				}
			}
			closedir($dirhandle);
		}
?>
		<tr><td align=right>
<?php
		echo("
			<a href=\"replyform.php?page=$page&number=$number\">답글</a>&nbsp;&nbsp;
			<a href=\"changeform.php?page=$page&number=$number\">변경</a>&nbsp;&nbsp;
			<a href=\"deleteform.php?page=$page&number=$number&fid=$fid&thread=$thread&secret=$my_secret\">삭제</a>&nbsp;&nbsp;
		");
	
?>
	
	</td></tr>
	</table>
	
	<p>
	<br>
	
<?php
	
	$result = mysql_query("select count(*) from z201707057a where postuid = $number");
	$total_comment = mysql_result($result,0,0);
	
	echo("댓글 : $total_comment 개<p>");
?>
	
	<form method="post" action="insertReply.php?page=<?php echo $page ; ?>&number=<?php echo $number ; ?>">
	<table board = 300> 
		<tr>
			<td width = 80>이름 
			</td>
			<td><input type = text name = name size = 19>
			</td>
		</tr>
		<tr>
			<td>비밀번호 
			</td>
			<td><input type = "password" name = "pw" size = 20 maxlength = 16 required>
			</td>
		</tr>
	
	</table>
		<textarea name ="comment" cols = 80 rows = 4></textarea>
		<input type = "submit" value = "작성"><br>
	</form>
<?php
	if($total_comment == 0)
	{
		echo("댓글이 없습니다.");
	}else{
		$query = "select * from z201707057a where postuid=$number order by replyuid desc";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result))
		{
			$name = $row[name];
			$comment = $row[comment];
			$signdate = date("Y년 m월 d일 H시 i분", $row[signdate]);
			$replyuid = $row[replyuid];
			
			echo("<table width = 650>
				<tr>
					<td align = right>
						올린시간 : $signdate
					</td>
				<tr>
			</table>
			");
	
			echo("<table border=1 width=650>
				<tr height = 50>
					<td width = 500>
						$comment
					</td>
					<td align = center>
					      작성자 : $name<br>
					     <a href=\"replyupdateform.php?replyuid=$replyuid&number=$number&password=$password\">수정</a>
					     &nbsp; &nbsp
					     <a href=\"replydeleteform.php?replyuid=$replyuid&number=$number\">삭제</a>
					</td>
				</tr>
		     	   </table>
			");
		}
	}
}else{
	echo("<script>alert('비밀번호가 틀렸습니다.'); </script>"); 
}
?>
	
	</body>
	</html>
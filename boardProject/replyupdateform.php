<?php
include "connect.php";

$query = "select * from z201707057a where replyuid = $replyuid";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

$getName = $row[name];
$getComment = $row[comment];
?>
<html>
<p>
<h2>댓글 수정</h2>
<p>

<form method = post action = "replyupdate.php?replyuid=<?php echo $replyuid; ?>&number=<?php echo $number; ?>&password=<?php echo $password; ?>">
<table>
	<tr>
		<td>작성자 : 
		</td>
		<td><input type = text name = name value = <?php echo $getName; ?> size = 19 disabled = false>
		</td>
	</tr>
	<tr>
		<td>내용 :
		</td>
		<td><textarea name = comment cols = 50 rows = 4><?php echo $getComment; ?></textarea>
		</td>
	</tr>
	<tr>
		<td>비밀번호 : 
		</td>
		<td><input type = password name = updatepw size = 20 maxlength = 16>
		</td>
	</tr>
	<tr>
		<td colspan = 2>
		<input type = submit value = "댓글 수정">
		<input type = button value = "취소" onclick = "hitory.back();">
		</td>
	</tr>
</table>
</form>

</html>

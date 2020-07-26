<?php
	//비번 설정 안되어있으면 바로 삭제되게설정
	if($secret == "x")
	{
		echo("<meta http-equiv='Refresh' content='0;URL=delete.php?number=$number&fid=$fid&thread=$thread'>");
	}
	else
	{
?>
<html>
<script type="text/javascript">
	function button_event(){
		if (confirm("정말 삭제하시겠습니까??") == true)
		{
 			document.form.submit();
		}
		else
		{  
   			return;
		}
	}
</script>
<body>
<h1>게시글 삭제</h1>
<form name="form" method="post" action = "delete.php">

	비밀번호 확인 : <input type = password name="password">
	<input type=hidden name="number" value=<?php echo $number ?>>
	<input type=hidden name="fid" value=<?php echo $fid ?>>
	<input type=hidden name="thread" value=<?php echo $thread ?>>
	<br>
	
	<input type="button" value="글 삭제" onclick="button_event();">

</form>
</body>
</html>
<?php
	}
?>

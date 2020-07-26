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
<form name = "form" method = "post" action = "replydelete.php?number=<?php echo $number; ?>&password=<?php echo $password; ?>&replyuid=<?php echo $replyuid; ?>">

비밀번호 확인 : <input type = password name = password>
<br>

<input type="button" value="글 삭제" onclick="button_event();">

</form>
</body>
</html>

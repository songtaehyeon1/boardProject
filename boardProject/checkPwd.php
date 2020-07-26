<html>
<script type="text/javascript">
	function button_event(){
		if (confirm("비밀글 보기") == true)
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
<h1>비밀번호 확인</h1>

<form name = "form" method ="post" action ="view.php">
비밀번호 확인 : <input type = password name ="password">
<input type = hidden name = "number" value = <?php echo "$number" ?>>
<input type = hidden name = "page" value = <?php echo "$page" ?>>
<br>
<input type="button" value="확인" onclick="button_event();">
</form>

</body>
</html>

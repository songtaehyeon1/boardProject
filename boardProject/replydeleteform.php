<html>
<script type="text/javascript">
	function button_event(){
		if (confirm("���� �����Ͻðڽ��ϱ�??") == true)
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
<h1>�Խñ� ����</h1>
<form name = "form" method = "post" action = "replydelete.php?number=<?php echo $number; ?>&password=<?php echo $password; ?>&replyuid=<?php echo $replyuid; ?>">

��й�ȣ Ȯ�� : <input type = password name = password>
<br>

<input type="button" value="�� ����" onclick="button_event();">

</form>
</body>
</html>

<?php
	//��� ���� �ȵǾ������� �ٷ� �����ǰԼ���
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
<form name="form" method="post" action = "delete.php">

	��й�ȣ Ȯ�� : <input type = password name="password">
	<input type=hidden name="number" value=<?php echo $number ?>>
	<input type=hidden name="fid" value=<?php echo $fid ?>>
	<input type=hidden name="thread" value=<?php echo $thread ?>>
	<br>
	
	<input type="button" value="�� ����" onclick="button_event();">

</form>
</body>
</html>
<?php
	}
?>

<html>
<script type="text/javascript">
	function button_event(){
		if (confirm("��б� ����") == true)
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
<h1>��й�ȣ Ȯ��</h1>

<form name = "form" method ="post" action ="view.php">
��й�ȣ Ȯ�� : <input type = password name ="password">
<input type = hidden name = "number" value = <?php echo "$number" ?>>
<input type = hidden name = "page" value = <?php echo "$page" ?>>
<br>
<input type="button" value="Ȯ��" onclick="button_event();">
</form>

</body>
</html>

<html>
	<body>
		<form name="signform" method="post" action="post.php" enctype=multipart/form-data>
                       
			�̸�:<input type="text" name="name" size="20" maxlength="12"><br>
			����:<input type="text" name="subject" size="50" maxlength="60"><br>
                                    <textarea name="comment" cols="60" rows="10"></textarea><p>
			 ���ε��� ���� : (�ִ�ũ�� 2M)<br>
                        	<input type="file" name="userfile" size="20"><br>
                                                                
			��й�ȣ:<input type="password" name="pwd" size="30" maxlength="30">
			��б��ۼ�:<input type="checkbox" name="secret" value="secret"><br>
			<input type="submit" value="�ۼ�">
			<input type="reset" value="�� ��">
		</form>
	</body>
</html>
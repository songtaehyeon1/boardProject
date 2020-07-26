<html>
	<body>
		<form name="signform" method="post" action="post.php" enctype=multipart/form-data>
                       
			이름:<input type="text" name="name" size="20" maxlength="12"><br>
			제목:<input type="text" name="subject" size="50" maxlength="60"><br>
                                    <textarea name="comment" cols="60" rows="10"></textarea><p>
			 업로드할 파일 : (최대크기 2M)<br>
                        	<input type="file" name="userfile" size="20"><br>
                                                                
			비밀번호:<input type="password" name="pwd" size="30" maxlength="30">
			비밀글작성:<input type="checkbox" name="secret" value="secret"><br>
			<input type="submit" value="작성">
			<input type="reset" value="취 소">
		</form>
	</body>
</html>
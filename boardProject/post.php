<?php
include "connect.php";
$signdate=time();
$my_userFileName="";
if($userfile!=""){ //이미지 업로드 시킨다면
	if($userfile=="none"){
		echo("시스템 이상으로 업로드에 실패하였습니다.");
		exit;
	}
	$save_dir="./data";
	$dest=$save_dir."/".$userfile_name;
	$fileExt="";
	$fileName="";
	$my_userFileName=$userfile_name;
	if(file_exists($dest)){		
		$fileExt = substr(strrchr($userfile_name, "."), 1); //확장자 분리
  		$fileName = substr($userfile_name, 0, strlen($userfile_name)-strlen($fileExt)-1); //파일명만 분리
		//이미지만 업로드 시키게 함
		if(!($fileExt =="jpg" || $fileExt =="png" || $fileExt =="gif" || $fileExt=="jpeg" || $fileExt=="bmp")){
			echo("이미지만 업로드 가능합니다.");
			exit;
		}
		$num=0;
		while(file_exists($dest)){
			$dest=$save_dir."/".$fileName."_".$num.".".$fileExt;
			$my_userFileName=$fileName."_".$num.".".$fileExt;
			$num++;
		}
	}
	if(!copy($userfile,$dest)){
		echo("파일을 지정한 디렉토리에 복사하는데 실패하였습니다");
		exit;
	}
}
	$query="select max(fid) from z201707057";	
	$result=mysql_query($query);
	$row=mysql_fetch_row($result);
	if($row[0]) 
		$new_fid=$row[0]+1;
	else
		$new_fid=1;

	if($secret != null && $pwd == null)
	{
		echo("<script>alert('비밀번호가 입력되지않았습니다..');
		 history.back();
		</script>");
	}
	else if($secret == null && $pwd != null)
	{
		echo("<script>alert('비밀번호는 비밀글에만 사용됩니다.');
		 history.back();
		</script>");	
	}
	else if($secret !=null)
	{
		$query="insert into z201707057(fid,name,subject,comment,pwd,signdate,ref,thread,secret,fname) values							($new_fid,'$name','$subject','$comment','$pwd',$signdate,0,'A','o','$my_userFileName')";
	}
	else
	{
		$query="insert into z201707057(fid,name,subject,comment,pwd,signdate,ref,thread,secret,fname) values							($new_fid,'$name','$subject','$comment','$pwd',$signdate,0,'A','x','$my_userFileName')"; 
	}


	$result=mysql_query($query);
	if(!$result){
		echo mysql_error();
		exit;
	}
	echo("<meta http-equiv='Refresh' content='0; URL=rboard.php'>");
	
?>
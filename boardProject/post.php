<?php
include "connect.php";
$signdate=time();
$my_userFileName="";
if($userfile!=""){ //�̹��� ���ε� ��Ų�ٸ�
	if($userfile=="none"){
		echo("�ý��� �̻����� ���ε忡 �����Ͽ����ϴ�.");
		exit;
	}
	$save_dir="./data";
	$dest=$save_dir."/".$userfile_name;
	$fileExt="";
	$fileName="";
	$my_userFileName=$userfile_name;
	if(file_exists($dest)){		
		$fileExt = substr(strrchr($userfile_name, "."), 1); //Ȯ���� �и�
  		$fileName = substr($userfile_name, 0, strlen($userfile_name)-strlen($fileExt)-1); //���ϸ� �и�
		//�̹����� ���ε� ��Ű�� ��
		if(!($fileExt =="jpg" || $fileExt =="png" || $fileExt =="gif" || $fileExt=="jpeg" || $fileExt=="bmp")){
			echo("�̹����� ���ε� �����մϴ�.");
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
		echo("������ ������ ���丮�� �����ϴµ� �����Ͽ����ϴ�");
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
		echo("<script>alert('��й�ȣ�� �Էµ����ʾҽ��ϴ�..');
		 history.back();
		</script>");
	}
	else if($secret == null && $pwd != null)
	{
		echo("<script>alert('��й�ȣ�� ��бۿ��� ���˴ϴ�.');
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
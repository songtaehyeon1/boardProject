<?php
include "connect.php";

$signdate=time();
//���� �̹����� ���ε� �Ǿ��־��ٸ� ���� �־��� ������ ����Ǿ��ִ� �̹��� ����
$temp=mysql_query("select * from z201707057 where uid=$uid");
if(!$temp){
	echo mysql_errno().": ".mysql_error();
	exit;
}
$temp2=mysql_fetch_array($temp);
if($temp2[fname]!=""){
	$my_userFileName2=$temp2[fname]; //������ ���ε�Ǿ��ִ� ���� ���ϸ�(Ȯ���� ����)
	$save_dir2="./data";
	$dest2=$save_dir2."/".$my_userFileName2;
	if(file_exists($dest2)){ //���� ������ �����Ѵٸ�
		unlink($dest2);
		mysql_query( "UPDATE z201707057 SET fname='' WHERE uid='$uid'");
	}
}

if($userfile!=""){ //�̹��� ���ε��Ѵٸ�
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
		$fileExt = substr(strrchr($userfile_name, "."), 1); 
  		$fileName = substr($userfile_name, 0, strlen($userfile_name)-strlen($fileExt)-1);	
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
	$query = "UPDATE z201707057 SET subject = '$subject', comment = '$comment', signdate=$signdate,  fname='$my_userFileName' WHERE uid='$uid'";
	$result=mysql_query($query);
}else{ //�̹��� ���ε� ���Ѵٸ�
	$query = "UPDATE z201707057 SET subject = '$subject', comment = '$comment', signdate=$signdate WHERE uid = '$uid'";
	$result = mysql_query($query);	
}
if(!$result){
	echo mysql_error();
	exit;
}
echo("<meta http-equiv='Refresh' content='0; URL=rboard.php?page=$page'>");
?>
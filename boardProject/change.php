<?php
include "connect.php";

$signdate=time();
//전에 이미지가 업로드 되어있었다면 전에 있었던 서버에 저장되어있던 이미지 삭제
$temp=mysql_query("select * from z201707057 where uid=$uid");
if(!$temp){
	echo mysql_errno().": ".mysql_error();
	exit;
}
$temp2=mysql_fetch_array($temp);
if($temp2[fname]!=""){
	$my_userFileName2=$temp2[fname]; //서버에 업로드되어있는 실제 파일명(확장자 포함)
	$save_dir2="./data";
	$dest2=$save_dir2."/".$my_userFileName2;
	if(file_exists($dest2)){ //동일 파일이 존재한다면
		unlink($dest2);
		mysql_query( "UPDATE z201707057 SET fname='' WHERE uid='$uid'");
	}
}

if($userfile!=""){ //이미지 업로드한다면
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
		echo("파일을 지정한 디렉토리에 복사하는데 실패하였습니다");
		exit;
	}
	$query = "UPDATE z201707057 SET subject = '$subject', comment = '$comment', signdate=$signdate,  fname='$my_userFileName' WHERE uid='$uid'";
	$result=mysql_query($query);
}else{ //이미지 업로드 안한다면
	$query = "UPDATE z201707057 SET subject = '$subject', comment = '$comment', signdate=$signdate WHERE uid = '$uid'";
	$result = mysql_query($query);	
}
if(!$result){
	echo mysql_error();
	exit;
}
echo("<meta http-equiv='Refresh' content='0; URL=rboard.php?page=$page'>");
?>
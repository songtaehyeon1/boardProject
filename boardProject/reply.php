<?
include "connect.php";
$query = " select  thread,  right(thread,1)  from  z201707057
		where 	fid = $fid  AND
				length(thread) = length('$thread') + 1  AND
				locate('$thread', thread) = 1
		order by  thread  DESC   LIMIT 1";

$result = mysql_query($query);		
$rows = mysql_num_rows($result);
if($rows) {
	$row = mysql_fetch_row($result);
	$t_head = substr($row[0], 0, -1); 	$t_foot = ++$row[1];
	$new_thread = $t_head . $t_foot;
} else {	$new_thread = $thread . "A";
}

$signdate = time();
$my_userFileName="";
if($userfile!=""){
	if($userfile=="none"){
		echo("�ý��� �̻����� ���ε忡 �����Ͽ����ϴ�.");
		exit;
	}
	$save_dir="./data";
	
	echo("$save_dir<br>");	

	$dest=$save_dir."/".$userfile_name;

	echo("$dest");

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
}
if($secret != null){ 
	$query =  "INSERT INTO  z201707057 (fid, name, subject, comment, pwd, signdate, ref, thread,secret,fname) 
		VALUES ($fid, '$name', '$subject', '$comment', '$pwd', $signdate, 0, '$new_thread','o','$my_userFileName')";
}else {
	$query =  "INSERT INTO  z201707057 (fid, name, subject, comment, pwd, signdate, ref, thread,secret,fname) 
		VALUES ($fid, '$name', '$subject', '$comment', '$pwd', $signdate, 0, '$new_thread','x','$my_userFileName')";
}
$result = mysql_query($query);
if ( ! $result ) { 
	echo("query error");   
	exit;   
}
echo("<meta http-equiv='Refresh' content='0; URL=rboard.php?page=$page'>");
?>















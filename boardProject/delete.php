<?php
include "connect.php";
$query = "select * from z201707057 where uid='$number'";
$result = mysql_query( $query );
if(! $result){
	echo mysql_errno().": ".mysql_error();
	exit;
}
$row = mysql_fetch_array( $result );
if(!$row){
	echo $row;
	exit;
}
$getpassword = $row[pwd];

if( $getpassword==$password )
{  
	//���� �̹������ִ��� ������ �Ǻ��ϰ� ������ ����� ������ �н�
	$result2=mysql_query("select * from z201707057 where fid='$fid' AND length(thread)>=length('$thread')"); //���۰� ������ ��۰Խñ۱��� ������
	if(! $result2){
		echo mysql_errno().": ".mysql_error();
		exit;
	}
	
	while($row=mysql_fetch_array($result2)){
		if($row[fname]==""){ //�̹��� ���ε� ���ߴٸ�
			$result=mysql_query("delete from z201707057 where uid=$row[uid]");
			if(!$result){
				echo mysql_errno().": ".mysql_error();
				exit;
			}
			echo("$row[subject]�Խñ��� �����Ǿ����ϴ�.");
		}else{ //�̹��� ���ε� �ߴٸ�
			$my_userFileName=$row[fname]; //������ ���ε�Ǿ��ִ� ���� ���ϸ�(Ȯ���� ����)
			$save_dir="./data";
			$dest=$save_dir."/".$my_userFileName;
			if(file_exists($dest)){ //���� ������ �����Ѵٸ�
				if(!unlink($dest)){ 
					echo("�������ϸ��� �̿��� ������ �ϴµ� �����Ͽ����ϴ�.");
					exit;
				}
				$result=mysql_query("delete from z201707057 where uid=$row[uid]");
				echo("$row[subject]�Խñ��� �����Ǿ����ϴ�<br>");
			}else{ //���������� �������� �ʴ´ٸ�
				echo("���� ������ �������� �ʽ��ϴ�.");
				exit;
			}
		}
		//�ش�Խñ��� ��۱��� ������ƾ
		$result3=mysql_query("select * from z201707057a where postuid=$row[uid]"); //postuid=�Խñ�, replyuid=��� ����������ȣ
		while($replyrow=mysql_fetch_array($result3)){
			$temp=mysql_query("delete from z201707057a where postuid=$replyrow[replyuid]");
			if(!$temp){
				echo("�� �Խñ��� ��۵� ����µ� ����  ");
				echo mysql_errno().": ".mysql_error();
				exit;
			}
		}
	}
	echo("3�ʵ� ���ư��ϴ�.");
	echo("<meta http-equiv='Refresh' content='3; URL=rboard.php'>");
}
else
{
	echo("<script>alert('��й�ȣ�� Ʋ�Ƚ��ϴ�.');
		 history.back();
		</script>");

}

?>
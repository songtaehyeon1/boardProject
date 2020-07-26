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
	//먼저 이미지가있는지 없는지 판별하고 있으면 지우고 없으면 패스
	$result2=mysql_query("select * from z201707057 where fid='$fid' AND length(thread)>=length('$thread')"); //원글과 원글의 답글게시글까지 가져옴
	if(! $result2){
		echo mysql_errno().": ".mysql_error();
		exit;
	}
	
	while($row=mysql_fetch_array($result2)){
		if($row[fname]==""){ //이미지 업로드 안했다면
			$result=mysql_query("delete from z201707057 where uid=$row[uid]");
			if(!$result){
				echo mysql_errno().": ".mysql_error();
				exit;
			}
			echo("$row[subject]게시글이 삭제되었습니다.");
		}else{ //이미지 업로드 했다면
			$my_userFileName=$row[fname]; //서버에 업로드되어있는 실제 파일명(확장자 포함)
			$save_dir="./data";
			$dest=$save_dir."/".$my_userFileName;
			if(file_exists($dest)){ //동일 파일이 존재한다면
				if(!unlink($dest)){ 
					echo("동일파일명을 이용한 삭제를 하는데 실패하였습니다.");
					exit;
				}
				$result=mysql_query("delete from z201707057 where uid=$row[uid]");
				echo("$row[subject]게시글이 삭제되었습니다<br>");
			}else{ //동일파일이 존재하지 않는다면
				echo("동일 파일이 존재하지 않습니다.");
				exit;
			}
		}
		//해당게시글의 댓글까지 삭제루틴
		$result3=mysql_query("select * from z201707057a where postuid=$row[uid]"); //postuid=게시글, replyuid=댓글 각각고유번호
		while($replyrow=mysql_fetch_array($result3)){
			$temp=mysql_query("delete from z201707057a where postuid=$replyrow[replyuid]");
			if(!$temp){
				echo("각 게시글의 댓글들 지우는데 오류  ");
				echo mysql_errno().": ".mysql_error();
				exit;
			}
		}
	}
	echo("3초뒤 돌아갑니다.");
	echo("<meta http-equiv='Refresh' content='3; URL=rboard.php'>");
}
else
{
	echo("<script>alert('비밀번호가 틀렸습니다.');
		 history.back();
		</script>");

}

?>
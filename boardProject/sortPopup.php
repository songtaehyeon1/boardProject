<?php
	include "connect.php";

	$num_per_page=10;
	$page_per_block=3;

	if(!$page){
		$page=1;
	}

	$result_paging=mysql_query("select count(uid) from z201707057");
	$total_record=mysql_result($result_paging,0,0);

	if($total_record==0){
		echo("게시글이 없습니다.");
		exit;
	}

	$first=$num_per_page*($page-1);	

	$result=mysql_query("select * from z201707057 where length(thread)=1 order by ref desc"); //thread=1이기때문에 원글만 가져옴
	if ( ! $result ) { 
		echo("query error");   
		exit;   
	}

	$article_num=$total_record-$num_per_page*($page-1);


	echo("<table border=1>");
	echo("<tr><td>번호</td><td>제목</td><td>글쓴이</td><td>작성일</td><td>조회수</td></tr>");
	while($row = mysql_fetch_array($result)){
		$original_uid = $row[uid];
		$original_name =  $row[name];
		$original_subject = $row[subject];
		$original_signdate = date("Y년 m월 d일 H시 i분", $row[signdate]);
		$original_ref = $row[ref];
		$original_thread = $row[thread];
		$original_secret=$row[secret];
	
		echo(" <tr> ");
		echo("<td>$article_num</td>");
		if($original_secret != "x"){
			echo("<td><a href=\"checkPwd.php?page=$page&number=$original_uid\">비밀글입니다.</a></td>");
		}else{
			echo("<td><a href=\"view.php?page=$page&number=$original_uid\">$original_subject</a></td>");
		}
		echo("<td>$original_name</td>");
		echo("<td>$original_signdate</td>");
		echo("<td>$original_ref</td>");
    		echo(" </tr> ");

		$article_num--;

		$result2=mysql_query("select * from z201707057 where fid=$row[fid] and length(thread)>=2 order by fid desc, thread asc");
		while($row2 = mysql_fetch_array($result2)){
			$sub_uid = $row2[uid];
			$sub_name =  $row2[name];
			$sub_subject = $row2[subject];
			$sub_signdate = date("Y년 m월 d일 H시 i분", $row2[signdate]);
			$sub_ref = $row2[ref];
			$sub_thread = $row2[thread];
			$sub_secret=$row2[secret];

			echo(" <tr>");
			echo("<td>$article_num</td>");
			echo(" <td>");
			$sp = strlen($sub_thread) - 1;
			for($j = 0; $j <$sp; $j++)
			{
				echo("&nbsp&nbsp&nbsp");
			}
			if($sub_secret != "x"){
				echo("<a href=\"checkPwd.php?page=$page&number=$sub_uid\">비밀글입니다.</a></td>");
			}else{
				echo("<a href=\"view.php?page=$page&number=$sub_uid\">$sub_subject</a></td>");
			}
			echo("<td>$sub_name</td>");
			echo("<td>$sub_signdate</td>");
			echo("<td>$sub_ref</td>");
    			echo(" </tr> ");
			
			$article_num--;
		}
	}
	echo("</table><br><br>");

?>
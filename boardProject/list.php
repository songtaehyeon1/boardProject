<?php
include"connect.php";
$num_per_page = 10;
$page_per_block = 3;

echo(" <table border = 1>
	<tr>
		<td>번호</td><td>제목</td><td>글쓴이</td><td>작성일</td><td>조회수</td>
	</tr>
");

if(! $page)
{
	$page = 1;
}
$first=$num_per_page*($page-1);
$query1="select count(uid) from z201707057 where $select_name like '%$search%' Order by fid DESC, thread ASC LIMIT $first, $num_per_page";
$result1=mysql_query($query1);

$total_record = mysql_result($result1,0,0);
$total_page = ceil($total_record / $num_per_page);

if($total_record==0){
	echo("게시글이 없습니다.");
	exit;
}

$query = "select * from z201707057 where $select_name like '%$search%' Order by fid DESC, thread ASC LIMIT $first, $num_per_page";
$result = mysql_query($query);

$article_num = $total_record - $num_per_page * ( $page - 1 );


while($row = mysql_fetch_array($result))
{
$my_uid = $row[uid];
$my_name =  $row[name];
$my_subject = $row[subject];
$my_signdate = date("Y년 m월 d일 H시 i분", $row[signdate]);
$my_ref = $row[ref];
$my_thread = $row[thread];

	echo(" <tr> ");
	echo(" <td>$article_num</td> ");
	echo(" <td> ");

		$sp = strlen($my_thread) - 1;
		for($j = 0; $j < $sp; $j++)
		{
			echo("&nbsp;&nbsp;&nbsp;");
		}
	echo(" <a href=\"view.php?page=$page&number=$my_uid\">$my_subject</a></td>");
	echo("<td>$my_name</td>");
	echo("<td>$my_signdate</td>");
	echo("<td>$my_ref</td>");
    echo(" </tr> ");

$article_num--;
}

echo("</table><br>");

?>





































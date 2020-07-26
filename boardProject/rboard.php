<html>
 <head>
 <script language=javascript>
		function open_notice(ref){
			newwin=open(ref,"글 목록", "scrollbars=Yes, width=800, height=500");
		}
		function toCheckPassword(ref){
			newwin=open(ref,"비밀번호확인","scrollbars=Yes, width=300, height=300");
		}
 </script>
 </head>
 <body>
	<a href=postform.php>글쓰기</a>
<?php
include "connect.php";
$num_per_page=10;
$page_per_block=3;

if(!$page){
	$page=1;
}

$result=mysql_query("select count(uid) from z201707057");
$total_record=mysql_result($result,0,0);
$total_page=ceil($total_record/$num_per_page);

if($total_record==0){
	echo("게시글이 없습니다.");
	exit;
}

$first=$num_per_page*($page-1);

$result=mysql_query("select * from z201707057 order by fid desc, thread asc limit $first, $num_per_page");

$article_num=$total_record-$num_per_page*($page-1);

echo("<table border=1>
	<tr>
		<td>번호</td><td>제목</td><td>글쓴이</td><td>작성일</td><td><a href=\"JavaScript:open_notice('sortPopup.php?page=$page&number=$my_uid')\">조회수</a></td>
	</tr>
");
while($row=mysql_fetch_array($result)){
	$my_uid=$row[uid];
	$my_name=$row[name];
	$my_password=$row[pwd];
	$my_subject=$row[subject];
	$my_signdate = date("Y년 m월 d일 H시 i분", $row[signdate]);
	$my_ref=$row[ref];
	$my_thread=$row[thread];
	$my_secret=$row[secret];

	echo("<tr>");
		echo("<td>$article_num</td>");
		echo("<td>");
			$sp=strlen($my_thread)-1;
			for($j=0; $j<$sp; $j++){
				echo("&nbsp;&nbsp;&nbsp;");
			}
		if($my_secret != "x"){
			echo("<a href=\"checkPwd.php?page=$page&number=$my_uid\">비밀글입니다.</a></td>");
		}else{
			echo("<a href=\"view.php?page=$page&number=$my_uid\">$my_subject</a></td>");
		}
		echo("<td><a href=\"JavaScript:open_notice('popup.php?writer=$my_name')\">$my_name</a></td>");
		echo("<td>$my_signdate</td>");
		echo("<td>$my_ref</td>");
	echo("</tr>");

	$article_num--;
}
echo("</table><br><br>");


$total_block=ceil($total_page/$page_per_block);
$block=ceil($page/$page_per_block);

$first_page=($block-1)*$page_per_block;
$last_page=$block*$page_per_block;

if($block>=$total_block){
	$last_page=$total_page;
}

if($block>1){
	$my_page=$first_page;
	echo("<a href=\"rboard.php?page=$my_page\">[이전]</a>");
}
else{
	echo("[이전]");
}

for($direct_page=$first_page+1; $direct_page<=$last_page; $direct_page++){
	if($page==$direct_page){
		echo("<b>[$direct_page]</b>");
	}else{
		echo("<a href=\"rboard.php?page=$direct_page\">[$direct_page]</a>");
	}
}

if($block<$total_block){
	$my_page=$last_page+1;
	echo("<a href=\"rboard.php?page=$my_page\">[다음]</a>");
}else{
	echo("[다음]");
}

?>
<br>
 <table>
  <form method = post action = "list.php">
  <tr>
   <td width = "100%" colspan = "5" align = "center">
	<select name = "select_name">
		<option value = name>이름</option>
		<option value = subject selected>제목</option>
	</select>
	<input type = "text" name = "search" size = 30>
	<input type = "submit" value = "검색">
   </td>
  </tr>
  </form>
</table>
 </body>
</html>






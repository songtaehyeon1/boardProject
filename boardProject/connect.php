<?php

$hostName="localhost";
$userName="yuser2";
$userPassword="php";
$dbName="CSE2";

$conn=mysql_connect($hostName, $userName, $userPassword);
if(!$conn){
	echo("�����ͺ��̽��� ������ �� �����ϴ�.");
	exit;
}

$db=mysql_select_db($dbName);
if(!$db){
	echo("�����ͺ��̽��� ������ �� �����ϴ�.");
	exit;
}
?>
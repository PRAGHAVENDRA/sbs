<?php

session_start(); 

if(isset($_POST['interests']))
{
	$interests = $_POST['interests'];
	$int_str = '';
	for($ic=0;$ic<sizeof($interests);$ic++)
	{
		if($interests[$ic] != '')
		{
			$int_str = $int_str . ";" . $interests[$ic];
		}
	}
	$int_str = preg_replace("/^\;/", "", $int_str);
}
else
{
	$int_str = '';
}
$email = $_POST['email'];

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$query = "UPDATE details SET interest='$int_str' where email='$email'";
echo $query;
$result = mysql_query($query);

$_SESSION['email'] = $email;
$_SESSION['valid'] = 1;

@header("Location: prasthanatraya.php");
exit;

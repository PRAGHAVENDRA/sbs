<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$query_l1 = "select distinct title,id from bhashya where bid='ब्रह्मसूत्रभाष्यम्' and id regexp '\_A'";
$result_l1 = mysql_query($query_l1);
$num_rows_l1 = mysql_num_rows($result_l1);

if($num_rows_l1)
{
	for($i_l1=1;$i_l1<=$num_rows_l1;$i_l1++)
	{
		$row_l1=mysql_fetch_assoc($result_l1);

		$title=$row_l1['title'];
		$id=$row_l1['id'];
		
		$title = preg_replace("/^[०१२३४५६७८९\.]+/", "", $title);
		$page_num = '01';
		if(preg_match("/.*\_C([0-9]+).*/", $id, $page_n)){$page_num = $page_n[1];}
	
		echo "<li class=\"sml\"><a class=\"sml\" href=\"format.php?bhashya=BS&page=" . $page_num . "#".$id."\">" . convert_devanagari($i_l1) . ". " . $title . "</a></li>";
	}
}
?>

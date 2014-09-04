<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
}
else{
    $sort = "id";
}

$query_l1 = "select distinct title,id,content from bhashya where id regexp '^BS\_' and id regexp '\_V' and id not regexp '\_B' order by $sort";
$result_l1 = mysql_query($query_l1);
$num_rows_l1 = mysql_num_rows($result_l1);

if($num_rows_l1)
{
    for($i_l1=1;$i_l1<=$num_rows_l1;$i_l1++)
	{
		$row_l1=mysql_fetch_assoc($result_l1);

		$title=$row_l1['title'];
		$id=$row_l1['id'];
		$content=$row_l1['content'];
		
		$xml1 = new SimpleXMLElement($content);
		$content = $xml1->__toString();
		
		$content = preg_replace("/॥.*॥ /u", "", $content);
		$page_num = '01';
		if(preg_match("/.*\_C([0-9]+).*/", $id, $page_n)){$page_num = $page_n[1];}
	
/*
		echo "<li class=\"sml\"><a class=\"sml\" href=\"format.php?bhashya=BS&page=" . $page_num . "#".$id."\">· " . $content . "</a></li>";
*/
		echo "<li class=\"sml\"><a class=\"sml\" href=\"javascript:void(0);\" onclick=\"scrollTo( '#$id', '$page_num', '" . $_POST['bhashya'] . "', '" . $_POST['hval'] . "', '" . $_POST['level'] . "' )\">· " . $content . "</a></li>";
	}
}


?>

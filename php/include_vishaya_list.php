<?php

include("connect.php");

$query_l1 = "select distinct title,id,content from bhashya where id regexp '^BS\_' and id regexp '\_V' and id not regexp '\_B' order by content";
$result_l1 = mysql_query($query_l1);
$num_rows_l1 = mysql_num_rows($result_l1);

if($num_rows_l1)
{
    echo "<ul id=\"navLevel4\">";
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
	
		echo "<li class=\"sml\"><a class=\"sml\" href=\"format.php?bhashya=BS&page=" . $page_num . "#".$id."\">" . convert_devanagari($i_l1) . ". " . $content . "</a></li>";
	}
    echo "</ul>";
}
?>

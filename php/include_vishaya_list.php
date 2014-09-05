<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
}
else{
    $sort = "ref";
}

$query_l1 = "select * from vishaya order by $sort";
$result_l1 = mysql_query($query_l1);
$num_rows_l1 = mysql_num_rows($result_l1);

if($num_rows_l1)
{
	for($i_l1=1;$i_l1<=$num_rows_l1;$i_l1++)
	{
		$row_l1=mysql_fetch_assoc($result_l1);

		$bhashya = $row_l1['bhashya'];
		$content = $row_l1['vakya'];
		$id = $row_l1['ref'];

        $vid = preg_replace("/\_B[0-9]+$/", "", $id);
        
		$content = preg_replace("/\([0-9]+\)$/", "", $content);
		$page_num = '01';
		if(preg_match("/.*\_C([0-9]+).*/", $id, $page_n)){$page_num = $page_n[1];}
	
/*
		echo "<li class=\"sml\"><a class=\"sml\" href=\"format.php?bhashya=" . $bhashya . "&amp;page=" . $page_num . "&amp;hval=" . $content . "&amp;qid=".$id."&amp;nav=1#" . $vid . "\">" . convert_devanagari($i_l1) . ". " . $content . "</a></li>";
*/
        echo "\n<li class=\"sml\"><a class=\"sml\" href=\"javascript:void(0);\" onclick=\"scrollToText( '#BH_" . $vid . "', '#" . $id . "', '" . $page_num . "', '" . $_POST['bhashya'] . "', '" . preg_replace("/'/", "\'", $content) . "', '" . $_POST['level'] . "' )\">" . convert_devanagari($i_l1) . ". " . $content . "</a></li>";
	}
}
?>

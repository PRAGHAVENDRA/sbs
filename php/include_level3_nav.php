<?php
foreach ($xml->div->div->div as $chapter)
{
	if((string) $chapter['class'] != "chapter")
	{
		continue;
	}
	$aid = preg_split("/\_C/", $chapter['id']);
	echo "<li><a id=\"l1".intval($aid[1])."\" href=\"javascript:void(0);\" onclick=\"show_nav_level1('#l1".intval($aid[1])."')\">".(string) $chapter->div[0]."</a><ul class=\"hide\" id=\"l1".intval($aid[1])."ul\">";
	foreach ($chapter->div as $section)
	{
		if((string) $section['class'] != "section")
		{
			continue;
		}
		$page_num = '01';
		if(preg_match("/.*\_C([0-9]+).*/", $section['id'], $page_n)){$page_num = $page_n[1];}
		
		echo "<li><a href=\"format.php?bhashya=" . $_POST['bid'] . "&page=" . $page_num . "#".$section['id']."\">".(string) $section->div[0]."</a></li>";
	}
	echo "</ul></li>";
}
?>

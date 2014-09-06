<?php

foreach ($xml->div->div->div as $chapter)
{
	if((string) $chapter['class'] != "chapter")
	{
		continue;
	}
	$aid = preg_split("/\_C/", $chapter['id']);
    $chName = (string) $chapter->div[0];
    $chName = preg_replace("/॥/", "", $chName);
    
	echo "<li><a id=\"l1".intval($aid[1])."\" href=\"javascript:void(0);\" onclick=\"show_nav_level1('#l1".intval($aid[1])."')\"><i class=\"fa fa-angle-right\"></i> " . $chName . "</a><ul id=\"l1".intval($aid[1])."ul\">";
	foreach ($chapter->div as $section)
	{
		if((string) $section['class'] != "section")
		{
			continue;
		}
		$page_num = '01';
		if(preg_match("/.*\_C([0-9]+).*/", $section['id'], $page_n)){$page_num = $page_n[1];}
		
        $sName = (string) $section->div[0];
        $sName = preg_replace("/॥/", "", $sName);
        
        echo "<li><a href=\"format.php?bhashya=" . $_POST['bid'] . "&page=" . $page_num . "#".$section['id']."\" onclick=\"scrollTo( '#" . $section['id'] . "', '" . $page_num . "', '" . $_POST['bhashya'] . "', '" . $_POST['hval'] . "', '" . $_POST['level'] . "' )\">· " . $sName . "</a></li>";
	}
	echo "</ul></li>";
}

?>

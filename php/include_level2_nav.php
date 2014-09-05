<?php

foreach ($xml->div->div->div as $chapter)
{
	if((string) $chapter['class'] != "chapter")
	{
		continue;
	}
	$page_num = '01';
	if(preg_match("/.*\_C([0-9]+).*/", $chapter['id'], $page_n)){$page_num = $page_n[1];}
    
    $chName = (string) $chapter->div[0];
    $chName = preg_replace("/॥/", "", $chName);
    
    echo "<li><a href=\"javascript:void(0);\" onclick=\"scrollTo( '#" . $chapter['id'] . "', '" . $page_num . "', '" . $_POST['bhashya'] . "', '" . $_POST['hval'] . "', '" . $_POST['level'] . "' )\">· " . $chName . "</a></li>";

}

?>

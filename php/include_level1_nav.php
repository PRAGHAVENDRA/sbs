<?php

$i = 1;
echo "<ul id=\"navLevel1\">";
foreach ($xml->div->div->div as $verse)
{
	if((string) $verse['class'] != "verse")
	{
		continue;
	}
	foreach ($verse->div as $versetext)
	{
		if((string) $versetext['class'] != "versetext")
		{
			continue;
		}
		$vstring = (string) $versetext->__toString();
		$vstring = preg_split("/ /", $vstring);
		$vstring = $vstring[0] . " " . $vstring[1] . " " . $vstring[2];
        
        echo "<li class=\"sml\"><a class=\"further sml\" href=\"javascript:void(0);\" onclick=\"scrollTo( '#" . $verse['id'] . "', '01', '" . $_POST['bhashya'] . "', '" . $_POST['hval'] . "', '" . $_POST['level'] . "' )\">" . convert_devanagari($i) . ". " . $vstring . "</a></li>";
		$i++;
	}
}
echo "</ul>";

?>

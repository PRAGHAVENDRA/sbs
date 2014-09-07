<?php

include("connect.php");
require_once("common.php");

$bhashya_level = array("BS"=>"4","Kathaka"=>"3","Mundaka"=>"3","Taitiriya"=>"3","Aitareya"=>"3","Brha"=>"3","Chandogya"=>"3","Kena_pada"=>"2","Kena_vakya"=>"2","Prashna"=>"2","Mandukya"=>"2","Gita"=>"2","svt"=>"2","kst"=>"2","Isha"=>"1","jbl"=>"1");
$bhashya_san = array("BS"=>"ब्रह्मसूत्रभाष्यम्","Kathaka"=>"काठकोपनिषद्भाष्यम्","Mundaka"=>"मुण्डकोपनिषद्भाष्यम्","Taitiriya"=>"तैत्तिरीयोपनिषद्भाष्यम्","Aitareya"=>"ऐतरेयोपनिषद्भाष्यम्","Brha"=>"बृहदारण्यकोपनिषद्भाष्यम्","Chandogya"=>"छान्दोग्योपनिषद्भाष्यम्","Kena_pada"=>"केनोपनिषत् पदभाष्य​म्","Kena_vakya"=>"केनोपनिषत् वाक्य​भाष्य​म्","Prashna"=>"प्रश्नोपनिषद्भाष्यम्","Mandukya"=>"माण्डूक्योपनिषद्भाष्यम्","Gita"=>"श्रीमद्भगवद्गीताभाष्यम्","svt"=>"श्वेताश्वतरोपनिषत्","kst"=>"कौषीतकिब्राह्मणोपनिषत्","Isha"=>"ईशावास्योपनिषद्भाष्यम्","jbl"=>"जाबालोपनिषत्");

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
	
        echo "\n<li class=\"sml\"><a class=\"navLinkScrollText sml\" href=\"format.php?bhashya=" . $bhashya . "&amp;page=" . $page_num . "&amp;hval=" . $content . "&amp;qid=".$id."&amp;nav=1#" . $vid . "\" data-index=\"#BH_" . $vid . ";#" . $id . ";" . $page_num . ";" . $bhashya_san{$bhashya} . ";" . preg_replace("/'/", "\'", $content) . ";" . $bhashya_level{$bhashya} . "\">" . convert_devanagari($i_l1) . ". " . $content . "</a></li>";
	}
}
?>

<?php

$id = $_GET['id'];

$vyakhyaCode = array("1"=>"BM","2"=>"NN","3"=>"PP","4"=>"RP");
$vyakhyaName = array("BM"=>"भामति","NN"=>"न्यायनिर्णय","PP"=>"पञ्चपादिक","RP"=>"रत्नप्रभ");

echo '<ul>';
foreach ($vyakhyaCode as $vk) {
	if (file_exists('vyakhya/' . $vk . '.xml')) {
    	$xml = simplexml_load_file('vyakhya/' . $vk . '.xml');

    	foreach ($xml->xpath('div[@id="' . $id . '_' . $vk . '"]') as $div) {
 			echo '<li><a class="showvyakhya" data-vyakhya="' . $vk . '" data-parent="sel_' . $id . '">' . $vyakhyaName{$vk} . '</a></li>';
 			break;
 		}
   	}
}
echo '</ul>';
?>

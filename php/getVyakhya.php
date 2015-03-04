<?php

$vyakhya = $_GET['vyakhya'];
$id = $_GET['id'];

$vyakhyaCode = array("1"=>"BM","2"=>"NN","3"=>"PP","4"=>"RP");
$vyakhyaName = array("BM"=>"भामति","NN"=>"न्यायनिर्णय","PP"=>"पञ्चपादिक","RP"=>"रत्नप्रभ");

if (file_exists('vyakhya/' . $vyakhya . '.xml')) {
	$xml = simplexml_load_file('vyakhya/' . $vyakhya . '.xml');

	foreach ($xml->xpath('div[@id="' . $id . '"]') as $div) {
		echo '<div class="VyakhyaDescriptor" id="' . $div['id'] . '">';
		echo '<div class="vyakhyaTitle">' . $vyakhyaName{$vyakhya} . '</div>';
		foreach ($div->p as $p) {
			echo '<p class="' . $p['class'] . '">' . $p . '</p>';
		}
		echo '</div>';
	}
}

?>

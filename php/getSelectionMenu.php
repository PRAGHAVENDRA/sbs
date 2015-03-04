<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<?php

$id = $_GET['id'];

$vyakhyaCode = array("1"=>"BM","2"=>"NN","3"=>"PP","4"=>"RP");
$vyakhyaName = array("BM"=>"भामति","NN"=>"न्यायनिर्णय","PP"=>"पञ्चपादिक","RP"=>"रत्नप्रभ");

foreach ($vyakhyaCode as $vk) {
	if (file_exists('vyakhya/' . $vk . '.xml')) {
    	$xml = simplexml_load_file('vyakhya/' . $vk . '.xml');
	}
	else {
	    exit( 'Failed to open' );
	}
}

?>

<ul>
    <li><a class="showvyakhya" data-vyakhya="BM" data-parent="sel_<?=$id?>">भामति</a></li>
    <li><a class="showvyakhya" data-vyakhya="NN" data-parent="sel_<?=$id?>">न्यायनिर्णय</a></li>
    <li><a class="showvyakhya" data-vyakhya="PP" data-parent="sel_<?=$id?>">पञ्चपादिक</a></li>
    <li><a class="showvyakhya" data-vyakhya="RP" data-parent="sel_<?=$id?>">रत्नप्रभ</a></li>
</ul>
</body>
</html>
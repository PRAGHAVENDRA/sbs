<?php

session_start(); 

if(!(isset($_SESSION['valid'])))
{
	@header("Location: login.php");
	exit;
}
elseif($_SESSION['valid'] != 1)
{
	@header("Location: login.php");
	exit;
}
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang= "en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style/indexstyle.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/reset.css" media ="screen" />
	<title>Shankara Bhashya</title>
</head>

<body>
	<div class="header_top">
		<div class="container">
			<nav class="fsan">
				<ul>
					<li><a title="Main Page" href="prasthanatraya.php">मुख्यपृष्ठम्</a></li>
					<li><a title="Sri Shankara Bhashya" href="prasthanatraya_list.php">श्रीशाङ्करप्रस्थानत्रयभाष्यम्</a></li>
					<li><a title="Search" href="search.php">अन्वेषणम्</a></li>
				</ul>
			</nav>
			<div class="logo"><a href="http://www.sringeri.net/"><img src="images/logo.png" alt="Sringeri Logo" /></a></div>
			<div class="title fsan">
				<span class="clr noul"><a href="../index.php">अद्वैतशारदा</a></span><br />
				दक्षिणाम्नाय श्रीशारदापीठम्, शृङ्गेरी
			</div>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
	<div class="page">
		<div class="map">
			<img src="images/AkhandaBharata.png" alt="Akhanda Bharata" usemap="#amnayapeetham"/>
			<map name="amnayapeetham">
				<area shape="rect" coords="15,220,150,270"  alt="Tattvamasi" title="छान्दोग्योपनिषत् (६-८-७)" target="_blank" href="format.php?bhashya=Chandogya&page=06&hval=%E0%A4%A4%E0%A4%A4%E0%A5%8D%E0%A4%A4%E0%A5%8D%E0%A4%B5%E0%A4%AE%E0%A4%B8%E0%A4%BF#Ch_C06_S08_V07">
				<area shape="rect" coords="115,349,212,411" alt="Aham Brahmasmi" title="बृहदारण्यकोपनिषत् (१-४-१०)" target="_blank" href="format.php?bhashya=Brha&page=01&hval=%E0%A4%85%E0%A4%B9%E0%A4%82%20%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE%E0%A4%BE%E0%A4%B8%E0%A5%8D%E0%A4%AE%E0%A5%80%E0%A4%A4%E0%A4%BF#BR_C01_S04_V10">
				<area shape="rect" coords="320,201,419,256" alt="Prajnanam Brahma" title="ऐतरेयोपनिषत् ( ३-१-३)" target="_blank" href="format.php?bhashya=Aitareya&page=03&hval=%E0%A4%AA%E0%A5%8D%E0%A4%B0%E0%A4%9C%E0%A5%8D%E0%A4%9E%E0%A4%BE%E0%A4%A8%E0%A4%82%20%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE#AI_C03_S01_V03">
				<area shape="rect" coords="276,77,387,133" alt="Ayamatma Brahma" title="माण्डूक्योपनिषत् (२)" target="_blank" href="format.php?bhashya=Mandukya&page=01&hval=%E0%A4%B9%E0%A5%8D%E0%A4%AF%E0%A5%87%E0%A4%A4%E0%A4%A6%E0%A5%8D%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE%E0%A4%BE%E0%A4%AF%E0%A4%AE%E0%A4%BE%E0%A4%A4%E0%A5%8D%E0%A4%AE%E0%A4%BE%20%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE#MK_V02">
			</map>
		</div>
		<div class="maincontent fsan sml clr noul">
			<p class="cen" style="font-size: 2.4em;">ॐ</p>
			<p class="big bld">॥ उपनिषद्भाष्याणि ॥</p>			
			<ul class="ulinks mtop">
				<li><a href="format.php?bhashya=Isha">॥ ईशावास्योपनिषद्भाष्यम् ॥</a></li>
				<li><a href="format.php?bhashya=Kena_pada">॥ केनोपनिषत्पदभाष्यम् ॥</a></li>
				<li><a href="format.php?bhashya=Kena_vakya">॥ केनोपनिषद्वाक्यभाष्यम् ॥</a></li>
				<li><a href="format.php?bhashya=Kathaka">॥ कठोपनिषद्भाष्यम् ॥</a></li>
				<li><a href="format.php?bhashya=Prashna">॥ प्रश्नोपनिषद्भाष्यम् ॥</a></li>
				<li><a href="format.php?bhashya=Mundaka">॥ मुण्डकोपनिषद्भाष्यम् ॥</a></li>
				<li><a href="format.php?bhashya=Mandukya">॥ माण्डूक्योपनिषद्भाष्यम् ॥</a></li>
				<li><a href="format.php?bhashya=Taitiriya">॥ तैत्तिरीयोपनिषद्भाष्यम् ॥</a></li>
				<li><a href="format.php?bhashya=Aitareya">॥ ऐतरेयोपनिषद्भाष्यम् ॥</a></li>
				<li><a href="format.php?bhashya=Chandogya">॥ छान्दोग्योपनिषद्भाष्यम् ॥</a></li>
				<li><a href="format.php?bhashya=Brha">॥ बृहदारण्यकोपनिषद्भाष्यम् ॥</a></li>
			</ul>
		</div>
	</div>
</body>
</html>

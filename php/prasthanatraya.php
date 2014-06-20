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
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/devanagari_kbd.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/common.js" charset="UTF-8"></script>
	<title>Shankara Bhashya</title>
</head>

<body>
	<script type="text/javascript" src="js/audio1.js" charset="UTF-8"></script>
	<div class="header_top">
		<div class="container">
			<nav class="fsan">
				<ul>
					<li><a title="Main Page" href="prasthanatraya.php">मुख्यपृष्ठम्</a></li>
					<li><a title="Sri Shankara Prasthanatraya Bhashya" href="prasthanatraya_list.php">श्रीशाङ्करप्रस्थानत्रयभाष्यम्</a></li>
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
	<div class="page big">
		<div class="map">
			<img src="images/AkhandaBharata.png" alt="Akhanda Bharata" usemap="#amnayapeetham"/>
			<map name="amnayapeetham">
				<area shape="rect" coords="15,220,150,270"  alt="Tattvamasi" title="छान्दोग्योपनिषत् (६-८-७)" target="_blank" href="format.php?bhashya=Chandogya&page=06&hval=%E0%A4%A4%E0%A4%A4%E0%A5%8D%E0%A4%A4%E0%A5%8D%E0%A4%B5%E0%A4%AE%E0%A4%B8%E0%A4%BF#Ch_C06_S08_V07">
				<area shape="rect" coords="115,349,212,411" alt="Aham Brahmasmi" title="बृहदारण्यकोपनिषत् (१-४-१०)" target="_blank" href="format.php?bhashya=Brha&page=01&hval=%E0%A4%85%E0%A4%B9%E0%A4%82%20%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE%E0%A4%BE%E0%A4%B8%E0%A5%8D%E0%A4%AE%E0%A5%80%E0%A4%A4%E0%A4%BF#BR_C01_S04_V10">
				<area shape="rect" coords="320,201,419,256" alt="Prajnanam Brahma" title="ऐतरेयोपनिषत् ( ३-१-३)" target="_blank" href="format.php?bhashya=Aitareya&page=03&hval=%E0%A4%AA%E0%A5%8D%E0%A4%B0%E0%A4%9C%E0%A5%8D%E0%A4%9E%E0%A4%BE%E0%A4%A8%E0%A4%82%20%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE#AI_C03_S01_V03">
				<area shape="rect" coords="276,77,387,133" alt="Ayamatma Brahma" title="माण्डूक्योपनिषत् (२)" target="_blank" href="format.php?bhashya=Mandukya&page=01&hval=%E0%A4%B9%E0%A5%8D%E0%A4%AF%E0%A5%87%E0%A4%A4%E0%A4%A6%E0%A5%8D%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE%E0%A4%BE%E0%A4%AF%E0%A4%AE%E0%A4%BE%E0%A4%A4%E0%A5%8D%E0%A4%AE%E0%A4%BE%20%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE#MK_V02">
			</map>
		</div>
		<div class="maincontent fsan sml clr" style="padding-bottom: 1em;">
			<p class="cen" style="font-size: 2em;">ॐ</p>
			<div class="ppbutton" id="playbutton1"><a title="Play Audio" id="play1" href="javascript:void(0);"><img style="margin: 40px 0 10px 20px;width: 20px;" src="images/play.png" alt="Play or Pause button"/></a></div>
			<div class="ppbutton" id="pausebutton1" style="display: none;"><a title="Pause" id="pause1" href="javascript:void(0);"><img style="margin: 40px 0 10px 20px;width: 20px;" src="images/pause.png" alt="Play or Pause button"/></a></div>
			<p style="position: absolute;margin-left: 2.5em;">अवतीर्णश्च कालट्यां केदारेऽन्तर्हितश्चयः ।<br />
			चतुष्पीठप्रतिष्ठाता जयताच्छङ्करो गुरुः ॥</p>			
		</div>
		<div class="maincontent fsan clr big">
			<p class="big"><a class="noulshadow" href="prasthanatraya_list.php"><span style="font-size: 0.7em;text-height: 1;display: block;margin-bottom: 0.25em;">श्रीमत्परमहंसपरिव्राजकाचार्यस्य<br />श्रीगोविन्दभगवत्पूज्यपादशिष्यस्य<br /></span>श्रीमच्छङ्करभगवतः<br />प्रस्थानत्रयभाष्यम्</a></p>
		</div>
	</div>
</body>
</html>

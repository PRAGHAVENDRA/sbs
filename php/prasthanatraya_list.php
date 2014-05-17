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
	<script type="text/javascript" src="js/audio2_3_4.js" charset="UTF-8"></script>
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
	<div class="page">
		<div class="map">
			<img src="images/AkhandaBharata.png" alt="Akhanda Bharata" usemap="#amnayapeetham"/>
			<map name="amnayapeetham">
				<area shape="rect" coords="15,220,150,270"  alt="Tattvamasi" title="छान्दोग्योपनिषत् (६-८-७)" target="_blank" href="format.php?bhashya=Chandogya&hval=%E0%A4%A4%E0%A4%A4%E0%A5%8D%E0%A4%A4%E0%A5%8D%E0%A4%B5%E0%A4%AE%E0%A4%B8%E0%A4%BF#Ch_C06_S08_V07">
				<area shape="rect" coords="115,349,212,411" alt="Aham Brahmasmi" title="बृहदारण्यकोपनिषत् (१-४-१०)" target="_blank" href="format.php?bhashya=Brha&hval=%E0%A4%85%E0%A4%B9%E0%A4%82%20%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE%E0%A4%BE%E0%A4%B8%E0%A5%8D%E0%A4%AE%E0%A5%80%E0%A4%A4%E0%A4%BF#BR_C01_S04_V10">
				<area shape="rect" coords="320,201,419,256" alt="Prajnanam Brahma" title="ऐतरेयोपनिषत् ( ३-१-३)" target="_blank" href="format.php?bhashya=Aitareya&hval=%E0%A4%AA%E0%A5%8D%E0%A4%B0%E0%A4%9C%E0%A5%8D%E0%A4%9E%E0%A4%BE%E0%A4%A8%E0%A4%82%20%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE#AI_C03_S01_V03">
				<area shape="rect" coords="276,77,387,133" alt="Ayamatma Brahma" title="माण्डूक्योपनिषत् (२)" target="_blank" href="format.php?bhashya=Mandukya&hval=%E0%A4%B9%E0%A5%8D%E0%A4%AF%E0%A5%87%E0%A4%A4%E0%A4%A6%E0%A5%8D%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE%E0%A4%BE%E0%A4%AF%E0%A4%AE%E0%A4%BE%E0%A4%A4%E0%A5%8D%E0%A4%AE%E0%A4%BE%20%E0%A4%AC%E0%A5%8D%E0%A4%B0%E0%A4%B9%E0%A5%8D%E0%A4%AE#MK_V02">
			</map>
		</div>
		<div class="maincontent fsan sml clr" style="padding-bottom:20px;">
			<p class="cen" style="font-size: 2.4em;">ॐ</p>
			<div class="ppbutton" id="playbutton2"><a title="Play Audio" id="play2" href="javascript:void(0);"><img style="margin: 27px 10px 0px 0;width: 18px;" src="images/play.png" alt="Play or Pause button"/></a></div>
			<div class="ppbutton" id="pausebutton2" style="display: none;"><a title="Pause" id="pause2" href="javascript:void(0);"><img style="margin: 27px 10px 0px 0;width: 18px;" src="images/pause.png" alt="Play or Pause button"/></a></div>
			<p class="clr4">गुरुः समस्तोपनिषत्स्वतन्त्रः।<br />
			अनेन दूरीकृतभेदवादम् अकारि शारीरकसूत्रभाष्यम् ।।</p><br />
			
			<div class="ppbutton" id="playbutton3"><a title="Play Audio" id="play3" href="javascript:void(0);"><img style="margin: 0px 10px 0px 0;width: 18px;" src="images/play.png" alt="Play or Pause button"/></a></div>
			<div class="ppbutton" id="pausebutton3" style="display: none;"><a title="Pause" id="pause3" href="javascript:void(0);"><img style="margin: 0px 10px 0px 0;width: 18px;" src="images/pause.png" alt="Play or Pause button"/></a></div>
			<p class="clr4">ततो महाभारतसारभूताः स व्याकरोद्भागवतीश्च गीताः ।</p><br />
			
			<div class="ppbutton" id="playbutton4"><a title="Play Audio" id="play4" href="javascript:void(0);"><img style="margin: 27px 10px 0px 0;width: 18px;" src="images/play.png" alt="Play or Pause button"/></a></div>
			<div class="ppbutton" id="pausebutton4" style="display: none;"><a title="Pause" id="pause4" href="javascript:void(0);"><img style="margin: 27px 10px 0px 0;width: 18px;" src="images/pause.png" alt="Play or Pause button"/></a></div>
			<p class="clr4">करतलकलिताद्वयात्मतत्त्वं क्षपितदुरन्तचिरन्तनप्रमोहम् ।<br />
			उपचितमुदितोदितैर्गुणौघैः उपनिषदामयमुज्जहार भाष्यम् ।।</p><br />
		</div>
		<div class="maincontent fsan clr noul">
			<p class="big bld"><a target="_blank" href="format.php?bhashya=BS">॥ ब्रह्मसूत्रभाष्यम् ॥</a></p>
			<p class="gpall big bld"><a target="_blank" href="format.php?bhashya=Gita">॥ श्रीमद्भगवद्गीताभाष्यम् ॥</a></p>
			<p class="big bld"><a href="upanishat.php">॥ उपनिषद्भाष्याणि ॥</a></p>			
		</div>
	</div>
</body>
</html>

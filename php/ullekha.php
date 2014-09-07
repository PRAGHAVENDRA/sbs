<?php require_once('include_requireLogin.php'); ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang= "en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style/indexstyle.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/reset.css" media ="screen" />
	<script type="text/javascript" src="js/common.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/devanagari_kbd.js" charset="UTF-8"></script>
	<title>Shankara Bhashya</title>
	
	<script type="text/javascript">
	$(document).ready(function() {
		$("#sidenav").height("100%");
		$("#rsidenav").height("100%");
		setTimeout(function(){$('#sidenav').css('left','-220px');},1000);
		setTimeout(function(){var hloc = window.location.href;var jump_id = hloc.split("#");jump_id = jump_id[1];$('#BH_'+jump_id).slideToggle('slow');},100);
		setTimeout( function(){$(document).scroll(function(){$('#callout').fadeOut(2000)})}, 2000);
		$("a").hover(function(){var htmlc;var ht;htmlc = $(this).html();if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '&qid=' + this.href.split(/\#/)[2] + '#' + this.href.split(/\#/)[1];}});
		$("a").focus(function(){var htmlc;var ht;htmlc = $(this).html();if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '&qid=' + this.href.split(/\#/)[2] + '#' + this.href.split(/\#/)[1];}});
	});
	</script>
</head>

<?php

$bhashya_level = array("BS"=>"4","Kathaka"=>"3","Mundaka"=>"3","Taitiriya"=>"3","Aitareya"=>"3","Brha"=>"3","Chandogya"=>"3","Kena_pada"=>"2","Kena_vakya"=>"2","Prashna"=>"2","Mandukya"=>"2","Gita"=>"2","svt"=>"2","kst"=>"2","Isha"=>"1","jbl"=>"1");
$bhashya_san = array("BS"=>"ब्रह्मसूत्रभाष्यम्","Kathaka"=>"काठकोपनिषद्भाष्यम्","Mundaka"=>"मुण्डकोपनिषद्भाष्यम्","Taitiriya"=>"तैत्तिरीयोपनिषद्भाष्यम्","Aitareya"=>"ऐतरेयोपनिषद्भाष्यम्","Brha"=>"बृहदारण्यकोपनिषद्भाष्यम्","Chandogya"=>"छान्दोग्योपनिषद्भाष्यम्","Kena_pada"=>"केनोपनिषत् पदभाष्य​म्","Kena_vakya"=>"केनोपनिषत् वाक्य​भाष्य​म्","Prashna"=>"प्रश्नोपनिषद्भाष्यम्","Mandukya"=>"माण्डूक्योपनिषद्भाष्यम्","Gita"=>"श्रीमद्भगवद्गीताभाष्यम्","svt"=>"श्वेताश्वतरोपनिषत्","kst"=>"कौषीतकिब्राह्मणोपनिषत्","Isha"=>"ईशावास्योपनिषद्भाष्यम्","jbl"=>"जाबालोपनिषत्");

include("common.php");

echo "<body>";
$flnm = $_GET['bid'] . "_uddhrita.php";

echo "<div id=\"searchpanel\">
	<a id=\"show_search\" href=\"search.php\"><img src=\"images/search.png\" /></a>
</div>";
echo "<div class=\"header_top\" id=\"header_top\">
		<div class=\"container\">
			<nav class=\"fsan\">
				<ul>
					<li><a title=\"Main Page\" href=\"prasthanatraya.php\">मुख्यपृष्ठम्</a></li>
					<li><a title=\"Sri Shankara Bhashya\" href=\"prasthanatraya_list.php\">श्रीशाङ्करप्रस्थानत्रयभाष्यम्</a></li>
					<li><a title=\"Search\" href=\"search.php\">अन्वेषणम्</a></li>
				</ul>
			</nav>
			<div class=\"logo\"><a href=\"http://www.sringeri.net/\"><img src=\"images/logo.png\" alt=\"Sringeri Logo\" /></a></div>
			<div class=\"title fsan\">
				<span class=\"clr noul\"><a href=\"../index.php\">अद्वैतशारदा</a></span><br />
				दक्षिणाम्नाय श्रीशारदापीठम्, शृङ्गेरी
			</div>
			<div id=\"ttop\" class=\"bhashya_title bh_title fsan\">".$bhashya_san{$_GET['bid']}."</div>
		</div>
	</div>
	<div class=\"clearfix\">&nbsp;</div>";

echo "<div class=\"page\" id=\"page\"><ul class=\"ullekha_list\">";

include("ullekha/".$_GET['bid'] . "_ullekha.php");

?>
	</ul></div>
</body>
</html>

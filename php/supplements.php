<?php require_once('include_requireLogin.php'); ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style/indexstyle.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/reset.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/dots.css" media ="screen" />
    <link href="style/font-awesome-4.1.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/common.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/devanagari_kbd.js" charset="UTF-8"></script>
	<title>Shankara Bhashya</title>
	
	<script type="text/javascript">
	$(document).ready(function() {$("#pageloader").fadeOut(1000);})
	</script>
</head>

<?php

$bhashya_level = array("BS"=>"4","Kathaka"=>"3","Mundaka"=>"3","Taitiriya"=>"3","Aitareya"=>"3","Brha"=>"3","Chandogya"=>"3","Kena_pada"=>"2","Kena_vakya"=>"2","Prashna"=>"2","Mandukya"=>"2","Gita"=>"2","svt"=>"2","kst"=>"2","Isha"=>"1","jbl"=>"1");
$bhashya_san = array("BS"=>"ब्रह्मसूत्रभाष्यम्","Kathaka"=>"काठकोपनिषद्भाष्यम्","Mundaka"=>"मुण्डकोपनिषद्भाष्यम्","Taitiriya"=>"तैत्तिरीयोपनिषद्भाष्यम्","Aitareya"=>"ऐतरेयोपनिषद्भाष्यम्","Brha"=>"बृहदारण्यकोपनिषद्भाष्यम्","Chandogya"=>"छान्दोग्योपनिषद्भाष्यम्","Kena_pada"=>"केनोपनिषत् पदभाष्य​म्","Kena_vakya"=>"केनोपनिषत् वाक्य​भाष्य​म्","Prashna"=>"प्रश्नोपनिषद्भाष्यम्","Mandukya"=>"माण्डूक्योपनिषद्भाष्यम्","Gita"=>"श्रीमद्भगवद्गीताभाष्यम्","svt"=>"श्वेताश्वतरोपनिषत्","kst"=>"कौषीतकिब्राह्मणोपनिषत्","Isha"=>"ईशावास्योपनिषद्भाष्यम्","jbl"=>"जाबालोपनिषत्");

require_once("common.php");

echo "<body>";
echo "<div id=\"pageloader\"></div>";
echo "<div id=\"loader\"><img src=\"images/loader.gif\" /></div>";


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
		</div>
	</div>
	<div class=\"clearfix\">&nbsp;</div>";
echo "<div class=\"page_inner\">";
echo "<div class=\"page_format\">";
?>
        <div class="chapter hashnav">
            <ul class="supllementLisitng">
                <li>
                    <span class="title"><a href="supplement.php?id=20140908001">१. आकाशाधिकरणम्</a></span></a><br />
                    <span class="author"><a href="#">विद्वान्  मणिद्राविडः, चेन्नै</a></span>
                    <p class="fright">
                        <i class="fa fa-youtube-play"></i>
                        <i class="fa fa-file-text-o"></i>
                    </p>                    
                </li>
                <li>
                    <span class="title"><a href="#">२. जन्माद्यधिकरणम्</a></span></a><br />
                    <span class="author"><a href="#">विद्वान्  मणिद्राविडः, चेन्नै</a></span>
                    <p class="fright">
                        <i class="fa fa-youtube-play"></i>
                        <i class="fa fa-file-text-o"></i>
                        <i class="fa fa-file-pdf-o"></i>
                    </p>                    
                </li>
                <li>
                    <span class="title"><a href="#">३. शास्त्रयोनित्वाधिकरणम्</a></span></a><br />
                    <span class="author"><a href="#">विद्वान्  मणिद्राविडः, चेन्नै</a></span>
                    <p class="fright">
                        <i class="fa fa-youtube-play"></i>
                        <i class="fa fa-file-pdf-o"></i>
                    </p>                    
                </li>
                <li>
                    <span class="title"><a href="#">४. समन्वयाधिकरणम्</a></span></a><br />
                    <span class="author"><a href="#">विद्वान्  मणिद्राविडः, चेन्नै</a></span>
                    <p class="fright">
                        <i class="fa fa-file-text-o"></i>
                        <i class="fa fa-file-pdf-o"></i>
                    </p>                    
                </li>
            </ul>
            </div>
        </div>
	</div>
	</div>
	</div>
</body>
</html>

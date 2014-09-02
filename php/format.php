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

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style/indexstyle.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/reset.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/dots.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/jquery.mCustomScrollbar.css" media="screen">
    <link href="style/font-awesome-4.1.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="js/common.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="js/devanagari_kbd.js" charset="UTF-8"></script>
	<title>Shankara Bhashya</title>
	
	<script type="text/javascript">
	$(document).ready(OnloadFunction);
	$(document).ready(function() {$("#pageloader").fadeOut(1000);})
	</script>
</head>

<?php

$bhashya_level = array("BS"=>"4","Kathaka"=>"3","Mundaka"=>"3","Taitiriya"=>"3","Aitareya"=>"3","Brha"=>"3","Chandogya"=>"3","Kena_pada"=>"2","Kena_vakya"=>"2","Prashna"=>"2","Mandukya"=>"2","Gita"=>"2","svt"=>"2","kst"=>"2","Isha"=>"1","jbl"=>"1");
$bhashya_san = array("BS"=>"ब्रह्मसूत्रभाष्यम्","Kathaka"=>"काठकोपनिषद्भाष्यम्","Mundaka"=>"मुण्डकोपनिषद्भाष्यम्","Taitiriya"=>"तैत्तिरीयोपनिषद्भाष्यम्","Aitareya"=>"ऐतरेयोपनिषद्भाष्यम्","Brha"=>"बृहदारण्यकोपनिषद्भाष्यम्","Chandogya"=>"छान्दोग्योपनिषद्भाष्यम्","Kena_pada"=>"केनोपनिषत् पदभाष्य​म्","Kena_vakya"=>"केनोपनिषत् वाक्य​भाष्य​म्","Prashna"=>"प्रश्नोपनिषद्भाष्यम्","Mandukya"=>"माण्डूक्योपनिषद्भाष्यम्","Gita"=>"श्रीमद्भगवद्गीताभाष्यम्","svt"=>"श्वेताश्वतरोपनिषत्","kst"=>"कौषीतकिब्राह्मणोपनिषत्","Isha"=>"ईशावास्योपनिषद्भाष्यम्","jbl"=>"जाबालोपनिषत्");

if(isset($_GET['bhashya']))
{
	$level = $bhashya_level{$_GET['bhashya']};
	$bhashya = $_GET['bhashya'] . '_id.xml';
}
else
{
	$bhashya = "Brha_id.xml";
	$level = "3";
}

if(isset($_GET['hval']))
{
	$hval = $_GET['hval'];
}
else
{
	$hval = '';
}

$_POST['bhashya'] = $bhashya_san{$_GET['bhashya']};
$_POST['bid'] = $_GET['bhashya'];
$_POST['hval'] = $hval;

if (file_exists($bhashya)) {
    $xml = simplexml_load_file($bhashya);
}
else {
    exit("Failed to open $bhashya");
}

require_once("common.php");

echo "<body>";
echo "<div id=\"pageloader\"></div>";
echo "<div id=\"loader\"><img src=\"images/loader.gif\" /></div>";

include("include_sideNavigation.php");
include("include_glossary.php");
include("include_searchAndUllekhaPanel.php");

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
			<div id=\"ttop\" class=\"bhashya_title bh_title fsan\">".$bhashya_san{$_GET['bhashya']}."</div>
		</div>
	</div>
	<div class=\"clearfix\">&nbsp;</div>";
	echo "<div class=\"page_inner\">";

if(($hval != '') && (!(isset($_GET['qid']))))
{
	echo "<div class=\"callout left\" id=\"callout\">
	<span class=\"qt\">$hval</span>
	<b class=\"co_arrow co_arrow_border\"></b>
	<b class=\"co_arrow\"></b>
	</div>";
}

if(isset($_GET['page'])){$page_num = intval($_GET['page']);}else{$page_num = 1;}

echo "<div class=\"page_format\" data-page=\"" . $page_num . ";" . $level . "\" data=\"true\" id=\"pageLazy\">";

include("include_level".$level."_body.php");

?>
	</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		var mul = $('#pageLazy').attr('data-page');
		var pagenum = mul.split(/;/)[0];
		var level = mul.split(/;/)[1];
		var goNow = true;
		$(window).scroll( function() {
			var go = $('#pageLazy');
			
			var postData = <?php echo !empty($_POST)?json_encode($_POST):'null';?>;
			if(go.attr('data') == "true" && goNow == true){
				if(($(this).scrollTop() + $(this).innerHeight()) > ($(document).height() - 600)) {
					
					$('#loader').fadeIn(500);
					pagenum = parseInt(pagenum)+parseInt(1);

					goNow = false;
					if(level != 1){
					$.ajax({
						type: "POST",
						url: "include_level" + level + "_body.php?page=" + pagenum,
						dataType: "html",
						data: postData,
						success: function(res){
							if(res.length > 4) {
								goNow = true;
								$('#loader').fadeOut(500);
								go.append(res).fadeIn();
								OnloadFunction();
							} else {
								goNow = false;
								$('#loader').fadeOut(500);
							}
						},
						error: function(e){
							goNow = false;
							$('#loader').fadeOut(500);
						}
					});}
				}
			}
		});
	});
</script>
</body>
</html>

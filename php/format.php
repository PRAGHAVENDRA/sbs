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
	<link rel="stylesheet" type="text/css" href="style/dots.css" media ="screen" />
	<script type="text/javascript" src="js/common.js" charset="UTF-8"></script>
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/devanagari_kbd.js" charset="UTF-8"></script>
	<title>Shankara Bhashya</title>
	
	<script type="text/javascript">
	function OnloadFunction(){
		$("#sidenav").height("96%");
		$("#sidenav1").height("96%");
		$("#sidenav2").height("96%");
		$("#rsidenav").height("96%");
		setTimeout(function(){$('#sidenav').css('left','-220px');},1000);
		setTimeout(function(){$('#sidenav1').css('left','-220px');},1000);
		setTimeout(function(){$('#sidenav2').css('left','-220px');},1000);
		setTimeout(function(){var hloc = window.location.href;var jump_id = hloc.split("#");jump_id = jump_id[1];$('#BH_'+jump_id).slideToggle('slow');},100);
		setTimeout( function(){$(document).scroll(function(){$('#callout').fadeOut(2000)})}, 2000);
		$(".qt a").hover(function(){var htmlc;var ht;htmlc = $(this).html();htmlc = htmlc.replace("<span class=\"highlight\">", "");htmlc = htmlc.replace("<\/span>", "");if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '#' + this.href.split(/\#/)[1];}});
		$(".qt a").focus(function(){var htmlc;var ht;htmlc = $(this).html();htmlc = htmlc.replace("<span class=\"highlight\">", "");htmlc = htmlc.replace("<\/span>", "");if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '#' + this.href.split(/\#/)[1];}});
		$('#show_adhyaya_button').click(function() {$('#sidenav').css('left','0px');$('#sidenav1').hide(10);$('#sidenav2').hide(10);$('#sidenav').show(10);setTimeout(function(){$('#sidenav').css('left','-220px');},1000);});
		$('#show_adhikarana_button').click(function() {$('#sidenav1').css('left','0px');$('#sidenav').hide(10);$('#sidenav2').hide(10);$('#sidenav1').show(10);setTimeout(function(){$('#sidenav1').css('left','-220px');},1000);});
		$('#show_sutra_button').click(function() {$('#sidenav2').css('left','0px');$('#sidenav').hide(10);$('#sidenav1').hide(10);$('#sidenav2').show(10);setTimeout(function(){$('#sidenav2').css('left','-220px');},1000);});
	}
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
} else {
 exit("Failed to open $bhashya");
}

require_once("common.php");

echo "<body>";
echo "<div id=\"pageloader\"></div>";
echo "<div id=\"loader\"><img src=\"images/loader.gif\" /></div>";

if($_GET['bhashya'] == 'BS')
{
echo "<div id=\"sidenav1\">
		<div class=\"arrow\">☰</div>
		<nav class=\"nav\"><ul>";
include("include_adhikarana_list.php");
echo "</ul></nav>
	</div>";
echo "<div id=\"sidenav2\">
		<div class=\"arrow\">☰</div>
		<nav class=\"nav\"><ul>";
include("include_sutra_list.php");
echo "</ul></nav>
	</div>";
}
echo "<div id=\"sidenav\">
		<div class=\"arrow\">☰</div>
		<nav class=\"nav\"><ul>";
include("include_level".$level."_nav.php");
echo "</ul></nav>
	</div>";
echo "<div id=\"rsidenav\">
	<div class=\"arrow\">☰</div>
		<nav class=\"nav\"><ul>";
include("glossary.php");
echo "</ul></nav>
	</div>";

echo "<div id=\"searchpanel\">
	<a id=\"show_search\" href=\"search.php\"><img src=\"images/search.png\" /></a>";
echo"</div>";
if($_GET['bhashya'] == 'BS')
{
echo "<div class=\"BS_nav\">";
echo "<p id=\"show_adhyaya\" class=\"adhikarana clr noul\"><a id=\"show_adhyaya_button\" target=\"_blank\" href=\"javascript:void(0);\">अध्यायाः</a></p>";
echo "<p id=\"show_sutra\" class=\"adhikarana clr noul\"><a id=\"show_sutra_button\" target=\"_blank\" href=\"javascript:void(0);\">सूत्राणि</a></p>";
echo "<p id=\"show_adhikarana\" class=\"adhikarana clr noul\"><a id=\"show_adhikarana_button\" target=\"_blank\" href=\"javascript:void(0);\">अधिकरणानि</a></p>";
echo "</div>";
}
echo "<div class=\"ullekha_nav\">";
echo "<p id=\"show_adhikarana\" class=\"adhikarana clr noul\"><a target=\"_blank\" href=\"ullekha.php?bid=".$_GET['bhashya']."\">उल्लेखाः</a></p>";
echo "</div>";

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

if($hval != '')
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

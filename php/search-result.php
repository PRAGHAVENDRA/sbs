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
	function OnloadFunction(){
		$(".qt a").hover(function(){var htmlc;var ht;htmlc = $(this).html();htmlc = htmlc.replace("<span class=\"highlight\">", "");htmlc = htmlc.replace("<\/span>", "");if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '#' + this.href.split(/\#/)[1];}});
		$(".qt a").focus(function(){var htmlc;var ht;htmlc = $(this).html();htmlc = htmlc.replace("<span class=\"highlight\">", "");htmlc = htmlc.replace("<\/span>", "");if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '#' + this.href.split(/\#/)[1];}});
		$(".readmore a").hover(function(){var htmlc;var ht;htmlc = $(this).html();if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + this.href.split(/\#/)[2] + '#' + this.href.split(/\#/)[1];}});
	}
	$(document).ready(OnloadFunction);
	</script>
</head>

<body>
	<div id="loader"><img src="images/loader.gif" /></div>
	<div id="searchpanel"><a id="show_search" href="search.php"><img src="images/search.png" /></a></div>
	<div class="header_top">
		<div class="container">
			<nav class="fsan">
				<ul>
					<li><a title="Main Page" href="prasthanatraya.php">मुख्यपृष्ठम्</a></li>
					<li><a title="Sri Shankara Bhashya" href="prasthanatraya_list.php">श्रीशाङ्करप्रस्थानत्रयभाष्यम्</a></li>
					<li><a title="Search" href="search.php">अन्वेषणम्</a></li>
					<li><a title="Help" href="feedback.php">साहाय्यम्</a></li>
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
	<div class="page" data-page="1" data="true" id="pageLazy">
		<div class="ch_name" style="margin-top: 10px;">अन्वेषणम् - फलितांशः</div>
		<hr />
<?php include("search-ajax.php"); ?>
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
				if(($(this).scrollTop() + $(this).innerHeight()) > ($(document).height() - 1200)) {
					
					$('#loader').fadeIn(500);
					pagenum = parseInt(pagenum)+parseInt(1);

					goNow = false;
					if(level != 1){
					$.ajax({
						type: "POST",
						url: "search-ajax.php?page=" + pagenum,
						dataType: "html",
						data: postData,
						success: function(res){
							if(res.match(/No results/) == null) {
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

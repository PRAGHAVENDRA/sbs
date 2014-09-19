<?php require_once('include_requireLogin.php'); ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang= "en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style/indexstyle.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/reset.css" media ="screen" />
	<script type="text/javascript" src="js/devanagari_kbd.js" charset="UTF-8"></script>
	<title>Shankara Bhashya</title>
</head>

<body>
	<div id="searchpanel"><a id="show_search" href="search.php"><img src="images/search.png" /></a></div>
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
		<div class="ch_name" style="margin-top: 10px;">अन्वेषणम्</div>
		<hr />
		<div class="search_input">
			<form method="POST" action="search-result.php">
				<table>
					<tr>
						<td colspan="2" class="right"><input name="searchtext" type="text" id="searchtext" onfocus="SetId('searchtext')" placeholder="शब्द"/></td>
					</tr>
					<tr>
						<td class="left">
							<input name="check_vb[]" type="checkbox" id="verse_check" value="V" CHECKED />
							<label for="verse_check" class="clr">मन्त्र / सूत्र</label>
						</td>
						<td class="right">
							<input name="check_vb[]" type="checkbox" id="bhashya_check" value="B" CHECKED />
							<label for="bhashya_check" class="clr">भाष्यम्</label>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="right" style="padding: 1em 0 0 3em;">
							<ul class="fleft">
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b03" value="ईशावास्योपनिषद्भाष्यम्" /><label for="b03">&nbsp;ईशावास्योपनिषद्भाष्यम्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b04" value="केनोपनिषत् पदभाष्य​म्" /><label for="b04">&nbsp;केनोपनिषत् पदभाष्य​म्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b05" value="केनोपनिषत् वाक्य​भाष्य​म्" /><label for="b05">&nbsp;केनोपनिषत् वाक्य​भाष्य​म्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b06" value="काठकोपनिषद्भाष्यम्" /><label for="b06">&nbsp;काठकोपनिषद्भाष्यम्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b07" value="प्रश्नोपनिषद्भाष्यम्" /><label for="b07">&nbsp;प्रश्नोपनिषद्भाष्यम्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b08" value="मुण्डकोपनिषद्भाष्यम्" /><label for="b08">&nbsp;मुण्डकोपनिषद्भाष्यम्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b09" value="माण्डूक्योपनिषद्भाष्यम्" /><label for="b09">&nbsp;माण्डूक्योपनिषद्भाष्यम्</label></li>
							</ul>
							<ul class="fright">
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b10" value="तैत्तिरीयोपनिषद्भाष्यम्" /><label for="b10">&nbsp;तैत्तिरीयोपनिषद्भाष्यम्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b11" value="ऐतरेयोपनिषद्भाष्यम्" /><label for="b11">&nbsp;ऐतरेयोपनिषद्भाष्यम्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b12" value="बृहदारण्यकोपनिषद्भाष्यम्" /><label for="b12">&nbsp;बृहदारण्यकोपनिषद्भाष्यम्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b13" value="छान्दोग्योपनिषद्भाष्यम्" /><label for="b13">&nbsp;छान्दोग्योपनिषद्भाष्यम्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b02" value="श्रीमद्भगवद्गीताभाष्यम्" /><label for="b02">&nbsp;श्रीमद्भगवद्गीताभाष्यम्</label></li>
								<li class="mbot"><input name="check_bhashya[]" type="checkbox" id="b01" value="ब्रह्मसूत्रभाष्यम्" /><label for="b01">&nbsp;ब्रह्मसूत्रभाष्यम्</label></li>
							</ul>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="right" style="padding: 1em 0 0 3em;">
							<input name="submit" type="submit" id="submit" value="अन्वेषणम्"/>
							<input name="reset" type="reset" id="reset" value="सम्मार्जनम्"/>
						</td>
					</tr>
				</table>
			</form>
		</div>
<?php include("keyboard.php");?>
	</div>
</body>
</html>

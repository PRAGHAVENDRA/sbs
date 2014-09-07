<?php require_once('include_requireLogin.php'); ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang= "en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style/indexstyle.css" media ="all" />
	<link rel="stylesheet" type="text/css" href="style/reset.css" media ="all" />
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
		<div class="ch_name" style="margin-top: 10px;font-family: gentium;" class="fgentium">Advaita Sharada - User Details</div>
		<hr />
		<table class="user_details">
			<tr class="hd">
				<td class="tr1">Sl. No.</td>
				<td class="tr2">Name</td>
				<td class="tr3">Information</td>
				<td class="tr4">Visit Count</td>
			</tr>
<?php

include("connect.php");

$query = "select * from details order by userid";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

if($num_rows)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		$row=mysql_fetch_assoc($result);

		$name=$row['name'];
		$info=$row['info'];
		$visitcount=$row['visitcount'];

		echo "<tr>";
		echo "<td class=\"tr1\">$i</td>";
		echo "<td class=\"tr2\">$name</td>";
		echo "<td class=\"tr3\">$info</td>";
		echo "<td class=\"tr4\">$visitcount</td>";
		echo "</tr>";
	}
}

?>
		</table>
	</div>
</body>
</html>

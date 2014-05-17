<?php

require_once("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$bhashya = $_POST['bhashya'];
$hval = $_POST['hval'];
$query_l1 = "select * from bhashya where bid='$bhashya' and level='1'";

if(isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) {
	$query_l1 .= " LIMIT ".(($_GET['page'] - 1)*1).",1";
	require_once("common.php");
} else {
	$query_l1 .= " LIMIT 1";
}

$result_l1 = mysql_query($query_l1);
$num_rows_l1 = mysql_num_rows($result_l1);

if($num_rows_l1)
{
	for($i_l1=1;$i_l1<=$num_rows_l1;$i_l1++)
	{
		$row_l1=mysql_fetch_assoc($result_l1);

		$id=$row_l1['id'];
		$type=$row_l1['type'];
		$ch_title=$row_l1['title'];
		$content=$row_l1['content'];

		echo "<div class=\"chapter hashnav\" id=\"$id\" type=\"$type\">\n";
		echo "<div class=\"ch_name\">$ch_title</div>\n";
		echo "<hr />\n";
		$vids = preg_split("/\;/", $content);
		foreach ($vids as $vid)
		{
			$query_l2 = "select * from bhashya where bid='$bhashya' and level='2' and id='$vid'";
			$result_l2 = mysql_query($query_l2);
			$num_rows_l2 = mysql_num_rows($result_l2);

			$row_l2=mysql_fetch_assoc($result_l2);
			$id=$row_l2['id'];
			$type=$row_l2['type'];
			$s_title=$row_l2['title'];
			$content=$row_l2['content'];

			if($type == "intro_bhashya")
			{
				echo ProcessRef($content, $hval) . "\n";
			}
			else
			{
				if($type == "kaarika")
				{
					echo "<div class=\"kaarika hashnav\" id=\"$id\" type=\"$type\">";
				}
				elseif($type == "gadya")
				{
					echo "<div class=\"gadya hashnav\" id=\"$id\" type=\"$type\">";
				}
				else
				{
					echo "<div class=\"verse hashnav\" id=\"$id\" type=\"$type\">";
				}
				echo ProcessRef($content, $hval) . "\n";
				
				$query_l2b = "select * from bhashya where bid='$bhashya' and level='2b' and id regexp '^$id'";
				$result_l2b = mysql_query($query_l2b);
				$num_rows_l2b = mysql_num_rows($result_l2b);
				if($num_rows_l2b)
				{
					echo "<a href=\"javascript:void(0);\" class=\"show_bhashya\" onclick=\"show_bhashya('#BH_$id')\">भाष्यम्</a>";
					echo "<div class=\"allbhashya hashnav\" id=\"BH_$id\">";
					for($i_l2b=1;$i_l2b<=$num_rows_l2b;$i_l2b++)
					{
						$row_l2b=mysql_fetch_assoc($result_l2b);
						$content=$row_l2b['content'];
						echo ProcessRef($content, $hval) . "\n";
					}
					echo "</div>";
				}
				echo "</div>";
			}
		}
		echo "</div>\n";
	}
}

?>

<?php

require_once("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$bhashya = $_POST['bhashya'];
$hval = $_POST['hval'];
$query_l1 = "select * from bhashya where bid='$bhashya' and level='1'";

if(isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) {
	$_GET['page'] = 1;
	$query_l1 .= " LIMIT ".(($_GET['page'] - 1)*1000).",1000";
	require_once("common.php");
} else {
	$query_l1 .= " LIMIT 1000";
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

		if($type == "intro_bhashya")
		{
			echo ProcessRef($content, $hval) . "\n";
		}
		else
		{
			echo "<div class=\"verse hashnav\" id=\"$id\" type=\"$type\">";
			echo ProcessRef($content, $hval) . "\n";
			
			$query_l3b = "select * from bhashya where bid='$bhashya' and level='1b' and id regexp '^$id'";
			$result_l3b = mysql_query($query_l3b);
			$num_rows_l3b = mysql_num_rows($result_l3b);

			if($num_rows_l3b)
			{
				echo "<a href=\"javascript:void(0);\" class=\"show_bhashya\" onclick=\"show_bhashya('#BH_$id')\">भाष्यम्</a>";
				echo "<div class=\"allbhashya hashnav\" id=\"BH_$id\">";

				for($i_l3b=1;$i_l3b<=$num_rows_l3b;$i_l3b++)
				{
					$row_l3b=mysql_fetch_assoc($result_l3b);

					$content=$row_l3b['content'];
					echo ProcessRef($content, $hval) . "\n";
				}
				echo "</div>";
			}
			echo "</div>";
		}
	}
}

?>

<?php

require_once("connect.php");

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
		
		$query_l2 = "select * from bhashya where bid='$bhashya' and level='2' and id regexp '^$id'";

		$result_l2 = mysql_query($query_l2);
		$num_rows_l2 = mysql_num_rows($result_l2);

		if($num_rows_l2)
		{
			for($i_l2=1;$i_l2<=$num_rows_l2;$i_l2++)
			{
				$row_l2=mysql_fetch_assoc($result_l2);

				$id=$row_l2['id'];
				$type=$row_l2['type'];
				$s_title=$row_l2['title'];
				$content=$row_l2['content'];

				echo "<div class=\"section hashnav\" id=\"$id\" type=\"$type\">";
				echo "<div class=\"ch_name\">$ch_title</div>\n";
				echo "<div class=\"sname\">$s_title</div>\n";		
				echo "<hr />\n";

				$query_l3 = "select * from bhashya where bid='$bhashya' and level='3' and id regexp '^$id'";
				$result_l3 = mysql_query($query_l3);
				$num_rows_l3 = mysql_num_rows($result_l3);

				if($num_rows_l3)
				{
					for($i_l3=1;$i_l3<=$num_rows_l3;$i_l3++)
					{
						$row_l3=mysql_fetch_assoc($result_l3);

						$id=$row_l3['id'];
						$type=$row_l3['type'];
						$s_title=$row_l3['title'];
						$content=$row_l3['content'];

						if($type == "intro_bhashya")
						{
							echo ProcessRef($content, $hval) . "\n";
						}
						else
						{
							echo "<div class=\"verse hashnav\" id=\"$id\" type=\"$type\">";
							echo ProcessRef($content, $hval) . "\n";
							
							$query_l3b = "select * from bhashya where bid='$bhashya' and level='3b' and id regexp '^$id'";
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

				echo "</div>\n";
			}
		}
		echo "</div>\n";
	}
}

?>

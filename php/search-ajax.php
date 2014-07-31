<?php

include("connect.php");
include("common.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

if(isset($_POST['searchtext']))
{
	$check_vb=$_POST['check_vb'];
	
	if(isset($_POST['check_vb'])){$check_vb=$_POST['check_vb'];}else{$check_vb[0] = '';}
	if(isset($_POST['check_bhashya']))
	{
		$check_bhashya=$_POST['check_bhashya'];
	
		$searchtext=$_POST['searchtext'];

		$searchtext = preg_replace("/[\t]+/", " ", $searchtext);
		$searchtext = preg_replace("/[ ]+/", " ", $searchtext);
		$searchtext = preg_replace("/^ +/", "", $searchtext);
		$searchtext = preg_replace("/ +$/", "", $searchtext);
		$searchtext = preg_replace("/  /", " ", $searchtext);
		$searchtext = preg_replace("/  /", " ", $searchtext);
	/*
		$searchtext = preg_replace("/^./u", "", $searchtext);
		$searchtext = preg_replace("/.$/u", "", $searchtext);
	*/
		
		$bfilter = '';
		for($ic=0;$ic<sizeof($check_bhashya);$ic++)
		{
			if($check_bhashya[$ic] != '')
			{
				$bfilter = $bfilter . "|" . $check_bhashya[$ic];
			}
		}
		$bfilter = preg_replace("/^\|/", "", $bfilter);
		
		if($bfilter == ''){$bfilter = '.*';} 
		
		$vbfilter = '';
		for($ic=0;$ic<sizeof($check_vb);$ic++)
		{
			if($check_vb[$ic] == 'V')
			{
				$vbfilter = $vbfilter . "|\_V[0-9]+$|\_K[0-9]+$";
			}
			elseif($check_vb[$ic] == 'B')
			{
				$vbfilter = $vbfilter . "|\_B[0-9]+$|\_I[0-9]+$";
			}
		}
		$vbfilter = preg_replace("/^\|/", "", $vbfilter);
		if($vbfilter != '')
		{
			$vbfilter = " and id REGEXP '" . $vbfilter ."'";
		}
		
		$query = "SELECT * FROM bhashya WHERE content REGEXP '$searchtext' and bid REGEXP '$bfilter'".$vbfilter;
		
		if(isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) {
			$query .= " LIMIT ".(($_GET['page'] - 1)*5).",5";
		} else {
			$query .= " LIMIT 5";
		}
		
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		
		if($num_rows)
		{
			echo "<ul class=\"search_result\">";
			for($i=1;$i<=$num_rows;$i++)
			{
				$row=mysql_fetch_assoc($result);

				$id=$row['id'];
				$address = get_address($id);
				$bid=$row['bid'];
				$type=$row['type'];
				$title=$row['title'];
				$content=$row['content'];
				echo "<li>";
				echo "<div class=\"search_banner\">$address</div>";
/*
				$xml = new SimpleXMLElement($content);
				$content = $xml->__toString();
				$content = GetSnippet($content, $searchtext);
				$content = "<div class=\"".$type."\" id=\"".$id."\">" . $content . "</div>";
*/
				$content = ProcessRef($content, "");
				echo HighlightContent($content, $searchtext);
				$link_id = preg_split("/\_B/", $id);
				$link_id = $link_id[0];
				
				echo ProcessRef("<p class=\"readmore\"><a target=\"_blank\" href=\"".get_bhashya($bid)."_id.html#$link_id#$searchtext\">read on...</a></p>", '');
				echo "</li>";
			}
			echo "</ul>";
		}
		else
		{
			echo"<span class=\"fgentium\">No results</span><br />";
			echo"<span class=\"fgentium clr\"><a href=\"search.php\">Go back and search again</a></span>";
		}
	}
	else
	{
		echo"<span class=\"fgentium\">Please select at least one Bhashya to search within</span><br />";
		echo"<span class=\"fgentium clr\"><a href=\"search.php\">Go back and search again</a></span>";
	}
}
else
{
	echo"<span class=\"fgentium\">No results</span><br />";
	echo"<span class=\"fgentium clr\"><a href=\"search.php\">Go back and search again</a></span>";
}
?>

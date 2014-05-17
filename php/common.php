<?php

function ProcessRef($str, $find)
{
	if($find == '')
	{
		$find = 'content';
	}
	
	$find = preg_replace("/‘/u", "", $find);
	$find = preg_replace("/’/u", "", $find);
	$find = preg_replace("/\(.*\)/u", "", $find);
	$find = preg_replace("/^\ /", "", $find);
	$find = preg_replace("/\ $/", "", $find);
	
	$str = preg_replace("/href=\"([a-zA-Z\_]+)\_id\.html/", "target=\"_blank\" href=\"format.php?bhashya=$1", $str);
	$str = preg_replace("/(href=\"format\.php\?bhashya=[a-zA-Z\_]+)\#([a-zA-Z]+\_C)([0-9][0-9])/", "$1&page=$3#$2$3", $str);
	$str = preg_replace("/<span/", " <span", $str);
	$str = preg_replace("/<\/span>/", "</span> ", $str);
	$str = preg_replace("/ ,/", ",", $str);
	$str = preg_replace("/([०१२३४५६७८९]) । /u", "$1-", $str);
	$str = preg_replace("/($find)/u","<span class=\"highlight\">$1</span>", $str);
	return($str);
}

function InsertIdRef($content)
{
	while(preg_match("/\<span class.*/", $content))
	{
		$content = preg_replace("/\<span class=\"qt/", "<span id=\"quote_".$GLOBALS['idnum']."\" class=\"qt", $content, 1);
		$GLOBALS['idnum']++;
	}
	return($content);
}

function get_address($id)
{
	$address = '';
	$vid = '';
	
	$ids = preg_split("/\_S/", $id);
	if($ids[0] != $id)
	{
		$cid = $ids[0];
		$cid = get_title($cid);
		$bid = $cid[0];
		$address = $address . "&nbsp;।&nbsp;" . $cid[1];		
	}
	$ids = preg_split("/\_V/", $id);
	if($ids[0] != $id)
	{
		$cid = $ids[0];
		$vid = $ids[1];
		$cid = get_title($cid);
		$bid = $cid[0];
		$address = $address . "&nbsp;।&nbsp;" . $cid[1];
	}
	$ids = preg_split("/\_K/", $id);
	if($ids[0] != $id)
	{
		$cid = $ids[0];
		$vid = $ids[1];
		$cid = get_title($cid);
		$bid = $cid[0];
		$address = $address . "&nbsp;।&nbsp;" . $cid[1];
	}
	$ids = preg_split("/\_I/", $id);
	if($ids[0] != $id)
	{
		$cid = $ids[0];
		$cid = get_title($cid);
		$bid = $cid[0];
		$address = $address . "&nbsp;।&nbsp;" . $cid[1];
	}
	$ids = preg_split("/\_B/", $id);
	if($ids[0] != $id)
	{
		$cid = $ids[0];
		$cid = get_title($cid);
		$bid = $cid[0];
		if($cid[1] != '')
		{
			$address = $address . "&nbsp;।&nbsp;" . $cid[1];
		}
	}
	
	if($vid != '')
	{
		$vid = preg_split("/\_B/", $vid);
		$vid = $vid[0];
		$address = $bid . $address . get_adhikarana($id) . "&nbsp;।&nbsp;" . get_versetype($id)."&nbsp;" .convert_devanagari($vid);
	}
	else
	{
		$address = $bid . $address;
	}
	if(preg_match("/\_B/", $id))
	{
		$address .=  "&nbsp;-&nbsp;भाष्यम्";

	}
	
	$address = preg_replace("/\&nbsp\;\।\&nbsp\;\&nbsp\;\।\&nbsp\;/", "&nbsp;।&nbsp;", $address);
	$address = preg_replace("/\&nbsp\;\।\&nbsp\;\&nbsp\;\।\&nbsp\;/", "&nbsp;।&nbsp;", $address);
	return($address);
}

function get_title($id)
{
	if(preg_match("/\_/", $id))
	{
		$query = "SELECT * FROM bhashya WHERE id = '$id'";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row=mysql_fetch_assoc($result);
		$title=$row['title'];
		$bid=$row['bid'];
		$title = preg_replace("/॥/", "", $title);
		$title = preg_replace("/  /", "", $title);
		$title = preg_replace("/^ +/", "", $title);
		$title = preg_replace("/ $/", "", $title);
		
		$ret[0] = $bid;
		$ret[1] = $title;
		return($ret);
	}
	else
	{
		$query = "SELECT bid FROM bhashya WHERE id regexp '^$id'";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$row=mysql_fetch_assoc($result);
		$bid=$row['bid'];
		
		$ret[0] = $bid;
		$ret[1] = '';
		return($ret);
	}
}

function convert_devanagari($vid)
{
	$vid = preg_replace("/^0/", "", $vid);

	$vid = preg_replace("/0/", "०", $vid);
	$vid = preg_replace("/0/", "०", $vid);
	$vid = preg_replace("/1/", "१", $vid);
	$vid = preg_replace("/2/", "२", $vid);
	$vid = preg_replace("/3/", "३", $vid);
	$vid = preg_replace("/4/", "४", $vid);
	$vid = preg_replace("/5/", "५", $vid);
	$vid = preg_replace("/6/", "६", $vid);
	$vid = preg_replace("/7/", "७", $vid);
	$vid = preg_replace("/8/", "८", $vid);
	$vid = preg_replace("/9/", "९", $vid);
	return($vid);
}

function get_versetype($id)
{
	$id = preg_split("/\_B/", $id);
	$id = $id[0];
	$query = "SELECT type FROM bhashya WHERE id='$id'";
	$result = mysql_query($query);
	$row=mysql_fetch_assoc($result);
	$type=$row['type'];
	
	switch($type)
	{
		case "sutra" :	return("सूत्रम्");
		case "mantra" :	return("मन्त्रः");
		case "kaarika" :	return("कारिका");
		default : return("श्लोक");
	}
}

function get_bhashya($bid)
{
	switch($bid)
	{
		case "ब्रह्मसूत्रभाष्यम्" :	return("BS");
		case "काठकोपनिषद्भाष्यम्" :	return("Kathaka");
		case "मुण्डकोपनिषद्भाष्यम्" :	return("Mundaka");
		case "तैत्तिरीयोपनिषद्भाष्यम्" :	return("Taitiriya");
		case "ऐतरेयोपनिषद्भाष्यम्" :	return("Aitareya");
		case "बृहदारण्यकोपनिषद्भाष्यम्" :	return("Brha");
		case "छान्दोग्योपनिषद्भाष्यम्" :	return("Chandogya");
		case "केनोपनिषत् पदभाष्य​म्" :	return("Kena_pada");
		case "केनोपनिषत् वाक्य​भाष्य​म्" :	return("Kena_vakya");
		case "प्रश्नोपनिषद्भाष्यम्" :	return("Prashna");
		case "माण्डूक्योपनिषद्भाष्यम्" :	return("Mandukya");
		case "श्रीमद्भगवद्गीताभाष्यम्" :	return("Gita");
		case "श्वेताश्वतरोपनिषत्" :	return("svt");
		case "कौषीतकिब्राह्मणोपनिषत्" :	return("kst");
		case "ईशावास्योपनिषद्भाष्यम्" :	return("Isha");
		case "जाबालोपनिषत्" :	return("jbl");
		default : return("BS");
	}
}

function GetSnippet($content,$searchtext)
{
	$buffer = 100;
	$max = preg_match_all("/[[:print:]\pL]/u", $content) + preg_match_all("/[[:print:]\pL]/u", $searchtext);
	$min = 0;

	$pos = intval(strpos($content, $searchtext) / 4);
	$start = $pos - $buffer;
	$end = $pos + $buffer;
	if($start<$min){$start = $min;$astart='';}
	if($end>$max){$end = $max;$aend='';}
		
	$sub_content = substr_unicode($content, $start, $end);
	
	if($sub_content == '')
	{
		$start = $max - $buffer;
		$end = $max;
		$sub_content = substr_unicode($content, $start, $end);
	}
	
	while($sub_content == '')
	{
		$start--;
		$sub_content = substr_unicode($content, $start, $end);
	}

	if($end<=$max){$aend='...';}
	if($start>$min){$astart='...';}
	return($astart.$sub_content.$aend);
	
	//~ $count = preg_match_all("/[[:print:]\pL]/u", $content);
	//~ echo $count;	
	//~ $words = preg_split("/\s/",$content);
	//~ return($content);
	//~ foreach($words as $word)
	//~ {
		//~ if(preg_match("/".$searchtext."/u", $word))
		//~ {
			//~ echo $word;
			//~ return($word);
		//~ }
	//~ }
	//~ return('');
	//~ $pos = strpos($content, $searchtext);
	//~ $buffer = 999;
	//~ $start = ($pos - $buffer >= 0) ? $pos - $buffer : 0;
	//~ $end = $start + strlen($searchtext) + $buffer;
	//~ $end = ($end >= strlen($content)) ? strlen($content) : $end;
	//~ $snippets = substr($content, $start, $end);
	//~ return($snippets . "....");
}

function substr_unicode($str, $s, $l)
{
    $r = '/^.{'.(int)$s.'}(.';
    $r .= ($l === null) ? '*)$' : '{'.(int)$l.'})';
    $r .= '/su';
    preg_match($r, $str, $o); return $o[1];
}
function HighlightContent($content, $searchtext)
{
	$content = preg_replace("/($searchtext)/u","<span class=\"highlight\">$1</span>", $content);
	return($content);
}

function get_adhikarana($id)
{
	$id = preg_split("/\_B/", $id);
	$id = $id[0];
	$query = "select title from bhashya where content regexp '$id' and id regexp '\_A'";
	$result = mysql_query($query);
	$row=mysql_fetch_assoc($result);
	$title=$row['title'];
	
	$title = preg_replace("/^[०१२३४५६७८९\.]+/", "", $title);
	$title = preg_replace("/^ +/", "", $title);
	return("&nbsp;।&nbsp;" . $title);
}

function VerifyCredentials($lemail, $lpassword)
{
	session_start();
	include("connect.php");

	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	
	$salt = "shankara";
	$lpassword = sha1($salt.$lpassword);

	$query_l2 = "select count(*) from details where email='$lemail' and password='$lpassword'";
	$result_l2 = mysql_query($query_l2);
	$row_l2=mysql_fetch_assoc($result_l2);
	$num=$row_l2['count(*)'];
	if($num > 0)
	{
		$query_l3 = "update details set visitcount=visitcount+1 where email='$lemail'";
		$result_l3 = mysql_query($query_l3);
		
		$_SESSION['email'] = $lemail;
		$_SESSION['valid'] = 1;
		
		@header("Location: prasthanatraya.php");
		exit;
	}
	else
	{
		@header("Location: login.php?error=3");
		exit;
	}
}

?>

<?php

include("connect.php");
include("common.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$del_query = "DROP TABLE IF EXISTS bhashya";
mysql_query($del_query);

$tc_query = "CREATE TABLE bhashya(id varchar(100),bid varchar(1000),level varchar(3),type varchar(100),title varchar(1000), authorline_id varchar(5), content mediumtext, primary key(id)) ENGINE=MyISAM character set utf8 collate utf8_general_ci";
mysql_query($tc_query);

$GLOBALS['idnum'] = 1;
$bhashya_san = array("BS"=>"ब्रह्मसूत्रभाष्यम्","Kathaka"=>"काठकोपनिषद्भाष्यम्","Mundaka"=>"मुण्डकोपनिषद्भाष्यम्","Taitiriya"=>"तैत्तिरीयोपनिषद्भाष्यम्","Aitareya"=>"ऐतरेयोपनिषद्भाष्यम्","Brha"=>"बृहदारण्यकोपनिषद्भाष्यम्","Chandogya"=>"छान्दोग्योपनिषद्भाष्यम्","Kena_pada"=>"केनोपनिषत् पदभाष्य​म्","Kena_vakya"=>"केनोपनिषत् वाक्य​भाष्य​म्","Prashna"=>"प्रश्नोपनिषद्भाष्यम्","Mandukya"=>"माण्डूक्योपनिषद्भाष्यम्","Gita"=>"श्रीमद्भगवद्गीता","svt"=>"श्वेताश्वतरोपनिषत्","kst"=>"कौषीतकिब्राह्मणोपनिषत्","Isha"=>"ईशावास्योपनिषद्भाष्यम्","jbl"=>"जाबालोपनिषत्");

insert_bhashya_to_db("BS");
echo "BS -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Kathaka");
echo "Kathaka -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Mundaka");
echo "Mundaka -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Taitiriya");
echo "Taitiriya -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Aitareya");
echo "Aitareya -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Brha");
echo "Brha -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Chandogya");
echo "Chandogya -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Kena_pada");
echo "Kena_pada -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Kena_vakya");
echo "Kena_vakya -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Prashna");
echo "Prashna -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Mandukya");
echo "Mandukya -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Gita");
echo "Gita -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("svt");
echo "svt -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("kst");
echo "kst -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("Isha");
echo "Isha -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;
insert_bhashya_to_db("jbl");
echo "jbl -> Insertion Completed\n";
$GLOBALS['idnum'] = 1;

function insert_bhashya_to_db($bhashya)
{
	$bhashya_level = array("BS"=>"4","Kathaka"=>"3","Mundaka"=>"3","Taitiriya"=>"3","Aitareya"=>"3","Brha"=>"3","Chandogya"=>"3","Kena_pada"=>"2","Kena_vakya"=>"2","Prashna"=>"2","Mandukya"=>"2","Gita"=>"2","svt"=>"2","kst"=>"2","Isha"=>"1","jbl"=>"1");
	$flnm = $bhashya . "_id.xml";
	$level = $bhashya_level{$bhashya};

	if (file_exists($flnm)){$xml = simplexml_load_file($flnm);}
	else{exit("Failed to open $flnm");}

	if($level == 4)
	{
		foreach ($xml->div->div->div as $chapter)
		{
			if((string) $chapter['class'] == "up_title")
			{
				$bid = (string) $chapter->__toString();
/*
				$bid = (string) $chapter;
*/
				continue;
			}
			elseif((string) $chapter['class'] != "chapter")
			{
				continue;
			}
			
			$id = (string) $chapter['id'];
			$type = (string) $chapter['type'];
			$level = sizeof(preg_split("/\_/", $id)) - 1;
			$title = (string) $chapter->div[0]->__toString();
/*
			$title = (string) $chapter->div[0];
*/
			$authorline_id = '';
			
			$content = '';
			foreach ($chapter->div as $section)
			{
				if((string) $section['class'] != "section")
				{
					continue;
				}
				$content = $content . ";" . $section['id'];
			}
			$content = preg_replace("/^\;/", "", $content);
			
			$ins_query_l1 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
			$ins_result_l1 = mysql_query($ins_query_l1);
			
			foreach ($chapter->div as $section)
			{
				if((string) $section['class'] != "section")
				{
					continue;
				}
				
				$id = (string) $section['id'];
				$type = (string) $section['type'];
				$level = sizeof(preg_split("/\_/", $id)) - 1;
				$title = (string) $section->div[0]->__toString();
/*
				$title = (string) $section->div[0];
*/
				$authorline_id = '';
				
				$content = '';
				foreach ($section->div as $subsection)
				{
					if(!(((string) $subsection['class'] == "subsection") || ((string) $subsection['class'] == "intro_bhashya")))
					{
						continue;
					}
					$content = $content . ";" . $subsection['id'];
				}
				$content = preg_replace("/^\;/", "", $content);
				
				$ins_query_l2 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
				$ins_result_l2 = mysql_query($ins_query_l2);
				
				foreach ($section->div as $subsection)
				{
					if((string) $subsection['class'] == "intro_bhashya")
					{
						$id = (string) $subsection['id'];
						$type = 'intro_bhashya';
						$level = sizeof(preg_split("/\_/", $id)) - 1;
						$title = '';
						$content = (string) $subsection->asXML();
						$content=InsertIdRef($content);
						$authorline_id = '';
						
						$ins_query_l3 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
						$ins_result_l3 = mysql_query($ins_query_l3);
					}
					if((string) $subsection['class'] == "subsection")
					{
						$id = (string) $subsection['id'];
						$type = (string) $subsection['type'];
						$level = 3;
						$title = (string) $subsection->div[0]->__toString();
/*
						$title = (string) $subsection->div[0];
*/
						$authorline_id = '';
						
						$content = '';
						foreach ($subsection->div as $verse)
						{
							if((string) $verse['class'] != "verse")
							{
								continue;
							}
							$content = $content . ";" . $verse['id'];
						}
						$content = preg_replace("/^\;/", "", $content);
						
						$ins_query_l3 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
						$ins_result_l3 = mysql_query($ins_query_l3);
						
						foreach ($subsection->div as $verse)
						{
							if((string) $verse['class'] == "verse")
							{
								$id = (string) $verse['id'];
								$type = (string) $verse['type'];
								$level = sizeof(preg_split("/\_/", $id));
								$title = '';
								$content = (string) $verse->div[0]->asXML();
								$content=InsertIdRef($content);
								$authorline_id = '';
								
								$ins_query_l4 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
								$ins_result_l4 = mysql_query($ins_query_l4);
								
								foreach ($verse->div as $bhashya)
								{
									if((string) $bhashya['class'] == "bhashya")
									{
										$id = (string) $bhashya['id'];
										$type = "bhashya";
										$level = '4b';
										$title = '';
										$content = (string) $bhashya->asXML();
										$content=InsertIdRef($content);
										$authorline_id = '';
										
										$ins_query_l3b = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
										$ins_result_l3b = mysql_query($ins_query_l3b);
									}
									else
									{
										continue;
									}
								}
							}
							else
							{
								continue;
							}
						}
					}	
					else
					{
						continue;
					}
				}
			}
		}
	}
	elseif($level == 3)
	{
		foreach ($xml->div->div->div as $chapter)
		{
			if((string) $chapter['class'] == "up_title")
			{
				$bid = (string) $chapter->__toString();
/*
				$bid = (string) $chapter;
*/
				continue;
			}
			elseif((string) $chapter['class'] != "chapter")
			{
				continue;
			}
			
			$id = (string) $chapter['id'];
			$type = (string) $chapter['type'];
			$level = sizeof(preg_split("/\_/", $id)) - 1;
			$title = (string) $chapter->div[0]->__toString();
/*
			$title = (string) $chapter->div[0];
*/
			$authorline_id = '';
			
			$content = '';
			foreach ($chapter->div as $section)
			{
				if((string) $section['class'] != "section")
				{
					continue;
				}
				$content = $content . ";" . $section['id'];
			}
			$content = preg_replace("/^\;/", "", $content);
			
			$ins_query_l1 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
			$ins_result_l1 = mysql_query($ins_query_l1);
			
			foreach ($chapter->div as $section)
			{
				if((string) $section['class'] != "section")
				{
					continue;
				}
				
				$id = (string) $section['id'];
				$type = (string) $section['type'];
				$level = sizeof(preg_split("/\_/", $id)) - 1;
				$title = (string) $section->div[0]->__toString();
/*
				$title = (string) $section->div[0];
*/
				$authorline_id = '';
				
				$content = '';
				foreach ($section->div as $verse)
				{
					if(!(((string) $verse['class'] == "verse") || ((string) $verse['class'] == "intro_bhashya")))
					{
						continue;
					}
					$content = $content . ";" . $verse['id'];
				}
				$content = preg_replace("/^\;/", "", $content);
				
				$ins_query_l2 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
				$ins_result_l2 = mysql_query($ins_query_l2);
				
				foreach ($section->div as $verse)
				{
					if((string) $verse['class'] == "verse")
					{
						$id = (string) $verse['id'];
						$type = (string) $verse['type'];
						$level = sizeof(preg_split("/\_/", $id)) - 1;
						$title = '';
						$content = (string) $verse->div[0]->asXML();
						$content=InsertIdRef($content);
						$authorline_id = '';
						
						$ins_query_l3 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
						$ins_result_l3 = mysql_query($ins_query_l3);
						
						foreach ($verse->div as $bhashya)
						{
							if((string) $bhashya['class'] == "bhashya")
							{
								$id = (string) $bhashya['id'];
								$type = "bhashya";
								$level = '3b';
								$title = '';
								$content = (string) $bhashya->asXML();
								$content=InsertIdRef($content);
								$authorline_id = '';
								
								$ins_query_l3b = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
								$ins_result_l3b = mysql_query($ins_query_l3b);
							}
							else
							{
								continue;
							}
						}
						
					}
					elseif((string) $verse['class'] == "intro_bhashya")
					{
						$id = (string) $verse['id'];
						$type = 'intro_bhashya';
						$level = sizeof(preg_split("/\_/", $id)) - 1;
						$title = '';
						$content = (string) $verse->asXML();
						$content=InsertIdRef($content);
						$authorline_id = '';
						
						$ins_query_l3 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
						$ins_result_l3 = mysql_query($ins_query_l3);
					}
					else
					{
						continue;
					}
				}
			}
		}
	}
	elseif($level == 2)
	{
		foreach ($xml->div->div->div as $chapter)
		{
			if((string) $chapter['class'] == "up_title")
			{
				$bid = (string) $chapter->__toString();
/*
				$bid = (string) $chapter;
*/
				continue;
			}
			elseif((string) $chapter['class'] != "chapter")
			{
				continue;
			}
			
			$id = (string) $chapter['id'];
			$type = (string) $chapter['type'];
			$level = sizeof(preg_split("/\_/", $id)) - 1;
			$title = (string) $chapter->div[0]->__toString();
/*
			$title = (string) $chapter->div[0];
*/
			$authorline_id = '';
			
			$content = '';
			foreach ($chapter->div as $verse)
			{
				if(!(((string) $verse['class'] == "verse") || ((string) $verse['class'] == "kaarika") || ((string) $verse['class'] == "intro_bhashya")))
				{
					continue;
				}
				$content = $content . ";" . $verse['id'];
			}
			$content = preg_replace("/^\;/", "", $content);
			
			$ins_query_l1 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
			$ins_result_l1 = mysql_query($ins_query_l1);
			
			foreach ($chapter->div as $verse)
			{
				if((string) $verse['class'] == "verse")
				{
					$id = (string) $verse['id'];
					$type = (string) $verse['type'];
					if($bid == "माण्डूक्योपनिषद्भाष्यम्")
					{
						$level = sizeof(preg_split("/\_/", $id));
					}
					else
					{
						$level = sizeof(preg_split("/\_/", $id)) - 1;
					}
					$title = '';
					$content = (string) $verse->div[0]->asXML();
					$content=InsertIdRef($content);
					$authorline_id = '';
					
					$ins_query_l3 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
					$ins_result_l3 = mysql_query($ins_query_l3);
					
					foreach ($verse->div as $bhashya)
					{
						if((string) $bhashya['class'] == "bhashya")
						{
							$id = (string) $bhashya['id'];
							$type = "bhashya";
							$level = $level."b";
							$level = preg_replace("/bb/", "b", $level);
							$title = '';
							$content = (string) $bhashya->asXML();
							$content=InsertIdRef($content);
							$authorline_id = '';
							
							$ins_query_l3b = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
							$ins_result_l3b = mysql_query($ins_query_l3b);
						}
						else
						{
							continue;
						}
					}
				}
				elseif((string) $verse['class'] == "kaarika")
				{
					$id = (string) $verse['id'];
					$type = 'kaarika';
					$level = sizeof(preg_split("/\_/", $id)) - 1;
					$title = '';
					$content = (string) $verse->div[0]->asXML();
					$content=InsertIdRef($content);
					$authorline_id = '';
					
					$ins_query_l3 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
					$ins_result_l3 = mysql_query($ins_query_l3);
					
					foreach ($verse->div as $bhashya)
					{
						if((string) $bhashya['class'] == "bhashya")
						{
							$id = (string) $bhashya['id'];
							$type = "bhashya";
							$level = '2b';
							$title = '';
							$content = (string) $bhashya->asXML();
							$content=InsertIdRef($content);
							$authorline_id = '';
							
							$ins_query_l3b = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
							$ins_result_l3b = mysql_query($ins_query_l3b);
						}
						else
						{
							continue;
						}
					}
				}
				elseif((string) $verse['class'] == "intro_bhashya")
				{
					$id = (string) $verse['id'];
					$type = 'intro_bhashya';
					$level = sizeof(preg_split("/\_/", $id)) - 1;
					$title = '';
					$content = (string) $verse->asXML();
					$content=InsertIdRef($content);
					$authorline_id = '';
					
					$ins_query_l3 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
					$ins_result_l3 = mysql_query($ins_query_l3);
				}
				else
				{
					continue;
				}
			}
		}
	}
	elseif($level == 1)
	{
		foreach ($xml->div->div->div as $verse)
		{
			if((string) $verse['class'] == "up_title")
			{
				$bid = (string) $verse->__toString();
/*
				$bid = (string) $verse;
*/
				continue;
			}
			if((string) $verse['class'] == "verse")
			{
				$id = (string) $verse['id'];
				$type = (string) $verse['type'];
				$level = sizeof(preg_split("/\_/", $id)) - 1;
				$title = '';
				$content = (string) $verse->div[0]->asXML();
				$content=InsertIdRef($content);
				$authorline_id = '';
				
				$ins_query_l3 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
				$ins_result_l3 = mysql_query($ins_query_l3);

				foreach ($verse->div as $bhashya)
				{
					if((string) $bhashya['class'] == "bhashya")
					{
						$id = (string) $bhashya['id'];
						$type = "bhashya";
						$level = '1b';
						$title = '';
						$content = (string) $bhashya->asXML();
						$content=InsertIdRef($content);
						$authorline_id = '';
						
						$ins_query_l3b = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
						$ins_result_l3b = mysql_query($ins_query_l3b);
					}
					else
					{
						continue;
					}
				}
			}
			elseif((string) $verse['class'] == "intro_bhashya")
			{
				$id = (string) $verse['id'];
				$type = 'intro_bhashya';
				$level = sizeof(preg_split("/\_/", $id)) - 1;
				$title = '';
				$content = (string) $verse->asXML();
				$content=InsertIdRef($content);
				$authorline_id = '';
				
				$ins_query_l3 = "INSERT INTO bhashya values('$id','$bid','$level','$type','$title','$authorline_id','$content')";
				$ins_result_l3 = mysql_query($ins_query_l3);
			}
			else
			{
				continue;
			}
		}
	}
}
?>

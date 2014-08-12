#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];
$bhashya = $ARGV[4];

use Switch;
open(IN, $bhashya."_id.xml") or die "can't open \n";
open(TEMP,">temp.html") or die "can't open 2\n";

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$line = <IN>;
$idref = 1;
$prevUllekha = '';
while($line)
{
	$line =~ s/<\/span>/<\/span>\n/g;
	$line =~ s/<span/\n<span/g;

	@line_splits = split(/\n/,$line);
	
	for($i=0;$i<@line_splits;$i++)
	{
		if($line_splits[$i] =~ /<span class="qt">(.*?)<\/span>/)
		{
			$href = $1;
			if($href =~ /<a.*href="(.*)_id.*".*>(.*)<\/a>/)
			{
				$ref_bhashya = $1;
				$dref = $2;
                
                if($dref =~ /(‘.*’)/)
                {
                    $prevUllekha = $1;
                }
                else
                {
                    $dref = $prevUllekha . " " . $dref;
                }
				$bs_id = get_bhashya_id("quote_".$idref, get_bhashya_code($bhashya));
				
				$bs_id =~ s/\_B[0-9]+//g;
				
				$dref =~ s/([०१२३४५६७८९]) । /$1-/g;

				$page_num = $bs_id;
				$page_num =~ s/.*\_C([0-9]+).*/$1/g;
				$page_num =~ s/.*\_V([0-9]+).*/$1/g;
				print TEMP "<li id=\"sort_".get_sortid($ref_bhashya)."\" type=\"".$ref_bhashya."\" class=\"qt\"><a href=\"".$bhashya."_id.html&page=" . $page_num . "#".$bs_id."#quote_".$idref."\">" . $dref . "</a></li>\n";
				$idref++;
			}
		}
		elsif($line_splits[$i] =~ /<span class="qt_o">(.*?)<\/span>/)
		{
			$ref_bhashya = 'zothers';
			$href = $1;
            if($href =~ /(‘.*’)/)
            {
                $prevUllekha = $1;
            }
            else
            {
                $href = $prevUllekha . " " . $href;
            }
			$bs_id = get_bhashya_id("quote_".$idref, get_bhashya_code($bhashya));
			$bs_id =~ s/\_B[0-9]+//g;
			
			$page_num = $bs_id;
			$page_num =~ s/.*\_C([0-9]+).*/$1/g;
			$page_num =~ s/.*\_V([0-9]+).*/$1/g;
			print TEMP "<li id=\"sort_99\" type=\"".$ref_bhashya."\" class=\"qt\"><a href=\"".$bhashya."_id.html&page=" . $page_num . "#".$bs_id."#quote_".$idref."\">" . $href . "</a></li>\n";
			$idref++;
		}
	}
	$line = <IN>;
}

system("sort temp.html > temp1.html");
system("uniq temp1.html > temp2.html");

close(IN);
close(TEMP);

open(IN,"temp2.html") or die "can't open \n";
open(TEMP,">ullekha/".$bhashya."_ullekha.php") or die "can't open 2\n";

$line = <IN>;

$upnf = '';
$bcount = 0;

while($line)
{
	if($line =~ /.*type="(.*)" class.*/)
	{
		$upn = $1;
		$upn_san = get_upanishat($upn);
		if(!($upnf eq $upn))
		{
			$bcount++;
			if($upnf eq '')
			{
				print TEMP "<li>"."<a id=\"udl1".$bcount."\" href=\"javascript:void(0);\" onclick=\"show_nav_level1('#udl1".$bcount."')\">" . $upn_san . "</a>\n"."<ul class=\"hide\" id=\"udl1".$bcount."ul\">"."\n";
			}
			else
			{
				print TEMP "</ul>\n</li>\n<li>"."<a id=\"udl1".$bcount."\" href=\"javascript:void(0);\" onclick=\"show_nav_level1('#udl1".$bcount."')\">" . $upn_san . "</a>\n"."<ul class=\"hide\" id=\"udl1".$bcount."ul\">"."\n";
			}
			$upnf = $upn;
			$line =~ s/href=\"([a-zA-Z\_]+)\_id\.html/target=\"_blank\" href=\"format.php?bhashya=$1/;
			print TEMP $line;
		}
		else
		{
			$line =~ s/href=\"([a-zA-Z\_]+)\_id\.html/target=\"_blank\" href=\"format.php?bhashya=$1/;
			print TEMP $line;
		}
	}
	$line = <IN>;
}
print TEMP "</ul>\n</li>\n";
close(IN);
close(TEMP);

system("rm temp.html");
system("rm temp1.html");
system("rm temp2.html");

sub get_upanishat()
{
	my($upn) = @_;
	switch ($upn)
	{
		case "Isha" { return("ईशावास्योपनिषत्"); }
		case "Kena_pada" { return("केनोपनिषत् पदभाष्य​म्"); }
		case "Kena_vakya" { return("केनोपनिषत् वाक्य​भाष्य​म्"); }
		case "Kathaka" { return("काठकोपनिषत्"); }
		case "Prashna" { return("प्रश्नोपनिषत्"); }
		case "Mundaka" { return("मुण्डकोपनिषत्"); }
		case "Mandukya" { return("माण्डूक्योपनिषत्"); }
		case "Taitiriya" { return("तैत्तिरीयोपनिषत्"); }
		case "Aitareya" { return("ऐतरेयोपनिषत्"); }
		case "Chandogya" { return("छान्दोग्योपनिषत्"); }
		case "Brha" { return("बृहदारण्यकोपनिषत्"); }
		case "BS" { return("ब्रह्मसूत्रभाष्यम्"); }
		case "Gita" { return("श्रीमद्भगवद्गीता"); }
		case "jbl" { return("जाबालोपनिषत्"); }
		case "kst" { return("कौषीतकिब्राह्मणोपनिषत्"); }
		case "svt" { return("श्वेताश्वतरोपनिषत्"); }
		case "zothers" { return("अन्यत्र"); }
		else { return(""); }
	}
}

sub get_bhashya_code()
{
	my($upn) = @_;
	switch ($upn)
	{
		case "Isha" { return("IS"); }
		case "Kena_pada" { return("KP"); }
		case "Kena_vakya" { return("KV"); }
		case "Kathaka" { return("Ka"); }
		case "Prashna" { return("PR"); }
		case "Mundaka" { return("MD"); }
		case "Mandukya" { return("MK"); }
		case "Taitiriya" { return("T"); }
		case "Aitareya" { return("AI"); }
		case "Chandogya" { return("Ch"); }
		case "Brha" { return("BR"); }
		case "BS" { return("BS"); }
		case "Gita" { return("BG"); }
		case "jbl" { return("JB"); }
		case "kst" { return("KT"); }
		case "svt" { return("SV"); }
		else { return("BS"); }
	}
}

sub get_sortid()
{
	my($upn) = @_;
	switch ($upn)
	{
		case "BS" { return("01"); }
		case "Gita" { return("02"); }
		case "Isha" { return("03"); }
		case "Aitareya" { return("04"); }
		case "Kathaka" { return("05"); }
		case "Kena_pada" { return("06"); }
		case "Kena_vakya" { return("07"); }
		case "kst" { return("08"); }
		case "Chandogya" { return("09"); }
		case "jbl" { return("10"); }
		case "Taitiriya" { return("11"); }
		case "Prashna" { return("12"); }
		case "Brha" { return("13"); }
		case "Mandukya" { return("14"); }
		case "Mundaka" { return("15"); }
		case "svt" { return("16"); }
		else { return("00"); }
	}
}

sub get_bhashya_id()
{
	my($idref,$bhashya) = @_;
	my($sth1);

	$idref =~ s/\_/\_/g;
	$idref = $idref . '"';
	
	$query = "select id from bhashya where id regexp '^".$bhashya."\_' and content regexp '".$idref."'";
	#~ print $query . "\n";
	$sth1=$dbh->prepare($query);
	$sth1->execute();
	$ref1 = $sth1->fetchrow_hashref();
	$id = $ref1->{'id'};
	$sth1->finish();
	return($id);
}	

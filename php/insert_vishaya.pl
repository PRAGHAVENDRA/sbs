#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"vishaya.xml") or die "can't open vishaya.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sthEnc=$dbh->prepare("SET NAMES utf8");
$sthEnc->execute();
$sthEnc->finish();

$sthDel=$dbh->prepare("DROP TABLE IF EXISTS vishaya;");
$sthDel->execute();
$sthDel->finish();

$sth11=$dbh->prepare("CREATE TABLE vishaya(source varchar(5),
bhashya varchar(20),
vid varchar(10),
ref varchar(50),
vakya varchar(2000), primary key(vid)) ENGINE=MyISAM");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

while($line)
{
	if($line =~ /<vishaya_vakya source="(.*)" bhashya="(.*)">/)
	{
		$source = $1;
		$bhashya = $2;
	}
	elsif($line =~ /<vishaya id="(.*)" ref="(.*)">(.*)<\/vishaya>/)
	{
		$vid = $1;
		$ref = $2;
		$vakya = $3;
		insert_vakya($source,$bhashya,$vid,$ref,$vakya);
		$vid = "";
		$ref = "";
		$vakya = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_vakya()
{
	my($source,$bhashya,$vid,$ref,$vakya) = @_;
	my($sth1);
    
    $source =~ s/'/\\'/g;
	$bhashya =~ s/'/\\'/g;
	$vid =~ s/'/\\'/g;
	$ref =~ s/'/\\'/g;
	$vakya =~ s/'/\\'/g;
	
    $sth1=$dbh->prepare("insert into vishaya values('$source','$bhashya','$vid','$ref','$vakya')");
	$sth1->execute();
	$sth1->finish();
}

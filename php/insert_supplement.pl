#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"supplements.xml") or die "can't open supplements.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sthEnc=$dbh->prepare("SET NAMES utf8");
$sthEnc->execute();
$sthEnc->finish();

$sthDel=$dbh->prepare("DROP TABLE IF EXISTS supplements;");
$sthDel->execute();
$sthDel->finish();

$sth11=$dbh->prepare("CREATE TABLE supplements(id varchar(15),
ref varchar(50),
title varchar(1000),
author varchar(1000),
media varchar(50), primary key(id)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

while($line)
{
	if($line =~ /<supplement id="(.*)" ref="(.*)">/)
	{
		$id = $1;
		$ref = $2;
	}
	elsif($line =~ /<title>(.*)<\/title>/)
	{
		$title = $1;
	}
	elsif($line =~ /<author>(.*)<\/author>/)
	{
		$author = $1;
	}
	elsif($line =~ /<media>(.*)<\/media>/)
	{
		$media = $1;
	}
	elsif($line =~ /<\/supplement>/)
	{
		insert_supplement($id,$ref,$title,$author,$media);
		$id = "";
		$ref = "";
		$title = "";
		$author = "";
		$media = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_supplement()
{
	my($id,$ref,$title,$author,$media) = @_;
	my($sth1);
    
    $title =~ s/'/\\'/g;
	$author =~ s/'/\\'/g;
	$media =~ s/'/\\'/g;
	
    $sth1=$dbh->prepare("insert into supplements values('$id','$ref','$title','$author','$media')");
	$sth1->execute();
	$sth1->finish();
}

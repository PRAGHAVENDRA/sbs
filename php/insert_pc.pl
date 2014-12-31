#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"pc.xml") or die "can't open pc.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sthEnc=$dbh->prepare("SET NAMES utf8");
$sthEnc->execute();
$sthEnc->finish();

$sthDel=$dbh->prepare("DROP TABLE IF EXISTS pc;");
$sthDel->execute();
$sthDel->finish();

$sth11=$dbh->prepare("CREATE TABLE pc(ref varchar(50),
vakya varchar(2000)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

while($line)
{
	if($line =~ /<pc ref="(.*)">(.*)<\/pc>/)
	{
		$ref = $1;
		$vakya = $2;
		insert_vakya($ref,$vakya);
		$pcid = "";
		$ref = "";
		$vakya = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_vakya()
{
	my($ref,$vakya) = @_;
	my($sth1);
    
    $ref =~ s/'/\\'/g;
    $vakya =~ s/'/\\'/g;
	
    $sth1=$dbh->prepare("insert into pc values('$ref','$vakya')");
	$sth1->execute();
	$sth1->finish();
}

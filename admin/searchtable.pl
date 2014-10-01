#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];
$volume = $ARGV[4];
$issue = $ARGV[5];

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth11=$dbh->prepare("delete from searchtable where volume='$volume' and issue='$issue'");
$sth11->execute();
$sth11->finish();

$sth1=$dbh->prepare("select * from article where volume='$volume' and issue='$issue' order by page");
$sth1->execute();

while($ref=$sth1->fetchrow_hashref())
{
	$titleid = $ref->{'titleid'};
	$page = $ref->{'page'};
	$page_end = $ref->{'page_end'};
	$title = $ref->{'title'};
	$authid = $ref->{'authid'};
	$authorname = $ref->{'authorname'};
	$year = $ref->{'year'};
	$month = $ref->{'month'};
	$featid = $ref->{'featid'};
		
	$title =~ s/'/\\'/g;
	$authorname =~ s/'/\\'/g;
	
	$sth2=$dbh->prepare("select * from testocr where volume='$volume' and issue='$issue' and cur_page between '$page' and '$page_end'");
	$sth2->execute();
	
	while($ref2=$sth2->fetchrow_hashref())
	{
		$text = $ref2->{'text'};
		$cur_page = $ref2->{'cur_page'};
		$sth4=$dbh->prepare("insert into searchtable values('$title','$authid','$authorname','$featid','$text','$page','$page_end','$cur_page',
		'$volume','$issue','$year','$month','$titleid')");
		$text = '';
		$sth4->execute();
		$sth4->finish();
	}
	$sth2->finish();
}

$sth1->finish();
$dbh->disconnect();

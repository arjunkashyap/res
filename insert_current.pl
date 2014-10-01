#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"current_issue.xml") or die "can't open current_issue.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth11d=$dbh->prepare("DROP TABLE IF EXISTS current_issue");
$sth11d->execute();
$sth11d->finish();

$sth11=$dbh->prepare("CREATE TABLE current_issue(volume varchar(3),
issue varchar(5),
year int(4), 
month varchar(2),
type varchar(20), 
title varchar(1000),
author varchar(100),
text varchar(1000),
page varchar(10)) ENGINE=MyISAM");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

$title='';
$text='';
$author='';
$page='';

while($line)
{
	if($line =~ /<current_issue vnum="(.*)" inum="(.*)" month="(.*)" year="(.*)">/)
	{
		$volume = $1;
		$issue = $2;
		$month = $3;
		$year = $4;
	}	
	elsif($line =~ /<feature_article>/)
	{
		$type = "fa";
	}
	elsif($line =~ /<editorial>/)
	{
		$type = "ed";
	}
	elsif($line =~ /<cover>/)
	{
		$type = "cv";
	}
	elsif($line =~ /<bcover>/)
	{
		$type = "bcv";
	}
	elsif($line =~ /<title>(.*)<\/title>/)
	{
		$title = $1;
	}
	elsif($line =~ /<author>(.*)<\/author>/)
	{
		$author = $1;
	}
	elsif($line =~ /<text>(.*)<\/text>/)
	{
		$text = $1;
	}
	elsif($line =~ /<page>(.*)<\/page>/)
	{
		$page = $1;
	}
	elsif($line =~ /<\/entry>/)
	{
		insert_current($volume,$issue,$year,$month,$type,$title,$author,$text,$page);
		$title='';
		$text='';
		$author='';
		$page='';
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_current()
{
	my($volume,$issue,$year,$month,$type,$title,$author,$text,$page) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	
	$sth1=$dbh->prepare("insert into current_issue values('$volume','$issue','$year','$month','$type','$title','$author','$text','$page')");

	$sth1->execute();
	$sth1->finish();
}

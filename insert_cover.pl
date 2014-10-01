#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"cover.xml") or die "can't open cover.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

#vnum, number, month, year, title, feature, authid, page, 

$sth11d=$dbh->prepare("DROP TABLE IF EXISTS cover");
$sth11d->execute();
$sth11d->finish();

$sth11=$dbh->prepare("CREATE TABLE cover(title varchar(500), 
volume varchar(3),
issue varchar(5),
cid int(5) auto_increment, primary key(cid))auto_increment=10001 ENGINE=MyISAM");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

while($line)
{
	if($line =~ /<cover vnum="(.*)" inum="(.*)">(.*)<\/cover>/)
	{
		$volume = $1;
		$issue = $2;
		$title = $3;
		insert_cover($title,$volume,$issue);
		$title = "";
		$volume = "";
		$issue = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_cover()
{
	my($title,$volume,$issue) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	
	$sth1=$dbh->prepare("insert into cover values('$title','$volume','$issue','')");

	$sth1->execute();
	$sth1->finish();
}

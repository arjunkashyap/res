#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"issue.xml") or die "can't open issue.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$line = <IN>;
while($line)
{
	if($line =~ /<author isfellow="(.*)" lname="(.*)" fname="(.*)">(.*)<\/author>/)
	{
		$lname = $2;
		$fname = $3;
		$isfellow = $1;
		$authorname = $4;
		
		insert_authors($fname,$lname,$isfellow,$authorname);		
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();


sub insert_authors()
{
	my($fname,$lname,$isfellow,$authorname) = @_;

	$fname =~ s/'/\\'/g;
	$lname =~ s/'/\\'/g;
	$authorname =~ s/'/\\'/g;
	
	my($sth,$ref,$sth1);
	$sth = $dbh->prepare("select authid from author where authorname='$authorname' and fname='$fname' and lname='$lname' and isfellow='$isfellow'");
	$sth->execute();
	$ref=$sth->fetchrow_hashref();
	if($sth->rows()==0)
	{
		$sth1=$dbh->prepare("insert into author values('$authorname','$fname','$lname','$isfellow','',null)");
		$sth1->execute();
		$sth1->finish();
	}
	$sth->finish();	
}

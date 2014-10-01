#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"res.xml") or die "can't open res.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth11=$dbh->prepare("CREATE TABLE author(authorname varchar(400),fname varchar(200),lname varchar(200), isfellow boolean, affiliation varchar(1000), authid int(6) auto_increment,  primary key(authid))auto_increment=10001 ENGINE=MyISAM;");
$sth11->execute();
$sth11->finish(); 

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

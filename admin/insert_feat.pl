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
	if($line =~ /<feature>(.*)<\/feature>/)
	{
		$feat_name = $1;
		insert_feature($feat_name);		
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();


sub insert_feature()
{
	my($feat_name) = @_;

	$feat_name =~ s/'/\\'/g;
	
	my($sth,$ref,$sth1);
	$sth = $dbh->prepare("select featid from feature where feat_name='$feat_name'");
	$sth->execute();
	$ref=$sth->fetchrow_hashref();
	if($sth->rows()==0)
	{
		$sth1=$dbh->prepare("insert into feature values('$feat_name',null)");
		$sth1->execute();
		$sth1->finish();
	}
	$sth->finish();	
}

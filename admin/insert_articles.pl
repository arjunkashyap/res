#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];
$volume = $ARGV[4];
$issue = $ARGV[5];

use DBI();

open(IN,"issue.xml") or die "can't open issue.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth11=$dbh->prepare("DELETE FROM article where volume='$volume' and issue='$issue'");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;
$abstract = "";

while($line)
{
	if($line =~ /<volume vnum="(.*)">/)
	{
		$volume = $1;
		print $volume . "\n";
	}
	elsif($line =~ /<issue inum="(.*)" month="(.*)" year="(.*)">/)
	{
		$issue = $1;
		$month = $2;
		$year = $3;
		$count = 0;
		$prev_pages = "";		
	}	
	elsif($line =~ /<title>(.*)<\/title>/)
	{
		$title = $1;
	}
	elsif($line =~ /<feature>(.*)<\/feature>/)
	{
		$feature = $1;
		$featid = get_featid($feature);
	}	
	elsif($line =~ /<page>(.*)<\/page>/)
	{
		$pages = $1;
		($page, $page_end) = split(/-/, $pages);
		if($pages eq $prev_pages)
		{
			$count++;
			$id = "id_" . $volume . "_" . $issue . "_" . $page . "_" . $page_end . "_" . $count; 
		}
		else
		{
			$id = "id_" . $volume . "_" . $issue . "_" . $page . "_" . $page_end . "_0";
			$count = 0;		
		}
		$prev_pages = $pages;		
	}	
	elsif($line =~ /<author isfellow="(.*)" lname="(.*)" fname="(.*)">(.*)<\/author>/)
	{
		$lname = $2;
		$fname = $3;
		$isfellow = $1;
		$authorname = $4;
		$authids = $authids . ";" . get_authid($fname,$lname,$authorname,$isfellow);
		$author_name = $author_name . ";" .$authorname;
	}
	elsif($line =~ /<allauthors\/>/)
	{
		$authids = "0";
		$author_name = "";
		
	}
	elsif($line =~ /<\/entry>/)
	{

		insert_article($title,$authids,$author_name,$featid,$page,$page_end,$volume,$issue,$year,$month,$abstract,$id);
		$authids = "";
		$featid = "";
		$author_name = "";
		$id = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_article()
{
	my($title,$authids,$author_name,$featid,$page,$page_end,$volume,$issue,$year,$month,$abstract,$id) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	$authids =~ s/^;//;
	$author_name =~ s/^;//;
	$author_name =~ s/'/\\'/g;
	
	$sth1=$dbh->prepare("insert into article values('$title','$authids','$author_name','$featid','$page','$page_end',
		'$volume','$issue','$year','$month','$abstract','0','$id')");

	$sth1->execute();
	$sth1->finish();
}

sub get_authid()
{
	my($fname,$lname,$authorname,$isfellow) = @_;
	my($sth,$ref,$authid);

	$fname =~ s/'/\\'/g;
	$lname =~ s/'/\\'/g;
	$authorname =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select authid from author where authorname='$authorname' and 
	fname='$fname' and lname='$lname' and isfellow='$isfellow'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$authid = $ref->{'authid'};
	$sth->finish();
	return($authid);
}

sub get_featid()
{
	my($feature) = @_;
	my($sth,$ref,$featid);

	$feature =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select featid from feature where feat_name='$feature'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$featid = $ref->{'featid'};
	$sth->finish();
	return($featid);
}

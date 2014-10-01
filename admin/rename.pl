#!/usr/bin/perl

$first_page = $ARGV[0];
$volume = $ARGV[1];
$issue = $ARGV[2];

$first_page = int($first_page) - 2;

system("chmod -R 777 Volumes");
system("rm Volumes/issue*");

@files = `ls Volumes/*.djvu`;

$djvucmd = "";
$fl = $files[0];
chop($fl);

$fl=~s/Volumes\///;
$fl=~s/p//;

($name, $ext) = split(/\./, $fl);
$name = int($name);
if($name != $first_page)
{
	$fl = $files[0];
	chop($fl);
	$fl_original = $fl;
	system ("mv $fl_original Volumes/cover1.djvu");
	$djvucmd = $djvucmd . "djvm -c Volumes/index.djvu Volumes/cover1.djvu";
	$fl = $files[1];
	chop($fl);
	$fl_original = $fl;
	system ("mv $fl_original Volumes/cover2.djvu");
	$djvucmd = $djvucmd . " Volumes/cover2.djvu";
	
	for($i=2;$i<@files;$i++)
	{
		$fl = $files[$i];
		chop($fl);
		$fl_original = $fl;
		
		$fl=~s/Volumes\///;
		$fl=~s/p//;
		($name, $ext) = split(/\./, $fl);
		$name = int($name);
			
		$name = $name + $first_page - 1;
		
		if ($name < 10)
		{
			$name = "000".$name;
		}
		elsif ($name < 100)
		{
			$name = "00".$name;
		}
		elsif ($name < 1000)
		{
			$name = "0".$name;
		}
		system ("mv $fl_original Volumes/$name.djvu");
		
		$djvucmd = $djvucmd . " Volumes/$name.djvu";
	}
	system("$djvucmd");
	system("rm Volumes/[0-9][0-9][0-9][0-9].djvu");
	system("djvmcvt -i Volumes/index.djvu Volumes index.djvu");
}

if(!(-e "../Volumes/$volume"))
{
	system("mkdir ../Volumes/$volume");
}
if(!(-e "../Volumes/$volume/$issue"))
{
	system("mkdir ../Volumes/$volume/$issue");
}
system("cp Volumes/*.djvu ../Volumes/$volume/$issue");
system("cp Volumes/*.iff ../Volumes/$volume/$issue");
system("rm Volumes/index.djvu");

@djvu = `ls Volumes/*.djvu`;
for($i=0;$i<@files;$i++)
{
	$fl = $djvu[$i];
	chop($fl);
	$fl_original = $fl;
	
	$fl=~s/Volumes\///;
	$fl=~s/p//;
	($name, $ext) = split(/\./, $fl);
	
	system ("djvused Volumes/$name.djvu -e print-pure-txt > Volumes/$name.txt");
}
system("rm Volumes/*.djvu");
system("rm Volumes/*.iff");

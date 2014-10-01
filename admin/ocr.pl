#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];
$volume = $ARGV[4];
$issue = $ARGV[5];

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth1=$dbh->prepare("delete from testocr where volume='$volume' and issue='$issue'");
$sth1->execute();
$sth1->finish(); 

@txts = `ls Volumes/*.txt`;

for($i=0;$i<@txts;$i++)
{
	$fl = $txts[$i];
	chop($fl);
	$full_text = text_prep($fl);
	$fl=~s/Volumes\///;
	($name, $ext) = split(/\./, $fl);
	
	$sth2=$dbh->prepare("insert into testocr values ('$volume','$issue','$name','$full_text')");
	$sth2->execute();
	$sth2->finish(); 	
}			

if(!(-e "../Text/$volume"))
{
	system("mkdir ../Text/$volume");
}
if(!(-e "../Text/$volume/$issue"))
{
	system("mkdir ../Text/$volume/$issue");
}

system("mv Volumes/*.txt ../Text/$volume/$issue");
system("rm tmp*");

sub text_prep()
{
	my($fl) = @_;
	
	open(IN, $fl) or die("Can not open $fl");
	open(OUT, ">tmp.txt") or die("Can not open $fl");
	@lines = <IN>;
	
	$txt = "";
	
	for($i1=0;$i1<@lines;$i1++)
	{
		chop($lines[$i1]);
	
		$lines[$i1] =~s/ $//;
		
		$txt = $txt." ".$lines[$i1];
	}
	
	$txt=~s/- //g;
	
	$txt=~s/[^0-9a-zA-Z]/ /g;
	
	$txt=~s/  / /g;
	$txt=~s/  / /g;
	$txt=~s/  / /g;
	
	@words = split(/ /, $txt);
	@wordlist = ();
	$text = "";
	
	$k = 0;
	
	for($i2=0;$i2<@words;$i2++)
	{
		$words[$i2]=~s/ //g;
		if(!($words[$i2] =~ /^about$|^above$|^across$|^after$|^again$|^against$|^all$|^almost$|^alone$|^along$|^already$|^also$|^although$|^always$|^among$|^and$|^another$|^any$|^anybody$|^anyone$|^anything$|^anywhere$|^are$|^area$|^areas$|^around$|^ask$|^asked$|^asking$|^asks$|^away$|^back$|^backed$|^backing$|^backs$|^became$|^because$|^become$|^becomes$|^been$|^before$|^began$|^behind$|^being$|^beings$|^best$|^better$|^between$|^big$|^both$|^but$|^came$|^can$|^cannot$|^case$|^cases$|^certain$|^certainly$|^clear$|^clearly$|^come$|^could$|^did$|^differ$|^different$|^differently$|^does$|^done$|^down$|^down$|^downed$|^downing$|^downs$|^during$|^each$|^early$|^either$|^end$|^ended$|^ending$|^ends$|^enough$|^even$|^evenly$|^ever$|^every$|^everybody$|^everyone$|^everything$|^everywhere$|^face$|^faces$|^fact$|^facts$|^far$|^felt$|^few$|^find$|^finds$|^first$|^for$|^four$|^from$|^full$|^fully$|^further$|^furthered$|^furthering$|^furthers$|^gave$|^general$|^generally$|^get$|^gets$|^give$|^given$|^gives$|^going$|^good$|^goods$|^got$|^great$|^greater$|^greatest$|^group$|^grouped$|^grouping$|^groups$|^had$|^has$|^have$|^having$|^her$|^here$|^herself$|^high$|^high$|^high$|^higher$|^highest$|^him$|^himself$|^his$|^how$|^however$|^important$|^interest$|^interested$|^interesting$|^interests$|^into$|^$|^its$|^itself$|^just$|^keep$|^keeps$|^kind$|^knew$|^know$|^known$|^knows$|^large$|^largely$|^last$|^later$|^latest$|^least$|^less$|^let$|^lets$|^like$|^likely$|^long$|^longer$|^longest$|^made$|^make$|^making$|^man$|^many$|^may$|^member$|^members$|^men$|^might$|^more$|^most$|^mostly$|^mrs$|^much$|^must$|^myself$|^necessary$|^need$|^needed$|^needing$|^needs$|^never$|^new$|^new$|^newer$|^newest$|^next$|^nobody$|^non$|^noone$|^not$|^nothing$|^now$|^nowhere$|^number$|^numbers$|^off$|^often$|^old$|^older$|^oldest$|^once$|^one$|^only$|^open$|^opened$|^opening$|^opens$|^order$|^ordered$|^ordering$|^orders$|^other$|^others$|^our$|^out$|^over$|^part$|^parted$|^parting$|^parts$|^per$|^perhaps$|^place$|^places$|^point$|^pointed$|^pointing$|^points$|^possible$|^present$|^presented$|^presenting$|^presents$|^problem$|^problems$|^put$|^puts$|^quite$|^rather$|^really$|^right$|^right$|^room$|^rooms$|^said$|^same$|^saw$|^say$|^says$|^second$|^seconds$|^see$|^seem$|^seemed$|^seeming$|^seems$|^sees$|^several$|^shall$|^she$|^should$|^show$|^showed$|^showing$|^shows$|^side$|^sides$|^since$|^small$|^smaller$|^smallest$|^some$|^somebody$|^someone$|^something$|^somewhere$|^state$|^states$|^still$|^still$|^such$|^sure$|^take$|^taken$|^than$|^that$|^the$|^their$|^them$|^then$|^there$|^therefore$|^these$|^they$|^thing$|^things$|^think$|^thinks$|^this$|^those$|^though$|^thought$|^thoughts$|^three$|^through$|^thus$|^today$|^together$|^too$|^took$|^toward$|^turn$|^turned$|^turning$|^turns$|^two$|^under$|^until$|^upon$|^use$|^used$|^uses$|^very$|^want$|^wanted$|^wanting$|^wants$|^was$|^way$|^ways$|^well$|^wells$|^went$|^were$|^what$|^when$|^where$|^whether$|^which$|^while$|^who$|^whole$|^whose$|^why$|^will$|^with$|^within$|^without$|^work$|^worked$|^working$|^works$|^would $|^year$|^years$|^yet$|^you$|^young$|^younger$|^youngest$|^your$|^yours$/i))
		{
			if(length($words[$i2]) > 2)
			{
				$wordlist[$k] = lc($words[$i2]);
				$k++
			}
		}
	}	
		
	@wordlist = sort(@wordlist);
	
	for($i3=0;$i3<@wordlist;$i3++)
	{
		print OUT $wordlist[$i3]."\n"
	}
	
	close(IN);
	close(OUT);
	
	system("uniq tmp.txt > tmp1.txt");
	
	open(IN, "tmp1.txt") or die("Can not open tmp1.txt");
	open(OUT, ">$fl") or die("Can not open $fl");
	@lines_unique = <IN>;
	
	$full_text = "";
	
	for($i4=0;$i4<@lines_unique;$i4++)
	{
		chop($lines_unique[$i4]);
		$full_text = $full_text . " " . $lines_unique[$i4];
	}
	$full_text =~s/^ //;
	print OUT $full_text;
	close(OUT);
	
	return($full_text);
}

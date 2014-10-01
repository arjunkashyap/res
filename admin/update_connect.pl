#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];
$volume = $ARGV[4];
$issue = $ARGV[5];

open(OUT, ">../php/connect.php") or die("Can not open connect.php");

print OUT "<?php
\$user='".$usr."';
\$password='".$pwd."';
\$database='".$db."';
\$volume='".$volume."';
\$issue='".$issue."';
?>
";

close(OUT);

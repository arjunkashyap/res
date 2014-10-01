#!/bin/sh

host="localhost"
db="res"
usr="root"
pwd="mysql"

echo "drop database res; create database res;" | /usr/bin/mysql -uroot -pmysql
perl insert_author.pl $host $db $usr $pwd
perl insert_feat.pl $host $db $usr $pwd
perl insert_articles.pl $host $db $usr $pwd
perl insert_current.pl $host $db $usr $pwd
perl insert_cover.pl $host $db $usr $pwd
perl ocr.pl $host $db $usr $pwd
perl searchtable.pl $host $db $usr $pwd
echo "create fulltext index ata_index on article (authorname, title);" | /usr/bin/mysql -uroot -pmysql res
echo "create fulltext index text_index on searchtable (text);" | /usr/bin/mysql -uroot -pmysql res
#~ echo "use cs; CREATE TABLE demographic_details(ip varchar(15),country varchar(100),city varchar(100),locationcode varchar(50)) ENGINE=MyISAM;"  | /usr/bin/mysql -uroot -pmysql

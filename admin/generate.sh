#!/bin/bash

host="localhost"
db="res"
usr="root"
pwd="mysql"

volume=$1
issue=$2
first_page=$3

num=$#

if [ $num -ne 3 ]
then 
    echo "Error: Please provide all the required parameters [Volume Issue FirstPage]"
    exit 1
fi

if [ ${#volume} -ne 2 ]
then
	echo "Error: Please enter the Volume number in two digit format"
    exit 1
fi

if [ ${#issue} -eq 1 ] || [ ${#issue} -eq 3 ] || [ ${#issue} -eq 4 ] || [ ${#issue} -gt 5 ]
then
	echo "Error: Please enter the Issue number in either two or five digit format"
    exit 1
fi

perl insert_author.pl $host $db $usr $pwd
perl insert_feat.pl $host $db $usr $pwd
perl insert_articles.pl $host $db $usr $pwd $volume $issue


echo "\nDatabase updated\n"

pdf2djvu -i Volumes/issue.djvu Volumes/issue.pdf
perl rename.pl $first_page $volume $issue

echo "\nDjVu file has been sucessfully created\n"

echo "\nText layer extraction and indexing is under progress\n"

perl ocr.pl $host $db $usr $pwd $volume $issue
perl searchtable.pl $host $db $usr $pwd $volume $issue

echo "\nInsertion of text and search engine optimization has been completed sucessfully\n"

convert issue.png -resize 'x150' ../php/images/cur_issue.png
convert issue.png -resize 'x700' ../php/cover/main/cover_"$volume"_"$issue".png
convert issue.png -resize 'x110' ../php/cover/thumbs/cover_"$volume"_"$issue".png
cp issue.png ../php/images/issue_full_size.png
convert issue.png -resize 'x200' ../php/images/issue.png

convert back.png -resize 'x120' ../php/images/p_image.png
cp back.png ../php/images/back_full_size.png

perl update_connect.pl $host $db $usr $pwd $volume $issue

echo "\nThe issue has been sucessfully uploaded onto the server\n"

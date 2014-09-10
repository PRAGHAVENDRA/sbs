#!/bin/sh

host="localhost"
db="sbs"
usr="root"
pwd="mysql";

echo "create database IF NOT EXISTS sbs character set utf8 collate utf8_general_ci;" | /usr/bin/mysql -uroot -p
#~ echo "CREATE TABLE IF NOT EXISTS details(name varchar(1000),email varchar(100),info varchar(5000),password varchar(100),interest varchar(2000),misc varchar(1000),isverified varchar(1),visitcount int(5), userid int(6) auto_increment, primary key(userid)) ENGINE=MyISAM;" | /usr/bin/mysql -uroot -p sbs
#~ echo "CREATE TABLE IF NOT EXISTS reset (hash varchar(100), email varchar(100), name varchar(1000), password varchar(100), timestamp varchar(100), resetid int(6) AUTO_INCREMENT, PRIMARY KEY (resetid)) ENGINE=MyISAM;" | /usr/bin/mysql -uroot -p sbs

php insert_db.php
perl insert_vishaya.pl $host $db $usr $pwd
perl insert_supplement.pl $host $db $usr $pwd

perl gen_ullekha.pl $host $db $usr $pwd Isha
perl gen_ullekha.pl $host $db $usr $pwd Kena_pada
perl gen_ullekha.pl $host $db $usr $pwd Kena_vakya
perl gen_ullekha.pl $host $db $usr $pwd Kathaka
perl gen_ullekha.pl $host $db $usr $pwd Prashna
perl gen_ullekha.pl $host $db $usr $pwd Mundaka
perl gen_ullekha.pl $host $db $usr $pwd Mandukya
perl gen_ullekha.pl $host $db $usr $pwd Taitiriya
perl gen_ullekha.pl $host $db $usr $pwd Aitareya
perl gen_ullekha.pl $host $db $usr $pwd Chandogya
perl gen_ullekha.pl $host $db $usr $pwd Brha
perl gen_ullekha.pl $host $db $usr $pwd BS
perl gen_ullekha.pl $host $db $usr $pwd Gita

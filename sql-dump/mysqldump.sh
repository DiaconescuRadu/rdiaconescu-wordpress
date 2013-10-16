#!/bin/bash
#dumping the database for a certain database
date=`date +%y%m%d`
if [ $# -ne 1 ]; then
	echo "Wrong number of params, please add the dump file";
	exit
fi

mysqldump --add-drop-table -h localhost\
 -u radi -p radi | bzip2\
 -c > $date$1.sql.bz2

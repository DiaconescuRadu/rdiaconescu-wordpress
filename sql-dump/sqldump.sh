#!/bin/bash
#dumping the database for a certain database
date=`date +%y_%m_%d_%H_%M`
if [ $# -ne 1 ]; then
	echo "Wrong number of params, please add the dump file";
	exit
fi

hostname=$(hostname);

if [ "$hostname" = "mongolia" ]; then 
    mysqldump --add-drop-table -h localhost\
     --user=radi -p radi | bzip2\
     -c > $date$1.sql.bz2
else
    mysqldump --add-drop-table -h localhost\
     --user=radi --password=X7Wr5KzR radi | bzip2\
     -c > $date$1.sql.bz2
fi

#!/bin/bash
#dumping the database for a certain database
date=`date +%y%m%d`
if [ $# -ne 1 ]; then
	echo "Wrong number of params, please add the dump file";
	exit
fi

hostname=$(hostname);
sqlfile=`echo $1 | sed -e 's/.bz2//'`

if [ ! -e $sqlfile ]; then
    bunzip2 -k $1
fi

if [ "$hostname" = "vpstesting" ]; then 
    echo hostname is vpstesting
    cat $sqlfile | sed -e "s/www.diaconescuradu.com/localhost:10080/g" | mysql --user=radi --password=X7Wr5KzR radi
else
    echo hostname is mongolia
    cat $sqlfile | sed -e "s/localhost:10080/www.diaconescuradu.com/g" | mysql --user=radi --password=X7Wr5KzR radi
fi

rm -rf $sqlfile

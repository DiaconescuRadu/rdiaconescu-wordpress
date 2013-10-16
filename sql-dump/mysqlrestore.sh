#!/bin/bash
#dumping the database for a certain database
date=`date +%y%m%d`
if [ $# -ne 1 ]; then
	echo "Wrong number of params, please add the dump file";
	exit
fi

hostname=$(hostname);

echo $hostname;

if [ "$hostname" = "vpstesting" ]; then 
    echo hostname is vpstesting
    cat $1 | sed -e "s/www.diaconescuradu.com/localhost:10080/g" | mysql -u radi -p radi
else
    echo hostname is mongolia
    cat $1 | sed -e "s/localhost:10080/www.diaconescuradu.com/g" | mysql -u radi -p radi
fi

#!/bin/bash
if [ $# -ne 1 ]; then
	echo "Wrong number of params, please add the dump file";
	exit
fi
mysql -u radi -p radi < $1

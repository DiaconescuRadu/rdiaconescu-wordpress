#!/bin/bash
date=`date +%y%m%d`
mysqldump --add-drop-table -h localhost\
 -u radi -p radi | bzip2\
 -c > $date$1.sql.bz2

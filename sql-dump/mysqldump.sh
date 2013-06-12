#!/bin/bash
date=`date +%y%m%d`
mysqldump --add-drop-table -h localhost\
 -u radi -p radi | bzip2\
 -c > $date.sql.bz2

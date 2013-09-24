#!/bin/bash
cd /home/radi/wordpress
exec ctags-exuberant \
-h \".php\" -Ra -f /home/radi/rdiaconescu-wordpress/wp-content/themes/responsive/tags \
--exclude=\"\.svn\" \
--totals=yes \
--tag-relative=yes \
--PHP-kinds=+cf \
--regex-PHP='/abstract class ([^ ]*)/\1/c/' \
--regex-PHP='/interface ([^ ]*)/\1/c/' \
--regex-PHP='/(public |static |abstract |protected |private )+function ([^ (]*)/\2/f/'

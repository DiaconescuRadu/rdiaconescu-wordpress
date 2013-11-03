#/bin/bash
rsync -vr -I --size-only -e 'ssh -p 10022' radi@localhost:/home/radi/rdiaconescu-wordpress/wp-content/uploads/20* .

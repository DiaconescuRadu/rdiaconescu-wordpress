#!/bin/bash

for orig_filename in `cat originals.txt`; do
    #echo $i;
    #orig_filename=`echo $i | sed -e "s/\(.*\)\.\(.*\)/\1_orig.\2/"`;
    filename=`echo $orig_filename | sed -e "s/\(.*\)_orig\.\(.*\)/\1.\2/"`;
    convert -quality 97 -resize 1300x700 -unsharp 2x0.5+0.6+0 $orig_filename $filename
    #echo $orig_filename;
    #if [ -e "$filename" ];then
        #convert -quality 98 -resize 1300x700 -unsharp 2x0.5+0.6+0 DSC_6293_orig.jpg DSC_6293.jpg
    #    echo "$filename";
    #fi
done

#convert -quality 98 -resize 1300x700 -unsharp 2x0.5+0.6+0 DSC_6293_orig.jpg DSC_6293.jpg

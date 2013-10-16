#!/bin/bash
count=0
for i in `ls cover_photos/`; do
    let count++;
    cp cover_photos/$i header_slider_images/cover_photo_$count.jpg;
done

#!/bin/bash
cd cropped

while read line; do
	wget "http:$line";

done < ../filelist

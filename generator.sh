#!/bin/bash
while [ 1 ]; do
	curl -s http://explosm.net/rcg | grep img | grep files | awk -F'"' '{ print $4 }' >> filelist
	tail -1 filelist
done

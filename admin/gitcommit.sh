#!/bin/bash
#git add -A 
git add .
git commit -m $(date +%Y%m%d-%H%M%S)
git push origin master

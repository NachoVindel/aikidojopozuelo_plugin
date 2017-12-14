#!/bin/bash

if (( $# < 1 )); then
    git add -A 
    git commit -m $(date +%T)
    git push origin master
else

    git add -A
    git commit -m $1
    git push origin master

fi
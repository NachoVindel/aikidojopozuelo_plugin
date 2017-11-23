#!/bin/bash

if (( $# < 1 )); then
    git add .
    git commit -m "nuevo commit"
    git push origin master
else

    git add .
    git commit -m $1
    git push origin master

fi
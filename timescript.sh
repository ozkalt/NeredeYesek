#!/bin/bash

A=10
D=2301
E=1101

while true; do
    sleep 3600;
    B=$(python pythonapi.py)
    CHECK=$(date +"%H%d");
    if [ $CHECK == $D ]; then
        C=1;
    elif [ $CHECK == $E ]; then
        C=2;
    else
        C=0;
    fi


	NOW=$(date +"%H");
    if [ $NOW == $A ]; then
		./app $B $C
	fi
done

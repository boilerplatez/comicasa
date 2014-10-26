#!/bin/bash

#git push
echo "Rudrax Shell"

if [ "$1" = "clear" ]
then
     sudo rm -r build/*
elif [ "$1" = "setup" ]
then
	mkdir -p build
	sudo chmod 777 build
else
    echo "no action"
fi

#zip -9 -r --exclude=*.git* --exclude="composer"  lib.zip lib



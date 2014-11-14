#!/bin/sh

export outputDirectory=${PWD}/build

clear
echo
echo Determining build directory structure
echo

if [ ! -d "$outputDirectory" ]; then
 echo Creating Directory $outputDirectory
 mkdir $outputDirectory
fi

echo -------------------------------------------------------------
echo Output Directory for Build: ${outputDirectory}
echo -------------------------------------------------------------
echo
echo
echo --------------------Building PHP SDK-------------------------
echo
echo Running Composer to make sure all dependencies are installed
php composer.phar install

echo
echo
php buildPhar.php

echo
echo
echo Contents of Build output @: $outputDirectory
ls $outputDirectory

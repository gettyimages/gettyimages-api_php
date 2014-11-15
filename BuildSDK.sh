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
echo Checking Build Dependencies
echo ..composer.phar

if [ ! -f ${PWD}/composer.phar ]; then
  echo Fetching composer.phar
  curl -sS https://getcomposer.org/installer | php
else
  echo Updating composer.phar inplace
  php composer.phar self-update
fi


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

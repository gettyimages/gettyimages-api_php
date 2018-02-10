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
  if [ -f ${PWD}/composer.lock ]; then
    rm composer.lock
  fi
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


if [[ ":$PATH:" == *":${PWD}/vendor/behat/behat/bin:"* ]]; then
  echo Behat already in path skipping
else
  echo Registering Behat in the path
  export PATH="${PATH}:${PWD}/vendor/behat/behat/bin"
fi


echo
echo
echo To run BDD scenarios
echo php ./vendor/behat/behat/bin/behat
echo or
echo behat

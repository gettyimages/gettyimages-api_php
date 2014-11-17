@echo off

set outputDirectory=%~dp0%build\
set currentDirectory=%~dp0%

echo %currentDirectory%

exit

cls
echo.
echo Determining build directory structure
echo.

IF NOT EXIST %outputDirectory%
  echo Creating Directory %outputDirectory%
  mkdir %outputDirectory%

echo -------------------------------------------------------------
echo Output Directory for Build: %outputDirectory%
echo -------------------------------------------------------------
echo.
echo Checking Build Dependencies
echo ..composer.phar

IF NOT EXIST %currentDirectory%composer.phar (
  echo Fetching composer.phar
  IF EXIST %currentDirectory%composer.lock (del composer.lock)
  curl -sS https://getcomposer.org/installer | php
) else (
  echo Updating composer.phar inplace
  php composer.phar self-update
)

echo.
echo --------------------Building PHP SDK-------------------------
echo.
echo Running Composer to make sure all dependencies are installed
php composer.phar install

echo.
echo.
php buildPhar.php

echo.
echo.
echo Contents of Build output @: %outputDirectory%
dir %outputDirectory%
echo ;%PATH%; | find /C /I ";%currentDirectory%vendor/behat/behat/bin;"

:: if [[ ":$PATH:" == *":${PWD}/vendor/behat/behat/bin:"* ]]; then
::  echo Behat already in path skipping
:: else
::  echo Registering Behat in the path
::  export PATH="${PATH}:${PWD}/vendor/behat/behat/bin"
:: fi

echo
echo
echo To run BDD scenarios
echo php ./vendor/behat/behat/bin/behat
echo or
echo behat

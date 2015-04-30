@echo off

set outputDirectory=%~dp0%build\
set currentDirectory=%~dp0%

cls
echo(
echo Determining build directory structure
echo(

IF NOT EXIST %outputDirectory% (
  echo Creating Directory %outputDirectory%
  mkdir %outputDirectory%
)

echo -------------------------------------------------------------
echo Output Directory for Build: %outputDirectory%
echo -------------------------------------------------------------
echo(
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

echo(
echo --------------------Building PHP SDK-------------------------
echo(
echo Running Composer to make sure all dependencies are installed
rem php composer.phar install

echo(
echo(
rem php buildPhar.php

echo(
echo(
echo Contents of Build output @: %outputDirectory%
dir /B %outputDirectory%
echo ;%PATH%; | find /C /I ";%currentDirectory%vendor/behat/behat/bin;" > nul

IF %ERRORLEVEL% == 1 (
  echo Behat not found adding to the path
  set PATH="%PATH%;%currentDirectory%vendor/behat/behat/bin"
) else (
  echo BEHAT found
)

echo(
echo To run BDD scenarios
echo php ./vendor/behat/behat/bin/behat
echo or
echo behat

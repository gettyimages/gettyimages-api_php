@echo off

set outputDirectory=%~dp0%build\

cls
echo.
echo Determining build directory structure
echo.

IF NOT EXIST %outputDirectory% mkdir %outputDirectory%

echo -------------------------------------------------------------
echo Output Directory for Build: %outputDirectory%
echo -------------------------------------------------------------
echo.
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
dir .\build
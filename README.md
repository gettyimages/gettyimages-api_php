# Getty Images API SDK - PHP
[![Build Status](https://travis-ci.org/gettyimages/gettyimages-api_php.svg?branch=master)](https://travis-ci.org/gettyimages/gettyimages-api_php)

## Initial Setup
### Assumptions
* You have PHP >=5.4 setup

### PHP.ini settings to build the code
    [Phar]
    ; http://php.net/phar.readonly
    phar.readonly = Off

	//Extensions
	extension=php_curl.dll
	extension=php_mbstring.dll
	extension=php_exif.dll
	extension=php_sockets.dll
    extension=php_openssl.dll

## Install via Composer
Please refer to README_ComposerInstall.md

## Quick Build
If everything is setup on your machine where PHP will run, you can most likely run BuildSDK.bat or Build.sh to automatically build the phar. If something fails please read the error messages, PHP can have a finicky setup if you've never tried to use it to build a package before.

### Windows

    Build.bat

### *nix / OSX

    Build.sh

This will put GettyImagesApi.phar in a build folder. Then you can use the package as you would any other phar.

The build does a few things for you automatically
1. Determines if you have composer.phar and will retrieve it if you don't have it
1. Runs composer install to get dependencies that are outlined in the composer.json file
1. Then produces the phar file in ./build/GettyImagesApi.phar

## Manually Installing PHP libraries

BuildSDK should get all the dependencies for you but if you want to do the update without a build
From the root of the repository

    php composer.phar install

### If you want the BDD dependencies

    php composer.phar install --require-dev

This command should install behat (the bdd framework) and any other php dependency libraries

## To get BDD scenarios for running the tests
git submodule update --init


## Environment variables of interest

The sdk does support using a proxy directly as well as ignoring ssl validation errors. This can be configured through the existense environment variables

    GettyImagesApi_IgnoreSSLValidation
    GettyImagesApi_UseProxy

### *nix Shell Example:

    export GettyImagesApi_IgnoreSSLValidation=TRUE
    export GettyImagesApi_UseProxy=127.0.0.0:8888

### Windows CMD Example:

    set GettyImagesApi_IgnoreSSLValidation=TRUE
    set GettyImagesApi_UseProxy=127.0.0.0:8888

### Powershell Example

    $env:GettyImagesApi_IgnoreSSLValidation=TRUE
    $env:GettyImagesApi_UseProxy="127.0.0.0:8888"

# Running BDD Scenarios

If you'd like to run the SDK through it's passes using your credentials, you can do this by creating the following environment variables prior to executing the behat infrastructure

#### Credential Environment Variables

    //If you only have sandbox credentials that you got through signing up
    GettyImagesApi_SandboxApiKey
    GettyImagesApi_SandboxApiSecret

    //If you only have an api key and api secret only export the first two variables.
    //Sandbox credentials can be used in most of the cases where key and secret are used
    GettyImagesApi_ApiKey
    GettyImagesApi_ApiSecret

    //If you're a getty images partner and have a username and password, export these variables
    GettyImagesApi_UserName
    GettyImagesApi_Password

#### Execute the tests

Note that depending on your actual credentials some of these scenarios may very well fail. The scenario should call out the type of credentials being used before the test executes.


    php ./vendor/behat/behat/bin/behat

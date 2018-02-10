# Getty Images API SDK - PHP

# Deprecated

As of November 2016, we will no longer be improving or maintaining this SDK. The API is still alive and under active feature development. Current documentation can be found at [developers.gettyimages.com/docs/](http://developers.gettyimages.com/docs/).
SDK source code remains open source, providing a technology example of interaction with the Getty Images API. We will no longer take pull requests for this repository.


## Introduction
This SDK makes using the Getty Images [API](http://developers.gettyimages.com) easy. It handles credential management, makes HTTP requests and is written with a fluent style in mind. The [API Documentation](https://github.com/gettyimages/gettyimages-api) is located on Github.

## Initial Setup
### Assumptions
* You have PHP >=5.4 setup

### PHP.ini settings to build the code
    [Phar]
    ; http://php.net/phar.readonly
    phar.readonly = Off

	//Extensions needed for Windows OSs
	extension=php_curl.dll
	extension=php_mbstring.dll
	extension=php_exif.dll
	extension=php_sockets.dll
    extension=php_openssl.dll

## Install via Composer
Please refer to [README_ComposerInstall.md](./README_ComposerInstall.md)

## Quick Build
If everything is setup on your machine where PHP will run, you can most likely run BuildSDK.bat or Build.sh to automatically build the phar. If something fails please read the error messages, PHP can have a finicky setup if you've never tried to use it to build a package before.

### Windows

    build.bat

### *nix / OSX

    ./build.sh

This will put GettyImagesApi.phar in a build folder. Then you can use the package as you would any other phar.

The build does a few things for you automatically

1. Determines if you have composer.phar and will retrieve it if you don't have it
1. Runs `composer install` to get dependencies that are outlined in the composer.json file
1. Then produces the phar file in ./build/GettyImagesApi.phar

## Manually Installing PHP libraries

BuildSDK should get all the dependencies for you but if you want to do the update without a build
From the root of the repository

    php composer.phar install

### If you want the BDD dependencies

    php composer.phar install --require-dev

This command should install behat (the bdd framework) and any other php dependency libraries


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

## Tests

### Running BDD Scenarios
The test project contains scenarios written in the [Gherkin language](https://github.com/cucumber/gherkin/wiki).

If you'd like to run the SDK through it's paces using your credentials, you can do this by creating the following environment variables prior to executing the behat infrastructure

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

To execute a specific feature, run the same command above and include the location of the feature

    php ./vendor/behat/behat/bin/behat features/authentication.feature

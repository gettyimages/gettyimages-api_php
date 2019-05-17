# Getty Images API SDK - PHP
[![Build Status](https://travis-ci.org/gettyimages/gettyimages-api_php.svg?branch=master)](https://travis-ci.org/gettyimages/gettyimages-api_php)  

## Introduction
This SDK makes using the Getty Images [API](http://developers.gettyimages.com) easy. It handles credential management, makes HTTP requests and is written with a fluent style in mind. For more info about the API, see the [Documentation](https://developers.gettyimages.com/api/).

* Search for images and videos from our extensive creative and editorial catalogs.
* Get image and video metadata.
* Download files using your Getty Images products (e.g., Editorial subscriptions, Easy Access, Thinkstock Subscriptions, and Image Packs).
* Custom Request functionality that allows user to call any endpoint.

## Help & Support

* [Getty Images API](http://developers.gettyimages.com/)
* [Contact Developer Support](mailto:apisupport@gettyimages.com)
* [Issue Tracker](https://github.com/gettyimages/gettyimages-api_php/issues)

## Getting started
### Installing the package
The SDK is available on [Packagist](https://packagist.org/packages/gettyimages/gettyimages-api).

## Examples
See [example.md](https://github.com/gettyimages/gettyimages-api_php/blob/master/examples/example.md) for examples.

## Building From Source Code
_Source code is only needed if you would like to contribute to the project. Otherwise, use the [package](https://packagist.org/packages/gettyimages/gettyimages-api)_

## Initial Setup
### Assumptions
* You have PHP >=7.0 setup

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

### Linux / OSX

#### Prerequisites 
On Ubuntu, you may need to install a few additional packages

```sh
sudo apt update
sudo apt install php-xml php-mbstring
```
#### Building

```sh
./build.sh
```

This will put GettyImagesApi.phar in a build folder. Then you can use the package as you would any other phar.

The build does a few things for you automatically

1. Determines if you have composer.phar and will retrieve it if you don't have it
1. Runs `composer install` to get dependencies that are outlined in the composer.json file
1. Then produces the phar file in ./build/GettyImagesApi.phar

## Manually Installing PHP libraries

BuildSDK should get all the dependencies for you but if you want to do the update without a build
From the root of the repository

    php composer.phar install

### If you want the test dependencies

    php composer.phar install --require-dev

This command should install PHPUnit and any other php dependency libraries


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

### Running unit tests
The test project contains unit tests written using the [PHPUnit Framwork](https://phpunit.de/index.html).

### Execute the unit tests
#### Assumptions
* You have PHPUnit installed

To execute all of the unit tests:
    ./vendor/bin/phpunit --bootstrap vendor/autoload.php unitTests/.

To execute one test class:
    ./vendor/bin/phpunit --bootstrap vendor/autoload.php unitTests/EXAMPLETEST

# Initial Setup

## Assumptions
* You have PHP >=5.4 setup

## Quick Build
If everything is setup on your machine where PHP will run, you can most likely run BuildSDK.bat or BuildSDK.sh to automatically run composer and then the Phar creation process.

    BuildSDK.bat
	
This will put ConnectSDK.phar in a build folder. Then you can use the package as you would any other phar.

## To get BDD scenarios
git submodule update --init

## Installing PHP libraries
From the root of the repository

    php composer.phar install

This command should install behat (the bdd framework) and any other php dependency libraries

## Environment variables of interest

The sdk does support using a proxy directly as well as ignoring ssl validation errors. This can be configured via having environment variables

    ConnectSDK_IgnoreSSLValidation
    ConnectSDK_UseProxy

### *nix Shell Example:

    export ConnectSDK_IgnoreSSLValidation=TRUE
    export ConnectSDK_UseProxy=127.0.0.0:8888

### Windows CMD Example:

    set ConnectSDK_IgnoreSSLValidation=TRUE
    set ConnectSDK_UseProxy=127.0.0.0:8888

### Powershell Example
    
    $env:ConnectSDK_IgnoreSSLValidation=TRUE
    $env:ConnectSDK_UseProxy="127.0.0.0:8888"

## Running BDD Scenarios

    php ./vendor/behat/behat/bin/behat
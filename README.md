Nyan Cat result printer for PHPUnit
===================================

[![Nyan Cat result printer for PHPUnit](https://github.com/whatthejeff/nyancat-phpunit-resultprinter/raw/master/nyan.png)](https://github.com/whatthejeff/nyancat-phpunit-resultprinter/raw/master/nyan.png)

## Requirements

The Nyan Cat result printer for PHPUnit works with PHP 5.3.3 or later.

## Installation

The recommended way to install the Nyan Cat result printer for PHPUnit is
[through composer](http://getcomposer.org). Just create a `composer.json` file
and run the `php composer.phar install --dev` command to install it:

    {
        "require-dev": {
            "whatthejeff/nyancat-phpunit-resultprinter": "1.0.*@dev"
        }
    }

Once installed, add the following attributes to the `<phpunit>` element in your
`phpunit.xml` file:

    printerFile="vendor/whatthejeff/nyancat-phpunit-resultprinter/src/NyanCat/PHPUnit/ResultPrinter.php"
    printerClass="NyanCat\PHPunit\ResultPrinter"

## Acknowledgements

The Nyan Cat result printer for PHPUnit was __heavily__ inspired by the
glorious [mocha/nyan.js](https://github.com/visionmedia/mocha/blob/master/lib/reporters/nyan.js).

## License

The Nyan Cat result printer for PHPUnit is licensed under the [MIT license](LICENSE).
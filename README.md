<p><img alt="Video of the Nyan Cat result printer for PHPUnit" src="https://github.com/whatthejeff/nyancat-phpunit-resultprinter/raw/master/nyan.gif"></p>

## Requirements

The Nyan Cat result printer for PHPUnit works with PHP 5.3.3 or later.

## Installation

The recommended way to install the Nyan Cat result printer for PHPUnit is
[through composer](http://getcomposer.org). Just create a `composer.json` file
and run the `php composer.phar install` command to install it:

~~~json
{
    "require-dev": {
        "whatthejeff/nyancat-phpunit-resultprinter": "~1.2"
    }
}
~~~

Once installed, add the following attributes to the `<phpunit>` element in your
`phpunit.xml` file:

    printerFile="vendor/whatthejeff/nyancat-phpunit-resultprinter/src/NyanCat/PHPUnit/ResultPrinter.php"
    printerClass="NyanCat\PHPUnit\ResultPrinter"

**NOTE:** If PHPUnit was not installed via composer, you also need to include
the composer autoloader. One easy way to do this is to add the following
attribute to the `<phpunit>` element in your `phpunit.xml` file:

    bootstrap="vendor/autoload.php"

**NOTE:** Windows shell (cmd.exe) is not rendering ANSI characters correctly.
However, there is a nice tool [ansicon](https://github.com/adoxa/ansicon) which handles this issues.
After installing it your Windows shell will be able to render The Nyan Cat:

    ansicon -i

## Tests

[![Build Status](https://travis-ci.org/whatthejeff/nyancat-phpunit-resultprinter.png?branch=master)](https://travis-ci.org/whatthejeff/nyancat-phpunit-resultprinter)

To run the test suite, you need [composer](http://getcomposer.org).

    $ php composer.phar install
    $ vendor/bin/phpunit

## Acknowledgements

The Nyan Cat result printer for PHPUnit was __heavily__ inspired by the
glorious [mocha/nyan.js](https://github.com/visionmedia/mocha/blob/master/lib/reporters/nyan.js).

## License

The Nyan Cat result printer for PHPUnit is licensed under the [MIT license](LICENSE).


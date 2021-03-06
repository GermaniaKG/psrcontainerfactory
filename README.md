# GermaniaKG · psrcontainerfactory


[![Packagist](https://img.shields.io/packagist/v/germania-kg/psrcontainerfactory.svg?style=flat)](https://packagist.org/packages/germania-kg/psrcontainerfactory)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/psrcontainerfactory.svg)](https://packagist.org/packages/germania-kg/psrcontainerfactory)
[![Build Status](https://img.shields.io/travis/GermaniaKG/psrcontainerfactory.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/psrcontainerfactory)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/psrcontainerfactory/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/psrcontainerfactory/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/psrcontainerfactory/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/psrcontainerfactory/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/psrcontainerfactory/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/psrcontainerfactory/build-status/master)


## Installation with Composer

```bash
$ composer require germania-kg/psrcontainerfactory
```

The PsrContainerFactory works with both **Pimple DIC** or **PHP-DI.** One of these must be installed. – N.B. that Pimple has aged and PHP-DI has evolved becoming kind of the DI library standard.

```bash
$ composer require php-di/php-di
$ composer require pimple/pimple
```

## Usage

The callable accepts *arrays*, StdClass *objects* and other instances of *ContainerInterface*.

```php
<?php
use Germania\PsrContainerFactory\PsrContainerFactory;
use Psr\Container\ContainerInterface;

$psr11 = (new PsrContainerFactory)([
	'foo' => 'bar'
]);
// yay!
echo ($psr_11 instanceOf ContainerInterface) ? "yay!" : "noe?";
```



## Issues

See [full issues list.][i0]

[i0]: https://github.com/GermaniaKG/psrcontainerfactory/issues

## Roadmap
Fill in planned or desired features

## Development

```bash
$ git clone https://github.com/GermaniaKG/psrcontainerfactory.git
$ cd psrcontainerfactory
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```


# PHP Cookie library

[![Latest Stable Version](https://poser.pugx.org/josantonius/cookie/v/stable)](https://packagist.org/packages/josantonius/cookie)
[![License](https://poser.pugx.org/josantonius/cookie/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/cookie/downloads)](https://packagist.org/packages/josantonius/cookie)
[![CI](https://github.com/josantonius/php-cookie/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-cookie/actions/workflows/ci.yml)
[![CodeCov](https://codecov.io/gh/josantonius/php-cookie/branch/master/graph/badge.svg)](https://codecov.io/gh/josantonius/php-cookie)
[![PSR1](https://img.shields.io/badge/PSR-1-f57046.svg)](https://www.php-fig.org/psr/psr-1/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](https://www.php-fig.org/psr/psr-4/)
[![PSR12](https://img.shields.io/badge/PSR-12-1abc9c.svg)](https://www.php-fig.org/psr/psr-12/)

**Translations**: [Español](.github/lang/es-ES/README.md)

PHP library for handling cookies.

> Version 1.x is considered as deprecated and unsupported.
> In this version (2.x) the library was completely restructured.
> It is recommended to review the documentation for this version and make the necessary changes
> before starting to use it, as it not be compatible with version 1.x.

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Available Methods](#available-methods)
- [Quick Start](#quick-start)
- [Usage](#usage)
- [About Cookie Expires](#about-cookie-expires)
- [Tests](#tests)
- [TODO](#todo)
- [Changelog](#changelog)
- [Contribution](#contribution)
- [Sponsor](#Sponsor)
- [License](#license)

---

## Requirements

This library is compatible with the PHP versions: 8.1.

## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **PHP Cookie library**, simply:

```console
composer require josantonius/cookie
```

The previous command will only install the necessary files,
if you prefer to **download the entire source code** you can use:

```console
composer require josantonius/cookie --prefer-source
```

You can also **clone the complete repository** with Git:

```console
git clone https://github.com/josantonius/php-cookie.git
```

## Available Methods

Available methods in this library:

### Sets cookie options

```php
/**
 * Default options:
 * 
 * domain:   ''    - Domain for which the cookie is available.
 * expires:  0     - The time the cookie will expire.
 * httpOnly: false - If cookie will only be available through the HTTP protocol.
 * path:     '/'   - Path for which the cookie is available.
 * raw:      false - If cookie will be sent as a raw string.
 * sameSite: null  - Enforces the use of a Lax or Strict SameSite policy.
 * secure:   false - If cookie will only be available through the HTTPS protocol.
 * 
 * These settings will be used to create and delete cookies.
 */

$cookie = new Cookie(
    string              $domain   = '',
    int|string|DateTime $expires  = 0,
    bool                $httpOnly = false,
    string              $path     = '/',
    bool                $raw      = false,
    null|string         $sameSite = null,
    bool                $secure   = false
);
```

**@see** <https://www.php.net/manual/en/datetime.formats.php>
for supported date and time formats.

**@throws** `CookieException` if $sameSite value is wrong.

### Sets a cookie by name

```php
$cookie->set(string $name, mixed $value, null|int|string|DateTime $expires = null): void;
```

**@throws** `CookieException` if headers already sent.

**@throws** `CookieException` if failure in date/time string analysis.

### Sets several cookies at once

If cookies exist they are replaced, if they do not exist they are created.

```php
$cookie->replace(array $data, null|int|string|DateTime $expires = null): void
```

**@throws** `CookieException` if headers already sent.

### Gets a cookie by name

Optionally defines a default value when the cookie does not exist.

```php
$cookie->get(string $name, mixed $default = null): mixed
```

### Gets all cookies

```php
$cookie->all(): array
```

### Check if a cookie exists

```php
$cookie->has(string $name): bool
```

### Deletes a cookie by name and returns its value

Optionally defines a default value when the cookie does not exist.

```php
$cookie->pull(string $name, mixed $default = null): mixed
```

**@throws** `CookieException` if headers already sent.

### Deletes an cookie by name

```php
$cookie->remove(string $name): void
```

**@throws** `CookieException` if headers already sent.

**@throws** `CookieException` if failure in date/time string analysis.

## Quick Start

To use this class with **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';
```

### Using objects

```php
use Josantonius\Cookie\Cookie;

$cookie = new Cookie();
```

### Using the facade

Alternatively you can use a facade to access the methods statically:

```php
use Josantonius\Cookie\Facades\Cookie;
```

## Usage

Example of use for this library:

### - Sets cookie options

[Using objects](#using-objects):

Without setting options:

```php
$cookie = new Cookie();
```

Setting options:

```php
$cookie = new Cookie(
    domain: 'example.com',
    expires: time() + 3600,
    httpOnly: true,
    path: '/foo',
    raw: true,
    sameSite: 'Strict',
    secure: true,
);
```

[Using the facade](#using-the-facade):

```php
Cookie::options(
    expires: 'now +1 hour',
    httpOnly: true,
);
```

### - Sets a cookie by name

[Using objects](#using-objects):

Without modifying the expiration time:

```php
$cookie->set('foo', 'bar');
```

Modifying the expiration time:

```php
$cookie->set('foo', 'bar', time() + 3600);
```

[Using the facade](#using-the-facade):

```php
Cookie::set('foo', 'bar', new DateTime('now +1 hour'));
```

### - Sets several cookies at once

[Using objects](#using-objects):

Without modifying the expiration time:

```php
$cookie->replace(['foo' => 'bar', 'bar' => 'foo']);
```

Modifying the expiration time:

```php
$cookie->replace(['foo' => 'bar', 'bar' => 'foo'], time() + 3600);
```

[Using the facade](#using-the-facade):

```php
Cookie::replace(['foo' => 'bar', 'bar' => 'foo'], time() + 3600);
```

### - Gets a cookie by name

[Using objects](#using-objects):

Without default value if cookie does not exist:

```php
$cookie->get('foo'); // null if cookie does not exist
```

With default value if cookie does not exist:

```php
$cookie->get('foo', false); // false if cookie does not exist
```

[Using the facade](#using-the-facade):

```php
Cookie::get('foo', false);
```

### - Gets all cookies

[Using objects](#using-objects):

```php
$cookie->all();
```

[Using the facade](#using-the-facade):

```php
Cookie::all();
```

### - Check if a cookie exists

[Using objects](#using-objects):

```php
$cookie->has('foo');
```

[Using the facade](#using-the-facade):

```php
Cookie::has('foo');
```

### - Deletes a cookie by name and returns its value

[Using objects](#using-objects):

Without default value if cookie does not exist:

```php
$cookie->pull('foo'); // null if attribute does not exist
```

With default value if cookie does not exist:

```php
$cookie->pull('foo', false); // false if attribute does not exist
```

[Using the facade](#using-the-facade):

```php
Cookie::pull('foo', false);
```

### - Deletes an cookie by name

[Using objects](#using-objects):

```php
$cookie->remove('foo');
```

[Using the facade](#using-the-facade):

```php
Cookie::remove('foo');
```

## About cookie expires

- The **expires** parameter used in several methods of this library accepts the following types:
`int|string|DateTime`.

  - `Integers` will be handled as unix time except zero.
  - `Strings` will be handled as date/time formats.
  See supported [Date and Time Formats](https://www.php.net/manual/en/datetime.formats.php)
  for more information.

    ```php
    $cookie = new Cookie(
        expires: '2016-12-15 +1 day'
    );
    ```

    It would be similar to:

    ```php
    $cookie = new Cookie(
        expires: new DateTime('2016-12-15 +1 day')
    );
    ```

  - `DateTime` objects will be used to obtain the unix time.

- If the **expires** parameter is used in the `set` or `replace` methods,
it will be taken instead of the **expires** value set in the cookie options.

    ```php
    $cookie = new Cookie(
        expires: 'now +1 minute'
    );

    $cookie->set('foo', 'bar');                // This cookie will expire in 1 minute

    $cookie->set('bar', 'foo', 'now +8 days'); // This cookie will expire in 8 days

    $cookie->replace(['foo' => 'bar']);        // This cookies will expire in 1 minute

    $cookie->replace(                          // This cookies will expire in 1 hour
        ['foo' => 'bar'],
        time() + 3600
    ); 
    ```

- If the **expires** parameter passed in the options is a date/time string,
it is formatted when using the `set` or `replace` method and not when setting the options.

    ```php
    $cookie = new Cookie(
        expires: 'now +1 minute', // It will not be formatted as unix time yet
    );

    $cookie->set('foo', 'bar');   // It is will formatted now
                                  // and will expire 1 minute after this cookie is created
    ```

## Tests

To run [tests](tests) you just need [composer](http://getcomposer.org/download/)
and to execute the following:

```console
git clone https://github.com/josantonius/php-cookie.git
```

```console
cd php-cookie
```

```console
composer install
```

Run unit tests with [PHPUnit](https://phpunit.de/):

```console
composer phpunit
```

Run [PSR2](http://www.php-fig.org/psr/psr-2/) code standard tests with
[PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

```console
composer phpcs
```

Run [PHP Mess Detector](https://phpmd.org/) tests to detect inconsistencies in code style:

```console
composer phpmd
```

Run all previous tests:

```console
composer tests
```

## TODO

- [ ] Add new feature
- [ ] Improve tests
- [ ] Improve documentation
- [ ] Improve English translation in the README file
- [ ] Refactor code for disabled code style rules. See [phpmd.xml](phpmd.xml) and [phpcs.xml](phpcs.xml)

## Changelog

Detailed changes for each release are documented in the
[release notes](https://github.com/josantonius/php-cookie/releases).

## Contribution

Please make sure to read the [Contributing Guide](.github/CONTRIBUTING.md), before making a pull
request, start a discussion or report a issue.

Thanks to all [contributors](https://github.com/josantonius/php-cookie/graphs/contributors)! :heart:

## Sponsor

If this project helps you to reduce your development time,
[you can sponsor me](https://github.com/josantonius#sponsor) to support my open source work :blush:

## License

This repository is licensed under the [MIT License](LICENSE).

Copyright © 2016-present, [Josantonius](https://github.com/josantonius#contact)

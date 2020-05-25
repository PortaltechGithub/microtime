# Microtime

Microtime is a library written in pure PHP that provides an interface and a class to work with microseconds. PHP offers the possibility to get the current timestamp in seconds and microseconds via the [microtime()](https://www.php.net/microtime) function, but the resulting two values must always be converted so that the number of microseconds since the unix epoch is obtained. The Microtime class does this work for you. This allows you to create a Microtime object from different formats and convert it into different formats like [DateTime](https://www.php.net/datetime) object, integer and string.


## Requirements

Microtime requires the following:

- PHP 7.1 or higher


## Installation

Microtime is installed via [Composer](https://getcomposer.org/).
To [add a dependency](https://getcomposer.org/doc/04-schema.md#package-links) to Microtime in your project, either

Run the following to use the latest stable version
```sh
    composer require reply/microtime
```
or if you want the latest master version
```sh
    composer require reply/microtime:dev-master
```

You can of course also manually edit your composer.json file
```json
{
    "require": {
       "reply/microtime": "^1.0"
    }
}
```


## Getting started

The following is a basic usage example of the Microtime library:

```php
<?php

use Reply\Microtime\Microtime;

// Creates a Microtime object from current timestamp
$microtime = Microtime::fromNow();

// Creates a Microtime object from a string containing seconds and microseconds
$microtime = Microtime::fromString('0.34497500 1589445224');
// or
$microtime = Microtime::fromMicrotime('0.34497500 1589445224');

// Creates a new Microtime object from an integer containing the microseconds since the unix epoch
$microtime = Microtime::fromInt(1589445224344975);
// or
$microtime = Microtime::fromMicroseconds(1589445224344975);

// Creates a new Microtime object from a float containing the result of the microtime(true) function
$microtime = Microtime::fromFloat(1589445622.7431);

// Creates a new Microtime object from an integer containing the seconds since the unix epoch
$microtime = Microtime::fromSeconds(1589445622);

// Creates a new Microtime object from a DateTime object
$microtime = Microtime::fromDateTime(new \DateTime());

// Returns the microtime as string
$string = $microtime->toString();
// or
$string = (string) $microtime;
// or
$string = "Time in microseconds: $microtime";

// Returns the microtime as integer
$int = $microtime->toInt();

// Returns the microtime as float
$float = $microtime->toFloat();

// Returns the microtime as string in the format of the microtime() function
$string = $microtime->toMicrotime();

// Returns the microtime in a DateTime object
$dateTime = $microtime->toDateTime();

// Returns the microtime in a DateTimeImmutable object
$dateTimeImmutable = $microtime->toDateTimeImmutable();
```

## Contributing

You're welcome to contribute to Microtime. Below are some of the things that you can do to contribute.

- [Fork the repository](https://github.com/reply/microtime/fork) and [request a pull](https://github.com/reply/microtime/pulls) to the [develop](https://github.com/reply/microtime/tree/develop) branch.
- Submit [bug reports or feature requests](https://github.com/reply/microtime/issues) to GitHub.
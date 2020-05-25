<?php declare(strict_types=1);

namespace Reply\Microtime;

use DateTime;
use DateTimeInterface;
use DateTimeImmutable;
use InvalidArgumentException;

/**
 * Microtime interface
 */
interface MicrotimeInterface
{
    /**
     * Creates a Microtime object from current timestamp
     *
     * @return Microtime
     */
    public static function fromNow(): Microtime;

    /**
     * Try to convert a string into a Microtime object
     *
     * Accepts the following formats:
     * - "0.mmmmmmmm ssssssssss" as returned from microtime()
     * - "ssssssssss.mmmmmm" a string that contains a float value
     * - "mmmmmmmmmmmmmmmm" a string that contains microseconds since the unix epoch
     *
     * @param string $string
     * @return Microtime
     * @throws InvalidArgumentException
     */
    public static function fromString(string $string): Microtime;

    /**
     * Creates a new Microtime object from an integer containing the microseconds since the unix epoch
     *
     * @param $int
     * @return MicroTime
     */
    public static function fromInt(int $int): Microtime;

    /**
     * Creates a new Microtime object from a float containing the result of the microtime(true) function
     *
     * Please note, that float might not be large enough to contain the timestamp without precision loss
     *
     * @param float $float
     * @return Microtime
     */
    public static function fromFloat(float $float): Microtime;

    /**
     * Creates a new Microtime object from an integer containing the microseconds since the unix epoch
     *
     * @param int $int
     * @return Microtime
     */
    public static function fromMicroseconds(int $int): Microtime;

    /**
     * Creates a new Microtime object from an integer containing the seconds since the unix epoch
     *
     * @param int $int
     * @return Microtime
     */
    public static function fromSeconds(int $int): Microtime;

    /**
     * Creates a new Microtime object from a string containing the result of the microtime() function
     *
     * @param string $microtime
     * @return Microtime
     */
    public static function fromMicrotime(string $microtime): Microtime;

    /**
     * Creates a new Microtime object from a DateTime object
     *
     * Please note, that the PHP DateTime object ignores microseconds when creating with "new" in PHP < 7.1
     *
     * @param DateTimeInterface $dateTime
     * @return Microtime
     */
    public static function fromDateTime(DateTimeInterface $dateTime): Microtime;

    /**
     * Returns the microtime as string
     *
     * @return string
     */
    public function toString(): string;

    /**
     * Returns the microtime as integer
     *
     * @return int
     */
    public function toInt(): int;

    /**
     * Returns the microtime as float
     *
     * Please note, that float might not be large enough to contain the timestamp without precision loss
     * If you need precision, use a string, if you need precision and comparability, use an integer
     *
     * @return float
     */
    public function toFloat(): float;

    /**
     * Returns the microtime as string in the format of the microtime() function
     *
     * @return string
     */
    public function toMicrotime(): string;

    /**
     * Returns the microtime in a DateTime object
     *
     * @return DateTime
     */
    public function toDateTime(): DateTime;

    /**
     * Returns the microtime in a DateTimeImmutable object
     *
     * @return DateTimeImmutable
     */
    public function toDateTimeImmutable(): DateTimeImmutable;

    /**
     * Magic method to return the microtime as string when using the Microtime object as string
     *
     * @return string
     */
    public function __toString(): string;
}

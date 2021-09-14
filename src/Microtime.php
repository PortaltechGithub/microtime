<?php declare(strict_types=1);

namespace Reply\Microtime;

use DateTime;
use DateTimeInterface;
use DateTimeImmutable;
use InvalidArgumentException;

/**
 * Microtime object
 */
class Microtime implements MicrotimeInterface
{
    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * @return Microtime
     */
    public static function fromNow(): Microtime
    {
        return static::fromMicrotime(microtime());
    }

    /**
     * {@inheritdoc}
     */
    public static function fromString(string $string): Microtime
    {
        $string = (string) $string;

        if (strpos($string, ' ') !== false && strpos($string, '0.') === 0) {
            return static::fromMicrotime($string);
        }

        if (ctype_digit($string)) {
            return static::fromInt((int) $string);
        }

        if (is_numeric($string) && floatval($string) == $string) {
            return static::fromFloat((float) $string);
        }

        throw new InvalidArgumentException(sprintf('Unable to parse string "%s"', $string));
    }

    /**
     * {@inheritdoc}
     */
    public static function fromInt(int $int): Microtime
    {
        return static::fromMicroseconds($int);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromFloat(float $float): Microtime
    {
        $string = (string) $float;
        $dotPosition = strpos($string, '.');
        if ($dotPosition === false) {
            $string = sprintf('%s.%s', $string, '0');
        }
        return new static(\DateTime::createFromFormat('U.u', $string));
    }

    /**
     * {@inheritdoc}
     */
    public static function fromMicroseconds(int $int): Microtime
    {
        $string = intval($int/10**6) . '.' . str_pad(strval($int % 10**6), 6, '0', STR_PAD_LEFT);

        return new static(\DateTime::createFromFormat('U.u', $string));
    }

    /**
     * {@inheritdoc}
     */
    public static function fromSeconds(int $int): Microtime
    {
        return new static(\DateTime::createFromFormat('U.u', $int . '.000000'));
    }

    /**
     * {@inheritdoc}
     */
    public static function fromMicrotime(string $microtime): Microtime
    {
        list($microseconds, $seconds) = explode(' ', $microtime);

        $string = $seconds . ' ' . substr($microseconds, 0, 8);

        return new static(\DateTime::createFromFormat('U 0.u', $string));
    }

    /**
     * {@inheritdoc}
     */
    public static function fromDateTime(DateTimeInterface $dateTime): Microtime
    {
        return new static($dateTime);
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        $microseconds = str_pad(
            substr($this->dateTime->format('u'), 0, 6),
            6,
            '0',
            STR_PAD_RIGHT
        );

        $seconds = $this->dateTime->getTimestamp();

        return sprintf(
            '%d%s',
            $seconds,
            $microseconds
        );
    }

    /**
     * {@inheritdoc}
     */
    public function toInt(): int
    {
        return (int) str_replace('.', '', $this->toString());
    }

    /**
     * {@inheritdoc}
     */
    public function toFloat(): float
    {
        return (float) $this->toString();
    }

    /**
     * {@inheritdoc}
     */
    public function toMicrotime(): string
    {
        return sprintf('0.%d00 %d', substr($this->dateTime->format('u'), 0, 6), $this->dateTime->format('U'));
    }

    /**
     * {@inheritdoc}
     */
    public function toDateTime(): DateTime
    {
        return $this->dateTime;
    }

    /**
     * {@inheritdoc}
     */
    public function toDateTimeImmutable(): DateTimeImmutable
    {
        return \DateTimeImmutable::createFromMutable($this->dateTime);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @param DateTimeInterface $date
     */
    protected function __construct(DateTimeInterface $date)
    {
        $this->dateTime = $date;
    }
}

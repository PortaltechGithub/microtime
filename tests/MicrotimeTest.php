<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Reply\Microtime\Microtime;

class MicrotimeTest extends TestCase
{
    const VALUE_STRING       = '0.66153000 1590417215';
    const VALUE_MICROSECONDS = 1590417215661530;
    const VALUE_SECONDS      = 1590417215;
    const VALUE_FLOAT        = 1590417215.6615;

    public function testCanBeCreatedFromCurrentTimestamp()
    {
        $this->checkObject(Microtime::fromNow());
    }

    public function testCanBeCreatedFromString()
    {
        $this->checkObject(Microtime::fromString( static::VALUE_STRING ));
    }

    public function testCanBeCreatedFromInteger()
    {
        $this->checkObject(Microtime::fromInt( static::VALUE_MICROSECONDS ));
    }

    public function testCanBeCreatedFromFloat()
    {
        $this->checkObject(Microtime::fromFloat( static::VALUE_FLOAT ));
    }

    public function testCanBeCreatedFromMicroseconds()
    {
        $this->checkObject(Microtime::fromMicroseconds( static::VALUE_MICROSECONDS ));
    }

    public function testCanBeCreatedFromSeconds()
    {
        $this->checkObject(Microtime::fromMicroseconds( static::VALUE_SECONDS ));
    }

    public function testCanBeCreatedFromMicrotime()
    {
        $this->checkObject(Microtime::fromMicrotime( microtime() ));
    }

    public function testCanBeCreatedFromDateTime()
    {
        $this->checkObject(Microtime::fromDateTime( new DateTime() ));
    }

    public function testCanBeExportedToString()
    {
        $output = Microtime::fromNow()->toString();

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
    }

    public function testCanBeExportedToInteger()
    {
        $output = Microtime::fromNow()->toInt();

        $this->assertNotEmpty($output);
        $this->assertIsInt($output);
    }

    public function testCanBeExportedToFloat()
    {
        $output = Microtime::fromNow()->toFloat();

        $this->assertNotEmpty($output);
        $this->assertIsFloat($output);
    }

    public function testCanBeExportedToMicrotime()
    {
        $output = Microtime::fromMicrotime(static::VALUE_STRING)->toMicrotime();

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertEquals(static::VALUE_STRING, $output);
    }

    public function testCanBeExportedToDateTime()
    {
        $output = Microtime::fromNow()->toDateTime();

        $this->assertInstanceOf(DateTime::class, $output);
        $this->assertNotEmpty($output->format('U'));
    }

    public function testCanBeExportedToDateTimeImmutable()
    {
        $output = Microtime::fromNow()->toDateTimeImmutable();

        $this->assertInstanceOf(DateTimeImmutable::class, $output);
        $this->assertNotEmpty($output->format('U'));
    }

    public function testCanBeConvertedToString()
    {
        $object = Microtime::fromString((string) static::VALUE_MICROSECONDS);

        $this->assertEquals((string) static::VALUE_MICROSECONDS, "{$object}");
    }

    public function testCanBeConvertedBetweenStringAndInteger()
    {
        $integer = Microtime::fromString((string) static::VALUE_MICROSECONDS)->toInt();
        $string  = Microtime::fromInt($integer)->toString();
        $object  = Microtime::fromString($string);

        $this->assertEquals(static::VALUE_MICROSECONDS, $object->toInt());
    }

    public function testCanBeConvertedBetweenDateTimeAndInteger()
    {
        $input = new DateTime();

        $integer  = Microtime::fromDateTime($input)->toInt();
        $dateTime = Microtime::fromInt($integer)->toDateTime();
        $object   = Microtime::fromDateTime($dateTime);

        $this->assertEquals($input, $object->toDateTime());
    }

    protected function checkObject($object)
    {
        $this->assertInstanceOf(Microtime::class, $object);
        $this->assertTrue($object->toInt() > 0);
    }
}
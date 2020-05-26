<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use StreetTT\Model\Person;

final class PersonTest extends TestCase
{
    public function testCanBeCreatedFromMinimumInformation(): void
    {
        $person = new Person('Mr', 'Test');
        $this->assertInstanceOf(
            Person::class,
            $person
        );
    }

    public function testCanBeCreatedFromFullInformation(): void
    {
        $person = new Person('Mrs', 'Test', 'Testy', 'T');
        $this->assertInstanceOf(
            Person::class,
            $person
        );
    }

    public function testIsReturnedAsArray(): void
    {
        $person = new Person('Ms', 'Test');

        $this->assertIsArray(
            $person->getArray()
        );
    }

    public function testArrayContainsExpectedData(): void
    {
        $title = 'Dr';
        $first_name = 'Testo';
        $initial = 'A';
        $last_name = 'Test';

        $person = new Person($title, $last_name, $first_name, $initial);
        $personArray = $person->getArray();

        $this->assertArrayHasKey('title', $personArray);
        $this->assertArrayHasKey('initial', $personArray);
        $this->assertArrayHasKey('first_name', $personArray);
        $this->assertArrayHasKey('last_name', $personArray);

        $this->assertEquals($title, $personArray['title']);
        $this->assertEquals($last_name, $personArray['last_name']);
        $this->assertEquals($first_name, $personArray['first_name']);
        $this->assertEquals($initial, $personArray['initial']);
    }
}

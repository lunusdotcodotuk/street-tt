<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use StreetTT\Model\Person;
use StreetTT\Model\PersonRepository;

final class PersonRepositoryTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $personRepository = new PersonRepository();
        $this->assertInstanceOf(
            PersonRepository::class,
            $personRepository
        );
    }

    public function testCanAddValidPerson(): void
    {
        $person = new Person('Mrs', 'Test', 'Testy', 'T');
        $personRepository = new PersonRepository();

        $personRepository[0] = $person;

        $this->assertInstanceOf(
            Person::class,
            $personRepository[0]
        );
    }

    public function testCannotAddInvalidPerson(): void
    {
        $personRepository = new PersonRepository();

        $this->expectException(InvalidArgumentException::class);

        $personRepository[] = 'invalid';
    }

    public function testCanIterateMultiplePersons(): void
    {
        $personRepository = new PersonRepository();

        $personRepository[] = new Person('Mrs', 'Test', 'Testy', 'T');
        $personRepository[] = new Person('Mr', 'Test');

        foreach ($personRepository as $person) {
            $this->assertInstanceOf(
                Person::class,
                $person
            );
        }
    }
}

<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use StreetTT\Importer;
use StreetTT\Model\Person;
use StreetTT\Model\PersonRepository;

final class ImporterTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $importer = new Importer([]);
        $this->assertInstanceOf(
            Importer::class,
            $importer
        );
    }

    public function testCanImportPeople(): void
    {
        $people = ["Mr John Smith", "Mister J Smith"];
        $importer = new Importer($people);
        $importer->import();
        $personRepository = $importer->getPersonRepository();
        $this->assertInstanceOf(
            PersonRepository::class,
            $personRepository
        );
        $invalidInputs = $importer->getInvalidInputs();
        $this->assertEquals(2, count($personRepository));
        $this->assertEquals(0, count($invalidInputs));
    }

    public function testCanImportPeopleAndIgnoreInvalidInputs(): void
    {
        $people = ["Mr John Smith", "invalid", "Mister J Smith"];
        $importer = new Importer($people);
        $importer->import();
        $personRepository = $importer->getPersonRepository();
        $this->assertInstanceOf(
            PersonRepository::class,
            $personRepository
        );
        $invalidInputs = $importer->getInvalidInputs();
        $this->assertEquals(2, count($personRepository));
        $this->assertEquals(1, count($invalidInputs));
    }

    public function testCanImportPeopleWithJoinedNames(): void
    {
        $people = ["Mr John Smith", "invalid", "Mister J Smith", "Mr John Smith and Mr Joe Bloggs", "Mr & Mrs Test"];
        $importer = new Importer($people);
        $importer->import();
        $personRepository = $importer->getPersonRepository();
        $this->assertInstanceOf(
            PersonRepository::class,
            $personRepository
        );
        $invalidInputs = $importer->getInvalidInputs();
        $this->assertEquals(6, count($personRepository));
        $this->assertEquals(1, count($invalidInputs));
    }
}

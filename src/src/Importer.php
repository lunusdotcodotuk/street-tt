<?php

namespace StreetTT;

use StreetTT\Model\Person;
use StreetTT\Model\PersonRepository;

class Importer
{
    private PersonRepository $personRepository;
    private array $import_data;
    private array $invalid_inputs;

    public function __construct(array $import_data)
    {
        $this->personRepository = new PersonRepository();
        $this->import_data = $import_data;
        $this->invalid_inputs = [];
    }

    public function import(): void
    {
        foreach ($this->import_data as $datum) {
            $this->consider($datum);
        }
    }

    public function getPersonRepository(): PersonRepository
    {
        return $this->personRepository;
    }

    public function getInvalidInputs(): array
    {
        return $this->invalid_inputs;
    }

    private function consider(string $datum): void
    {
        $data = explode(' ', $datum);
        if (count($data) < 2) {
            $this->invalid_inputs[] = $datum;
        } else {
            switch(count($data)) {
                case 2:
                    $this->personRepository[] = new Person($data[0], $data[1]);
                    break;
                case 3:
                    $this->handleThreeInputs($data);
                    break;
                default:
                    break;
            }
        }
    }

    private function handleThreeInputs(array $data): void
    {
        if (strlen($data[1]) === 1) {
            $this->personRepository[] = new Person($data[0], $data[2], null, $data[1]);
        } else {
            $this->personRepository[] = new Person($data[0], $data[2], $data[1]);
        }
    }
}

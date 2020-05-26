<?php

namespace StreetTT;

use StreetTT\Model\Person;
use StreetTT\Model\PersonRepository;

class Importer
{
    const JOINING_TERMS = ['&', ' and ', ' And '];

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
        $this->import_data = $this->processForJointNames($this->import_data);
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

    private function processForJointNames(array $data): array
    {
        $returnArray = [];
        foreach($data as $possibleJointName) {
            if (!$this->containsAJoin($possibleJointName)) {
                $returnArray[] = $possibleJointName;
            } else {
                $newNames = $this->handleJointName($possibleJointName);
                $returnArray[] = $newNames[0];
                $returnArray[] = $newNames[1];
            }
        }
        return $returnArray;
    }

    private function containsAJoin(string $name): bool
    {
        foreach (self::JOINING_TERMS as $test) {
            if (strpos($name, $test)) {
                return true;
            }
        }
        return false;
    }

    private function handleJointName($name): array
    {
        $returnNames = [];
        $tempNames = [];
        foreach (self::JOINING_TERMS as $test) {
            if (strpos($name, $test)) {
                $newNames = explode($test, $name);
                foreach ($newNames as $newName) {
                    $tempNames[] = explode(' ', $newName);
                }
                break;
            }
        }
        foreach ($tempNames as $key=>$newName) {
            if (count($newName) < 2) {
                if ($key = 0) {
                    $newName[1] = $tempNames[1][count($tempNames[1])-1];
                } else {
                    $newName[1] = $tempNames[0][count($tempNames[0])-1];
                }
            }
            $returnNames[] = implode(' ', $newName);
        }
        return $returnNames;
    }
}

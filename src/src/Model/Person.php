<?php

namespace StreetTT\Model;

class Person
{
    private string $title;
    private ?string $first_name;
    private ?string $initial;
    private string $last_name;

    public function __construct(
        string $title,
        string $last_name,
        string $first_name = null,
        string $initial = null
    )
    {
        $this->title = $title;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->initial = $initial;
    }

    public function getArray() : array
    {
        return [
            'title'=>$this->title,
            'first_name'=>$this->first_name,
            'initial'=>$this->initial,
            'last_name'=>$this->last_name
            ];
    }
}

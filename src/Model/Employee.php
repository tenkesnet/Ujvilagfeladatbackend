<?php

namespace Bardo\Ujvilagbackend\Model;



class Employee
{
    public int $id;
    public string $name;

    function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}

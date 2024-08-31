<?php

namespace App\Entity;

class Engineer
{
    public string $id;
    public bool $isAssigned = false;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}

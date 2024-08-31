<?php

namespace App\Entity;

class Aircraft
{
    public string $id;
    public string $type;
    private int $baseMaintenanceDays;
    private int $engineersAssigned = 0;

    public function __construct(string $id, string $type)
    {
        $this->id = $id;
        $this->type = $type;
        $this->baseMaintenanceDays = $type === 'fixed-wing' ? 15 : 20;
    }

    public function getMaintenanceDays(): int
    {
        return (int) ceil($this->baseMaintenanceDays / (1 + 0.3 * $this->engineersAssigned));
    }

    public function assignEngineer(): void
    {
        $this->engineersAssigned = min(3, $this->engineersAssigned + 1);
    }

    public function unassignEngineer(): void
    {
        $this->engineersAssigned = max(0, $this->engineersAssigned - 1);
    }
}

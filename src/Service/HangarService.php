<?php

namespace App\Service;

use App\Entity\Aircraft;
use App\Entity\Engineer;

class HangarService
{
    private array $aircraftList = [];
    private array $engineerList = [];
    private const MAX_CAPACITY = 5;

    public function checkHangarSpace(): int
    {
        return self::MAX_CAPACITY - count($this->aircraftList);
    }

    public function addAircraft(Aircraft $aircraft): void
    {
        if (count($this->aircraftList) < self::MAX_CAPACITY) {
            $this->aircraftList[$aircraft->id] = $aircraft;
        }
    }

    public function removeAircraft(string $aircraftId): void
    {
        unset($this->aircraftList[$aircraftId]);
    }

    public function getAircraftList(): array
    {
        return array_values($this->aircraftList);
    }

    public function addEngineer(Engineer $engineer): void
    {
        $this->engineerList[$engineer->id] = $engineer;
    }

    public function assignEngineerToAircraft(string $aircraftId, string $engineerId): void
    {
        if (isset($this->aircraftList[$aircraftId], $this->engineerList[$engineerId]) &&
            !$this->engineerList[$engineerId]->isAssigned) {

            $this->aircraftList[$aircraftId]->assignEngineer();
            $this->engineerList[$engineerId]->isAssigned = true;
        }
    }

    public function unassignEngineerFromAircraft(string $aircraftId, string $engineerId): void
    {
        if (isset($this->aircraftList[$aircraftId], $this->engineerList[$engineerId]) &&
            $this->engineerList[$engineerId]->isAssigned) {

            $this->aircraftList[$aircraftId]->unassignEngineer();
            $this->engineerList[$engineerId]->isAssigned = false;
        }
    }

    public function getMaintenanceTimeLeft(string $aircraftId): int
    {
        return $this->aircraftList[$aircraftId]->getMaintenanceDays() ?? 0;
    }

    public function getTotalMaintenanceTimeLeft(): int
    {
        return array_sum(array_map(function ($aircraft) {
            return $aircraft->getMaintenanceDays();
        }, $this->aircraftList));
    }
}

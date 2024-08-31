<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\HangarService;
use App\Entity\Aircraft;
use App\Entity\Engineer;

class HangarTest extends TestCase
{
    private HangarService $hangarService;

    protected function setUp(): void
    {
        $this->hangarService = new HangarService();
    }

    public function testCheckHangarSpace()
    {
        $this->assertEquals(5, $this->hangarService->checkHangarSpace());

        $this->hangarService->addAircraft(new Aircraft("A001", "fixed-wing"));
        $this->assertEquals(4, $this->hangarService->checkHangarSpace());
    }

    public function testAddAndRemoveAircraft()
    {
        $aircraft = new Aircraft("A002", "rotary-wing");
        $this->hangarService->addAircraft($aircraft);
        $this->assertCount(1, $this->hangarService->getAircraftList());

        $this->hangarService->removeAircraft("A002");
        $this->assertCount(0, $this->hangarService->getAircraftList());
    }

    public function testAssignAndUnassignEngineer()
    {
        $aircraft = new Aircraft("A003", "fixed-wing");
        $engineer = new Engineer("E001");
        $this->hangarService->addAircraft($aircraft);
        $this->hangarService->addEngineer($engineer);

        $this->hangarService->assignEngineerToAircraft("A003", "E001");
        $this->assertTrue($engineer->isAssigned);

        $this->hangarService->unassignEngineerFromAircraft("A003", "E001");
        $this->assertFalse($engineer->isAssigned);
    }

    public function testGetTotalMaintenanceTimeLeft()
    {
        $aircraft1 = new Aircraft("A004", "fixed-wing");
        $aircraft2 = new Aircraft("A005", "rotary-wing");

        $this->hangarService->addAircraft($aircraft1);
        $this->hangarService->addAircraft($aircraft2);

        $this->assertEquals(35, $this->hangarService->getTotalMaintenanceTimeLeft());
    }
}

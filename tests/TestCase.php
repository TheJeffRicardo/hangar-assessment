<?php

// Initialize the hangar
$hangar = new Hangar();

// Create aircraft
$aircraft1 = new Aircraft("A001", "fixed-wing");
$aircraft2 = new Aircraft("A002", "rotary-wing");

// Add aircraft to the hangar
$hangar->addAircraft($aircraft1);
$hangar->addAircraft($aircraft2);

// Assign engineers
$hangar->assignEngineerToAircraft("A001");
$hangar->assignEngineerToAircraft("A001");
$hangar->assignEngineerToAircraft("A002");

// Get maintenance status
$status = $hangar->getMaintenanceStatus();
print_r($status);

?>

<?php

use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelFuel;

$pkwLabelFilename = PKWLabelFuel::make('<your-api-key>')
    ->setMake('Škoda')
    ->setModel('Octavia Combi RS')
    ->setFuel('diesel')
    ->setConsumption(8.5)
    ->setConsumptionCity(9.3)
    ->setConsumptionSuburban(8.9)
    ->setConsumptionRural(8)
    ->setConsumptionHighway(7.2)
    ->setCo2Combined(136)
    ->setCubicCapacity(1997)
    ->setFin('1234567891011')
    ->generateFilename();

echo $pkwLabelFilename;

<?php

use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHybrid;

$pkwLabelFullFilename = PKWLabelHybrid::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setFuel('benzin')
    ->setWeightedConsumption(4)
    ->setElectricWeightedConsumption(8)
    ->setConsumption(8.5)
    ->setConsumptionCity(9.3)
    ->setConsumptionSuburban(8.9)
    ->setConsumptionRural(8)
    ->setConsumptionHighway(7.2)
    ->setElectricConsumption(15)
    ->setElectricConsumptionCity(16)
    ->setElectricConsumptionSuburban(15)
    ->setElectricConsumptionRural(14.5)
    ->setElectricConsumptionHighway(14.5)
    ->setCo2Combined(95)
    ->setCo2Discharged(125)
    ->setCubicCapacity(1987)
    ->setRangeEaer(350)
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs') // Output directory belirleniyor
    ->generateFullFilename();

echo $pkwLabelFullFilename;

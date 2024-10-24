<?php

use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelElectric;

$pkwLabelFilenameAsPath = PKWLabelElectric::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setElectricConsumption(15)
    ->setElectricConsumptionCity(16.3)
    ->setElectricConsumptionSuburban(15.9)
    ->setElectricConsumptionRural(14.2)
    ->setElectricConsumptionHighway(14)
    ->setRange(350)
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs') // set output directory
    ->generateFullFilename();

echo $pkwLabelFilenameAsPath;

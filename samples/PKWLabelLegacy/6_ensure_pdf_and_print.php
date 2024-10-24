<?php

use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelLegacy;

PKWLabelLegacy::make('<your-api-key>')
    ->setBrand('Skoda')
    ->setModel('Octavia III 1.9 TDI Elegance')
    ->setPower('84')
    ->setFuelType('supere10')
    ->setMass('1484')
    ->setCo2Emission('148')
    ->setEngineCapacity('1998')
    ->setConsumption('7.2')
    ->setConsumptionCity('n/a')
    ->setConsumptionHighway('n/a')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->ensurePdfAndPrint();
<?php

use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHydrogen;

PKWLabelHydrogen::make('<your-api-key>')
    ->setMake('Škoda')
    ->setModel('Octavia Combi RS')
    ->setConsumption('8.5')
    ->setConsumptionCity('9.3')
    ->setConsumptionSuburban('8.9')
    ->setConsumptionRural('8')
    ->setConsumptionHighway('7.2')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->createPdf();

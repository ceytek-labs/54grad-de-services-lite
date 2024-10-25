<p align="center">
    <a href="https://packagist.org/packages/ceytek-labs/54grad-de-services-lite">
        <img alt="Total Downloads" src="https://img.shields.io/packagist/dt/ceytek-labs/54grad-de-services-lite">
    </a>
    <a href="https://packagist.org/packages/ceytek-labs/54grad-de-services-lite">
        <img alt="Latest Version" src="https://img.shields.io/packagist/v/ceytek-labs/54grad-de-services-lite">
    </a>
    <a href="https://packagist.org/packages/ceytek-labs/54grad-de-services-lite">
        <img alt="Size" src="https://img.shields.io/github/repo-size/ceytek-labs/54grad-de-services-lite">
    </a>
    <a href="https://packagist.org/packages/ceytek-labs/54grad-de-services-lite">
        <img alt="License" src="https://img.shields.io/packagist/l/ceytek-labs/54grad-de-services-lite">
    </a>
</p>


# 54grad.de Services Lite

**54grad.de** is a company that offers vehicle labeling, customer management, and software solutions.

This package is designed to integrate the services provided by **54grad.de** into PHP projects, allowing for seamless use of vehicle labeling data and other related functionalities within a PHP-based environment.

> **Disclaimer:** This package is not an official product of 54grad.de. The developers accept no responsibility for any issues, discrepancies, or damages that may arise from its use.

## Installation

You can add this package to your projects via Composer:

```bash
composer require ceytek-labs/54grad-de-services-lite
```

## Requirements

- PHP 7.0 or higher

## Services

- [PKW Label](#pkw-label)
    - [PKW Label Electric](#pkw-label-electric)
    - [PKW Label Fuel](#pkw-label-fuel)
    - [PKW Label Hybrid](#pkw-label-hybrid)
    - [PKW Label Hydrogen](#pkw-label-hydrogen)
    - [PKW Label Outdated](#pkw-label-outdated)

## PKW Label

The PKW Label API allows car dealerships to automate the calculation and generation of vehicle labels required by the EnVKV (German Energy Consumption Labeling Ordinance for Passenger Cars). This API is designed to simplify the process of creating standardized labels that display important vehicle information such as fuel consumption and CO2 emissions, ensuring compliance with regulatory standards.

In essence, it streamlines the creation of these labels, reducing manual work and ensuring accuracy.

**[⬆ Back to services](#services)**

## PKW Label Electric

The **PKW Label Electric** API allows users to generate energy labels for electric vehicles, including key information such as electric consumption, driving range, and vehicle identification numbers (FIN). It automates the process of creating legally required labels under the EnVKV (German Energy Consumption Labeling Ordinance), making it easier for dealerships and vehicle manufacturers to comply with regulations.

### Example Usage

Here are a few examples of how you can use the **PKWLabelElectric** class in your PHP projects to generate and display electric vehicle labels.

**[⬆ Back to services](#services)**

#### 1. Generate Filename

This example generates the filename for the PDF without creating the actual file:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelElectric;

$pkwLabelFilename = PKWLabelElectric::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setElectricConsumption('15')
    ->setElectricConsumptionCity('16.3')
    ->setElectricConsumptionSuburban('15.9')
    ->setElectricConsumptionRural('14.2')
    ->setElectricConsumptionHighway('14')
    ->setRange('350')
    ->setFin('1234567891011')
    ->generateFilename();

echo $pkwLabelFilename;
```

**[⬆ Back to services](#services)**

#### 2. Generate Filename with Path

If you want to include the output directory in the filename:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelElectric;

$pkwLabelFilenameAsPath = PKWLabelElectric::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setElectricConsumption('15')
    ->setElectricConsumptionCity('16.3')
    ->setElectricConsumptionSuburban('15.9')
    ->setElectricConsumptionRural('14.2')
    ->setElectricConsumptionHighway('14')
    ->setRange('350')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->generateFullFilename();

echo $pkwLabelFilenameAsPath;
```

**[⬆ Back to services](#services)**

#### 3. Create PDF

This example shows how to create the PDF and save it to the output directory:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelElectric;

PKWLabelElectric::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setElectricConsumption('15')
    ->setElectricConsumptionCity('16.3')
    ->setElectricConsumptionSuburban('15.9')
    ->setElectricConsumptionRural('14.2')
    ->setElectricConsumptionHighway('14')
    ->setRange('350')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->createPdf();
```

**[⬆ Back to services](#services)**

#### 4. Create and Display PDF

This example creates the PDF and displays it directly in the browser:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelElectric;

PKWLabelElectric::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setElectricConsumption('15')
    ->setElectricConsumptionCity('16.3')
    ->setElectricConsumptionSuburban('15.9')
    ->setElectricConsumptionRural('14.2')
    ->setElectricConsumptionHighway('14')
    ->setRange('350')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->createPdf()
    ->displayPdf();
```

**[⬆ Back to services](#services)**

#### 5. Display Already Created PDF

If the PDF is already created, you can directly display it:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelElectric;

PKWLabelElectric::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setElectricConsumption('15')
    ->setElectricConsumptionCity('16.3')
    ->setElectricConsumptionSuburban('15.9')
    ->setElectricConsumptionRural('14.2')
    ->setElectricConsumptionHighway('14')
    ->setRange('350')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->displayPdf();
```

**[⬆ Back to services](#services)**

#### 6. Ensure PDF Exists and Print

This function checks if the PDF already exists. If not, it generates the PDF and displays it:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelElectric;

PKWLabelElectric::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setElectricConsumption('15')
    ->setElectricConsumptionCity('16.3')
    ->setElectricConsumptionSuburban('15.9')
    ->setElectricConsumptionRural('14.2')
    ->setElectricConsumptionHighway('14')
    ->setRange('350')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->ensurePdfAndPrint();
```

**[⬆ Back to services](#services)**

## PKW Label Fuel

The **PKW Label Fuel** API is designed to automate the creation of energy labels for fuel-powered vehicles. This API supports the generation of standardized labels that display essential vehicle details, such as fuel consumption, CO2 emissions, and engine capacity. The labels created by this API comply with the EnVKV (German Energy Consumption Labeling Ordinance), making it easier for car dealerships and manufacturers to meet regulatory requirements.

By automating the generation of these labels, the API reduces manual effort and ensures accuracy for fuel-powered vehicles.

### Example Usage

Here are a few examples of how you can use the **PKWLabelFuel** class in your PHP projects to generate and display electric vehicle labels.

**[⬆ Back to services](#services)**

#### 1. Generate Filename

This example generates the filename for the PDF without creating the actual file:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelFuel;

$pkwLabelFilename = PKWLabelFuel::make('<your-api-key>')
    ->setManufacturer('Škoda')
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
```

**[⬆ Back to services](#services)**

#### 2. Generate Filename with Path

If you want to include the output directory in the filename:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelFuel;

$pkwLabelFullFilename = PKWLabelFuel::make('<your-api-key>')
    ->setManufacturer('Škoda')
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
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->generateFullFilename();

echo $pkwLabelFullFilename;
```

**[⬆ Back to services](#services)**

#### 3. Create PDF

This example shows how to create the PDF and save it to the output directory:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelFuel;

PKWLabelFuel::make('<your-api-key>')
    ->setManufacturer('Škoda')
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
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->createPdf();
```

**[⬆ Back to services](#services)**

#### 4. Create and Display PDF

This example creates the PDF and displays it directly in the browser:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelFuel;

PKWLabelFuel::make('<your-api-key>')
    ->setManufacturer('Škoda')
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
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->createPdf()
    ->displayPdf();
```

**[⬆ Back to services](#services)**

#### 5. Display Already Created PDF

If the PDF is already created, you can directly display it:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelFuel;

PKWLabelFuel::make('<your-api-key>')
    ->setManufacturer('Škoda')
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
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->displayPdf();
```

**[⬆ Back to services](#services)**

#### 6. Ensure PDF Exists and Print

This function checks if the PDF already exists. If not, it generates the PDF and displays it:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelFuel;

PKWLabelFuel::make('<your-api-key>')
    ->setManufacturer('Škoda')
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
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->ensurePdfAndPrint();
```

**[⬆ Back to services](#services)**

## PKW Label Hybrid

The **PKW Label Hybrid** API allows for automated generation of energy labels for hybrid vehicles. It provides comprehensive details, including fuel consumption, electric consumption, CO2 emissions, and driving range. The generated labels meet the requirements set by the EnVKV (German Energy Consumption Labeling Ordinance), making it easier for car dealerships and manufacturers to comply with regulatory standards.

This API reduces the need for manual label creation, ensuring accuracy and consistency for hybrid vehicle data.

### Example Usage

Here are a few examples of how you can use the **PKWLabelFuel** class in your PHP projects to generate and display electric vehicle labels.

**[⬆ Back to services](#services)**

#### 1. Generate Filename

This example generates the filename for the PDF without creating the actual file:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHybrid;

$pkwLabelFilename = PKWLabelHybrid::make('<your-api-key>')
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
    ->generateFilename();

echo $pkwLabelFilename;
```

**[⬆ Back to services](#services)**

#### 2. Generate Filename with Path

If you want to include the output directory in the filename:

```php
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
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->generateFullFilename();

echo $pkwLabelFullFilename;
```

**[⬆ Back to services](#services)**

#### 3. Create PDF

This example shows how to create the PDF and save it to the output directory:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHybrid;

PKWLabelHybrid::make('<your-api-key>')
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
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->createPdf();
```

**[⬆ Back to services](#services)**

#### 4. Create and Display PDF

This example creates the PDF and displays it directly in the browser:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHybrid;

PKWLabelHybrid::make('<your-api-key>')
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
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->createPdf()
    ->displayPdf();
```

**[⬆ Back to services](#services)**

#### 5. Display Already Created PDF

If the PDF is already created, you can directly display it:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHybrid;

PKWLabelHybrid::make('<your-api-key>')
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
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->displayPdf();
```

**[⬆ Back to services](#services)**

#### 6. Ensure PDF Exists and Print

This function checks if the PDF already exists. If not, it generates the PDF and displays it:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHybrid;

PKWLabelHybrid::make('<your-api-key>')
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
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->ensurePdfAndPrint();
```

**[⬆ Back to services](#services)**

## PKW Label Hydrogen

The **PKW Label Hydrogen** API enables the automatic creation of energy labels for hydrogen-powered vehicles. This API is designed to provide critical information, including fuel consumption across various driving conditions (such as city, suburban, rural, and highway), along with other essential details like vehicle identification (FIN). This labeling functionality is tailored to meet the EnVKV (German Energy Consumption Labeling Ordinance) requirements, simplifying regulatory compliance for dealerships and vehicle manufacturers.

This tool allows you to efficiently create accurate and standardized labels for hydrogen vehicles with minimal manual intervention.

### Example Usage

Here are a few examples of how you can use the **PKWLabelFuel** class in your PHP projects to generate and display electric vehicle labels.

**[⬆ Back to services](#services)**

#### 1. Generate Filename

This example generates the filename for the PDF without creating the actual file:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHydrogen;

$pkwLabelFilename = PKWLabelHydrogen::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setConsumption('8.5')
    ->setConsumptionCity('9.3')
    ->setConsumptionSuburban('8.9')
    ->setConsumptionRural('8')
    ->setConsumptionHighway('7.2')
    ->setFin('1234567891011')
    ->generateFilename();

echo $pkwLabelFilename;
```

**[⬆ Back to services](#services)**

#### 2. Generate Filename with Path

If you want to include the output directory in the filename:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHydrogen;

$pkwLabelFullFilename = PKWLabelHydrogen::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setConsumption('8.5')
    ->setConsumptionCity('9.3')
    ->setConsumptionSuburban('8.9')
    ->setConsumptionRural('8')
    ->setConsumptionHighway('7.2')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->generateFullFilename();

echo $pkwLabelFullFilename;
```

**[⬆ Back to services](#services)**

#### 3. Create PDF

This example shows how to create the PDF and save it to the output directory:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHydrogen;

PKWLabelHydrogen::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setConsumption('8.5')
    ->setConsumptionCity('9.3')
    ->setConsumptionSuburban('8.9')
    ->setConsumptionRural('8')
    ->setConsumptionHighway('7.2')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->createPdf();
```

**[⬆ Back to services](#services)**

#### 4. Create and Display PDF

This example creates the PDF and displays it directly in the browser:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHydrogen;

PKWLabelHydrogen::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setConsumption('8.5')
    ->setConsumptionCity('9.3')
    ->setConsumptionSuburban('8.9')
    ->setConsumptionRural('8')
    ->setConsumptionHighway('7.2')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->createPdf()
    ->displayPdf();
```

**[⬆ Back to services](#services)**

#### 5. Display Already Created PDF

If the PDF is already created, you can directly display it:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHydrogen;

PKWLabelHydrogen::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setConsumption('8.5')
    ->setConsumptionCity('9.3')
    ->setConsumptionSuburban('8.9')
    ->setConsumptionRural('8')
    ->setConsumptionHighway('7.2')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->displayPdf();
```

**[⬆ Back to services](#services)**

#### 6. Ensure PDF Exists and Print

This function checks if the PDF already exists. If not, it generates the PDF and displays it:

```php
use CeytekLabs\FiftyFourGradDeServicesLite\EnVKV\PKWLabelHydrogen;

PKWLabelHydrogen::make('<your-api-key>')
    ->setManufacturer('Škoda')
    ->setModel('Octavia Combi RS')
    ->setConsumption('8.5')
    ->setConsumptionCity('9.3')
    ->setConsumptionSuburban('8.9')
    ->setConsumptionRural('8')
    ->setConsumptionHighway('7.2')
    ->setFin('1234567891011')
    ->setOutputDirectory(__DIR__ . '/pdfs')
    ->ensurePdfAndPrint();
```
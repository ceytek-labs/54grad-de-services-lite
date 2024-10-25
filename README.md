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

**The PKW Label Electric API** allows users to generate energy labels for electric vehicles, including key information such as electric consumption, driving range, and vehicle identification numbers (FIN). It automates the process of creating legally required labels under the EnVKV (German Energy Consumption Labeling Ordinance), making it easier for dealerships and vehicle manufacturers to comply with regulations.

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
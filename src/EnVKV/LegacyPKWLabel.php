<?php

namespace CeytekLabs\FiftyFourGradDeServicesLite\EnVKV;

class LegacyPKWLabel
{
    private $api = 'https://envkv.54grad.de/api/pkwlabel';
    private $key;

    private $brand;
    private $model;
    private $power;
    private $fuelType;
    private $mass;
    private $co2Emission;
    private $engineCapacity;
    private $consumption;
    private $consumptionCity;
    private $consumptionHighway;

    private $filename = null;
    private $outputDirectory;

    public static function make(string $key = null): self
    {
        if (is_null($key)) {
            throw new \Exception('Key must be filled');
        }

        $instance = new self;

        $instance->key = $key;

        return $instance;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function setPower(string $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function setFuelType(string $fuelType): self
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    public function setMass(string $mass): self
    {
        $this->mass = $mass;

        return $this;
    }

    public function setCo2Emission(string $co2Emission): self
    {
        $this->co2Emission = $co2Emission;

        return $this;
    }

    public function setEngineCapacity(string $engineCapacity): self
    {
        $this->engineCapacity = $engineCapacity;

        return $this;
    }

    public function setConsumption(string $consumption): self
    {
        $this->consumption = $consumption;

        return $this;
    }

    public function setConsumptionCity(string $consumptionCity): self
    {
        $this->consumptionCity = $consumptionCity;

        return $this;
    }

    public function setConsumptionHighway(string $consumptionHighway): self
    {
        $this->consumptionHighway = $consumptionHighway;

        return $this;
    }

    public function setOutputDirectory(string $outputDirectory): self
    {
        if (!is_dir($outputDirectory)) {
            mkdir($outputDirectory, 0755, true);
        }

        $this->outputDirectory = $outputDirectory;

        return $this;
    }

    public function generateFilename(): string
    {
        $fields = [];

        if (!isset($this->brand)) {
            throw new \Exception('Please set your brand');
        }

        $fields['marke'] = $this->brand;

        if (!isset($this->model)) {
            throw new \Exception('Please set your model');
        }

        $fields['modell'] = $this->model;

        if (!isset($this->power)) {
            throw new \Exception('Please set your power (kw)');
        }

        $fields['kw'] = $this->power;

        if (!isset($this->fuelType)) {
            throw new \Exception('Please set your fuel type');
        }

        $fields['kraftstoff'] = $this->fuelType;

        if (!isset($this->mass)) {
            throw new \Exception('Please set your mass');
        }

        $fields['masse'] = $this->mass;

        if (!isset($this->co2Emission)) {
            throw new \Exception('Please set your CO2 emission');
        }

        $fields['co2'] = $this->co2Emission;

        if (!isset($this->engineCapacity)) {
            throw new \Exception('Please set your engine capacity (hubraum)');
        }

        $fields['hubraum'] = $this->engineCapacity;

        if (!isset($this->consumption)) {
            throw new \Exception('Please set your consumption');
        }

        $fields['verbrauch'] = $this->consumption;

        if (!isset($this->consumptionCity)) {
            throw new \Exception('Please set your city consumption (verbrauch_in)');
        }

        $fields['verbrauch_in'] = $this->consumptionCity;

        if (!isset($this->consumptionHighway)) {
            throw new \Exception('Please set your highway consumption (verbrauch_au)');
        }

        $fields['verbrauch_au'] = $this->consumptionHighway;

        $filename = 'pkw-label-'.md5(implode('-', $fields)).'.pdf';

        return $filename;
    }

    public function generateFullFilename()
    {
        if (!isset($this->outputDirectory)) {
            throw new \Exception('Output directory is not set');
        }

        return $this->outputDirectory.'/'.$this->generateFilename();
    }

    public function createPdf(): self
    {
        $this->filename = $this->generateFullFilename();

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query([
                'marke' => $this->brand,
                'modell' => $this->model,
                'kw' => $this->power,
                'kraftstoff' => $this->fuelType,
                'masse' => $this->mass,
                'co2' => $this->co2Emission,
                'hubraum' => $this->engineCapacity,
                'verbrauch' => $this->consumption,
                'verbrauch_in' => $this->consumptionCity,
                'verbrauch_au' => $this->consumptionHighway,
            ]),
            CURLOPT_HTTPHEADER => [
                'x-apikey: ' . $this->key,
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            throw new \Exception('Curl error: ' . curl_error($curl));
        }

        curl_close($curl);

        file_put_contents($this->filename, $response);

        return $this;
    }

    public function displayPdf()
    {
        if (!isset($this->filename)) {
            $this->filename = $this->generateFullFilename();
        }

        if (!file_exists($this->filename)) {
            throw new \Exception('PDF file not found. You must call generatePdf() first.');
        }

        header('Content-Type: application/pdf');
        readfile($this->filename);
        exit;
    }

    public function ensurePdfAndPrint()
    {
        if (!isset($this->filename)) {
            $this->filename = $this->generateFullFilename();
        }

        if (!file_exists($this->filename)) {
            $this->createPdf();            
        }

        if (!file_exists($this->filename)) {
            throw new \Exception('PDF file not found. Something went wrong.');
        }

        header('Content-Type: application/pdf');
        readfile($this->filename);
        exit;
    }
}

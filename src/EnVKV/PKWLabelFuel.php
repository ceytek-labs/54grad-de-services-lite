<?php

namespace CeytekLabs\FiftyFourGradDeServicesLite\EnVKV;

class PKWLabelFuel
{
    private $api = 'https://api.pkwlabel.com/v1/pkwlabel/fuel';
    private $key;

    private $make;
    private $model;
    private $fuel;
    private $consumption;
    private $consumptionCity;
    private $consumptionSuburban;
    private $consumptionRural;
    private $consumptionHighway;
    private $co2Combined;
    private $cubicCapacity;
    private $fin;

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

    public function setMake(string $make): self
    {
        $this->make = $make;

        return $this;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;

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

    public function setConsumptionSuburban(string $consumptionSuburban): self
    {
        $this->consumptionSuburban = $consumptionSuburban;

        return $this;
    }

    public function setConsumptionRural(string $consumptionRural): self
    {
        $this->consumptionRural = $consumptionRural;

        return $this;
    }

    public function setConsumptionHighway(string $consumptionHighway): self
    {
        $this->consumptionHighway = $consumptionHighway;

        return $this;
    }

    public function setCo2Combined(string $co2Combined): self
    {
        $this->co2Combined = $co2Combined;

        return $this;
    }

    public function setCubicCapacity(string $cubicCapacity): self
    {
        $this->cubicCapacity = $cubicCapacity;

        return $this;
    }

    public function setFin(string $fin): self
    {
        $this->fin = $fin;

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

        if (!isset($this->make)) {
            throw new \Exception('Please set your make');
        }

        $fields['make'] = $this->make;

        if (!isset($this->model)) {
            throw new \Exception('Please set your model');
        }

        $fields['model'] = $this->model;

        if (!isset($this->fuel)) {
            throw new \Exception('Please set your fuel type');
        }

        $fields['fuel'] = $this->fuel;

        if (!isset($this->fin)) {
            throw new \Exception('Please set your FIN (vehicle identification number)');
        }

        $fields['fin'] = $this->fin;

        $filename = 'pkw-label-fuel-'.md5(implode('-', $fields)).'.pdf';

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
            CURLOPT_POSTFIELDS => json_encode([
                'make' => $this->make,
                'model' => $this->model,
                'fuel' => $this->fuel,
                'consumption' => $this->consumption,
                'consumption_city' => $this->consumptionCity,
                'consumption_suburban' => $this->consumptionSuburban,
                'consumption_rural' => $this->consumptionRural,
                'consumption_highway' => $this->consumptionHighway,
                'co2_combined' => $this->co2Combined,
                'cubic_capacity' => $this->cubicCapacity,
                'fin' => $this->fin
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization' => 'Bearer '.$this->key
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
            throw new \Exception('PDF file not found. You must call createPdf() first.');
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

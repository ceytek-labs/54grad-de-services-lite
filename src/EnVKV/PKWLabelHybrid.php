<?php

namespace CeytekLabs\FiftyFourGradDeServicesLite\EnVKV;

class PKWLabelHybrid
{
    private $api = 'https://api.pkwlabel.com/v1/pkwlabel/hybrid';
    private $key;

    private $make;
    private $model;
    private $fuel;
    private $weightedConsumption;
    private $electricWeightedConsumption;
    private $consumption;
    private $consumptionCity;
    private $consumptionSuburban;
    private $consumptionRural;
    private $consumptionHighway;
    private $electricConsumption;
    private $electricConsumptionCity;
    private $electricConsumptionSuburban;
    private $electricConsumptionRural;
    private $electricConsumptionHighway;
    private $co2Combined;
    private $co2Discharged;
    private $cubicCapacity;
    private $rangeEaer;
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

    public function setWeightedConsumption(string $weightedConsumption): self
    {
        $this->weightedConsumption = $weightedConsumption;
        
        return $this;
    }

    public function setElectricWeightedConsumption(string $electricWeightedConsumption): self
    {
        $this->electricWeightedConsumption = $electricWeightedConsumption;
        
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

    public function setElectricConsumption(string $electricConsumption): self
    {
        $this->electricConsumption = $electricConsumption;
        
        return $this;
    }

    public function setElectricConsumptionCity(string $electricConsumptionCity): self
    {
        $this->electricConsumptionCity = $electricConsumptionCity;
        
        return $this;
    }

    public function setElectricConsumptionSuburban(string $electricConsumptionSuburban): self
    {
        $this->electricConsumptionSuburban = $electricConsumptionSuburban;
        
        return $this;
    }

    public function setElectricConsumptionRural(string $electricConsumptionRural): self
    {
        $this->electricConsumptionRural = $electricConsumptionRural;
        
        return $this;
    }

    public function setElectricConsumptionHighway(string $electricConsumptionHighway): self
    {
        $this->electricConsumptionHighway = $electricConsumptionHighway;
        
        return $this;
    }

    public function setCo2Combined(string $co2Combined): self
    {
        $this->co2Combined = $co2Combined;
        
        return $this;
    }

    public function setCo2Discharged(string $co2Discharged): self
    {
        $this->co2Discharged = $co2Discharged;
        
        return $this;
    }

    public function setCubicCapacity(string $cubicCapacity): self
    {
        $this->cubicCapacity = $cubicCapacity;
        
        return $this;
    }

    public function setRangeEaer(string $rangeEaer): self
    {
        $this->rangeEaer = $rangeEaer;
        
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
            throw new \Exception('Please set your fuel');
        }

        $fields['fuel'] = $this->fuel;

        if (!isset($this->fin)) {
            throw new \Exception('Please set your FIN (vehicle identification number)');
        }

        $fields['fin'] = $this->fin;

        $filename = 'pkw-label-hybrid-' . md5(implode('-', $fields)) . '.pdf';

        return $filename;
    }

    public function generateFullFilename(): string
    {
        if (!isset($this->outputDirectory)) {
            throw new \Exception('Output directory is not set');
        }

        return $this->outputDirectory . '/' . $this->generateFilename();
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
                'weighted_consumption' => $this->weightedConsumption,
                'electric_weighted_consumption' => $this->electricWeightedConsumption,
                'consumption' => $this->consumption,
                'consumption_city' => $this->consumptionCity,
                'consumption_suburban' => $this->consumptionSuburban,
                'consumption_rural' => $this->consumptionRural,
                'consumption_highway' => $this->consumptionHighway,
                'electric_consumption' => $this->electricConsumption,
                'electric_consumption_city' => $this->electricConsumptionCity,
                'electric_consumption_suburban' => $this->electricConsumptionSuburban,
                'electric_consumption_rural' => $this->electricConsumptionRural,
                'electric_consumption_highway' => $this->electricConsumptionHighway,
                'co2_combined' => $this->co2Combined,
                'co2_discharged' => $this->co2Discharged,
                'cubic_capacity' => $this->cubicCapacity,
                'range_eaer' => $this->rangeEaer,
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

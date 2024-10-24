<?php

namespace CeytekLabs\FiftyFourGradDeServicesLite\EnVKV;

class PKWLabelElectric
{
    private $api = 'https://api.pkwlabel.com/v1/pkwlabel/electric';
    private $key;

    private $make;
    private $model;
    private $electricConsumption;
    private $electricConsumptionCity;
    private $electricConsumptionSuburban;
    private $electricConsumptionRural;
    private $electricConsumptionHighway;
    private $range;
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

    public function setRange(string $range): self
    {
        $this->range = $range;

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

        if (!isset($this->electricConsumption)) {
            throw new \Exception('Please set your electric consumption');
        }

        $fields['electric_consumption'] = $this->electricConsumption;

        if (!isset($this->fin)) {
            throw new \Exception('Please set your FIN (vehicle identification number)');
        }

        $fields['fin'] = $this->fin;

        $filename = 'pkw-label-electric-'.md5(implode('-', $fields)).'.pdf';

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
                'electric_consumption' => $this->electricConsumption,
                'electric_consumption_city' => $this->electricConsumptionCity,
                'electric_consumption_suburban' => $this->electricConsumptionSuburban,
                'electric_consumption_rural' => $this->electricConsumptionRural,
                'electric_consumption_highway' => $this->electricConsumptionHighway,
                'range' => $this->range,
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

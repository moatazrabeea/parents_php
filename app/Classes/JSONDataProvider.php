<?php

namespace App\Classes;

class JSONDataProvider
{
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function getData()
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $jsonData = file_get_contents($this->filePath);

        if ($jsonData === false) {
            return [];
        }

        return json_decode($jsonData, true) ?: [];
    }
}
<?php

namespace App\Classes;

class DataProviderX implements DataProviderInterface {
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }
    private function translateStatusCode($genericStatusCode) {
        $mapping = [
            'authorised' => 1,
            'decline' => 2,
            'refunded' => 3
        ];
        return $mapping[$genericStatusCode] ?? null;
    }
    public function getData(array $filters): array {
        if (isset($filters['statusCode'])) {
            $filters['statusCode'] = $this->translateStatusCode($filters['statusCode']);
        }

        $data = json_decode(file_get_contents($this->filePath), true);
        return array_filter($data, function ($item) use ($filters) {
            foreach ($filters as $key => $value) {
                if (isset($item[$key]) && $item[$key] != $value) {
                    return false;
                }
            }
            return true;
        });
    }
}

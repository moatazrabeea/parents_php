<?php

namespace App\Classes;

class DataFilter
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function filter($filters)
    {
        foreach ($filters as $key => $value) {
            $this->data = array_filter($this->data, function ($transaction) use ($key, $value) {
                return isset($transaction[$key]) && $transaction[$key] == $value;
            });
        }

        return $this->data;
    }
}
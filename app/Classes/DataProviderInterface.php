<?php

namespace App\Classes;

interface DataProviderInterface {
    public function getData(array $filters): array;
}

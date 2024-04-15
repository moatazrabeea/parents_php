<?php

require_once 'vendor/autoload.php';


use App\Classes\DataCombiner;
use App\Classes\DataProviderX;
use App\Classes\DataProviderY;

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
switch ($request) {
    case '/api/v1/users':
        // Create data combiner and add providers
        $dataCombiner = new DataCombiner();
        $dataCombiner->addProvider(new DataProviderX('data/DataProviderX.json'));
        $dataCombiner->addProvider(new DataProviderY('data/DataProviderY.json'));

// Handle API request
        $filters = $_GET; // Assuming filters are passed through query parameters
        $users = $dataCombiner->combineData($filters);
// Return JSON response
        header('Content-Type: application/json');
        echo json_encode($users, JSON_PRETTY_PRINT);

        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Resource not found']);
        break;
}


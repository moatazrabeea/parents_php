<?php

require_once 'vendor/autoload.php';

use App\Classes\JSONDataProvider;
use App\Classes\DataCombiner;
use App\UserAPI;

// Create data combiner and add providers
$dataCombiner = new DataCombiner();
$dataCombiner->addProvider(new JSONDataProvider('data/DataProviderX.json'));
$dataCombiner->addProvider(new JSONDataProvider('data/DataProviderY.json'));

// Create API instance
$api = new UserAPI($dataCombiner);

// Handle API request
$filters = $_GET; // Assuming filters are passed through query parameters
$users = $api->getUsers($filters);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($users, JSON_PRETTY_PRINT);

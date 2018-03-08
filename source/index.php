<?php

namespace App;

require 'vendor/autoload.php';
include 'Services/Search.php';
include 'Services/ApiHandler.php';

use App\Services\{ApiHandler,Search};
use Aura\Router\RouterContainer;

$apiHandler = new ApiHandler();

$filters = array();

// Check our filters to push them into our filters array

if (isset($_GET['name']))
	$filters['name'] = $_GET['name'];

if (isset($_GET['priceFrom']) && is_numeric($_GET['priceFrom']))
	$filters['priceFrom'] = $_GET['priceFrom'];

if (isset($_GET['priceTo']) && is_numeric($_GET['priceTo']))
	$filters['priceTo'] = $_GET['priceTo'];

// Get our Hotels Object from the given api
$json = $apiHandler->callApi('GET' , 'https://api.myjson.com/bins/tl0bp');

$searchObject = new Search($json);

// Search in our json response with our filters
$result = $searchObject->searchInTheJson($filters);

// If we have sortBy query parameter we allowing sorting
if (isset($_GET['sortBy'])){
	$result = $searchObject->sortTheResult($result,$_GET['sortBy']);
}

// destroying our apiHandler object to close our curl session
unset($apiHandler);

// returning our result as json response
header('Content-Type: application/json');

echo json_encode($result);

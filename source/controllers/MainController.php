<?php

namespace App\Controllers;

require 'vendor/autoload.php';
include 'Services/Search.php';
include 'Services/ApiHandler.php';
include 'Services/Sort.php';
include 'Services/Validator.php';
include 'Services/HotelMapperService.php';

use App\Services\{ApiHandler,Search,Sort,Validator,HotelMapperService};

/**
* This is a class is our main class
*
* @author     Hussien
* @version    1
* ...
*/
class MainController
{
	private $apiHandler;
	private $validator;
	private $hotelMapperService;
	private $configs;

	public function __construct(ApiHandler $apiHandler , Validator $validator , HotelMapperService $hotelMapperService)
	{
		$this->apiHandler = $apiHandler;
		$this->validator = $validator;
		$this->hotelMapperService = $hotelMapperService;
		$this->configs = include ('config/configs.php');
	}
	/**
	* This function for running our application
	*/
	public function run()
	{
		$filters = array ();

		$filters = $this->validator->validate($this->configs['request']);

		$json = $this->apiHandler->callApi($this->configs['method'] , $this->configs['url']);
		
		$hotels = $this->hotelMapperService->mapJsonToHotels($json);

		$search = new Search($hotels);

		$result = $search->searchInHotels($filters);

		if ($filters['sortBy']){
			$sort = new Sort($result);
			if($filters['sortBy'] == 'name') {
				$result = $sort->sortByName();
			} else if ($filters['sortBy'] == 'price') {
				$result = $sort->sortByPrice();
			}
		}

		$result = $this->hotelMapperService->serialize($result);

		header('Content-Type: application/json');

		echo json_encode($result);
	}
}
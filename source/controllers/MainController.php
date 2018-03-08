<?php

namespace App\Controllers;

require 'vendor/autoload.php';
include 'Services/Search.php';
include 'Services/ApiHandler.php';
include 'Services/Sort.php';
include 'Services/Validator.php';

use App\Services\{ApiHandler,Search,Sort,Validator};

class MainController
{
	private $apiHandler;
	private $validator;
	private $configs;

	public function __construct(ApiHandler $apiHandler , Validator $validator)
	{
		$this->apiHandler = $apiHandler;
		$this->validator = $validator;
		$this->configs = include ('config/configs.php');
	}

	public function run()
	{
		$filters = array ();

		$filters = $this->validator->validate($this->configs['request']);

		$json = $this->apiHandler->callApi($this->configs['method'] , $this->configs['url']);

		$search = new Search($json);

		$result = $search->searchInTheJson($filters);

		if ($filters['sortBy']){
			$sort = new Sort($result);
			if($filters['sortBy'] == 'name') {
				$result = $sort->sortByName();
			} else if ($filters['sortBy'] == 'price') {
				$result = $sort->sortByPrice();
			}
		}

		header('Content-Type: application/json');

		echo json_encode($result);
	}
}
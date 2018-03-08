<?php

namespace App\Services;

/**
* This is a class to search in a json object and return the result
*
* @author     Hussien
* @version    1
* ...
*/
Class Search {

	private $json;

	/**
	* Here we assign our private property the json object we want to search
	*/
	public function __construct(string $json)
	{
		$this->json = $json;
	}

	/**
	* Here we search in the json
	*/
	public function searchInTheJson(array $filters = []): array
	{
		// code to search in the json
		$result = array();
		$arrayToSearchIn = $this->convertJSONToArray($this->json);
		$hotels = $arrayToSearchIn["hotels"];

		if(count($filters) > 0) {
			if (isset($filters['name'])) {
				$hotels = array_filter($hotels , function($hotel) use ( $filters ) {
					return $filters['name'] == $hotel->name;
				});
			}			
			if(isset($filters['priceFrom']) && isset($filters['priceTo'])) {
				$hotels = array_filter( $hotels, function($hotel) use ( $filters ) {
					return ((float)$filters['priceFrom'] <= $hotel->price && (float)$filters['priceTo'] >= $hotel->price);
				});				
			} else if (isset($filters['priceFrom'])) {
				$hotels = array_filter( $hotels, function($hotel) use ( $filters ) {
					return (float)$filters['priceFrom'] <= $hotel->price;
				});
			} else if (isset($filters['priceTo'])){
				$hotels = array_filter( $hotels, function($hotel) use ( $filters ) {
					return $filters['priceTo'] >= $hotel->price;
				});
			}
			return $hotels;
		} else {
			return $hotels;
		}
	}

	/**
	* This function for converting the JSON object to array
	* @param $json
	* @return array
	*/
	public function convertJSONToArray(string $json): array
	{
		return (array)json_decode($json);
	}

	/**
	* This function for sorting the result based on sortBy parameter
	* @param array $arrayWantToBeSorted
	* @param string $sortBy
	* @return array
	*/
	public function sortTheResult(array $arrayWantToBeSorted , string $sortBy): array
	{
		if($sortBy == 'name') {
			$names = array();
			foreach ($arrayWantToBeSorted as $key => $row)
			{
			    $names[$key] = $row->name;
			}
			array_multisort($names, SORT_ASC, $arrayWantToBeSorted);
			return $arrayWantToBeSorted;
		} else if ($sortBy == 'price') {
			$prices = array();
			foreach ($arrayWantToBeSorted as $key => $row)
			{
			    $prices[$key] = $row->price;
			}
			array_multisort($prices, SORT_ASC, $arrayWantToBeSorted);
			return $arrayWantToBeSorted;
		}
		else {
			return $arrayWantToBeSorted;
		}
	}
} 

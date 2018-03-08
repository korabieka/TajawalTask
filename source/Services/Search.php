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
		$arrayToSearchIn = $this->convertJSONToArray($this->json);
		$hotels = $arrayToSearchIn["hotels"];

		// Applying filters if they are exists
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
			$result = $hotels;
		} else {
			$result = $hotels;
		}

		return $result;
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
} 

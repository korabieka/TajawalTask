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

	private $hotels;

	/**
	* Here we assign our private property the json object we want to search
	* @param array $hotels
	*/
	public function __construct(array $hotels)
	{
		$this->hotels = $hotels;
	}

	/**
	* Here we search in mapped hotels
	* @param array $filters
	* @return array
	*/
	public function searchInHotels(array $filters = []): array
	{

		// Applying filters if they are exists

		if(count($filters) > 0) {

			if ($filters['name']) {
				$this->hotels = array_filter($this->hotels , function($hotel) use ( $filters ) {
					return $filters['name'] == $hotel->getName();
				});
			}

			if($filters['priceFrom'] && $filters['priceTo']) {
				$this->hotels = array_filter( $this->hotels, function($hotel) use ( $filters ) {
					return ((float)$filters['priceFrom'] <= $hotel->getPrice() && (float)$filters['priceTo'] >= $hotel->getPrice());
				});				
			} else {

				if ($filters['priceFrom']) {
					$this->hotels = array_filter( $this->hotels, function($hotel) use ( $filters ) {
						return (float)$filters['priceFrom'] <= $hotel->getPrice();
					});
				} 
			 	
			 	if ($filters['priceTo']){
					$this->hotels = array_filter( $this->hotels, function($hotel) use ( $filters ) {
					return $filters['priceTo'] >= $hotel->getPrice();
					});
				}
			}
			$result = $this->hotels;
		} else {
			$result = $this->hotels;
		}

		return $result;
	}
} 

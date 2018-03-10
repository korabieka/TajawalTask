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

			if (isset($filters['name'])) {
				$this->hotels = $this->searchByName($this->hotels, $filters);
			}

			if(isset($filters['priceFrom']) && isset($filters['priceTo'])) {

				$this->hotels = $this->searchByPrice($this->hotels,'fromTo', $filters);

			} else {

				if (isset($filters['priceFrom'])) {
					$this->hotels = $this->searchByPrice($this->hotels,'from', $filters);	
				} 
			 	
			 	if (isset($filters['priceTo'])){
					$this->hotels = $this->searchByPrice($this->hotels,'to', $filters);	
				}
			}
			$result = $this->hotels;
		} else {
			$result = $this->hotels;
		}

		return $result;
	}

	/**
	* Here we search by name
	* @param array $hotels
	* @return array
	*/
	public function searchByName(array $hotels , array $filters): array
	{
		$hotels = array_filter($hotels , function($hotel) use ( $filters ) {
			return $filters['name'] == $hotel->getName();
		});

		return $hotels;
	}

	/**
	* Here we search by price range
	* @param array $filters
	* @param string $priceRange
	* @param array $filters
	* @return array
	*/
	public function searchByPrice(array $hotels , string $priceRange , array $filters): array
	{
		switch ($priceRange) {
			case 'fromTo':
				$hotels = array_filter($hotels, function($hotel) use ( $filters ) {
					return ((float)$filters['priceFrom'] <= $hotel->getPrice() && (float)$filters['priceTo'] >= $hotel->getPrice());
				});	
				break;
			case 'from':
				$hotels = array_filter($hotels, function($hotel) use ( $filters ) {
						return (float)$filters['priceFrom'] <= $hotel->getPrice();
					});
				break;
			case 'to':
				$hotels = array_filter($hotels, function($hotel) use ( $filters ) {
					return $filters['priceTo'] >= $hotel->getPrice();
					});
				break;
		}
		return $hotels ;
	}
} 

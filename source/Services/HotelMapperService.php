<?php

namespace App\Services;

include './Mappers/HotelMapper.php';

use App\Mappers\HotelMapper;

/**
* This is a class acts as a service which map json to our mapped object (hotel)
*
* @author     Hussien
* @version    1
* ...
*/
class HotelMapperService
{
	/**
	* This function to map json to hotel object
	* @param string $json
	* @return array
	*/
	public function mapJsonToHotels(string $json): array
	{
		$hotelMapper = new HotelMapper();

		$mappedHotels = array();

		$hotels = json_decode($json)->hotels;

		foreach ($hotels as $hotel) {
			$clonedHotelMapper = clone $hotelMapper;
			$clonedHotelMapper->setName($hotel->name);
			$clonedHotelMapper->setPrice($hotel->price);
			$clonedHotelMapper->setCity($hotel->city);
			$clonedHotelMapper->setAvailability($hotel->availability);
			$mappedHotels[] = $clonedHotelMapper;
		}

		return $mappedHotels;
	}

	/**
	* This function to serialize our array of objects
	* @param array $hotels
	* @return array
	*/
	public function serialize(array $hotels): array
	{
		$serializedHotels = array();

		foreach ($hotels as $hotel) {
			$serializedHotels[] =  $hotel->toArray();
		}
		return $serializedHotels;
	}
}
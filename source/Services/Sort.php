<?php

namespace App\Services;

/**
* This is a class is responsible for sorting objects in an array
*
* @author     Hussien
* @version    1
* ...
*/
class Sort
{
	private $arrayToBeSorted;

	/**
	* This is a constructor function
	* @param array $array
	*/
	public function __construct(array $array)
	{
		$this->arrayToBeSorted = $array;
	}

	/**
	* This function for sorting the result by hotel name
	* @return array
	*/
	public function sortByname(): array
	{
		$names = array();
		
		foreach ($this->arrayToBeSorted as $key => $row) {
		    $names[$key] = $row->getName();
		}

		array_multisort($names, SORT_ASC, $this->arrayToBeSorted);
		
		return $this->arrayToBeSorted;
	}

	/**
	* This function for sorting the result by price
	* @return array
	*/
	public function sortByPrice(): array
	{
		$prices = array();

		foreach ($this->arrayToBeSorted as $key => $row) {
		    $prices[] = $row->getPrice();
		}

		array_multisort($prices, SORT_ASC, $this->arrayToBeSorted);

		return $this->arrayToBeSorted;
	}
}
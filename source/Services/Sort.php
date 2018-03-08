<?php

namespace App\Services;

class Sort
{
	private $arrayToBeSorted;

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
		    $names[$key] = $row->name;
		}

		array_multisort($names, SORT_ASC, $arrayToBeSorted);
		
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
		    $prices[$key] = $row->price;
		}

		array_multisort($prices, SORT_ASC, $this->arrayToBeSorted);
		
		return $this->arrayToBeSorted;
	}
}
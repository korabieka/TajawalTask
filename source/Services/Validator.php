<?php

namespace App\Services;

class Validator
{
	public $filters = array();

	public function __construct()
	{

	}

	public function validate(array $filters): array
	{
		if ($filters['name'])
			$this->filters['name'] = $filters['name'];
		if ($filters['priceFrom'] && is_numeric($filters['priceFrom']))
			$this->filters['priceFrom'] = $filters['priceFrom'];
		if ($filters['priceTo'] && is_numeric($filters['priceTo']))
			$this->filters['priceTo'] = $filters['priceTo'];
		if ($filters['sortBy'])
			$this->filters['sortBy'] = $filters['sortBy'];
		return $this->filters;
	}
}
<?php

namespace App\Mappers;

class Hotel
{
    /**
    * Hotel name
    * @var string
    */
    private $name;

    /**
    * Hotel price
    * @var float
    */
    private $price;

    /**
    * Hotel city
    * @var string
    */
    private $city;

    
    /**
    * Hotel availability
    * @var array
    */
    private $availability;

    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return array
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @param array $availability
     *
     * @return self
     */
    public function setAvailability(array $availability)
    {
        $this->availability = $availability;

        return $this;
    }

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'city' => $this->getCity(),
            'availability' => $this->getAvailability(),
        ];
    }
}

<?php

namespace App\Mappers;

class HotelMapper
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return self
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return self
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return array
     */
    public function getAvailability(): array
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
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'city' => $this->getCity(),
            'availability' => $this->getAvailability(),
        ];
    }
}

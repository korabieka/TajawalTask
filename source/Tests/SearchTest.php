<?php

require 'vendor/autoload.php';
include './Services/Search.php';
include './Services/HotelMapperService.php';
include 'HotelHelper.php';

use PHPUnit\Framework\TestCase;
use App\Services\{Search,HotelMapperService};
use App\Mappers\HotelMapper;
/**
* This is a class to test our api
*
* @author     Hussien
* @version    1
* ...
*/
class SearchTest extends TestCase
{
    use HotelHelper;

    private $hotelMapperService;
    private $jsonHotels;
    private $mappedHotels;
    
    /**
    * Here we we can map our mockup to our hotels mapper class
    */
    protected function setUp()
    {
        $this->hotelMapperService = new HotelMapperService();
        $this->jsonHotels = json_encode($this->getHotelsRequestExample());
        $this->mappedHotels = $this->hotelMapperService->mapJsonToHotels($this->jsonHotels);
    }

    /**
    * Here we we test our response's structure and type when we search by name
    */
    
    public function testSearchByName()
    {
        $search=new Search($this->mappedHotels);
        $result=$search->searchInHotels(["name"=>"Rotana Hotel"]);
        $this->assertInternalType('array',$result);
        foreach ($result as $hotel) {
            $this->assertObjectHasAttribute('name', $hotel);
            $this->assertObjectHasAttribute('price', $hotel);
            $this->assertObjectHasAttribute('city', $hotel);
            $this->assertObjectHasAttribute('availability', $hotel);
        }
    }

    /**
    * Here we we test our response's structure and type when we search by price
    */
    public function testSearchByPrice()
    {
        $search=new Search($this->mappedHotels);
        $result=$search->searchInHotels(["priceFrom"=>"100","priceTo"=>"150"]);
        $this->assertInternalType('array',$result);
        foreach ($result as $hotel) {
            $this->assertObjectHasAttribute('name', $hotel);
            $this->assertObjectHasAttribute('price', $hotel);
            $this->assertObjectHasAttribute('city', $hotel);
            $this->assertObjectHasAttribute('availability', $hotel);
        }   
    }
}

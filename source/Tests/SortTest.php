<?php

require_once 'vendor/autoload.php';
include_once './Services/Sort.php';
include_once './Services/HotelMapperService.php';
include_once 'HotelHelper.php';

use PHPUnit\Framework\TestCase;
use App\Services\{Sort,HotelMapperService};
use App\Mappers\HotelMapper;
/**
* This is a class to test our Sorting service
*
* @author     Hussien
* @version    1
* ...
*/
class SortTest extends TestCase
{
    use HotelHelper;

    private $hotelMapperService;
    private $jsonHotels;
    private $mappedHotels;
    private $sort;
    /**
    * Here we we can map our mockup to our hotels mapper class
    */
    protected function setUp()
    {
        $this->hotelMapperService = new HotelMapperService();
        $this->jsonHotels = json_encode($this->getHotelsRequestExample());
        $this->mappedHotels = $this->hotelMapperService->mapJsonToHotels($this->jsonHotels);
        $this->sort = new Sort($this->mappedHotels);
    }

    /**
    * Here we we test our response's structure and type when we sort by name
    */
    
    public function testSortByName()
    {
        $result=$this->sort->sortByName();
        $result = $this->hotelMapperService->serialize($result);
        $this->assertInternalType('array',$result);
        foreach ($result as $i => $hotel) {
            $this->assertGreaterThan($result[$i+1]['name'],$hotel['name']);
            $this->assertArrayHasKey('name', $hotel);
            $this->assertArrayHasKey('price', $hotel);
            $this->assertArrayHasKey('city', $hotel);
            $this->assertArrayHasKey('availability', $hotel);
        }
    }

    /**
    * Here we we test our response's structure and type when we sort by price
    */
    public function testSortByPrice()
    {
        $result=$this->sort->sortByPrice();
        $result = $this->hotelMapperService->serialize($result);
        $this->assertInternalType('array',$result);
        foreach ($result as $i => $hotel) {
            var_dump($hotel['price']);die;
            $this->assertGreaterThan($result[$i+1]['price'],$hotel['price']);
            $this->assertArrayHasKey('name', $hotel);
            $this->assertArrayHasKey('price', $hotel);
            $this->assertArrayHasKey('city', $hotel);
            $this->assertArrayHasKey('availability', $hotel);
        }   
    }
}

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
    * Here we we test our response's structure and type when we sort by name
    */
    
    public function testSortByName()
    {
        $sort=new Sort($this->mappedHotels);
        $result=$sort->sortByName();
        $this->assertInternalType('array',$result);
        foreach ($result as $hotel) {
            $this->assertObjectHasAttribute('name', $hotel);
            $this->assertObjectHasAttribute('price', $hotel);
            $this->assertObjectHasAttribute('city', $hotel);
            $this->assertObjectHasAttribute('availability', $hotel);
        }
    }

    /**
    * Here we we test our response's structure and type when we sort by price
    */
    public function testSortByPrice()
    {
        $sort=new Sort($this->mappedHotels);
        $result=$sort->sortByPrice();
        $this->assertInternalType('array',$result);
        foreach ($result as $hotel) {
            $this->assertObjectHasAttribute('name', $hotel);
            $this->assertObjectHasAttribute('price', $hotel);
            $this->assertObjectHasAttribute('city', $hotel);
            $this->assertObjectHasAttribute('availability', $hotel);
        }   
    }
}

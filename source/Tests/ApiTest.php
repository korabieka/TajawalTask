<?php

require('vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

/**
* This is a class to test our api
*
* @author     Hussien
* @version    1
* ...
*/
class ApiTest extends TestCase
{
    protected $client;

    /**
    * Here we we can instantiate a new Guzzle client before each test
    */
    protected function setUp()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.myjson.com'
        ]);
    }

    /**
    * Here we we test our response code and our response's structure
    */
    
    public function testGet_HotelsObject()
    {
        $response = $this->client->get('/bins/tl0bp');

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        foreach ($data['hotels'] as $hotel) {
            $this->assertArrayHasKey('name', $hotel);
            $this->assertArrayHasKey('price', $hotel);
            $this->assertArrayHasKey('city', $hotel);
            $this->assertArrayHasKey('availability', $hotel);
        }
    }
}

<?php

namespace App\Services;

/**
* This is a class to handle the request and response of the API
*
* @author     Hussien
* @version    1
* ...
*/
class ApiHandler
{
	private $curl;
	
	/**
	* Here we start the curl session in the constructor
	*/
	public function __construct()
	{
		$this->curl = curl_init();
	}

	/**
	* Here we call the api and returning the json result
	* @param string $method
	* @param string $url
	* @param array $data
	* @return string
	*/
	public function callAPI(string $method, string $url, array $data = null): string
    {
	    switch ($method)
        {
	        case "POST":
	            curl_setopt($this->curl, CURLOPT_POST, 1);

	            if ($data)
	                curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
	            break;
	        case "PUT":
	            curl_setopt($this->curl, CURLOPT_PUT, 1);
	            break;
	        default:
	            if ($data)
	                $url = sprintf("%s?%s", $url, http_build_query($data));
	            curl_setopt($this->curl, CURLOPT_URL,$url);
	    }
	    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

	    $result = curl_exec($this->curl);

	    curl_close($this->curl);
	    
	    return $result;
    }
}
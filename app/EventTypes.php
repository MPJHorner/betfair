<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class EventTypes{

	/*
	* Event types baseUrl
	*/
	protected $baseUrl = 'https://api.betfair.com/exchange/betting/json-rpc/v1';

	/*
	* Default Query Parameter
	* The parameter which used to send the data to 
	*/
	protected $queryParam = "json";

	/*
	* Default Method
	*/
	protected $method = "POST";

	/*
	* Set the timeout of the request
	*/
	protected $timeOut = 15.0;

	/*
	* Create an instance of guzzle client
	*/
	public function client(){
		return new Client([
			'timeout' => $this->timeOut,
		]);
	}

	/**
	* Send request via Curl and get data
	* @return collection
	*/
    public static function get(){
    	/*
    	* Instance of the called API
    	*/
    	$api = new static;

		try {
			$res = $api->client()->request($api->method, $api->baseUrl, [
				$api->queryParam => $api->params(),
				'headers' => $api->getHeaders()
			]);
		} catch (RequestException $e) {
			return response($e->getMessage(), 422);
		}

		return $api->handleReturnedData(collect(json_decode($res->getBody(), true)));
    }

	/*
	* Set the parameters of the Api
	*/
    protected function params(){
		return $data = [
			[
	        	'id'      => 1,
	        	'jsonrpc' => 2.0,
	        	'method'  => "SportsAPING/v1.0/listEventTypes",
	        	'params'  => [
	        		'filter' => (object)[]
	        	]
	        ]
	    ];
    }

	/*
	* Set the Api Headers
	*/
    protected function getHeaders(){
		return [
			'Content-Type'     => 'application/json',
			'X-Authentication' => env('BETFAIR_APP_TOKEN'),
			'Accept'           => 'application/json',
			'X-Application'    => env('BETFAIR_APP_KEY'),
		];
    }

    /**
    * Handle returned data
    * @param  $data
    * @return Handeled Data
    */
    protected function handleReturnedData($data){
    	if (isset($data[0]) && isset($data[0]['result'])) {
			$data = $data[0]['result'];
    	}else{
	    	return $data;
    	}

    	$result = [];
    	foreach ($data as $item) {
    		$result[$item['eventType']['name']] = [
    			'name'  => $item['eventType']['name'],
    			'id'    => $item['eventType']['id'],
    			'count' => $item['marketCount'],
    		];
    	}
    	return $result;
    }
}

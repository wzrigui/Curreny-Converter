<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ExchangeCurrency
{

	private $client;
	private $apiUrl;

	public function __construct(HttpClientInterface  $HttpClient, string $apiUrl)
    {
        $this->client = $HttpClient;
        $this->apiUrl = $apiUrl;
    }

    public function getExchangeValue(float $amountToExchange,string $currencyToConvert,string $currencyDesired) : float
    {
		$response =  $this->client->request('GET',  $this->apiUrl . $currencyToConvert);
 		$conversionResult = round(($amountToExchange * $response->toArray()['rates'][$currencyDesired]), 2);

		return $conversionResult;
    }
}
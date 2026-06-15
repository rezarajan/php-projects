<?php
namespace WeatherApp\WeatherService;

use GuzzleHttp\Client;

// Users OpenWeatherMap to fetch weather data for an input city
class WeatherService
{
	// API Key
	private readonly string $apiKey;

	// GeoCache for City -> Lat/Long
	// This prevents API overuse by storing previously
	// queried values
	private array $geoCache = [];

	// Guzzle Client
	private Client $client;

	// Set the values here. The API values should be parsed from the environment, but this is delegated to the calling code.
	public function __construct()
	{

		// Ensure the key is set
		if(empty($_ENV['OPENWEATHER_API_KEY'])) {
			throw new \RuntimeException("API Key is missing");
		}

		$this->apiKey = $_ENV['OPENWEATHER_API_KEY'];
		$this->client = new Client([
			'base_uri' => 'https://api.openweathermap.org/',
			'timeout' => 5.0
		]);
	}

	// Implements a function to get the Weather
	public function getWeather(string $city): array
	{
		$coords = $this->getCoordinates($city);
		return $this->fetchWeather($coords['lat'], $coords['lon']);
	}

	/**
	* Get latitude and longitude for a given city name.
	*
	* @param string $city
	* @return array{lat: float, lon: float}
	*/
	protected function getCoordinates(string $city): array
	{
		// If cache hit, return cache value
		if (isset($this->geoCache[$city])) {
			return $this->geoCache[$city];
		}

		// Fetch from API
		$params = ['query' => [
			'q' => $city,
			'appid' => $this->apiKey,
			'units' => 'metric'
		]];
		$response = $this->client->get('geo/1.0/direct', $params);

		$data = json_decode($response->getBody()->getContents(), true);

		if (empty($data)) {
			throw new \RuntimeException("City not found: {$city}");
		}

		$coords = [
			'lat' => $data[0]['lat'],
			'lon' => $data[0]['lon'],
		];

		// Push the values to the cache
		$this->geoCache[$city] = $coords;

		return $coords;
	}

	// Queries the API for the weather
	protected function fetchWeather(float $lat, float $lon): array
	{
		$params = [
			'query' => [
				'lat' => $lat,
				'lon' => $lon,
				'appid' => $this->apiKey,
				'units' => 'metric',
			]
		];

		$response = $this->client->get('data/2.5/weather', $params);

		return json_decode($response->getBody()->getContents(), true);
	}

}



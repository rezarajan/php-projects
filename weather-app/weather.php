<?php

use WeatherApp\WeatherService\WeatherService;

require_once __DIR__ . '/vendor/autoload.php';

if($argc < 2)
{
    echo "Usage: php weather.php <city>\n";
    echo "Example: php weather.php London\n";
    exit(1);
}

// Input city
$city = $argv[1];

$weatherService = new WeatherService(
	$_ENV['OPENWEATHER_API_KEY']
);

$data = $weatherService->getWeather($city);

echo "🌤 Weather Report for {$data['name']}, {$data['sys']['country']}\n";
echo "--------------------------------------\n";

echo "🌡 Temperature: {$data['main']['temp']}°C\n";
echo "🤒 Feels like: {$data['main']['feels_like']}°C\n";
echo "💧 Humidity: {$data['main']['humidity']}%\n";
echo "📊 Pressure: {$data['main']['pressure']} hPa\n";
echo "☁️ Condition: {$data['weather'][0]['description']}\n";
echo "💨 Wind: {$data['wind']['speed']} m/s\n";
echo "👁 Visibility: {$data['visibility']} m\n";

$sunrise = date('H:i', $data['sys']['sunrise']);
$sunset  = date('H:i', $data['sys']['sunset']);

echo "🌅 Sunrise: {$sunrise}\n";
echo "🌇 Sunset: {$sunset}\n";

echo "--------------------------------------\n";

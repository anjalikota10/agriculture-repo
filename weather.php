<?php
$city_name = 'Solapur';
$api_key = 'fe424122ab870431152a5aaa103d7b75'; // Your API key
$api_url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city_name . '&appid=' . $api_key . '&units=metric';

// Fetch weather data
$weather_data = file_get_contents($api_url);
$data = json_decode($weather_data, true);

// Check if the response is valid
if ($data && $data['cod'] == 200) {
    $temperature = $data['main']['temp']; // Current temperature
    echo "<h2>Current Temperature in {$city_name}: {$temperature}°C</h2>";
} else {
    echo "<p>Unable to fetch weather data. Please try again later.</p>";
}
?>

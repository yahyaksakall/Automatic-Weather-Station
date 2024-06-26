<?php
$servername = "localhost"; 
$username = "root";  
$password = ""; 
$dbname = "weather_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function generate_weather_data() {
    $weather_data = [];
    $start_date = new DateTime();
    
    for ($day = 0; $day < 7; $day++) {
        $date = clone $start_date;
        $date->modify("+$day day");
        $temperature = round(mt_rand(-100, 350) / 10, 1);
        $pressure = round(mt_rand(9800, 10500) / 10, 1);
        $wind_strength = round(mt_rand(0, 200) / 10, 1);
        $wind_direction = ['N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW'][array_rand(['N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW'])];
        $precipitation = round(mt_rand(0, 1000) / 10, 1); 
        
        $weather_data[] = [
            'date' => $date->format('Y-m-d'),
            'temperature' => $temperature,
            'pressure' => $pressure,
            'wind_strength' => $wind_strength,
            'wind_direction' => $wind_direction,
            'precipitation' => $precipitation
        ];
    }
    
    return $weather_data;
}

$weather_data = generate_weather_data();

foreach ($weather_data as $day_data) {
    $sql = "INSERT INTO weather (date, temperature, pressure, wind_strength, wind_direction, precipitation) VALUES (
        '{$day_data['date']}', 
        {$day_data['temperature']}, 
        {$day_data['pressure']}, 
        {$day_data['wind_strength']}, 
        '{$day_data['wind_direction']}', 
        {$day_data['precipitation']}
    )";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<?php
$servername = "localhost"; 
$username = "root";  
$password = ""; 
$dbname = "weather_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function fetch_weather_data() {
    global $conn;
    $sql = "SELECT * FROM weather ORDER BY date ASC";
    $result = $conn->query($sql);
    $weather_data = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $weather_data[] = [
                'date' => $row['date'],
                'temperature' => $row['temperature'],
                'pressure' => $row['pressure'],
                'wind_strength' => $row['wind_strength'],
                'precipitation' => $row['precipitation']
            ];
        }
    }
    return $weather_data;
}

$weather_data = fetch_weather_data();

$conn->close();

echo json_encode($weather_data);
?>
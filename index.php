<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        canvas {
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Weather Data for 7 Days</h1>
        <canvas id="temperatureChart" width="400" height="200"></canvas>
        <canvas id="pressureChart" width="400" height="200"></canvas>
        <canvas id="windChart" width="400" height="200"></canvas>
        <canvas id="precipitationChart" width="400" height="200"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        fetch('get_data.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(day => day.date);

                const temperatureData = data.map(day => day.temperature);
                const pressureData = data.map(day => day.pressure);
                const windStrengthData = data.map(day => day.wind_strength);
                const precipitationData = data.map(day => day.precipitation);

                const ctxTemperature = document.getElementById('temperatureChart').getContext('2d');
                const temperatureChart = new Chart(ctxTemperature, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Temperature (°C)',
                            data: temperatureData,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: false
                            }
                        }
                    }
                });

                const ctxPressure = document.getElementById('pressureChart').getContext('2d');
                const pressureChart = new Chart(ctxPressure, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pressure (hPa)',
                            data: pressureData,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: false
                            }
                        }
                    }
                });

                const ctxWind = document.getElementById('windChart').getContext('2d');
                const windChart = new Chart(ctxWind, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Wind Strength (km/h)',
                            data: windStrengthData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                const ctxPrecipitation = document.getElementById('precipitationChart').getContext('2d');
                const precipitationChart = new Chart(ctxPrecipitation, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Precipitation (mm)',
                            data: precipitationData,
                            borderColor: 'rgba(153, 102, 255, 1)',
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    </script>
</body>
</html>

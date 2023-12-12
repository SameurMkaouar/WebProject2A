<?php
require_once "../../model/user.php";
$user = new user();
$registrationStatistics = $user->getRegistrationStatistics();

// Convert PHP data to JavaScript-friendly format
$jsData = json_encode($registrationStatistics);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
    <style>
       
    </style>
</head>
<body>
<canvas id="chart-registrations" style="display: block;box-sizing: border-box;height: 273px;width: 745px;width: 459px;"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Use PHP data in JavaScript
            const data = <?php echo $jsData; ?>;
            const canvas = document.getElementById("chart-registrations");
canvas.width = 200; // Set the desired width
canvas.height = 200; // Set the desired height

            // Separate data for patients and doctors
            const patientsData = data.filter(item => item.Role === "patient");
            const doctorsData = data.filter(item => item.Role !== "patient");

            // Create datasets
            const patientsDataset = {
                label: "Patients Registration per day",
                data: patientsData.map(item => item.registrations_count),
                backgroundColor: getRandomColor(),
                borderColor: getRandomColor(),
                borderWidth: 3,
            };

            const doctorsDataset = {
                label: "Doctors Registration per day",
                data: doctorsData.map(item => item.registrations_count),
                backgroundColor: getRandomColor(),
                borderColor: getRandomColor(),
                borderWidth: 3,
            };

            const ctx = document.getElementById("chart-registrations").getContext("2d");
            const myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: patientsData.map(item => item.CreationDate),
                    datasets: [patientsDataset, doctorsDataset],
                },
                options: {
                    plugins: {
        title: {
            display: true,
            text: 'User Registrations Chart',
            fontSize: 16,
        },
        legend: {
            display: true,
            position: 'bottom',
        },
    },
            responsive: true,
            maintainAspectRatio: false, // Add this line to make the chart size customizable
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1,
                },
            },

        },
            });

            // Function to generate random color
            function getRandomColor() {
                const letters = "0123456789ABCDEF";
                let color = "#";
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        });
    </script>
</body>
</html>

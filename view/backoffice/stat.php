<?php
// stat.php

require_once '../../config.php';

// Récupérer l'instance de connexion à la base de données
$pdo = config::getConnexion();

// Requête SQL
$sql = "SELECT
            MONTH(dateevent) AS mois,
            COUNT(idevent) AS nombre_evenements
        FROM
            event
        GROUP BY
            mois
        ORDER BY
            mois";

$result = $pdo->query($sql);

// Vérifier si la requête a réussi
if ($result) {
    // Récupérer les résultats
    $stats = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $stats[$row['mois']] = $row['nombre_evenements'];
    }

    // Collecter les données sous forme de tableau JSON
    $data = [];

    $monthNames = [
        1 => 'Janvier 2024',
        2 => 'Février 2024',
        3 => 'Mars 2024',
        4 => 'Avril 2024',
        5 => 'Mai 2024',
        6 => 'Juin',
        7 => 'Juillet',
        8 => 'Août',
        9 => 'Septembre',
        10 => 'Octobre',
        11 => 'Novembre 2023',
        12 => 'Décembre 2023'
    ];

    foreach ($stats as $mois => $nombre_evenements) {
        $data['mois'][] = $monthNames[$mois];
        $data['nombre_evenements'][] = $nombre_evenements;
    }

    // Afficher les données JSON pour que JavaScript puisse les utiliser
    echo '<div style="width: 400px; height: 200px;">';
    echo '<canvas id="myChart" width="400" height="200"></canvas>';
    echo '</div>';

    // Inclure Chart.js
    echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
    
    // Écrire le script JavaScript pour créer le graphique
    echo '<script>';
    echo 'var jsonData = ' . json_encode($data) . ';';
    echo 'var ctx = document.getElementById("myChart").getContext("2d");';
    echo 'var myChart = new Chart(ctx, {';
    echo '    type: "bar",';
    echo '    data: {';
    echo '        labels: jsonData.mois,';
    echo '        datasets: [{';
    echo '            label: "Nombre d\'événements par mois",';
    echo '            data: jsonData.nombre_evenements,';
    echo '            backgroundColor: "rgba(75, 192, 192, 0.2)",'; // Couleur de fond des barres
    echo '            borderColor: "rgba(75, 192, 192, 1)",'; // Couleur de bordure des barres
    echo '            borderWidth: 1';
    echo '        }]';
    echo '    },';
    echo '    options: {';
    echo '        scales: {';
    echo '            y: {';
    echo '                beginAtZero: true';
    echo '            }';
    echo '        }';
    echo '    }';
    echo '});';
    echo '</script>';
} else {
    echo "Erreur dans la requête : " . $pdo->errorInfo()[2];
}

// Aucun besoin de fermer la connexion avec le design pattern Singleton
?>

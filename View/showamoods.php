<?php
include_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Today's Moods</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-body {
            padding: 15px;
        }

        .update-btn,
        .delete-btn {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<div class="container mt-4">
    <?php
    $pdo = config::getConnexion();

    if (!$pdo) {
        echo "<p class='text-danger'>Error: Unable to connect to the database.</p>";
    } else {
        try {
            $query = $pdo->query("SELECT * FROM today_moods");
            $products = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($products) {
                foreach ($products as $product) {
                    // Display each product information in a card
                    echo <<<HTML
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">Thoughts: {$product['talkaboutit']}</p>
                                    <a href='updatemoods.php?UserID={$product['UserID']}' class='btn btn-primary update-btn'>Update</a>
                                    <a href='deletemoods.php?UserID={$product['UserID']}' class='btn btn-danger delete-btn'>Delete</a>
                                </div>
                            </div>
                        HTML;
                }
            } else {
                echo "<p>No thoughts found.</p>";
            }
        } catch (PDOException $e) {
            echo "<p class='text-danger'>Error: " . $e->getMessage() . "</p>";
        }
    }
    ?>
</div>
</body>

</html>

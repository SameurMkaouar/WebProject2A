<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../config.php';

$pdo = config::getConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check if the 'feedback' key exists in the $_POST array
        if (isset($_GET['feedback'])) {
            $feedbackValue = $_GET['feedback'];
        } else {
            throw new Exception('Feedback value is missing.');
        }

        // Check if the 'id' key exists in the $_GET array
        if (isset($_GET['id'])) {
            $reponseid = $_GET['id'];
        } else {
            throw new Exception('Reonseid ID is missing.');
        }

        if (isset($_POST['feedbacktime'])) {
            $feedbackTime = new DateTime($_POST['feedbacktime']);
            $feedbackTime->modify('+1 hour'); // Adjust the timestamp as needed
            $formattedFeedbackTime = $feedbackTime->format('Y-m-d H:i:s'); // Format the adjusted timestamp
        } else {
            throw new Exception('Feedback time is missing.');
        }

        // Validate input
        if (($feedbackValue)==NULL) {
            throw new Exception('Invalid input values de feedbackvalue.');
        }
        if (!is_numeric($reponseid)) {
            throw new Exception('Invalid input values de reponseid.');
        }
        // Ensure feedback value is within the allowed range (adjust as needed)
        if ($feedbackValue < 1 || $feedbackValue > 5) {
            throw new Exception('Feedback value is out of range.');
        }

        // Update the database with the feedback value and the adjusted timestamp
        $query = $pdo->prepare("UPDATE reponse SET feedback = :feedback, feedbacktime = :formattedFeedbackTime WHERE reponseid = :reponseid");
        $query->bindParam(':feedback', $feedbackValue, PDO::PARAM_INT);
        $query->bindParam(':formattedFeedbackTime', $formattedFeedbackTime);
        $query->bindParam(':reponseid', $reponseid, PDO::PARAM_INT);
        $query->execute();

        echo 'Feedback updated successfully!';
        header('Location: ../view/contact2.php');
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    // Handle other HTTP methods if needed
    echo 'Invalid request method.';
}
?>

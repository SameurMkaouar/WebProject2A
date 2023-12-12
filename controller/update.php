<?php
session_start();
include("../model/user.php");
require_once "../model/util.php";

$user = new user();
$errorMsg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $sex = $_POST["sex"];
    $numero = $_POST["numero"];
    $Description = $_POST['description'];
    
    // Validate and sanitize file upload
    if ($_FILES['picture']['error'] == UPLOAD_ERR_OK) {
        $profilePicture = file_get_contents($_FILES['picture']['tmp_name']);
    } else {
        // If no new file is uploaded, retain the existing picture
        $result = $user->retrieveInformation($_SESSION['user_id']);
        if (!empty($result)) {
            $userRecords = $result[0];
            $profilePicture = $userRecords['Picture'];
        } else {
            // Handle the case where no information is retrieved or an error occurs
            $profilePicture = file_get_contents('../../assets/frontoffice/images/Default_ProfilePic.jpg');
        }
    }

    $db = config::getConnexion();

    try {
        // Check if Old password is provided for password update
        if (!empty($_POST['old_password'])) {
            // Retrieve the user's actual password
            $actualPassword =$userRecords['Password'];

            // Verify if the old password matches the actual password
            if (!password_verify($_POST['old_password'], $actualPassword)) {
                $errorMsg = "Old password is incorrect. Please try again.";
            }
            else if($_POST['new_password']!==$_POST['repeat_password'] || $_POST['new_password']===""){
                $errorMsg ="your new password confirmation is invalid";
            }
            else{

            // Old password is correct, proceed with the update
            $query = "UPDATE users
                      SET Firstname = ?, Lastname = ?, Email = ?, Username = ?, Sex = ?, Picture = ?, Numero = ?, Description = ?, Password = ?
                      WHERE Id = ?";

            // Hash the new password
            $newPasswordHash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            // Prepare the statement
            $stmt = $db->prepare($query);

            // Execute the statement with the parameters
            $stmt->execute([$firstname, $lastname, $email, $username, $sex, $profilePicture, $numero, $Description, $newPasswordHash, $_SESSION['user_id']]);

            // Close the database connection
            $stmt->closeCursor();}
        } 
        else {
            // Old password is not provided, proceed without updating the password
            $query = "UPDATE users
                      SET Firstname = ?, Lastname = ?, Email = ?, Username = ?, Sex = ?, Picture = ?, Numero = ?, Description = ?
                      WHERE Id = ?";

            // Prepare the statement
            $stmt = $db->prepare($query);

            // Execute the statement with the parameters
            $stmt->execute([$firstname, $lastname, $email, $username, $sex, $profilePicture, $numero, $Description, $_SESSION['user_id']]);

            // Close the database connection
            $stmt->closeCursor();
        }

        $_SESSION['username'] = $username;
        $_SESSION['picture'] = $profilePicture;

        // Add a success message or notification
        $_SESSION['success_message'] = "Profile updated successfully!";

        // Redirect to the desired location after the update
        if (has_role("admin")) {
            header("location: ../view/backoffice/admin_profile.php");
            exit();
        } else {
            if($errorMsg ===""){
            header("location: ../view/frontoffice/test.php");
            exit();}
            else{
                header("location: ../view/frontoffice/profile_edit.php?error=$errorMsg");
            exit();}
            
        }
    } catch (Exception $e) {
        // Log the error or display a user-friendly error message
        error_log($e->getMessage());
        $_SESSION['error_message'] = "An error occurred while updating your profile. " . $e->getMessage();
        header("location: ../view/frontoffice/error_page.php");
        exit();
    }
}
?>

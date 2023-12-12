<?php
require_once "user.php";
function is_loggedin(): bool
{
    return isset($_SESSION['username']) && isset($_SESSION['user_id']);
}
function has_role($desiredRole)
{
    // Check if the 'user_role' session variable is set
    if (isset($_SESSION['role'])) {
        // Check if the user's role matches the desired role
        return $_SESSION['role'] == $desiredRole;
    }
}

function validateResetToken($token)
{
    $token_hash = hash("sha256", $token);
    $user = new user();
    $result = $user->retrievetoken($token_hash);

    if (empty($result)) {
        return ['status' => 'invalid', 'userRecord' => null];
    }

    $userRecord = $result[0];

    if (strtotime($userRecord["ResetTokenExpires"]) <= time()) {
        return ['status' => 'expired', 'userRecord' => $userRecord];
    }

    return ['status' => 'valid', 'userRecord' => $userRecord];
}

function displayPicture($picture, $width = "70", $class = "rounded-circle")
{
    if (isset($picture) && !empty($picture)) {
        // User has a profile picture, display it
        $userPictureBlob = $picture;
        $userPicture = base64_encode($userPictureBlob);
        echo '<img src="data:image/jpeg;base64,' . $userPicture . '" alt="User image" style="width: 50px; height: 50px; object-fit: cover;">';
    } else {
        // User doesn't have a profile picture, display the default one
        //$defaultPicturePath = '../assets/frontoffice/images/j3fr.jpg';
        $defaultPicturePath = __DIR__ . '/../assets/frontoffice/images/j3fr.jpg';
        $encodedDefaultImage = base64_encode(file_get_contents($defaultPicturePath));

        echo '<img src="data:image/jpeg;base64,' . $encodedDefaultImage . '" alt="default" width="' . $width . '" class="' . $class . '">';
    }
}
function displayProfilePicture($picture, $width = "300", $class = "rounded-circle")
{
    if (isset($picture) && !empty($picture)) {
        // User has a profile picture, display it
        $userPictureBlob = $picture;
        $userPicture = base64_encode($userPictureBlob);
    } else {
        // User doesn't have a profile picture, display the default one
        $defaultPicturePath = __DIR__ . '/../assets/frontoffice/images/j3fr.jpg';
        $encodedDefaultImage = base64_encode(file_get_contents($defaultPicturePath));
        $userPicture = $encodedDefaultImage;
    }

    echo '<img src="data:image/jpeg;base64,' . $userPicture . '" alt="User image" style="width: ' . $width . 'px; height: ' . $width . 'px; object-fit: cover; margin-top: 10px;" class="' . $class . '">';
}

function displayPictureMsg($picture, $width = "300", $class = "rounded-circle")
{
    if (isset($picture) && !empty($picture)) {
        // User has a profile picture, display it
        $userPictureBlob = $picture;
        $userPicture = base64_encode($userPictureBlob);
    } else {
        // User doesn't have a profile picture, display the default one
        $defaultPicturePath = __DIR__ . '/../assets/frontoffice/images/j3fr.jpg';
        $encodedDefaultImage = base64_encode(file_get_contents($defaultPicturePath));
        $userPicture = $encodedDefaultImage;
    }

    echo '<img src="data:image/jpeg;base64,' . $userPicture . '" alt="User image" style="width: ' . $width . 'px; height: ' . $width . 'px; object-fit: cover; margin-top: 10px;" >';
}

<?php
function is_loggedin(): bool {
    return isset($_SESSION['username']) && isset($_SESSION['user_id']);
}



?>
<?php
    if (isset($_POST['logout'])) {
        // Destroy the session
        session_destroy();
        // Redirect the user to the login page or any other page you want
        header("Location: login.php");
        exit();
    }
?>
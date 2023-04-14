<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portal";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    // echo"connected well";
}


error_reporting( E_ALL );
ini_set( "display_errors", 1 );
require_once( "sample.php" );
// Close MySQL database connection
// mysqli_close($conn);
?>

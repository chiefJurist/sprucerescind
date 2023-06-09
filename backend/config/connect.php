<?php 
    // Connect to the database
    $servername = 'localhost';
    $username = 'smart-remit-admins';
    $password = '$smart-remit-admins$';
    $dbname = 'smart-remit-database';
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Checking the connection
    if (!$conn) {
        echo "connection error" . mysqli_connect_error();
    }
?>
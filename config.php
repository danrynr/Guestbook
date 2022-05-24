<?php
    $db_host = "localhost";
    $db_user = "username";
    $db_pass = "password";
    $db_name = "guestbook";

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (mysqli_connect_error()) {
        die ("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    // echo "Connected successfully";
?>

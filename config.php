<?php
    $db_host = "localhost";
    $db_user = "dan";
    $db_pass = "Sourbread012&*";
    $db_name = "guestbook";

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (mysqli_connect_error()) {
        die ("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    // echo "Connected successfully";
?>
<?php
    include 'config.php';
    session_start();
    $_SESSION['sadmin_username'] = "";
    $_SESSION['sadmin_nama'] = "";
    header('location: index.php');
    mysqli_close($conn);
?>
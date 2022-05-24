<?php
    if ($_GET['del']) {
        $id=(int)$_GET['del'];

        include ("config.php");

        $query = "DELETE FROM visitors WHERE id=$id";
        mysqli_query($conn, $query);
        header("location: index.php");
        exit;
    }
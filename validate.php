<?php
    include 'config.php';
    session_start();
    echo "test";
    $username = $_POST['tusername'];
    $password = md5($_POST['tpasswd']);

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn, $query) or die ('error making query');
    $affected_rows = mysqli_num_rows($result);
    $data = mysqli_fetch_row($result);

    echo $affected_rows;
    if ($affected_rows == 1) {
        $_SESSION['admin_username'] = $username;
        header('location: admin.php');
    } else {
        header('location: login.php');
    }
?>
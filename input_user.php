<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="content">
        <tr>
            <td><center><font color="#FF0000"><?php echo $message;?></font></center></td>
        </tr>
    </table>

    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" name="uploadform" id="uploadform">
        <table width="90%" border="0" align="center" cellpadding="2" celllspacing="2" class="content">
            <tr bgcolor="$FFDFAA">
                <td colspan="3">
                    <div align="center">
                        <strong>Add User Administrator</strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="26%"><strong>Username</strong></td>
                <td width="2%">:</td>
                <td width="72%"><input type="text" name="tusername" id="tusername" size="20" maxlength="20"><span class="style2">*</span></td>
            </tr>
            <tr>
                <td><strong>Password</strong></td>
                <td>:</td>
                <td><input type="password" name="tpassword" id="tpassword" size="20" maxlength="20"><span class="style2">*</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input name="upload" type="submit" class="box" id="upload" value="Submit"></td>
            </tr>
        </table>
    </form>

    <?php
        if (isset($_POST['upload'])) {
            include 'config.php';

            $username = trim($_POST['tusername']);
            $password = md5(trim($_POST['tpassword']));

            if (empty($username) || empty($password)) {
                $message = "Data Not Valid!";
            } else {
                $query = "SELECT * FROM user WHERE username = '$username'";
                $hasil = mysqli_query($conn, $query) or die ('Error, query failed username'.mysqli_error($conn));
                $result = mysqli_fetch_array($hasil);

                if ($result != 0) {
                    $message = "There is same username";
                } else {
                    $query = "INSERT INTO users (username, password)"."VALUES ('$username', '$password')";
                    mysqli_query($conn, $query) or die ('Error, query failed'.mysqli_error($conn));
                    mysqli_close($conn);

                    echo "Add User Administrator $username SUCCESS";
                    exit;
                }
            }
        }
    ?>
</body>
</html>



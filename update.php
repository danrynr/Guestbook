<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <?php
        session_start();
        include 'config.php';

        if (empty($_SESSION['admin_username'])) {
            header('location: login.php');
        }

        if (isset($_POST['btnUpdate'])) {
            include 'config.php';

            $name = trim($_POST['tname']);
            $email = trim($_POST['temail']);
            $content = trim($_POST['tcontent']);
            $id = trim($_POST['id']);
            $query = "UPDATE visitors SET name='$name',email='$email',comment='$content' WHERE id='$id'";
            mysqli_query($conn, $query) or die ('Error, query failed 1' . mysqli_error($conn));
            
            header('location: admin.php');
            exit;
        }

        $id = $_GET['updt'];
        $query = "SELECT * FROM visitors WHERE id = '$id'";
        $result = mysqli_query($conn, $query) or die('Error, query failed 2' . mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        list($id, $name, $email, $content, $date, $ip) = $row;
    ?>

    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="content">
            <tr bgcolor="FFDFAA">
                <td colspan="3">
                    <div align="center"><strong>Update Guestbook</strong></div>
                </td>
            </tr>
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <tr>
                <td width="27%" align="left" valign="top">Nama</td>
                <td width="2%" align="center" valign="top">:</td>
                <td width="71%" valign="top"><input type="text" name="tname" id="tname" size="50" maxlength="100" value="<?php echo $name;?>"></td>
            </tr>
            <tr>
                <td align="left" valign="top">Email</td>
                <td align="center" valign="top">:</td>
                <td valign="top"><input type="text" name="temail" id="temail" size="50" maxlength="50" value="<?php echo $email;?>"></td>
            </tr>
            <tr>
                <td align="left" valign="top">Comment</td>
                <td align="center" valign="top">:</td>
                <td valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top"><textarea name="tcontent" id="tcontent" cols="60" rows="15"><?php echo $content; ?></textarea></td>
            </tr>
            <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="center" valign="top">&nbsp;</td>
                <td valign="top"><input type="submit" name="btnUpdate" id="btnUpdate" class="box" value="Update"></td>
            </tr>
            
        </table>
    </form>
</body>
</html>
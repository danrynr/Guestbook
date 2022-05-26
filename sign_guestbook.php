<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include 'config.php';

        $name = htmlentities(trim($_POST['tname']));
        $email = htmlentities(trim($_POST['temail']));
        $content = nl2br(htmlentities(trim($_POST['tcontent'])));
        $date = date('j F Y, g:i a');
        $ip1 = $_SERVER['REMOTE_ADDR'];
        $ip2 = getenv('HTTP_X_FORWARDED_FOR');
        $ip = $ip.'-'.$ip2;

        if (isset($_POST['upload'])) {
            if ((empty($name)) || (empty($email)) || (empty($content))) {
                header('location: error.php');
                exit;
            } else {
                $query = "INSERT INTO visitors (name, email, comment, date , ip) VALUES ('$name', '$email', '$content', '$date', '$ip')";
                mysqli_query($conn, $query) or die ('Error, query failed' . mysqli_error($conn));
                mysqli_close($conn);
                header('location: index.php');

                exit;
            }
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="uploadform" id="uploadform">
        <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="content">
            <tr bgcolor="#FFDFAA">
                <td colspan="3">
                    <div align="center">
                        <strong>Sign Guestbook</strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" valign="top">
                    <div align="center">
                        <a href="index.php">Cancel</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="26%" valign="top">
                    <strong>Name <span class="style1">*</span></strong>
                </td>
                <td width="2%">:</td>
                <td width="72%">
                    <input type="text" name="tname" id="tname" size="30" maxlength="30">
                    <span class="style1"></span>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <strong>Email <span class="style1">*</span></strong>
                    <td>:</td>
                    <td>
                        <input type="text" name="temail" id="temail" size="30" maxlength="30">
                    </td>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <textarea name="tcontent" id="tcontent" cols="50" rows="5"></textarea>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="submit" name="upload" id="upload" class="box" value="Submit"></td>
            </tr>
            <tr>
                <td colspan="3"><span class="style1">*</span>:Must Entry Data</td>
            </tr>
        </table>
    </form>
</body>
</html>

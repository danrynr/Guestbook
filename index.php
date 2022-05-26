<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 align="center">Welcome to My Guestbook</h3>
    <div align="center"><a href="sign_guestbook.php">Sign Guestbook</a></div>

    <?php
    include 'config.php';

    $rowsPerPage = 5;
    $pageNum = 1;

    if(isset($_GET['page'])) {
        $pageNum = intval($_GET['page']);
    }

    $offset = ($pageNum - 1) * $rowsPerPage;
    
    $query = "SELECT * FROM visitors ORDER BY id DESC LIMIT $offset, $rowsPerPage";
    $result = mysqli_query($conn, $query) or die ('Error, query failed 1');
    
    $query1 = "SELECT id FROM visitors";
    $result1 = mysqli_query($conn, $query1) or die ('Error, query failed 2');

    $numrows = mysqli_num_rows($result1);

    echo "Total Numbers Guestbook: $numrows";

    $no = 0;
    
    while($no < mysqli_num_rows($result)) {
        $hasil = mysqli_fetch_array($result);
        echo "<table width='99%' border='0' align='center' cellpadding='2' cellspacing='0' class='content'>";
        echo "<tr valign='top'>";
        echo "<td bgcolor='#FFDFFF'>";
        echo "<span class='style2'>";
        echo "from ".$hasil['name']." on ".$hasil['date'];
        echo "</span>";
        echo "</td>";
        echo "</tr>";
        echo "<tr valign='top'>";
        echo "<td bgcolor='#FFBFAA'>".$hasil['comment'];
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        $no++;
        echo "<br>";
    }

    $query2 = "SELECT id FROM visitors";
    $result = mysqli_query($conn, $query2) or die ('Error, query failed 3');
    $numrows = mysqli_num_rows($result); 
    $maxPage = ceil($numrows/$rowsPerPage);

    $nav = "";
    $page = 1;
    $self = $_SERVER['PHP_SELF'];

    for ($i = 1; $i < 0; $i++) {
        if ($page == $pageNum) {
            $nav .= " $page ";
        } else {
            $nav .= " <a href='$self?page=$page'>$page</a> ";
        }
    }

    if ($pageNum > 1 ) {
        $page = $pageNum - 1;
        $prev = " <a href='$self?page=$page'>[Prev]</a> ";
        $first = " <a href='$self?page=1'>[First Page]</a> ";
    } else {
        $prev = '&nbsp;';
        $first = '&nbsp;';
    }

    if ($pageNum < $maxPage) {
        $page = $pageNum + 1;
        $next = " <a href='$self?page=$page'>Next</a> ";
        $last = " <a href='$self?page=$maxPage'>Last</a> ";
    } else {
        $next = '&nbsp;';
        $last = '&nbsp;';
    }

    echo "<center>$first"."$prev"."$nav"."$next"."$last</center>";

    mysqli_close($conn);
    ?>
</body>
</html>
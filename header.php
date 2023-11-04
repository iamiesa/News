<?php
include "admin/config.php";

$title = basename($_SERVER['PHP_SELF']);
$page_title = "News";
switch ($title) {
    case "single.php":
        if (isset($_GET['id'])) {
            $sql_title = "select * from post where post_id = {$_GET['id']}";
            $result_title = mysqli_query($conn, $sql_title) or die(" Title Quer Failed");
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['title']." News";
        } else {
            $page_title = " No Result Found";
        }
        break;
    case "search.php":
        $page_title = " Serach Page";
        break;
    case "author.php":
        if (isset($_GET['auth_id'])) {
            $sql_title = "select * from user   
            where user_id = {$_GET['auth_id']}";
            $result_title = mysqli_query($conn, $sql_title) or die(" Title Quer Failed");
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = "News By  ".$row_title['username'];
        } else {
            $page_title = " No Result Found";
        }
        break;
    case "category.php":
        if (isset($_GET['cid'])) {
            $sql_title = "select * from category   
            where category_id = {$_GET['cid']}";
            $result_title = mysqli_query($conn, $sql_title) or die(" Title Quer Failed");
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = "Under ".$row_title['category_name'] ."  Category";
        } else {
            $page_title = " No Result Found";
        }
        break;
    default:
        $page_title = "News";
        break;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <a href="index.php" id="logo"><img src="images/news.jpg"></a>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php
                    $hostname = "http://localhost/news-template";

                    if (isset($_GET['cid'])) {
                        $cid = $_GET['cid'];
                    }
                    $active = "";
                    $sql = "select * from category where post > 0 ";
                    $result = mysqli_query($conn, $sql) or die(" Error");
                    if (mysqli_num_rows($result) > 0) {

                    ?>
                        <ul class='menu'>
                            <li><a href='<?php echo "$hostname" ?>'> HOME</a></li>

                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                if (isset($_GET['cid'])) {
                                    $cid = $_GET['cid'];
                                    if ($row['category_id'] == $cid) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                }

                                echo  " <li><a class='{$active}' href='category.php?cid={$row['category_id']}'> {$row['category_name']}</a></li> ";
                            } ?>

                        <?php } ?>
                        </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->
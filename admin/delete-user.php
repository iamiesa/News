<?php
 include "config.php";

 $user_id = $_GET['id'];

 $sql =  " delete from user where user_id={$user_id}";
 $results = mysqli_query($conn, $sql) or die (" Error");

 mysqli_close($conn);

 header("location: http://localhost/news-template/admin/users.php");

 ?>
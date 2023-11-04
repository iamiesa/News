<?php
        session_start();
        include "config.php";

       
        if (empty($_FILES['new-image']['name'])) {

            $file_name= $_POST['old-image'];
        }

        else{
            $error = array();
           

            $file_name = $_FILES['new-image']['name'];
            $file_size = $_FILES['new-image']['size'];
            $file_tmp = $_FILES['new-image']['tmp_name'];
            $file_type = $_FILES['new-image']['type'];
            $file_ext = end(explode('.',$file_name));
            $extension = array('jpeg', 'jpg', 'png');

            if (in_array($file_ext,$extension) === false) {
                $error[] = "please upload files with extensions jpeg jpg png";
            }
            if ($file_size > 2097152) {
                $error[] = " file size should not exceed 2mb";
            }
            if (empty($error) == true) {
                move_uploaded_file($file_tmp,"upload/".$file_name);
            } else {
                print_r($error);
                die();
            }
        }
       
        $title = mysqli_real_escape_string($conn, $_POST['post_title']);
        $desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $date = date("d M,Y");
        $author = $_SESSION['user_id'];


        $sql = " update post set title = '{$title}',description = '{$desc}',
        category = '{$category}',post_date = '{$date}',author = '{$author}',post_img = '{$file_name}'
        where  post_id = {$_POST['post_id']}  ";
       
            $result = mysqli_query($conn,$sql);

            if($result){
            header("location: http://localhost/news-template/admin/post.php");

            }
       else{
        echo " Query Failed";
       }
       ?>
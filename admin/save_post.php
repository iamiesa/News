        <?php
        session_start();
        include "config.php";

        if (isset($_FILES['fileToUpload'])) {

            $error = array();

            $file_name = $_FILES['fileToUpload']['name'];
            $file_size = $_FILES['fileToUpload']['size'];
            $file_tmp = $_FILES['fileToUpload']['tmp_name'];
            $file_type = $_FILES['fileToUpload']['type'];
            $file_ext = end(explode('.',$file_name));
            $extension = array('jpeg', 'jpg', 'png');

            if (in_array($file_ext, $extension) === false) {
                $error[] = "please upload files with extensions jpeg jpg png";
            }
            if ($file_size > 2097152) {
                $error[] = " file size should not exceed 2mb";
            }
            if (empty($error) == true) {
                    // move_uploaded_file($image_temp_name,'./upload/'.$image_name))
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


        $sql = " insert into post(title,description,category,post_date,author,post_img)
        values('$title','$desc','$category','$date','$author','$file_name');";

        $sql .= " update category set post = post + 1 where category_id = {$category}";

        if (mysqli_multi_query($conn, $sql)) {
            header("location: http://localhost/news-template/admin/post.php");
        } else {
            echo " Query failed";
        }

        ?>



<?php

session_start();
include 'connection.php';
if(isset($_SESSION['user_id']))
{
    //echo "book submit";
    if(isset($_POST['submit']))
    {
        
        $user_id = $_POST['user_id'];
        $book_title = $_POST['book_title'];
        $upload_date = $_POST['upload_date'];
        // book cover
        $cover_name = $_FILES['book_cover']['name'];
        $cover_size = $_FILES['book_cover']['size'];
        $cover_tmp_name = $_FILES['book_cover']['tmp_name'];
        $cover_type = $_FILES['book_cover']['type'];
        $cover_path="cover_of_books/";
        // PDF file upload;
        $file_name = $_FILES['book_file']['name'];
        $file_size = $_FILES['book_file']['size'];

        $filesize = ceil($file_size/1024);// byte converted in KB size and saved in database
        //echo $filesize;
        //die();
        $file_tmp_name = $_FILES['book_file']['tmp_name'];
        $file_type = $_FILES['book_file']['type'];
        $file_path="pdf_book_files/";

        $book_desc = $_POST['book_desc'];

            if(move_uploaded_file($cover_tmp_name,$cover_path.$cover_name) && move_uploaded_file($file_tmp_name,$file_path.$file_name))
            {
                
                $pdf= file_get_contents("pdf_book_files/".$file_name);
                $pagenumber = preg_match_all("/\/Page\W/",$pdf,$dummy);
                
                $book_insert = " insert into book_table (book_title, book_cover, book_file,book_size,book_pages, book_desc, upload_date, user_id) values ('$book_title', '$cover_name', '$file_name', '$filesize','$pagenumber', '$book_desc', '$upload_date', $user_id)";
                //echo $book_insert;
                //die();
                $book_insert= $conn->query($book_insert);
                if($book_insert)
                {
                    //die("successful");
                    $_SESSION['img_successfully']="Image successfully Uploaded.";
                    header("location:book_add_form.php");
                }
                else
                {
                    //die("failed");
                    $_SESSION['img_uperror'] =" Sorry Image Could Not Uploaded";
                    header("location:book_add_form.php");
                }
        }
    }
}
else
{
    header('location: login.php');
}
?>
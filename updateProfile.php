<?php
session_start();
include "connection.php";
if(isset($_SESSION['uid']))
{
     $uid = $_POST['uid'];
    
   if(isset($_FILES['gimage']) && isset($_FILES['pdf_file']))
    {
        //print_r($_FILES['pdf_file']);
        // Upload Cover Page Of Book
        
         $file_name = $_FILES['gimage']['name'];
         $file_size = $_FILES['gimage']['size'];
         $file_tmp_name = $_FILES['gimage']['tmp_name'];
		 $file_type = $_FILES['gimage']['type'];
		 $file_path="cover_of_books/";

        // Upload PDF File of Book
         $pdf_name = $_FILES['pdf_file']['name'];
         //$total_pages= count_pdf_pages($pdf_name);
         //echo "total pages".$total_pages ;
         //die();
         $pdf_size = $_FILES['pdf_file']['size'];
         $pdf_tmp_name = $_FILES['pdf_file']['tmp_name'];
         $pdf_type = $_FILES['pdf_file']['type'];
         $pdf_path="pdf_book_files/";
         
		if(move_uploaded_file($file_tmp_name,$file_path.$file_name ) && move_uploaded_file($pdf_tmp_name,$pdf_path.$pdf_name ))
		{
            $pdf = file_get_contents("pdf_book_files".$file_name);
            $number = preg_match_all("/\/Page\W/",$pdf,$dummy);
            echo "<h1>This Book Have Total ".$number."pages </h1>";
            die();
            $namefilecover="";
            $nameofbook="";
            $delsql="select book_cover, pdf_file from bookuser where uid=$uid";
            $delquery=$conn->query($delsql);
            if($delquery->num_rows>0)
            {
                while($delrow=$delquery->fetch_assoc() )
                {
                    $namefilecover = $delrow['book_cover'];
                    $nameofbook = $delrow['pdf_file'];
                }
                
            }
            //unlink("cover_of_books/$namefilecover");
            //unlink("pdf_book_files/$nameofbook");

			$sqlupi="update bookuser set book_cover='$file_name', pdf_file='$pdf_name'  where uid=$uid";
            //echo $sqlupi;
            //die();
			$queryupi= $conn->query($sqlupi);
		if($queryupi)
         {
            
             $_SESSION['upimage']="<h3 class='text-success'>Image successfully.</h3>";

            header("location:userprofile.php");
         }
			
		}
          

    }

    elseif(isset($_POST['submit']))
    {
        $uidp =$_POST['uid'];
        $fullname = $_POST['fullname'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $book_title = $_POST['book_title'];
        $book_desc = $_POST['book_desc'];
        
        $sqlupdata="update bookuser set fullname='$fullname',mobile='$mobile',email='$email',book_title='$book_title',book_desc='$book_desc'where uid=$uid";
        //echo $sqlupdata;
        //die();
        $queryupdata= $conn->query($sqlupdata);
        if($queryupdata)
         {
             $_SESSION['updata']="Data is successfully updated.";

            header("location:updateprofiledata.php");
         }
         else
         {
            $_SESSION['errupdata']="Data is successfully updated.";

            header("location:userprofiledata.php");
         }

    }
   

}
?>
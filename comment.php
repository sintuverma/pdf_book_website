<?php
session_start();
include "connection.php";
if(isset($_SESSION['user_id']))
{
    if(isset($_POST['submit']))
    {
           $book_id = $_POST['book_id'];
          //die();
          $book_comment=$_POST['book_comment'];
          $user_id=$_POST['user_id'];
          $username=$_POST['username'];
          $comsql= "insert into comment(comment_date,book_comment,book_id, user_id, username) values (now(), '$book_comment', $book_id,$user_id, '$username' ) ";
          //echo $comsql;
          //die();
          $comquery = $conn->query($comsql);
          if($comquery)
          {
             
            $_SESSION['comment_successful'] = "Feedback Successfully Submitted";
            header("location:dashboard.php");
          }
          else
          {
            
            $_SESSION['comment_error'] = "Feedback Successfully Not Submitted";
            header("location:dashboard.php");
          }

    }
}
else
{
    header("location:index.php");
}

?>
<?php
session_start();

include 'connection.php';
if(isset($_SESSION['user_id']))
{
    
    if(isset($_POST['submit']))
    {
        //echo "updated page";
         $comm_id = $_POST['comment_id'];

        $updcomment = $_POST['updcomment'];
        $updcommsql = "update comment set book_comment='$updcomment', comment_date=now() where comment_id= $comm_id ";
        //echo $updcommsql;
        //die();
        $updc_query = $conn->query($updcommsql) ;
        if($updc_query)
        {
            header ("location:dashboard.php");
            $_SESSION['updcomment'] = " Comment Updated Successfully";
        }
        else
        {
            header ("location:dashboard.php");
            $_SESSION['updcomment_err'] = " Comment  Not Updated Successfully";
        }
    }

}

else
{
    header("location:login.php");
}
?>
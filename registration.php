<?php
include "connection.php";
session_start();
if(isset($_POST['submit']))
{
    
    if(empty($_POST['fullname']) or empty($_POST['mobile']) or empty($_POST['email']) or empty($_POST['password']))
    {

        $error =" Please Fill All Field ";
        $_SESSION['error']= $error;
        header("location:index.php");
        
    }
    else
    {
        $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
        $password =mysqli_real_escape_string($conn,$_POST['password']);
        $encp = md5($password);
        if($mobile && $email)
        {
            $chksql ="select mobile, email from  user where email = '$email' and mobile = '$mobile'";
            $chkquery = $conn->query($chksql);
            if($chkquery->num_rows > 0)
            {
                $_SESSION['user_aval']= " Mobile And Email already exists Fill New number and email";
                header("location:index.php");
            }
        }
        else
        {
            $sql = "insert into user (fullname, mobile,email, password, created_at) values('$fullname', '$mobile', '$email', '$encp',now())";
            //echo $sql;
            //die();
            $query =$conn->query($sql);
            if($query)
            {
                $_SESSION['successfulreg']="Your Registration is successful";
                header("location:login.php");
            }
            else
            {
                $_SESSION['reg_error']="Your Registration is not successful";
                header("location:index.php");
            }
        }
       
    }
}
?>
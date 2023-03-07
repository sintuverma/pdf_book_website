<?php
session_start();
include "connection.php";
$mobile=$_POST['mobile'];
$password = $_POST['password'];
$encpass = md5($password);
$sql = "select user_id, fullname, mobile, password from user  where mobile = '$mobile' and password = '$encpass'";
$query = $conn->query($sql);
if($query->num_rows>0)
{
    while($row = $query->fetch_assoc())
    {
        //print_r($row);
        $_SESSION['user_id'] =$row['user_id'];
        $_SESSION['fullname'] =$row['fullname'];
        header("location:dashboard.php");
    }
    
}
else
{
    $_SESSION['log_error']= "Mobile or Password Not Available";
    header("location:login.php");

}
?>
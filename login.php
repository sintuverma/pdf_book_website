<?php
session_start();
$log_error="";
$reg_success = "";
if(isset($_SESSION['successfulreg']))
{
    $reg_success= $_SESSION['successfulreg'];
}
if(isset($_SESSION['log_error']))
{
    
    $log_error= $_SESSION['log_error'];
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5 bg-dark text-primary rounded"> Welcome Book Shop</h1>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 bg-dark text-primary rounded">
            <h4 class="text-center mt-2 mb-3 bg-dark text-success"><?php if($reg_success){echo $reg_success;}?></h4>
                <h2 class="text-center mt-2 mb-3 bg-dark text-primary rounded">Login</h2>
                <h4 class="text-center mt-2 mb-3 bg-dark text-danger"><?php if($log_error){echo $log_error;}?></h4>
                <form method="POST" action="loginpage.php">
                    
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="number" minlength="10" maxlength="10" id="mobile" class="form-control" placeholder="Enter Your  Mobile Number" name="mobile"required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" minlength="8" id="password"class="form-control" placeholder="Enter Your Password" name="password" minlength="8" required>
                    </div>
                    <div class="d-grid gap-2 mb-2">
                        <button type="submit" class="btn btn-outline-success" id="submit" name="submit">Login</button>
                    </div>
                    <p class="text-warning mb-3"> Don't have Account</p><a href="index.php">Click Here For Registration</a>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

<?php 
if(isset($_SESSION['successfulreg']))
{
    unset($_SESSION['successfulreg']);
}
if(isset($_SESSION['log_error']))
{
    unset($_SESSION['log_error']);
}
?>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.esm.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="jquery-3.6.0"></script>

</html>
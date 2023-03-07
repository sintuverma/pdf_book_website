<?php
session_start();
$error="";
$reg_error = "";
if(isset($_SESSION['error']))
{
    
    $error= $_SESSION['error'];
}
if(isset($_SESSION['reg_error']))
{
    
    $reg_error= $_SESSION['reg_error'];
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
            <h4 class="text-center mt-2 mb-3 bg-dark text-danger"><?php if($reg_error){echo $reg_error;}?></h4>
            <h4 class="text-center mt-2 mb-3 bg-dark text-danger"><?php if(isset($_SESSION['user_aval'])){echo $_SESSION['user_aval'];}?></h4>
                <h2 class="text-center mt-2 mb-3 bg-dark text-primary rounded">Registration Here</h2>
                <h4 class="text-center mt-2 mb-3 bg-dark text-danger"><?php if($error){echo $error;}?></h4>
                <form method="POST" action="registration.php">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name:</label>
                        <input type="text" minlength="5" id="fullname" class="form-control" placeholder="Enter Full Name" name="fullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number:</label>
                        <input type="number" minlength="10" maxlength="10" id="mobile" class="form-control" placeholder="Enter Your  Mobile Number" name="mobile"required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Email:</label>
                        <input type="email"  id="email" class="form-control" placeholder="Enter Your email" name="email"required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" minlength="8" id="password"class="form-control" placeholder="Enter Your Password" name="password" minlength="8" required>
                    </div>
                    <div class="d-grid gap-2 mb-2">
                        <button type="submit" class="btn btn-outline-success" onclick="formsubmit()" id="submit" name="submit">Submit</button>
                    </div>
                    <p class="text-warning mb-3"> Already You have Account <span><a href="login.php">Click Here for Login</a></span></p>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

<?php 
if(isset($_SESSION['error']))
{
    unset($_SESSION['error']);
}
unset($_SESSION['user_aval']);
?>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.esm.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="jquery-3.6.0"></script>
<script> 
function formsubmit()
{
    
    var fullname = document.getElementById("fullname").length;
    
    var mobile = document.getElementById("mobile").length;
    var password = document.getElementById("password").length;
    if(fullname==0)
        {
            alert("minimum 5");
        }
}

//  $(document).ready(function() {
//             $("#submit").click(function() {
//                 var 
//                 var name = $("fullname").val();
//                 var mobile = $("mobile").val();
//                 var password = $("password").val();
//                 alert(name+" "+mobile+" "+password);
//                 if ($(this).hasClass("with-space")) {
//                     var withSpace = myStr.length;
//                     alert(withSpace);
//                 } else if ($(this).hasClass("without-space")) {
//                     var withoutSpace = myStr.replace(/ /g, '').length;
//                     alert(withoutSpace);
//                 }
//             });
//         });
</script>

</html>
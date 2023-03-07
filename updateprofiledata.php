<?php
include "connection.php";
session_start();
$uid="";
if(isset($_SESSION['uid']))
{
     // fetching the that user data who is login currently
     $uid=$_SESSION['uid'];
     $sqlp="select * from bookuser where uid = $uid";
     $fullname="";
     $mobile="";
     $email="";
     $book_title;
     $userbook="";
     $book_desc="";
     $queryp = $conn->query($sqlp);
     if($queryp->num_rows>0)
         {
             while($rowp= $queryp->fetch_assoc())
             {
                 //print_r($rowu);
                $uidp=$rowp['uid'];
                 $fullname=$rowp['fullname'];
                 $mobile=$rowp['mobile'];
                 $email=$rowp['email'];
                 $book_title=$rowp['book_title'];
                 $userbook=$rowp['book_cover'];
                 $book_desc=$rowp['book_desc'];
                 
             }
         }
 



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Update Profile</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5 bg-dark text-primary rounded"> Update Your Data</h1>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 bg-dark text-primary rounded">
                
                <h2 class="text-center mt-2 mb-3 bg-dark text-primary rounded">Update</h2>
                <a href="userprofile.php" style="text-decoration:none"><h2 class="text-center mt-2 mb-3 bg-dark text-warning rounded"><< Back To Profile</h2></a>
                <h2 class="text-center mt-2 mb-3 bg-dark text-success rounded">
                    <?php 
                    if(isset($_SESSION['updata'])) 
                    {
                         echo  $_SESSION['updata'];
                         unset($_SESSION['updata']);
                    }
                    elseif(isset($_SESSION['errupdata']))
                    {
                        echo  $_SESSION['errupdata'];
                        unset($_SESSION['errupdata']);
                    }
                    ?>
                </h2>
                
                <form method="POST" action="updateProfile.php" enctype='multipart/form-data'>
                    <input type="hidden" name="uid" value="<?php echo $uidp; ?>">
                    <div class="mb-3">
                        <label for="fullname">Full Name:</label>
                        <input type="text" minlength="5" id="fullname" class="form-control"
                            placeholder="Update Full Name" name="fullname" value="<?php echo $fullname;?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile">Mobile Number:</label>
                        <input type="number" minlength="10" maxlength="10" id="mobile" class="form-control"
                            placeholder="Update Your Mobile" name="mobile" value="<?php echo $mobile;?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" placeholder="Update Your Email" name="email"
                            value="<?php echo $email;?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="book_title">Book Title:</label>
                        <input type="text" class="form-control" placeholder="Update Your Book Title" name="book_title"
                            value="<?php echo $book_title;?>" required>
                    </div>
                    
                    
                    <div class="mb-3">
                            <label for="book_desc"> Book Description :</label>
                            <textarea class="form-control" name="book_desc" placeholder="Update Your Book Description" value=""
                            required rows="2"><?php echo $book_desc;?></textarea>
                    </div>
                    <div class="d-grid gap-2 mb-2">
                        <button type="submit" class="btn btn-outline-success" id="submit" name="submit">Submit</button>
                    </div>

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
<?php
}
else
{
    header("location:index,php");
}

?>
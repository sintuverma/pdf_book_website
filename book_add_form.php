<?php

session_start();
include "connection.php";
if (isset($_SESSION['user_id']))
{
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Add Book </title>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5 bg-dark text-primary rounded"> Welcome Add Book For Sell</h1>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 bg-dark text-primary rounded">
            
            <h4 class="text-center mt-2 mb-3 bg-dark text-success"><?php if(isset($_SESSION['img_successfully'])){echo $_SESSION['img_successfully'];}?></h4>
                <h2 class="text-center mt-2 mb-3  text-primary rounded">Add Your Book </h2>
                <h4 class="text-center mt-2 mb-3  text-danger"><?php if(isset($_SESSION['img_uperror'])){echo $_SESSION['img_uperror'];}?></h4>
                <a href="dashboard.php" style="text-decoration:none"><h2 class="text-center mt-2 mb-3  text-warning rounded"><< Back To Home </h2><a>

                <form  method="POST" action="book_add_phpform.php"  enctype='multipart/form-data'>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>" />
                    <input type="hidden" name="upload_date" value="<?php echo date("d-M-Y");?>" />
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Book Title:</label>
                        <input type = "text" minlength = "5" maxlength ="255" id= "book_title" class ="form-control" placeholder = "Enter Your Book Title" name="book_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="book_cover" class="form-label">Book Cover:</label>
                        <input type = "file" class = "form-control" placeholder = "Upload Book Cover " accept =".png, .jpg, .jpeg, .gif" name = "book_cover" required />
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="book_file" class="form-label">Book File:</label>
                        <input type="file" class="form-control" placeholder="Upload PDF" accept=".pdf " name="book_file" required />
                    </div>
                    <div class="mb-3">
                            <label for="book_desc"> Book Description :</label>
                            <textarea class="form-control" name="book_desc" placeholder="Add Your Book Description" value=""
                            required rows="2"></textarea>
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

?>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.esm.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="jquery-3.6.0"></script>

</html>

<?php
unset($_SESSION['img_successfully']);
unset($_SESSION['img_uperror']);

}
else
{
    header("location:login.php");
}

?>

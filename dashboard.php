<?php
session_start();
include "connection.php";
$id="";
if(isset($_SESSION['user_id']))
{
    $id=$_SESSION['user_id'];
    // fetching the that user data who is login currently
    $sqlu="select * from user where user_id= $id";
    //echo $sqlu;
    //die();
    $fullname="";
    $queryu = $conn->query($sqlu);
    if($queryu->num_rows>0)
        {
            while($rowu= $queryu->fetch_assoc())
            {
                //print_r($rowu);
                $uid= $rowu['user_id'];
                $fullname=$rowu['fullname'];
                
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
    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mt-2 rounded sticky-top">

            <a class="navbar-brand" href="#">Books</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashbord.php">Welcome &nbsp;<span
                                class="text-uppercase text-warning"><?php echo $fullname;?></span>
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item  mr-sm-2 ">
                        <a class="nav-link text-danger  " href="logout.php">
                            LogOut</a>
                    </li>
                    <li class="nav-item  mr-sm-2 ">
                        <a class="nav-link text-dark " href="book_add_form.php">
                            Profile</a>
                    </li>
                </ul>
            </div>
        </nav>
        <a class="btn btn-success mt-2" href="book_add_form.php"> Add  Book</a>
        <div class="row">
            <?php
            if(isset( $_SESSION['comment_successful']))
            {
                echo "<h5 class='text-success'>". $_SESSION['comment_successful']."</h5>";
            }
            if(isset( $_SESSION['comment_error']))
            {
                echo "<h5 class='text-danger'>". $_SESSION['comment_error']."</h5>";
            }
            ?>
            <h1 class=" text-dark rounded text-center mt-3 ml-3"> List Of Books </h1>
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <?php
            if(isset($_SESSION['updcomment']))
            {
                echo '<div class="alert alert-success alert-dismissible" role="alert">';
                echo ' <button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                echo ' <strong>'.$_SESSION['updcomment'].'</strong>';
                echo '</div>';
            }
            if(isset($_SESSION['updcomment_err']))
            {
                echo '<div class="alert alert-danger alert-dismissible">';
                echo ' <button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
                echo ' <strong>'.$_SESSION['updcomment_err'].'</strong>';
                echo '</div>';
            }
            ?>
            <div class="card">
                    <div class="card-header">
                            Book List
            </div>
            <?php
                $sqlb="select book_id, book_title, book_cover,book_desc from book_table";
                $queryb = $conn->query($sqlb);
                if($queryb->num_rows>0)
                {
                    while($rowb= $queryb->fetch_assoc())
                    {//print_r($rowb);
            ?>
            
                      <div class="card-body mt-2">
                         <h5 class="card-title"><?php echo $rowb['book_title'];?></h5>
                            <img src="cover_of_books/<?php echo $rowb['book_cover'];?>" alt="<?php echo $rowb['book_cover'];?> " class="img-thumbnail img-fluid roumded" width="200" height="200" class="img-thumbnail rounded">
                            <p class="card-text">
                            
                            </p>
                            <a href="book_details.php?details=<?php echo $rowb['book_id'];?>" class="btn btn-primary">Book Details</a>
                        </div> 
                        <hr/>
                        
                   
                <?php
                    
                    }

                }

                else
                {
                    echo "<h1 class='text-danger bg-dark mt-2 '>Oops... No books available. You can make first</h1>";
                }
                
                ?>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.esm.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="jquery-3.6.0"></script>

<?php
}

else
{
    header("location:login.php");
}
unset($_SESSION['comment_successful']);
unset($_SESSION['comment_error']);
unset($_SESSION['updcomment']);
unset($_SESSION['updcomment_err']);


?>
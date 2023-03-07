<?php
include "connection.php";
session_start();
//$id="";
if(isset($_SESSION['user_id']))
{
     // fetching the that user data who is login currently
     $uid=$_SESSION['user_id'];
     $sqlp="select * from bookuser where uid = $uid";

     $fullname="";
     $mobile="";
     $email="";
     $queryp = $conn->query($sqlp);
     if($queryp->num_rows>0)
         {
             while($rowp= $queryp->fetch_assoc())
             {
                // print_r($rowp);
                 $fullname=$rowp['fullname'];
                 $mobile=$rowp['mobile'];
                 $email=$rowp['email'];    
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
    <title><?php echo $fullname; ?> Profile|</title>
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
                        <a class="nav-link active" href="Dashbord.php">Welcome &nbsp;<span
                                class="text-uppercase text-warning"><?php echo $fullname;?></span>
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item  mr-sm-2 ">
                        <a class="nav-link text-danger" href="logout.php">LogOut</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row">
            <h1 class=" text-dark rounded text-center mt-3 ml-3"> List Of Books </h1>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <?php
                 $sqlb="select book_id, book_title, book_cover,book_desc from bookuser where uid= $uid";
                 //echo $sqlb;
                 //die();
                 $queryb = $conn->query($sqlb);
                 if($queryb->num_rows>0)
                 {
                     while($rowb= $queryb->fetch_assoc())
                     {//print_r($rowb);
                        //die();
                      ?>

                <div class="card text-center">
                    <div class="card-header">
                        Books List
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-capitalize"><?php echo $rowb['book_title'];?></h5>
                        <?php if(isset($_SESSION['upimage'])){ echo $_SESSION['upimage'];} unset($_SESSION['upimage']);?>
                        <a style="cursor:pointer; text-decoration:none" data-bs-toggle="modal"
                            data-bs-target="#imgModal">
                        <?php
                            if($rowb['book_cover']=="nofile.png")
                        {
                         ?>
                         <img src="nofile/nofile.png" alt="<?php echo $rowb['book_cover'];?> "class="img-thumbnail img-fluid roumded" width="200" height="200" class="img-thumbnail rounded">
                         
                         <?php  
                        }
                        else
                        {
                        ?>
                        <img src="cover_of_books/<?php echo $rowb['book_cover'];?>" alt="<?php echo $rowb['book_cover'];?> " class="img-thumbnail img-fluid roumded" width="200" height="200" class="img-thumbnail rounded">
                        <?php
                        }
                        ?>
                        </a>
                        <p class="card-text"><?php echo $rowb['book_desc']?></p>
                        <a class="btn btn-primary" href="updateprofiledata.php?uid=<?php echo $rowb['uid'];?>">
                            Add Or Update
                        </a>
                    </div>

                    <!-- The  Image  Update Modal -->
                    <div class="modal" id="imgModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!--  Image Update Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Details</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Image Update Modal body -->
                                <div class="modal-body">

                                    
                                        
                            <form  method="POST" action="updateprofile.php"  enctype='multipart/form-data'>
                                        <input type="hidden" name="uid" value="<?php echo $rowb['uid'];?>">
                                            <div class=" form-group mb-3">
                                                <label for="book_cover" class="text-primary">Book Cover: </label>
                                                <input class="form-control" type="file" id="formFile" accept=".png, .jpg, .jpeg, .gif, .x-eps"
                                                    name="gimage" required>
                                            </div>
                                            <div class="mb-3">
                                            <label for="Pdf_file" class="text-primary">PDF File: </label>
                                                <input class="form-control" type="file" id="pdf_file" accept="application/pdf"
                                                    name="pdf_file" required>
                                            </div>
                                            <div class="d-grid gap-2 mb-2">
                                            <button type="submit" class="btn btn-outline-success" id="submit"
                                                name="submit">Submit</button>
                                        </div>
                                        </form>
                                                                                
                                        <!-- Data image and file Update Modal -->
                                        <div class="modal" id="myModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Detailes</h4>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">

                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>

                                                    <hr>
                                                </div>
                                            </div>

                                            <?php   
                     }
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
    header("location:index.php");
 }
?>
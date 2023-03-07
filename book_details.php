<?php
session_start();
include "connection.php";

if(isset($_SESSION['user_id']) && isset($_SESSION['fullname']))
{
   
    $user_id =$_SESSION['user_id'];
    $username=$_SESSION['fullname'];
    $id = $_GET['details'];
    $bsql = "select * from book_table where book_id = $id";
    $bquery =$conn->query($bsql);
    if($bquery->num_rows>0)
    {
        $book_id = "";
        $book_title = "";
        $image = "";
        $filename="";
        $book_size="";
        $book_pages="";
        $book_desc = "";
        $upload_date = "";
        $userf_id = "";
        $book_sizekb = "";
        $book_sizemb = "";
        
        while($brow=$bquery->fetch_assoc())
        {
         // print_r($brow);
        $book_id = $brow['book_id'];
        $book_title = $brow['book_title'];
        $image = $brow['book_cover'];
        $filename = $brow['book_file'];
        $book_size = $brow['book_size'];
        if($book_size>1024)
        {
             $book_sizemb= ceil($book_size/1024);

        }
        else
        {
            $book_sizekb =  $brow['book_size'];  
        }
        $book_pages = $brow['book_pages'];
        $book_desc = $brow['book_desc'];
        $upload_date = $brow['upload_date'];

        }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title><?php echo $book_title?> Book </title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mt-2 rounded sticky-top">
            <a class="navbar-brand" href="#">Books Details</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashbord.php">Welcome &nbsp;<span
                                class="text-uppercase text-warning">Uploaded By</span>
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item  mr-sm-2 ">
                        <a class="nav-link text-danger  " href="logout.php">
                            LogOut</a>
                    </li>

                    <li class="nav-item  mr-sm-2 ">
                        <a class="nav-link text-dark" href="#"> Profile </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="row">
            
            <h1 class=" text-dark rounded text-center mt-3 ml-3"> List Of Books </h1>
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        Books List
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-capitalize  text-warning inline"><?php echo $book_title;?> <p
                                class='text-success'>Pages Of
                                Book-<?php echo $book_pages.": Upload Date ".$upload_date;?></p>
                        </h5>
                        <img src="cover_of_books/<?php echo $image;?>" alt="<?php echo $image;?>"
                            class="img-thumbnail rounded">
                        <p class="card-text"><?php echo $book_desc;?></p>
                        <p class="Dark ">File Size:
                            <?php
                        if($book_sizekb)
                        {
                            echo $book_sizekb." KB ";
                        }
                        else
                        {
                            echo $book_sizemb." MB ";
                        }
                        ?>
                            <span> | Number Of Pages in Book: <?php echo $book_pages ?></span>
                        </p>
                        <p> </p>

                        <a download="<?php echo $filename?>" href="pdf_book_files/<?php echo $filename?>"
                            class="btn btn-primary inline"> Download Now </a>

                        <hr />

                        <form method="post" action="comment.php">
                            <input type="hidden" id="book_id" name="book_id" value="<?php echo $book_id;?>">
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">
                            <input type="hidden" id="username" name="username" value="<?php echo $username;?>">
                            <div class="form-group">
                                <label for="book_desc" id="book_comment" class="mt-2 text-success"> Feedback :</label>
                                <textarea class="form-control" maxlength="500" name="book_comment" id="book_comment"
                                    placeholder="Type Your Feedback" value="" required rows="2"></textarea>
                            </div>
                            <input type="submit" class="btn btn-success mt-2 " name="submit" id="save_comment"
                                value="submit">
                        </form>

                        <?php 
                      $comsql ="select * from comment where book_id = $book_id";
                      //echo $comsql;
                      //die();
                      //$comsql= "SELECT comment_id, book_comment, comment_date FROM bookuser as bu INNER JOIN comment as cm ON   bu.uid = cm.user_id";
                      $cmquery = $conn->query($comsql);
                      if($cmquery->num_rows>0)
                      {
                          $book_comment = "";
                          $comm_id = "";
                          $user_comm_id = "";
                          $username_comm = "";
                          $username_comm = "";
                          while($cmrow=$cmquery->fetch_assoc())
                          {
                        
                              //print_r($cmrow);
                             
                               $commid=$cmrow['comment_id'];
                               $comm_date=$cmrow['comment_date'];
                               $book_comment=$cmrow['book_comment'];
                               $user_comm_id= $cmrow['user_id'];
                               $username_comm= $cmrow['username'];
                               $_SESSION['user_id'];
                              
                          if( $user_comm_id == $_SESSION['user_id'])
                          { //echo " edit comment </br>";
                            ?>

                        <div class="card mt-2 mb-1">
                            <div class="card-header">Commented on <span>
                                    <strong><small><?php echo $cmrow['comment_date']; ?></small></strong> Username:
                                    <small class="text-capitalize"><strong>
                                            <?php echo $username_comm; ?></small></strong></span>
                            </div>
                            <div class="card-body">
                                <p><?php  echo $cmrow['book_comment'];?> </p>
                                <!-- edit comment by model form -->
                                <a href="edit_cooment_page.php?comment_id=<?php echo  $cmrow['comment_id'];?>"> Edit</a>
                                

                            </div>
                        </div>
                        <?php  
                          }
                           else
                           {//echo " not edit comment </br>";
                        ?>
                        <div class="card mt-2 mb-1">
                            <div class="card-header">Commented on <span>
                                    <strong><small><?php echo $cmrow['comment_date']; ?></small></strong> Username:
                                    <small class="text-capitalize"><strong>
                                            <?php echo $username_comm; ?></small></strong></span>
                            </div>
                            <div class="card-body">
                                <p><?php  echo $cmrow['book_comment'];?> </p>
                            </div>
                        </div>

                        <?php      
                           }
                            
                          }
                      }
                    
    }
    else
    {
        echo "<h1 class='text-danger'> Sorry Book Data Not Available</h1>";
    }
}

else
{
    header("location:index.php");
}
?>
                        <script src="js/bootstrap.min.js"></script>
                        <script src="js/bootstrap.esm.min.js"></script>
                        <script src="js/bootstrap.bundle.min.js"></script>
                        <script src="jquery-3.6.0"></script>
                        <script>
                            // $(document).ready(function(){ 
                            //     ('#save_comment').on("click", function(e){
                            //         alert("hiii");
                            //         e.preventDefault();// ye submit karne se rokta hai
                            //     var book_id = $("#book_id").val();
                            //     var user_id = $("#user_id").val();
                            //     var username = $("#username").val();
                            //     $.ajax({
                            //             url : "comment.php";
                            //             type : "POST",
                            //             data : {book_id:book_id, user_id:user_id, username:username}
                            //             success : function(data)
                            //             {
                            //                 if(data==1)
                            //                 {
                            //                     alert(" insert successfully ");
                            //                 }
                            //                 else
                            //                 {
                            //                     alert(" insert failed ");
                            //                 }
                            //             }
                            //     });
                            //     });
                            // });
                            <
                            script / >
<?php
session_start();
include 'connection.php';
if(isset($_SESSION['user_id']))
{
    $comment_id= $_GET['comment_id'];
    $comsql = "SELECT book_comment FROM comment WHERE comment_id =$comment_id";
    //echo $comsql;
    $comquery = $conn->query($comsql);
    if($comquery)
    {
    ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Update Comment </title>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5 bg-dark text-primary rounded"> Update comment Page</h1>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 bg-dark text-primary rounded">
            <?php
            $sqlupd = "select book_comment, comment_id from comment where comment_id = $comment_id";
            $queryupd =$conn->query($sqlupd);
            if($queryupd)
            {
                while( $row = $queryupd->fetch_assoc())
                {
                    //print_r($row);
                    $comment_id = $row['comment_id'];
                    $comment = $row['book_comment'];
                }
            }
            ?>
                <form method="POST" action="editcomment.php">
                    <input type="hidden" name="comment_id" value="<?php echo $comment_id;?>">

                    <h4 class="text-center text-warning"> Update  Comment </h4>

                    <div class="mb-3 mt-3">

                    <textarea class="form-control" maxlength="500" name="updcomment" id="updcomment"
                    placeholder="Update Your Feedback"  required rows="2"> <?php echo $comment;?></textarea>

                    </div>

                    <input type="submit" class="btn btn-success mt-1 mb-2 " name="submit" value="submit">
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <?php    
    }
    else
    {
       
    }
}
?>
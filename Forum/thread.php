<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <title>Welcome to iDiscuss - Coding Forums</title>
    <link rel="icon" type="image/x-icon" href="images/weblogo.png">
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <header>
        <?php include 'partials/_header.php'; ?>
    </header>


    <?php 
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_name'];
        }
   
    ?>

<?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method== 'POST'){
            //Insert comment into comments table
            $comment = $_POST['comment'];
            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment);
            $sno = $_POST['sno'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`,`comment_by`, `comment_time`) VALUES ('$comment', '$id','$sno', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Comment has been added!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }

        };
    ?>


    <!-- Category container starts here -->
    <div class="container my-3">
        <div class="jumbotron py-4">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. Create unique posts.Keep posts
                courteous.Use respectful language when posting.Posting content from private messages and displaying that
                subject matter on the public forum is prohibited.Edit and delete posts as necessary using the tools
                provided by the forum.</p>
            <p class="lead">
                posted by:<em> <?php echo $posted_by; ?></em>
            </p>
        </div>
    </div>

    <?php

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

            echo '<div class="container">
            <h1 class="py-2">Post a Comment</h1>
            <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                <div class="form-group">
                    <label for="comment">Type your Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                </div>
                <button type="submit" class="btn btn-success">Post Comment</button>
            </form>
        </div>';
        }
        else{
            echo '<div class="container">
            <h1 class="py-2">Post a Comment</h1>
            <p class="lead">You are not logged in. Please login to be able to post comments.</p>
            </div>
            ';
        }
    ?>

    <div class="container mb-5" style="min-height:433px;">
        <h1 class="py-2">Discussions</h1>
        <?php 
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($conn,$sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_time = $row['comment_time'];
                $thread_user_id = $row['comment_by'];
                $sql2 = "SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
            
                echo '<div class="media my-3">
                        <img class="mr-3" src="images/userdefaultimg.png" width="56px" alt="Generic placeholder image">
                        <div class="media-body">
                        <p class="font-weight-bold my-0">'.$row2['user_name'].' | '.$comment_time.'</p>
                            '. $content .'
                        </div>
                    </div>';
            }
            if($noResult){
                echo '<div class="jumbotron jumbotron-fluid py-4">
                <div class="container">
                    <p class="display-4">no Comments found</p>
                    <p class="lead">Be the first person to comment out</p>
                </div>
                </div>';
            }
        ?>
    </div>

    <footer class="bg-dark text-center text-white">
        <?php include 'partials/_footer.php'; ?>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
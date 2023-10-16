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
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE category_id=$id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
   
    ?>

    <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method== 'POST'){
            //Insert thread into db
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];
            $th_title = str_replace("<", "&lt;", $th_title);
            $th_title = str_replace(">", "&gt;", $th_title);

            $th_desc = str_replace("<", "&lt;", $th_desc);
            $th_desc = str_replace(">", "&gt;", $th_desc);
            $sno = $_POST['sno'];
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your thread has been added! Please wait for community to respond
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
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forums</h1>
            <?php
                $id = $_GET['catid'];
                echo'
                <p class="lead"><?php echo $catdesc; ?></p>
                <hr class="my-4">
                <p>This is a peer to peer forum. Create unique posts.Keep posts
                    courteous.Use respectful language when posting.Posting content from private messages and displaying that
                    subject matter on the public forum is prohibited.Edit and delete posts as necessary using the tools
                    provided by the forum.</p>
                <p class="lead">
                    <a class="btn btn-success btn-lg" href="threadlist.php?catid='.$id.'" role="button">Learn more</a>
                </p>';
            ?>
        </div>
    </div>

    <?php

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

            echo '<div class="container">
                <h1 class="py-2">Start a Disscussion</h1>
                <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                    <div class="form-group">
                        <label for="title">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="title"
                            placeholder="Enter title" required>
                        <small id="titleHelp" class="form-text text-muted">Keep your title as short and crisp as
                            possible</small>
                    </div>
                    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                    <div class="form-group">
                        <label for="desc">Ellaborate Your Concern</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>';
        }
        else{
            echo '<div class="container">
            <h1 class="py-2">Start a Disscussion</h1>
            <p class="lead">You are not logged in. Please login to be able to start a Discussion</p>
            </div>
            ';
        }
    ?>


    <div class="container mb-5" style="min-height:433px;">
        <h1 class="py-2">Browse Questions</h1>
        <?php 
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($conn,$sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $id = $row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_time = $row['timestamp'];
                $thread_user_id = $row['thread_user_id'];
                $sql2 = "SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                

                echo '<div class="media my-3">
                        <img class="mr-3" src="images/userdefaultimg.png" width="56px" alt="Generic placeholder image">
                        <div class="media-body">
                        <p class="font-weight-bold my-0">'.$row2['user_name'].' at '.$thread_time.'</p>
                            <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='. $id .'">'. $title .'</a></h5>
                            '. $desc .'
                        </div>
                    </div>';
                }
                // echo var_dump($noResult);
                if($noResult){
                    echo '<div class="jumbotron jumbotron-fluid py-4">
                    <div class="container">
                      <p class="display-4">no Threads found</p>
                      <p class="lead">Be the first person to ask a question</p>
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
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
    <style>
        #maincontainer{
            min-height:87vh;
        }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <header>
        <?php include 'partials/_header.php'; ?>
    </header>
    
    <!-- ALTER TABLE threads ADD FULLTEXT(`thread_title`,`thread_desc`); for FULLTEXT search-->
    <!-- Search results -->
    <div class="container my-3" id="maincontainer">
        <h1 class="py-3">Search results for <em>"<?php echo $_GET['search']?>"</em></h1>
        <hr>
        <?php
            $noResult = true;
            $query = $_GET["search"];
            $sql = "SELECT * FROM `threads` WHERE match (thread_title,thread_desc) against ('$query')";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $thread_id = $row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $url = "thread.php?threadid=". $thread_id;

                //Display the search result
                echo '<div class="result">
                    <h3>
                        <a href="'.$url.'" class="text-dark">'.$title.'</a>
                    </h3>
                    <p>'.$desc.'</p>
                </div>';
            }
            if($noResult){
                echo '<div class="jumbotron jumbotron-fluid py-4">
                <div class="container">
                    <p class="display-4">no Results found</p>
                    <p class="lead">Suggestions:
                        <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                        </ul>
                    </p>
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
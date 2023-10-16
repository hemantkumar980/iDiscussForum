<?php include 'partials/_dbconnect.php'; ?>
<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/forum">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Top Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql = "SELECT category_name, category_id FROM `categories`LIMIT 5";
        $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
          echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
            }
        echo '</div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" >Contact</a>
      </li>
    </ul>
    <div class="row mx-2">';
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" required>
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      <p class="text-light my-0 mx-2">Welcome '. $_SESSION['username'].' </p>
      <a href="partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a>
      </form>';
      
    }
    else{

    
        echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" required>
          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
        <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">SignUp</button>';
    }    
    echo '</div>
  </div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Signup Successfully!</strong> Now you can login
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" && isset($_GET['error'])){
  $err = $_GET['error'];
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error!</strong> '.$err.' 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if(isset($_GET['login']) && $_GET['login'] == "true"){
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You are logged in.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if(isset($_GET['login']) && $_GET['login'] == "false"){
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error!</strong> Invalid Credentials.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if(isset($_GET['logout']) && $_GET['logout'] == "true"){
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You are logged out.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>

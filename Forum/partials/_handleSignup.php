<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_dbconnect.php';
    $user_name = $_POST['uname'];
    $user_email = $_POST['signupEmail'];
    $user_password = $_POST['signupPassword'];
    $user_cpassword = $_POST['signupcPassword'];

    // Check whether this email exits
    $existSql = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email already in use";
    }
    else{
        if($user_password == $user_cpassword){
            $hash = password_hash($user_password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`,`user_email`, `user_password`, `timestamp`) VALUES('$user_name','$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError = "Password do not match";
            
        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=$showError");
}

?>
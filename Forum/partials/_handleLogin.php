<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['user_password'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION['useremail'] = $email;
                $_SESSION['username'] = $row['user_name'];
                header("Location: /forum/index.php?login=true");
            }
            else{
                header("Location: /forum/index.php?login=false");
                
            }
            
        }
    }
    else{
        header("Location: /forum/index.php?login=false");
    }

}


?>
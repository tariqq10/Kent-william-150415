<?php

require_once 'config.php';


$name = $email = $password = "";
$name_err = $email_err = $password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email address.";
    } else {
        
        $sql = "SELECT id FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
           
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = trim($_POST["email"]);

            
            if (mysqli_stmt_execute($stmt)) {
                
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email address is already registered.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }

    
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    
    if (empty($name_err) && empty($email_err) && empty($password_err)) {

        
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
           
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_password);

            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
                  
        if (mysqli_stmt_execute($stmt)) {
           
            header("location: login.php");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }
}


mysqli_close($conn);
}
?>


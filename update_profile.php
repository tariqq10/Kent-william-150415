<?php

session_start();

if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    header("location: login.php");
    exit;
}

require_once 'config.php';


$name = $email = $phone = $address = "";
$name_err = $email_err = $phone_err = $address_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        
        $sql = "SELECT id FROM users WHERE email = ? AND id <> ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "si", $param_email, $param_id);

          
            $param_email = trim($_POST["email"]);
            $param_id = $_SESSION["id"];

            
            if (mysqli_stmt_execute($stmt)) {
               
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "Email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

           
            mysqli_stmt_close($stmt);
        }
    }

    
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter your phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter your address.";
    } else {
        $address = trim($_POST["address"]);
    }

   
    if (empty($name_err) && empty($email_err) && empty($phone_err) && empty($address_err)) {
        
        $sql = "UPDATE users SET name=?, email=?, phone=?, address=? WHERE id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_email, $param_phone, $param_address, $param_id);

           
            $param_name = $name;
            $param_email = $email;
            $param_phone = $phone;
            $param_address = $address;
            $param_id = $_SESSION["id"];

            
            if (mysqli_stmt_execute($stmt)) {
                
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;

               
                header("location: profile.php");
                exit;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
}
?>
   

<?php


session_start();


if (!isset($_SESSION["user_id"])) {
    
    header("location: login.php");
    exit;
}

require_once "config.php";

$sql = "SELECT name, email FROM users WHERE id = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {
  
    mysqli_stmt_bind_param($stmt, "i", $param_user_id);

    
    $param_user_id = $_SESSION["user_id"];

    
    if (mysqli_stmt_execute($stmt)) {
        
        mysqli_stmt_bind_result($stmt, $name, $email);

        
        mysqli_stmt_fetch($stmt);
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

 
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome</title>
</head>

<body>
    <h1>Welcome, <?php echo $name; ?>!</h1>
    <p>Your email is: <?php echo $email; ?></p>
    <a href="logout.php">Logout</a>
</body>

</html>

<?php

session_start();

if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    header("location: login.php");
    exit;
}


require_once 'config.php';

$sql = "SELECT name, email, phone, address FROM users WHERE id = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
  
    mysqli_stmt_bind_param($stmt, "i", $param_id);

  
    $param_id = $_SESSION["id"];

    if (mysqli_stmt_execute($stmt)) {
        
        mysqli_stmt_store_result($stmt);

        
        if (mysqli_stmt_num_rows($stmt) == 1) {
           
            mysqli_stmt_bind_result($stmt, $name, $email, $phone, $address);
            if (mysqli_stmt_fetch($stmt)) {
               
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>User Profile</h1>
        <form action="update_profile.php" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" required value="<?php echo $name; ?>">

            <label for="email">Email</label>
            <input type="email" name="email" required value="<?php echo $email; ?>">

            <label for="phone">Phone</label>
            <input type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required value="<?php echo $phone; ?>">

        <label for="address">Address</label>
        <textarea name="address" required><?php echo $address; ?></textarea>

        <button type="submit" name="submit">Update Profile</button>
    </form>
    <br>
    <a href="logout.php">Log Out</a>
</div>
</body>
</html>
<?php
            }
        } else {
            
            header("location: login.php");
            exit;
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
 
mysqli_stmt_close($stmt);


mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>
<body>
    <div class="container">
        <center><h1><ul>Sign Up</ul></h1></center>
        <form action="register_process.php" method="post">
           <div><label for="name">Name</label>
            <input type="text" name="name" required></div>

            <div><label for="email">Email</label>
            <input type="email" name="email" required></div>

           <div><label for="password">Password</label>
            <input type="password" name="password" required></div>

            <button type="submit" name="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Log In</a></p>
    </div>
</body>
</html>

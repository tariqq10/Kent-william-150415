
<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <style>
        h1 {
  font-size: 36px;
  font-weight: bold;
  color: #333;
  text-align: center;
  margin-top: 30px;
  margin-bottom: 30px;
}
        form {
  background-color: #f7f7dc;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
  max-width: 500px;
  margin: 0 auto;
}

form label {
  display: block;
  font-size: 16px;
  font-weight: bold;
  color: #2979FF;
  margin-bottom: 5px;
}

form input[type="text"],
form input[type="email"],
form input[type="password"] {
  display: block;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  margin-bottom: 10px;
}

form button[type="submit"] {
  background-color: #2979FF;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
}

form button[type="submit"]:hover {
  background-color: #005eff;
}

    </style>
    

</head>
<body>
    <div class="container">
        <strong><h1>Log In</h1></strong>
        <form action="login_process.php" method="post">
            <div><label for="email">Email</label>
            <input type="email" name="email" required></div>

            <div><label for="password">Password</label>
            <input type="password" name="password" required></div>

            <button type="submit" name="submit">Log In</button>
        </form>
        <center><p>Don't have an account? <a href="register.php">Sign Up</a></p></center>
    </div>
</body>
</html>

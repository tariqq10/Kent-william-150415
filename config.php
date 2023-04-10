<?php
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];

$conn = new mysqli('localhost','root','','Data');
if($conn->connect_error){
    echo "$conn->connect_error";
    die("Connection Failed : ". $conn->connect_error);
} else {
    $stmt = $conn->prepare("insert into users(name,email, password,)(?, ?, ?)");
    $stmt->bind_param("sss", $name,$email, $password,);
    $execval = $stmt->execute();
    echo $execval;
    echo "Registration successfully...";
    $stmt->close();
    $conn->close();
}
?>
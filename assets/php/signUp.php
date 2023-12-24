<?php
$username=$_POST['username'];
$password=$_POST['password'];
echo `$username`;

// Database Connection 
$conn=new mysqli('localhost','root','','resturantly');
if($conn->connect_error){
    die('Connection Failed'.$conn->connect_error );
}
else{
    $stmt=$conn->prepare("insert into signUp(username,password ) values(?,?)");
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();
    header("Location: /signIn.html");
    $stmt->close();
    $conn->close();
}
?>
<!doctype html>

<html lang="en">

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
<head>

  <meta charset="UTF-8">

  <title>CodePen - Animated Login Form using Html &amp; CSS Only</title>

  <link rel="stylesheet" href="./assets/css/signIn.css">

</head>

<body> <!-- partial:index.partial.html -->

  <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <span></span> <span></span> <span></span> <span></span> <span></span>

    <div class="signin">

      <div class="content">

        <h2>Sign Up</h2>



        <form class="form" action="" method="post">

          <div class="inputBox">

            <input type="text" name="username" required> <i>Username</i>

          </div>

          <div class="inputBox">

            <input type="password" name="password" required> <i>Password</i>

          </div>

          <div class="links"> <a href="#">Forgot Password</a> <a href="./signIn.html">SignIn</a>

          </div>

          <div class="inputBox">

            <input type="submit" value="Sign Up">

          </div>

        </form>

      </div>

    </div>

  </section> <!-- partial -->

</body>

</html>
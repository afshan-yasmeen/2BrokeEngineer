<?php
include('./inc/db.php');
include('./inc/function.php');
$attempt_alert = '';
$alert = '';
if (isset($_POST["register"])) {
  $result = array();
  $username = $_POST['username'];
  $password = $_POST['password'];
  $user_encrypted_password = password_hash($password, PASSWORD_DEFAULT);
  $register_user_data = array(
    'username' => $username,
    'password' => $user_encrypted_password,
  );
  $username_count = count_records('signup', '', array("username" => "$username"));

  if ($username_count > 0) {
    $result[] = "Username is already exist";
  }else{
  $result = insert('signup', $register_user_data, [], 'Successfully Register');
  }
  $alert = '';
  $alert_message = '';
  if (is_array($result)) {
    foreach ($result as $error) {
      $alert_message .= $error . '<br>';
      $alert = 'danger';
    }
  } else {
    $alert = 'success';
    $alert_message = $result;
    //redirect("./verify.php?user_id=$user_id");
  }
  $attempt_alert =  "<div class='alert alert-$alert' style='text-align:center; background-color:green;'>$alert_message</div>";
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CodePen - Animated Login Form using Html &amp; CSS Only</title>
  <link rel="stylesheet" href="./assets/css/signIn.css">
</head>

<body> <!-- partial:index.partial.php -->
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
          <?= $attempt_alert; ?>
          <div class="inputBox">
            <input type="text" name="username" required> <i>Username</i>
          </div>
          <div class="inputBox">
            <input type="password" name="password" required> <i>Password</i>
          </div>
          <div class="links"> <a href="#">Forgot Password</a> <a href="./signIn.php">SignIn</a>
          </div>
          <div class="inputBox">
            <input type="submit" name="register" value="Sign Up">
          </div>
        </form>
      </div>
    </div>
  </section> <!-- partial -->
</body>

</html>
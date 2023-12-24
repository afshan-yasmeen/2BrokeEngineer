<?php
include('./inc/db.php');
include('./inc/function.php');
$attempt_alert = '';
$alert = '';
$alert_message = '';
if (isset($_POST["login"])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $user_input_count = count_records('signup', '', array("username" => "$username"));
  $result = array();
  if ($user_input_count == 0) {
    $result[] = "Email or username is not found";
  } else {
    $results = select('signup', '*', "username = '$username'");
    if (is_array($results)) {
      foreach ($results as $row) {
        if (password_verify($password, $row["password"])) {
          redirect("./index.php");
        } else {
          $result[] = "Wrong Password";
        }
      }
    }
  }
  if (is_array($result)) {
    foreach ($result as $error) {
      if (is_array($error)) {
        $alert_message .= array_to_string($error) . '<br>';
      } else {
        $alert_message .= $error . '<br>';
      }
      $alert = 'danger';
    }
  } else {
    $alert = 'success';
    $alert_message = $result;
  }
  $attempt_alert =  "<div class='alert alert-$alert' style='text-align:center;  background-color:green;'>$alert_message</div>";
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
  <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
    <div class="signin">
      <div class="content">
        <h2>Sign In</h2>
        <form class="form" action="" method="post">
          <?= $attempt_alert; ?>
          <div class="inputBox">
            <input type="text" name="username" required> <i>Username</i>
          </div>
          <div class="inputBox">
            <input type="password" name="password" required> <i>Password</i>
          </div>
          <div class="links"> <a href="#">Forgot Password</a> <a href="./signUp.php">Signup</a>
          </div>
          <div class="inputBox">
            <input type="submit" name="login" value="Login">
          </div>
        </form>
      </div>
    </div>
  </section> <!-- partial -->
</body>
</html>
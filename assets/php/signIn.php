<?php

    // Get user input from the login form
    $loginUsername = $_POST['username'];
    $loginPassword = $_POST['password'];

    // Database Connection
    $conn = new mysqli('localhost', 'root', '', 'resturantly');
    if ($conn->connect_error) {
        die('Connection Failed' . $conn->connect_error);
    } else {
        // Check if the user exists in the database
        $stmt = $conn->prepare("SELECT username, password FROM signUp WHERE username = ?");
        $stmt->bind_param("s", $loginUsername);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // User exists, fetch the stored password
            $stmt->bind_result($storedUsername, $storedPassword);
            $stmt->fetch();

            // Verify the entered password against the stored password
            if ($loginPassword== $storedPassword) {
                // Password is correct, login successful
                session_start();
                $_SESSION['username'] = $loginUsername;
                header("Location: /index.html"); // Redirect to the dashboard or another authenticated page
                exit();
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "User not found";
        }

        $stmt->close();
        $conn->close();
    }

?>

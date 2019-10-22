<?php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Define variables and initialize with empty values
$email = $password = "";
$login_err = $email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(sanitizeInput($_POST["email"]))) {
        $login_err = "Please enter email.";
    } else {
        $email = sanitizeInput($_POST["email"]);
    }

    // Check if password is empty
    if (empty(sanitizeInput($_POST["password"]))) {
        $login_err = "Please enter your password.";
    } else {
        $password = sanitizeInput($_POST["password"]);
    }

    // Validate credentials
    if (empty($login_err)) {
        $sql = "SELECT user_id, email, password FROM user WHERE email = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["userId"] = $id;
                            $_SESSION["email"] = $email;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else {
                            $login_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    $login_err = "No account found with that email address.";
                }
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
<?php
// Define variables and initialize with empty values
$firstName = $lastName = $email = $password = $confirm_password = "";
$register_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Names
    if (empty(sanitizeInput($_POST["firstName"])) || empty(sanitizeInput($_POST["lastName"]))) {

    } else {
        $param_firstName = sanitizeInput($_POST["firstName"]);
        $param_lastName = sanitizeInput($_POST["lastName"]);
    }

    // Email
    if (empty(sanitizeInput($_POST["email"]))) {
        $register_err = "Please enter a email.";
    } else {
        $sql = "SELECT user_id FROM user WHERE email = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = sanitizeInput($_POST["email"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $register_err = "This email is already taken.";
                } else {
                    $email = sanitizeInput($_POST["email"]);
                }
            }
        }
        mysqli_stmt_close($stmt);
    }

    // Password
    if (empty(sanitizeInput($_POST["password"]))) {
        $register_err = "Please enter a password.";
    } elseif (sanitizeInput($_POST["password"]) < 6) {
        $register_err = "Password must have at least 6 characters.";
    } else {
        $password = sanitizeInput($_POST["password"]);
    }

    // Confirm password
    if (empty(sanitizeInput($_POST["confirm_password"]))) {
        $register_err = "Please confirm password.";
    } else {
        $confirm_password = sanitizeInput($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $register_err = "Password did not match.";
        }
    }

    // Inserts data
    if (empty($register_err)) {
        $sql = "INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_firstName, $param_lastName, $param_email, $param_password);

            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            if (mysqli_stmt_execute($stmt)) {
                $url = "index.php?" . pageKey . "=" . pageIdLogin;
                header("location: $url");
            }
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
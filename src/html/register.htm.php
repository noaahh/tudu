<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Tudu</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="style/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Organize life</h1>
    <h1 class="h3 mb-3 font-weight-normal">Then go enjoy it…</h1>

    <div class="form-group">
        <label for="firstName" class="sr-only">First Name</label>
        <input type="text" name="firstName" class="form-control" placeholder="First Name" required autofocus>
    </div>
    <div class="form-group">
        <label for="lastName" class="sr-only">Last Name</label>
        <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>

    </div>

    <div class="form-group">
        <label for="email" class="sr-only">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email address" required>
    </div>

    <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>

    </div>

    <div class="form-group">
        <label for="confirm_password" class="sr-only">Confirm password</label>
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" required>
    </div>

    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    </div>

    <?php
    $loginUrl = "index.php?" . pageKey . "=" . pageIdLogin;
    echo "<a href='$loginUrl'>Login</a>";

    if (!empty($register_err)) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">$register_err</div>";
    }

    echo "<p class=\"mt-5 mb-3 text-muted\">&copy; Tudu 2019</p>";
    ?>
</form>
</body>
</html>